<?php
require_once __DIR__ . '/passwords.php';
require_once dirname(__DIR__, 2) . '/config/session.php';
function signupError(string $message, int $status = 400): never
{
    http_response_code($status);
    header('Content-Type: text/html; charset=utf-8');
    echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    echo ' <a href="signup.php">Return to signup</a>';
    exit;
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    signupError('Please submit the signup form.', 405);
}
if (!appValidCsrf($_POST['csrf_token'] ?? null)) {
    signupError('Please reload the signup page and try again.', 403);
}
$username = is_string($_POST['username'] ?? null) ? trim($_POST['username']) : '';
$email = is_string($_POST['email'] ?? null) ? trim($_POST['email']) : '';
$password = $_POST['password1'] ?? null;
$confirmation = $_POST['password2'] ?? null;
if ($username === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)
    || !is_string($password) || $password === '' || !is_string($confirmation)
    || $confirmation === '' || $password !== $confirmation) {
    signupError('Enter a username, a valid email, and matching passwords.');
}
if (strlen($username) > 20 || strlen($email) > 30) {
    signupError('Username must be at most 20 bytes and email at most 30 bytes.');
}
if (!passwordCanBeHashed($password)) {
    signupError('Password must contain no null bytes and be at most 72 bytes.');
}
try {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    require_once dirname(__DIR__, 2) . '/config/database.php';
    $conn = databaseMysqli('mens_daydb');
    $check = $conn->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
    $check->bind_param('ss', $username, $email);
    $check->execute();
    if ($check->get_result()->num_rows > 0) {
        signupError('Unable to create an account with those details.', 409);
    }
    $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    $stmt->bind_param('sss', $username, $email, $hash);
    $stmt->execute();
    header('Location: login.php', true, 303);
    exit;
} catch (Throwable $error) {
    signupError('Unable to create your account. Please check your details and try again.');
}
