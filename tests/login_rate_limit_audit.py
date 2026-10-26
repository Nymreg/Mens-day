"""Source checks for the account login limit."""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
handler = (ROOT / 'Pages/Login Page/login_conn_db.php').read_text(encoding='utf-8')

assert 'failed_attempts = ?, locked_until = CASE WHEN ? >= 5 THEN DATE_ADD(UTC_TIMESTAMP(), INTERVAL 120 SECOND)' in handler
assert "prepare('SELECT id, username, password FROM users WHERE username = ?')" in handler
assert 'prepare("SELECT failed_attempts, locked_until' in handler
assert 'LOGIN_RATE_LIMIT_KEY' not in handler
assert 'hash_hmac(' not in handler
print('PASS: five failures trigger a 120-second account lock using prepared statements without a key')
