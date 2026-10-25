<?php
// Keep warnings/fatal details out of the JSON response.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ob_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
function loginDiagnosticId(): string
{
    return bin2hex(random_bytes(16));
}
function logLoginDiagnostic(string $category, string $correlationId): void
{
    error_log(json_encode([
        'event' => 'login_backend_error',
        'category' => $category,
        'correlation_id' => $correlationId,
    ]));
}
register_shutdown_function(static function (): void {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        ob_clean();
        $correlationId = loginDiagnosticId();
        logLoginDiagnostic('php_fatal', $correlationId);
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Unable to sign in right now. Please try again later.',
            'correlation_id' => $correlationId,
        ]);
    }
});
function loginError(string $message, int $status = 400, array $details = []): never
{
    unset($_SESSION['username'], $_SESSION['is_admin'], $_SESSION['user_id']);
    http_response_code($status);
    exit(json_encode(['status' => 'error', 'message' => $message] + $details));
}
function loginRateLimitState(mysqli $conn, string $scope, string $subjectHash): array
{
    $insert = $conn->prepare('INSERT IGNORE INTO login_rate_limits (scope, subject_hash, failed_attempts, window_started_at, updated_at) VALUES (?, ?, 0, UTC_TIMESTAMP(), UTC_TIMESTAMP())');
    $insert->bind_param('ss', $scope, $subjectHash);
    $insert->execute();
    $select = $conn->prepare('SELECT failed_attempts, locked_until, GREATEST(0, TIMESTAMPDIFF(SECOND, UTC_TIMESTAMP(), locked_until)) AS remaining_seconds, TIMESTAMPDIFF(SECOND, window_started_at, UTC_TIMESTAMP()) AS window_age FROM login_rate_limits WHERE scope = ? AND subject_hash = ? FOR UPDATE');
    $select->bind_param('ss', $scope, $subjectHash);
    $select->execute();
    return $select->get_result()->fetch_assoc();
}
function resetLoginRateLimit(mysqli $conn, string $scope, string $subjectHash): void
{
    $reset = $conn->prepare('UPDATE login_rate_limits SET failed_attempts = 0, locked_until = NULL, window_started_at = UTC_TIMESTAMP(), updated_at = UTC_TIMESTAMP() WHERE scope = ? AND subject_hash = ?');
    $reset->bind_param('ss', $scope, $subjectHash);
    $reset->execute();
}
function recordLoginFailure(mysqli $conn, string $scope, string $subjectHash, int $attempts, int $threshold, int $lockMinutes): void
{
    $update = $conn->prepare('UPDATE login_rate_limits SET failed_attempts = ?, locked_until = CASE WHEN ? >= ? THEN DATE_ADD(UTC_TIMESTAMP(), INTERVAL ? MINUTE) ELSE NULL END, updated_at = UTC_TIMESTAMP() WHERE scope = ? AND subject_hash = ?');
    $update->bind_param('iiiiss', $attempts, $attempts, $threshold, $lockMinutes, $scope, $subjectHash);
    $update->execute();
}
function loginClientAddress(): string
{
    $address = $_SERVER['REMOTE_ADDR'] ?? '';
    if (getenv('TRUST_PROXY_HEADERS') === 'true') {
        $forwarded = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'] ?? '');
        $proxyAddress = trim($forwarded[0] ?? '');
        if (filter_var($proxyAddress, FILTER_VALIDATE_IP)) {
            $address = $proxyAddress;
        }
    }
    return filter_var($address, FILTER_VALIDATE_IP) ? $address : 'unknown';
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    loginError('Please submit the login form.', 405);
}
$username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
$password = $_POST['password'] ?? null;
if ($username === '' || !is_string($password) || $password === '') {
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
    $rateLimitKey = getenv('LOGIN_RATE_LIMIT_KEY');
    if (!is_string($rateLimitKey) || strlen($rateLimitKey) < 32) {
        throw new RuntimeException('Missing or weak login rate-limit key.');
    }
    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $candidates = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $candidateIds = array_map(static fn(array $candidate): int => (int) $candidate['id'], $candidates);
    sort($candidateIds, SORT_NUMERIC);
    $accountIdentity = $candidateIds
        ? 'account:' . implode(':', $candidateIds)
        : 'unknown:' . strtolower($username);
    $accountHash = hash_hmac('sha256', $accountIdentity, $rateLimitKey);
    $ipHash = hash_hmac('sha256', 'ip:' . loginClientAddress(), $rateLimitKey);

    $conn->begin_transaction();
    $states = [];
    foreach (['account' => $accountHash, 'ip' => $ipHash] as $scope => $subjectHash) {
        $state = loginRateLimitState($conn, $scope, $subjectHash);
        $remainingSeconds = $state['remaining_seconds'] === null ? 0 : (int) $state['remaining_seconds'];
        $expiredLock = $state['locked_until'] !== null && $remainingSeconds === 0;
        $expiredIpWindow = $scope === 'ip' && (int) $state['window_age'] >= 900;
        if ($expiredLock || $expiredIpWindow) {
            resetLoginRateLimit($conn, $scope, $subjectHash);
            $state['failed_attempts'] = 0;
            $state['locked_until'] = null;
            $state['remaining_seconds'] = 0;
        }
        $state['subject_hash'] = $subjectHash;
        $states[$scope] = $state;
    }
    if ($states['account']['locked_until'] !== null) {
        $conn->commit();
        loginError('Too many failed login attempts. Please try again after 5 minutes.', 429, [
            'remaining_attempts' => 0,
            'remaining_seconds' => (int) $states['account']['remaining_seconds'],
        ]);
    }
    if ($states['ip']['locked_until'] !== null) {
        $conn->commit();
        loginError('Too many login attempts from this network. Please try again later.', 429, [
            'remaining_seconds' => (int) $states['ip']['remaining_seconds'],
        ]);
    }

    // The existing data can contain duplicate usernames.
    foreach ($candidates as $row) {
        if (!accountPasswordMatches($password, $row['password'])) continue;
        if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // Do not overwrite a concurrently changed password.
            $update = $conn->prepare('UPDATE users SET password = ? WHERE id = ? AND BINARY password = BINARY ?');
            $update->bind_param('sis', $hash, $row['id'], $row['password']);
            $update->execute();
            if ($update->affected_rows !== 1) loginError('Please try signing in again.', 409);
        }
        resetLoginRateLimit($conn, 'account', $accountHash);
        resetLoginRateLimit($conn, 'ip', $ipHash);
        $conn->commit();
        if (!session_regenerate_id(true)) {
            loginError('Unable to start your session. Please try again later.', 503);
        }
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_id'] = (int) $row['id'];
        require_once dirname(__DIR__, 2) . '/config/session.php';
        $_SESSION['is_admin'] = appIsAdmin();
        unset($_SESSION['csrf_token']);
        $redirect = $_SESSION['is_admin']
            ? '/Pages/Admin%20Page/account_management.php'
            : '/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php';
        exit(json_encode(['status' => 'success', 'message' => 'Welcome back!', 'redirect' => $redirect]));
    }
    $accountAttempts = (int) $states['account']['failed_attempts'] + 1;
    $ipAttempts = (int) $states['ip']['failed_attempts'] + 1;
    recordLoginFailure($conn, 'account', $accountHash, $accountAttempts, 5, 5);
    recordLoginFailure($conn, 'ip', $ipHash, $ipAttempts, 20, 15);
    $conn->commit();
    if ($accountAttempts >= 5) {
        loginError('Too many failed login attempts. Please try again after 5 minutes.', 429, [
            'remaining_attempts' => 0,
            'remaining_seconds' => 300,
        ]);
    }
    if ($ipAttempts >= 20) {
        loginError('Too many login attempts from this network. Please try again later.', 429, [
            'remaining_seconds' => 900,
        ]);
    }
    loginError('Invalid username or password.', 401, [
        'remaining_attempts' => 5 - $accountAttempts,
    ]);
} catch (Throwable $error) {
    $category = $error instanceof mysqli_sql_exception
        ? 'database_error'
        : ($error instanceof RuntimeException && $error->getMessage() === 'Missing or weak login rate-limit key.'
            ? 'rate_limit_config_error'
            : 'unexpected_backend_error');
    $correlationId = loginDiagnosticId();
    logLoginDiagnostic($category, $correlationId);
    loginError('Unable to sign in right now. Please try again later.', 503, [
        'correlation_id' => $correlationId,
    ]);
}
