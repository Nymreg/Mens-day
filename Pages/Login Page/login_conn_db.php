<?php
ini_set('display_errors', '0');
ini_set('log_errors', '1');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function loginError(string $message, int $status = 400, array $details = []): never
{
    unset($_SESSION['username'], $_SESSION['is_admin'], $_SESSION['user_id']);
    http_response_code($status);
    exit(json_encode(['status' => 'error', 'message' => $message] + $details));
}

function accountRateLimitState(mysqli $conn, string $accountHash): array
{
    $insert = $conn->prepare("INSERT IGNORE INTO login_rate_limits (scope, subject_hash, failed_attempts, window_started_at, updated_at) VALUES ('account', ?, 0, UTC_TIMESTAMP(), UTC_TIMESTAMP())");
    $insert->bind_param('s', $accountHash);
    $insert->execute();

    $select = $conn->prepare("SELECT failed_attempts, locked_until, locked_until > UTC_TIMESTAMP() AS is_locked, GREATEST(0, TIMESTAMPDIFF(SECOND, UTC_TIMESTAMP(), locked_until)) AS remaining_seconds FROM login_rate_limits WHERE scope = 'account' AND subject_hash = ? FOR UPDATE");
    $select->bind_param('s', $accountHash);
    $select->execute();
    return $select->get_result()->fetch_assoc();
}

function resetAccountRateLimit(mysqli $conn, string $accountHash): void
{
    $reset = $conn->prepare("UPDATE login_rate_limits SET failed_attempts = 0, locked_until = NULL, window_started_at = UTC_TIMESTAMP(), updated_at = UTC_TIMESTAMP() WHERE scope = 'account' AND subject_hash = ?");
    $reset->bind_param('s', $accountHash);
    $reset->execute();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    loginError('Please submit the login form.', 405);
}

$username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
$statusRequest = ($_POST['action'] ?? null) === 'lockout_status';
$password = $_POST['password'] ?? null;
if ($username === '' || (!$statusRequest && (!is_string($password) || $password === ''))) {
    loginError('Please fill in both username and password.');
}

try {
    require_once dirname(__DIR__, 2) . '/config/session.php';
    if (session_status() !== PHP_SESSION_ACTIVE) {
        loginError('Unable to start your session. Please try again later.', 503);
    }
    if (!appValidCsrf($_POST['csrf_token'] ?? null)) {
        http_response_code(403);
        exit(json_encode(['status' => 'error', 'message' => 'Please reload the login page and try again.']));
    }

    require_once __DIR__ . '/passwords.php';
    require_once dirname(__DIR__, 2) . '/config/database.php';
    $conn = databaseMysqli('mens_daydb');
    $conn->query("CREATE TABLE IF NOT EXISTS login_rate_limits (
        scope ENUM('account', 'ip') NOT NULL,
        subject_hash CHAR(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
        failed_attempts SMALLINT UNSIGNED NOT NULL DEFAULT 0,
        window_started_at DATETIME NOT NULL,
        locked_until DATETIME DEFAULT NULL,
        updated_at DATETIME NOT NULL,
        PRIMARY KEY (scope, subject_hash),
        KEY locked_until (locked_until)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");

    $accountHash = hash('sha256', strtolower(trim($username)));
    $conn->begin_transaction();
    $state = accountRateLimitState($conn, $accountHash);

    if ((int) $state['is_locked'] === 1) {
        $conn->commit();
        if ($statusRequest) {
            exit(json_encode([
                'status' => 'status',
                'locked' => true,
                'remaining_seconds' => (int) $state['remaining_seconds'],
            ]));
        }
        loginError('Too many failed login attempts. Please try again in', 429, [
            'remaining_attempts' => 0,
            'remaining_seconds' => (int) $state['remaining_seconds'],
            'lockout_type' => 'account',
        ]);
    }

    if ($state['locked_until'] !== null) {
        resetAccountRateLimit($conn, $accountHash);
        $state['failed_attempts'] = 0;
    }

    if ($statusRequest) {
        $conn->commit();
        exit(json_encode(['status' => 'status', 'locked' => false, 'remaining_seconds' => 0]));
    }

    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $candidates = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    foreach ($candidates as $row) {
        if (!accountPasswordMatches($password, $row['password'])) {
            continue;
        }
        if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $update = $conn->prepare('UPDATE users SET password = ? WHERE id = ? AND BINARY password = BINARY ?');
            $update->bind_param('sis', $hash, $row['id'], $row['password']);
            $update->execute();
            if ($update->affected_rows !== 1) {
                loginError('Please try signing in again.', 409);
            }
        }

        resetAccountRateLimit($conn, $accountHash);
        $conn->commit();
        if (!session_regenerate_id(true)) {
            loginError('Unable to start your session. Please try again later.', 503);
        }
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = (int) $row['id'];
        $_SESSION['is_admin'] = appIsAdmin();
        unset($_SESSION['csrf_token']);
        $redirect = $_SESSION['is_admin']
            ? '/Pages/Admin%20Page/account_management.php'
            : '/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php';
        exit(json_encode(['status' => 'success', 'message' => 'Welcome back!', 'redirect' => $redirect]));
    }

    $attempts = (int) $state['failed_attempts'] + 1;
    $failure = $conn->prepare("UPDATE login_rate_limits SET failed_attempts = ?, locked_until = CASE WHEN ? >= 5 THEN DATE_ADD(UTC_TIMESTAMP(), INTERVAL 120 SECOND) ELSE NULL END, updated_at = UTC_TIMESTAMP() WHERE scope = 'account' AND subject_hash = ?");
    $failure->bind_param('iis', $attempts, $attempts, $accountHash);
    $failure->execute();

    $remainingSeconds = 0;
    if ($attempts >= 5) {
        $state = accountRateLimitState($conn, $accountHash);
        $remainingSeconds = (int) $state['remaining_seconds'];
    }
    $conn->commit();

    if ($attempts >= 5) {
        loginError('Too many failed login attempts. Please try again in', 429, [
            'remaining_attempts' => 0,
            'remaining_seconds' => $remainingSeconds,
            'lockout_type' => 'account',
        ]);
    }
    loginError('Invalid username or password.', 401, [
        'remaining_attempts' => 5 - $attempts,
    ]);
} catch (mysqli_sql_exception) {
    error_log('LOGIN_DB: login database operation failed');
    loginError('Unable to sign in right now. Please try again later.', 503);
} catch (Throwable $error) {
    loginError('Unable to sign in right now. Please try again later.', 503);
}
