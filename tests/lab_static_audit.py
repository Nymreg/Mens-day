
"""Offline security checks for the retired SQL injection lab.

Does not send HTTP requests or connect to MySQL.
"""
from pathlib import Path

ROOT = Path(__file__).resolve().parents[1]
AUTH = ROOT / "Pages" / "Login Page"

secure = (AUTH / "login_conn_db.php").read_text(encoding="utf-8")
form = (AUTH / "login.php").read_text(encoding="utf-8")
js = (AUTH / "login.js").read_text(encoding="utf-8")

# The vulnerable demonstration endpoint must not be present.
assert not (AUTH / "login_conn_db_unsecured.php").exists(), (
    "Unsecured login endpoint still exists; remove it."
)

# Login form must submit to the secure handler and include CSRF protection.
assert 'action="login_conn_db.php"' in form
assert "appCsrfToken()" in form
assert "fetch(form.action," in js

# Secure handler must use a prepared statement and bound parameter.
assert "prepare('SELECT id, username, password FROM users WHERE username = ?')" in secure
assert "bind_param('s', $username)" in secure

# The secure handler must not enable the old lab mode.
assert "ENABLE_SQLI_LAB" not in secure
assert "DEBUG ERROR:" not in secure

print("PASS: unsecured endpoint is retired or absent")
print("PASS: login form uses the secure handler and CSRF token")
print("PASS: secure login uses a prepared statement")
print("PASS: old lab mode and debug error exposure are absent")
