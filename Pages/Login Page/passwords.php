<?php
// PASSWORD_DEFAULT uses bcrypt in PHP 8.3; reject input it would truncate.
function passwordCanBeHashed(string $password): bool
{
    return strlen($password) <= 72 && !str_contains($password, "\0");
}
function accountPasswordMatches(string $password, string $stored): bool
{
    if ($password === '' || !passwordCanBeHashed($password)) return false;
    if (password_get_info($stored)['algoName'] !== 'unknown') {
        return password_verify($password, $stored);
    }
    // Never authenticate using a truncated/unsupported hash as plaintext.
    if (str_starts_with($stored, '$')) return false;
    return hash_equals($stored, $password);
}
