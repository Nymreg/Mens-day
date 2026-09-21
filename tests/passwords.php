<?php
require_once __DIR__ . '/../Pages/Login Page/passwords.php';
function check(bool $result, string $label): void {
    if (!$result) throw new RuntimeException($label);
}
$password = '  Exact <password>  ';
$hash = password_hash($password, PASSWORD_DEFAULT);
check(accountPasswordMatches($password, $hash), 'Hashed password');
check(!accountPasswordMatches(trim($password), $hash), 'Whitespace preserved');
check(!accountPasswordMatches($hash, $hash), 'Hash is not a password');
check(accountPasswordMatches($password, $password), 'Legacy exact match');
check(!accountPasswordMatches(strtolower($password), $password), 'Legacy case sensitivity');
check(password_needs_rehash($password, PASSWORD_DEFAULT), 'Legacy migration required');
check(!accountPasswordMatches('$2y$10$truncated', '$2y$10$truncated'), 'Truncated hash rejected');
check(!accountPasswordMatches('', ''), 'Empty rejected');
check(!passwordCanBeHashed(str_repeat('a', 73)), 'Overlong password rejected');
check(!passwordCanBeHashed("a\0b"), 'Null byte rejected');
echo "10 password checks passed.\n";
