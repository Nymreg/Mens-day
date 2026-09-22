<?php
require_once dirname(__DIR__, 2) . '/config/session.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !appValidCsrf($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Unable to sign out. Return to your account and try again.');
}
$_SESSION = [];
if (ini_get('session.use_cookies')) {
    $cookie = session_get_cookie_params();
    setcookie(session_name(), '', time() - 3600, $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly']);
}
session_destroy();
header('Location: login.php', true, 303);
exit;
