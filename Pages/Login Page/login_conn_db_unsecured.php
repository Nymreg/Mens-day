<?php
ini_set('display_errors', '0');
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

function labLoginError(string $message, int $status): never
{
    http_response_code($status);
    exit(json_encode(['status' => 'error', 'message' => $message]));
}

// Exact opt-in, before sessions, database access, or authentication processing.
if (getenv('ENABLE_SQLI_LAB') !== 'true') {
    labLoginError('Security demonstration lab is disabled.', 403);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    labLoginError('Please submit the login form.', 405);
}

/*
 * INTENTIONALLY MISSING BRUTE-FORCE PROTECTION
 * FOR AUTHORIZED ACADEMIC SECURITY DEMONSTRATION.
 *
 * A production authentication system should implement appropriate
 * controls such as rate limiting, throttling, monitoring, MFA,
 * lockout policies, or other abuse-prevention mechanisms.
 */
try {
    require_once dirname(__DIR__, 2) . '/config/session.php';
    if (!appValidCsrf($_POST['csrf_token'] ?? null)) {
        labLoginError('Please reload the login page and try again.', 403);
    }
    unset($_SESSION['username'], $_SESSION['user_id'], $_SESSION['is_admin']);
    $username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
    $password = $_POST['password'] ?? null;
    if ($username === '' || !is_string($password) || $password === '') {
        labLoginError('Please fill in both username and password.', 400);
    }
    require_once __DIR__ . '/passwords.php';
    require_once dirname(__DIR__, 2) . '/config/database.php';
    $conn = databaseMysqli('mens_daydb');

    // Preserve ordinary hashed/legacy password checking without changing data.
    // This prepared lookup is NOT the final authentication decision in this lab.
    $candidate = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
    $candidate->bind_param('s', $username);
    $candidate->execute();
    $candidates = $candidate->get_result();
    $verifiedId = 0;
    $passwordMatched = 0;
    while ($candidateRow = $candidates->fetch_assoc()) {
        if (accountPasswordMatches($password, $candidateRow['password'])) {
            $verifiedId = (int) $candidateRow['id'];
            $passwordMatched = 1;
            break;
        }
    }

    /*
     * INTENTIONALLY VULNERABLE SQL-INJECTION LAB
     * FOR AUTHORIZED ACADEMIC DEMONSTRATION ONLY.
     * DO NOT USE IN PRODUCTION.
     */
    // UNSAFE: raw username becomes SQL syntax. Password validity is placed in
    // this alterable WHERE clause instead of being enforced by a PHP rejection.
    // Returning any row is the final login decision, so changing the SQL logic
    // can bypass even a failed password check. The secure handler never does this.
    $sql = "SELECT id, username FROM users WHERE username = '$username' AND id = $verifiedId AND $passwordMatched = 1";
    $row = $conn->query($sql)->fetch_assoc();
    if (!$row) {
        labLoginError('Invalid username or password. Please try again.', 401);
    }
    if (!session_regenerate_id(true)) {
        labLoginError('Unable to start your session. Please try again later.', 503);
    }
    $_SESSION['username'] = $row['username'];
    $_SESSION['user_id'] = (int) $row['id'];
    $_SESSION['is_admin'] = appIsAdmin();
    unset($_SESSION['csrf_token']);
    $redirect = $_SESSION['is_admin']
        ? '/Pages/Admin%20Page/account_management.php'
        : '/Pages/Landing%20Page/Landing%20Page%20Men%27s%20Day.php';
    exit(json_encode(['status' => 'success', 'message' => 'Lab authentication succeeded.', 'redirect' => $redirect]));
} catch (Throwable $error) {
    labLoginError('Unable to sign in right now. Please try again later.', 503);
}
