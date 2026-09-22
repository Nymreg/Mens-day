<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    if (!session_start(['use_strict_mode' => 1, 'cookie_httponly' => true, 'cookie_samesite' => 'Lax'])) {
        http_response_code(503);
        header('Content-Type: application/json; charset=utf-8');
        exit(json_encode(['status' => 'error', 'message' => 'Session temporarily unavailable. Please try again.']));
    }
}

function appIsLoggedIn(): bool
{
    return isset($_SESSION['username']) && is_string($_SESSION['username']) && $_SESSION['username'] !== '';
}

function appIsAdmin(): bool
{
    // Roles are assigned by trusted database IDs, never by a public username.
    $ids = array_filter(array_map('trim', explode(',', getenv('ADMIN_USER_IDS') ?: '')), 'ctype_digit');
    return appIsLoggedIn() && isset($_SESSION['user_id']) && in_array((string) $_SESSION['user_id'], $ids, true);
}

function appCsrfToken(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function appValidCsrf($token): bool
{
    return is_string($token) && isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
