<?php
// Keep warnings/fatal details out of the JSON response.
ini_set('display_errors', '0');
ob_start();
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
register_shutdown_function(static function (): void {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR], true)) {
        ob_clean();
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Unable to sign in right now. Please try again later.']);
    }
});
function loginError(string $message, int $status = 400): never
{
    unset($_SESSION['username'], $_SESSION['is_admin']);
    http_response_code($status);
    exit(json_encode(['status' => 'error', 'message' => $message]));
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
    if (!session_start()) {
        loginError('Unable to start your session. Please try again later.', 503);
    }
    require_once __DIR__ . '/passwords.php';
    require_once dirname(__DIR__, 2) . '/config/database.php';
    $conn = databaseMysqli('mens_daydb');
    $stmt = $conn->prepare('SELECT id, username, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();
    // The existing data can contain duplicate usernames.
    while ($row = $result->fetch_assoc()) {
        if (!accountPasswordMatches($password, $row['password'])) continue;
        if (password_needs_rehash($row['password'], PASSWORD_DEFAULT)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // Do not overwrite a concurrently changed password.
            $update = $conn->prepare('UPDATE users SET password = ? WHERE id = ? AND BINARY password = BINARY ?');
            $update->bind_param('sis', $hash, $row['id'], $row['password']);
            $update->execute();
            if ($update->affected_rows !== 1) loginError('Please try signing in again.', 409);
        }
        if (!session_regenerate_id(true)) {
            loginError('Unable to start your session. Please try again later.', 503);
        }
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_admin'] = ($row['username'] === 'admin');
        exit(json_encode(['status' => 'success', 'message' => 'Welcome back!']));
    }
    loginError('Invalid username or password. Please try again.', 401);
} catch (Throwable $error) {
    loginError('Unable to sign in right now. Please try again later.', 503);
}
