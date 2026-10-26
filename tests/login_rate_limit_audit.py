"""Source-level checks for persistent login account and IP rate limits."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
handler = (ROOT / 'Pages/Login Page/login_conn_db.php').read_text(encoding='utf-8')
script = (ROOT / 'Pages/Login Page/login.js').read_text(encoding='utf-8')
form = (ROOT / 'Pages/Login Page/login.php').read_text(encoding='utf-8')
schema = (ROOT / 'Database Schema/login_rate_limits.sql').read_text(encoding='utf-8')

assert 'CREATE TABLE `login_rate_limits`' in schema
assert "PRIMARY KEY (`scope`, `subject_hash`)" in schema
assert 'TIMESTAMPDIFF(SECOND, UTC_TIMESTAMP(), locked_until)' in handler
assert 'FOR UPDATE' in handler
assert 'DATE_ADD(UTC_TIMESTAMP(), INTERVAL ? MINUTE)' in handler
assert "recordLoginFailure($conn, 'account', $accountHash, $accountAttempts, 5, 5)" in handler
assert "recordLoginFailure($conn, 'ip', $ipHash, $ipAttempts, 20, 15)" in handler
assert "'remaining_attempts' => 5 - $accountAttempts" in handler
assert "'remaining_seconds' => 300" in handler
assert "appValidCsrf($_POST['csrf_token'] ?? null)" in handler
assert "prepare('SELECT id, username, password FROM users WHERE username = ?')" in handler
assert "getenv('LOGIN_RATE_LIMIT_KEY')" in handler
assert 'hash_hmac(' in handler
assert 'Warning: ${remainingAttempts} login attempts remaining.' in script
assert 'performance.now()' in script
assert 'id="login-feedback"' in form
print('PASS: database rate limits, parameterized authentication, CSRF, attempt feedback, and server-timed countdown source checks')