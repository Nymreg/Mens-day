"""Source checks for the account login limit."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
handler = (ROOT / 'Pages/Login Page/login_conn_db.php').read_text(encoding='utf-8')

assert 'CREATE TABLE IF NOT EXISTS login_rate_limits' in handler
assert 'WHEN ? >= 5 THEN DATE_ADD(UTC_TIMESTAMP(), INTERVAL 120 SECOND)' in handler
assert "prepare('SELECT id, username, password FROM users WHERE username = ?')" in handler
assert 'prepare("SELECT failed_attempts, locked_until' in handler
assert 'LOGIN_RATE_LIMIT_KEY' not in handler
assert 'hash_hmac(' not in handler
print('PASS: five attempts, 120-second lock, prepared statements, automatic table creation, and no custom key')
