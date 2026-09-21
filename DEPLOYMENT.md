# Render and Aiven deployment

The repository was inspected before edits: 66 PHP files, all HTML/JS/CSS source,
three SQL dumps, Dockerfile, and the asset inventory. There were 28 MySQLi
connection sites and no PDO connections. All 28 now use `config/database.php`.
The helper also provides `databasePdo()` for PDO callers. Both drivers require
TLS, verify the server certificate using the supplied CA, and check the session
SSL cipher. There is no plaintext connection fallback.

## Render settings

Create a Docker Web Service with repository root as the build context and
`./Dockerfile` as the Dockerfile path. Leave the Docker command unset so the
image starts Apache in the foreground. Set these environment variables:

| Variable | Value |
| --- | --- |
| DB_HOST | Aiven service hostname (not a URL or IP alias) |
| DB_PORT | Aiven service port from Connection information |
| DB_USER | Aiven database user with access to both databases |
| DB_PASSWORD | That user's password; enter only in Render |
| DB_SSL_CA | `/etc/secrets/ca.pem` |
| PORT | `80` (matches Apache's listening port) |

Download the service CA certificate from Aiven and add its complete PEM contents
as a Render secret file named `ca.pem`. Do not commit credentials or certificates.
Render mounts Docker runtime secret files at `/etc/secrets/<filename>`.
No DB_NAME variable is needed: application calls retain `mens_daydb` and `product`.
If Aiven IP filtering is enabled, allow your Render service's outbound IP ranges
and the workstation used for imports.

## Import commands (PowerShell)

Install the Oracle MySQL 8.4 command-line client (`mysql`, not `mysqlsh`). Run
from this repository's root. Replace the three connection placeholders and the
local CA path below. Passwords are entered at the prompt, never in the command.
Use an Aiven user allowed to create databases/tables for the import.

```powershell
$aivenHost = 'YOUR_AIVEN_HOST'
$aivenPort = 'YOUR_AIVEN_PORT'
$aivenUser = 'YOUR_AIVEN_USER'
$aivenCa = 'C:/secure/ca.pem'
$mysqlArgs = @('--host', $aivenHost, '--port', $aivenPort, '--user', $aivenUser, '--password', '--ssl-mode=VERIFY_IDENTITY', "--ssl-ca=$aivenCa", '--default-character-set=utf8mb4')

mysql @mysqlArgs --execute='CREATE DATABASE IF NOT EXISTS mens_daydb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci; CREATE DATABASE IF NOT EXISTS product CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;'
if ($LASTEXITCODE -ne 0) { throw 'Database creation failed' }
mysql @mysqlArgs --database=mens_daydb --execute='source Database Schema/mens_daydb.sql'
if ($LASTEXITCODE -ne 0) { throw 'mens_daydb import failed' }
mysql @mysqlArgs --database=product --execute='source Database Schema/product.sql'
if ($LASTEXITCODE -ne 0) { throw 'product import failed' }
mysql @mysqlArgs --execute="SHOW SESSION STATUS LIKE 'Ssl_cipher'; SHOW CREATE TABLE mens_daydb.users; SHOW TABLES FROM product;"
```

Import into empty databases only. These dumps contain data and are not repeatable
migrations; do not drop existing tables to resolve an import failure. Back up any
existing database first. Do not additionally import the Hats `transactions.sql`:
it is an older subset of `product.sql`. Existing IDs, unique email index, data,
and AUTO_INCREMENT counters are preserved. Password capacity is now 255 characters.

## Remaining checks before public launch

1. Commit/push the reviewed changes and deploy the Docker service on Render.
2. Verify `/` redirects to the landing page, and check navigation and assets.
3. Test signup, login, account management, and a checkout; confirm writes reach
   `mens_daydb.users` and `product.transactions` respectively.
4. Address pre-existing authentication problems before public launch: signup and
   admin account creation store plaintext passwords, login compares plaintext,
   and `admin_actions.php` has no server-side authorization check. These behaviors
   were not rewritten in this deployment change. The dumped users include
   truncated bcrypt hashes that cannot be repaired by widening the column; those
   users need password resets alongside a password_hash/password_verify migration.
5. PHP sessions are currently filesystem-based. Redeploys can log users out;
   multiple instances need shared session storage.

## Verification performed

All 68 PHP files (including the two additions) passed syntax checks with local
PHP 8.4. All 28 helper include paths resolve. Every CREATE TABLE in all three
dumps has an inline primary key, with no later ADD PRIMARY KEY. A repository scan
confirmed that application connection credentials are centralized in environment
lookups. `git diff --check` passed.

Docker and a MySQL client/server are unavailable in this workspace, and no Aiven
credentials were supplied. A PHP 8.3 container build, live TLS connection, actual
MySQL 8.4 imports, and browser smoke tests still need to run during deployment.

## File change summary

| File | Change |
| --- | --- |
| `config/database.php` | Added shared environment configuration and verified TLS connections for MySQLi and PDO; generic connection errors. |
| `Database Schema/mens_daydb.sql` | Inline users primary key; password widened to VARCHAR(255). |
| `Database Schema/product.sql` | Inline primary keys for all four tables. |
| `Pages/subAccessories/Hats Products/transactions.sql` | Inline primary key in legacy dump. |
| `Pages/Login Page/login_conn_db.php` | Shared connection to mens_daydb. |
| `Pages/Login Page/signup_conn_db.php` | Shared connection to mens_daydb. |
| `Pages/Admin Page/admin_actions.php` | Shared connection to mens_daydb; removed request-body logging that included passwords. |
| `Dockerfile` | PHP 8.3 Apache, MySQLi/PDO MySQL, production PHP settings, explicit app copies, Apache access rules. |
| `docker/apache-security.conf` | Disable directory listing and deny access to config and sensitive file types. |
| `index.php` | Redirect root requests to the existing landing page. |
| `.dockerignore` | Exclude repository metadata, SQL dumps, secrets, and development files from build context. |
| `.gitignore` | Ignore local environment files, certificates, and keys. |
| `DEPLOYMENT.md` | Deployment instructions, connection inventory, validation limits, and change summary. |

Each of these 25 checkout files now uses the shared connection to `product`;
checkout queries and response behavior are preserved:

- `Pages/subAccessories/Belts Pages/save_transaction.php`
- `Pages/subAccessories/Bracelet Products/save_transaction.php`
- `Pages/subAccessories/Hats Products/save_transaction.php`
- `Pages/subAccessories/Rings Products/save_transaction.php`
- `Pages/subAccessories/Watches Pages/save_transaction.php`
- `Pages/subBottoms/Chinos Products/save_transaction.php`
- `Pages/subBottoms/Jeans Products/save_transaction.php`
- `Pages/subBottoms/Shorts Products/save_transaction.php`
- `Pages/subBottoms/Sweatpants Products/save_transaction.php`
- `Pages/subBottoms/Trouser Products/save_transaction.php`
- `Pages/subFootwear/Boots Products/save_transaction.php`
- `Pages/subFootwear/Dress Shoes Products/save_transaction.php`
- `Pages/subFootwear/Sandals Products/save_transaction.php`
- `Pages/subFootwear/Slippers Products/save_transaction.php`
- `Pages/subFootwear/Sneakers Products/save_transaction.php`
- `Pages/subOutwear/Blazer Products/save_transaction.php`
- `Pages/subOutwear/Coats Products/save_transaction.php`
- `Pages/subOutwear/Jackets Products/save_transaction.php`
- `Pages/subOutwear/Raincoat Products/save_transaction.php`
- `Pages/subOutwear/Vest Products/save_transaction.php`
- `Pages/subTops/Hoodies Products/save_transaction.php`
- `Pages/subTops/Polo Shirts Products/save_transaction.php`
- `Pages/subTops/Shirts Products/save_transaction.php`
- `Pages/subTops/Sweaters Products/save_transaction.php`
- `Pages/subTops/Tshirts Products/save_transaction.php`
