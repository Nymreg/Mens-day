"""Offline source checks and SQL semantics on an in-memory synthetic database.

Does not send HTTP requests, connect to MySQL, or attempt password guessing.
SQLite checks the shared SQL expression semantics, not PHP/MySQL integration.
"""
from pathlib import Path
import re
import sqlite3

ROOT = Path(__file__).resolve().parents[1]
AUTH = ROOT / 'Pages' / 'Login Page'
lab = (AUTH / 'login_conn_db_unsecured.php').read_text(encoding='utf-8')
secure = (AUTH / 'login_conn_db.php').read_text(encoding='utf-8')
form = (AUTH / 'login.php').read_text(encoding='utf-8')
helper = (AUTH / 'passwords.php').read_text(encoding='utf-8')
database = (ROOT / 'config/database.php').read_text(encoding='utf-8')

gate = "if (getenv('ENABLE_SQLI_LAB') !== 'true')"
assert gate in lab
assert lab.index(gate) < lab.index("'/config/session.php'") < lab.index("databaseMysqli('mens_daydb')")
assert "labLoginError('Security demonstration lab is disabled.', 403);" in lab
assert "$labEnabled = getenv('ENABLE_SQLI_LAB') === 'true';" in form
assert "$labSelected = $labEnabled && ($_GET['mode'] ?? '') === 'lab';" in form
assert "$labSelected ? 'login_conn_db_unsecured.php' : 'login_conn_db.php'" in form
assert 'fetch(form.action,' in (AUTH / 'login.js').read_text(encoding='utf-8')
print('PASS: exact opt-in gate precedes authentication; secure form is default')

assert "prepare('SELECT id, username, password FROM users WHERE username = ?')" in secure
assert "bind_param('s', $username)" in secure
assert "accountPasswordMatches($password, $row['password'])" in secure
assert 'password_verify($password, $stored)' in helper
assert 'ENABLE_SQLI_LAB' not in secure
assert 'password_hash(' not in lab
assert not re.search(r'\b(?:UPDATE|INSERT|DELETE)\b', lab)
assert 'appValidCsrf(' in lab and 'session_regenerate_id(true)' in lab
assert "$_SESSION['is_admin'] = appIsAdmin();" in lab
assert 'MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true' in database
assert 'PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true' in database
print('PASS: secure password/query flow, lab read-only SQL, CSRF/session/role and TLS source checks')

# Exercise the actual lab query template with disposable, noncredential data.
template = re.search(r'\$sql = "([^"]+)";', lab)[1]
db = sqlite3.connect(':memory:')
db.execute('CREATE TABLE users (id INTEGER PRIMARY KEY, username TEXT)')
db.execute('INSERT INTO users VALUES (?, ?)', (1, 'synthetic-member'))
def lab_result(username, verified_id, matched):
    query = template.replace('$username', username).replace('$verifiedId', str(verified_id)).replace('$passwordMatched', str(matched))
    return db.execute(query).fetchone()

assert lab_result('synthetic-member', 1, 1) == (1, 'synthetic-member')
assert lab_result('synthetic-member', 0, 0) is None
sql_shaped_username = "' OR 1=1 -- "
assert lab_result(sql_shaped_username, 0, 0) == (1, 'synthetic-member')
assert db.execute('SELECT id, username FROM users WHERE username = ?', (sql_shaped_username,)).fetchone() is None
db.close()
print('PASS: synthetic SQL model accepts valid decision, rejects invalid decision, demonstrates lab bypass and bound-input contrast')
print('LIMIT: PHP execution, MySQL dialect/driver, HTTP sessions and repeated HTTP attempts require runtime verification')
