# Authorized authentication demonstration

The secure handler `Pages/Login Page/login_conn_db.php` is unchanged.
The separate `login_conn_db_unsecured.php` handler deliberately contains SQL
injection and has no rate limiting, lockout, progressive delay, CAPTCHA or IP
throttle. The existing secure handler also lacks those brute-force controls;
this version does not provide a protected brute-force comparison.

## Selection and deployment

- Default: lab disabled. Only the exact runtime value `ENABLE_SQLI_LAB=true`
  enables the lab endpoint. Missing, empty, `false`, `TRUE` and `1` are disabled.
- The normal `Pages/Login Page/login.php` always defaults to secure login.
- When enabled, its small mode indicator/link selects `login.php?mode=lab`.
  The form action changes and `login.js` submits that action.
- The endpoint independently checks the switch; a direct request cannot evade it.
- Disabled requests return HTTP 403 JSON: `Security demonstration lab is disabled.`
- On Render, add `ENABLE_SQLI_LAB=true` only for the controlled demonstration
  service. Existing DB variables, certificate secret and `ADMIN_USER_IDS` stay
  unchanged. No Aiven schema, password, credential or TLS changes are required.
- Setting the flag to `false` or removing it disables future lab authentication.
  It does not revoke sessions already issued. Sign out after demonstrations.
- No deployment, commit or push is performed by these changes.

## Deliberate authentication defect

The lab first performs a prepared candidate lookup and checks the supplied
password with the existing helper. It does not rehash or update passwords.
It then constructs a second SELECT with the raw username and the numeric password
decision embedded in its WHERE clause. Unlike the secure endpoint, it does not
reject a failed password decision in PHP before executing that query. Any row
returned by this alterable query establishes the session. Injected SQL can
therefore change the condition and bypass the password decision.

Normal accounts with supported hashes or supported legacy plaintext values
can log in normally. Existing truncated/unsupported hashes remain invalid.
The lab retains POST, CSRF, session regeneration and the existing admin-ID check.
An injection that selects an allowlisted account can still authenticate as that
account: preserving the authorization mechanism does not undo an authentication
bypass. The lab must remain confined to the authorized environment.

Failed password attempts do not create a retry counter or rotate the CSRF token;
each valid POST is processed again. Successful authentication rotates the session
ID and removes the old CSRF token as in the secure handler. No guessing utility
or dictionary is included. Production mitigations normally include per-account
and per-source throttling, monitoring, MFA and carefully designed lockout policy.

## Verification

`python -B tests/lab_static_audit.py` checks the switch, selected form action,
secure query/password helpers, lab read-only queries and preserved TLS options.
It exercises the actual unsafe query template against a synthetic in-memory
SQLite table to compare unsafe construction with parameter binding. This is
SQL-expression evidence, not a live PHP/MySQL test.

`python -B tests/static_audit.py` checks existing local paths, JavaScript syntax
and checkout wrappers. Its legacy-reference rule now permits only the login
form to select the lab handler. Docker assertions now permit the gated standalone
handler but still reject independent local database connections.

Before a classroom demonstration, verify on the isolated deployment: disabled
endpoint returns 403; secure login remains available; enabled lab form carries
CSRF; a known disposable account can log in; a small number of manual incorrect
attempts each return failure without lockout; session roles still follow the
configured allowlist. Do not use real credentials for demonstrations.
