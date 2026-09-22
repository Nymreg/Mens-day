<?php
require_once dirname(__DIR__, 2) . '/config/session.php';
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
function adminResponse(bool $success, string $message, int $status = 200): never {
    http_response_code($status);
    exit(json_encode(['success' => $success, 'message' => $message]));
}
if (!appIsAdmin()) adminResponse(false, 'Access denied.', 403);
$action = $_GET['action'] ?? '';
if (!in_array($action, ['list', 'add', 'delete', 'update_inline'], true)) adminResponse(false, 'Invalid action.', 400);
$method = $action === 'list' ? 'GET' : 'POST';
if ($_SERVER['REQUEST_METHOD'] !== $method) {
    header('Allow: ' . $method);
    adminResponse(false, 'Method not allowed.', 405);
}
if ($method === 'POST' && !appValidCsrf($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null)) adminResponse(false, 'Please reload the page and try again.', 403);
try {
    require_once dirname(__DIR__, 2) . '/config/database.php';
    $conn = databaseMysqli('mens_daydb');
    if ($action === 'list') {
        exit(json_encode($conn->query('SELECT id, username, email FROM users')->fetch_all(MYSQLI_ASSOC)));
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (!is_array($data)) adminResponse(false, 'Invalid request.', 400);
    if ($action === 'delete') {
        $id = filter_var($data['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if (!$id) adminResponse(false, 'Valid account ID required.', 400);
        if ($id === (int) $_SESSION['user_id']) adminResponse(false, 'You cannot delete your current account.', 400);
        $stmt = $conn->prepare('DELETE FROM users WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        adminResponse($stmt->affected_rows === 1, $stmt->affected_rows === 1 ? 'Account deleted successfully' : 'Account not found.');
    }
    $username = is_string($data['username'] ?? null) ? trim($data['username']) : '';
    $email = is_string($data['email'] ?? null) ? trim($data['email']) : '';
    if ($action === 'add') {
        if ($username === '' || strlen($username) > 20 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 30) adminResponse(false, 'Enter a username up to 20 bytes and a valid email up to 30 bytes.', 400);
        require_once dirname(__DIR__) . '/Login Page/passwords.php';
        $password = $data['password'] ?? null;
        if (!is_string($password) || $password === '' || !passwordCanBeHashed($password)) adminResponse(false, 'Invalid password length or format.', 400);
        $check = $conn->prepare('SELECT id FROM users WHERE username = ? OR email = ?');
        $check->bind_param('ss', $username, $email);
        $check->execute();
        if ($check->get_result()->num_rows) adminResponse(false, 'Account details already in use.', 409);
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $username, $email, $hash);
        $stmt->execute();
        adminResponse(true, 'Account created successfully');
    }
    $id = filter_var($data['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
    if (!$id || ($username === '' && $email === '') || strlen($username) > 20
        || ($email !== '' && (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 30))) adminResponse(false, 'Enter valid account changes.', 400);
    if ($username !== '') {
        $check = $conn->prepare('SELECT id FROM users WHERE username = ? AND id <> ?');
        $check->bind_param('si', $username, $id);
        $check->execute();
        if ($check->get_result()->num_rows) adminResponse(false, 'Account details already in use.', 409);
    }
    $stmt = $conn->prepare("UPDATE users SET username = COALESCE(NULLIF(?, ''), username), email = COALESCE(NULLIF(?, ''), email) WHERE id = ?");
    $stmt->bind_param('ssi', $username, $email, $id);
    $stmt->execute();
    if ($id === (int) $_SESSION['user_id'] && $username !== '') $_SESSION['username'] = $username;
    adminResponse(true, $stmt->affected_rows ? 'Account updated successfully' : 'No changes made.');
} catch (Throwable $error) {
    adminResponse(false, 'Unable to complete the account request.', 500);
}
