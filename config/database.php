<?php
// Shared configuration for both existing databases. Credentials are runtime-only.
function databaseConfig(string $database): array
{
    if (!in_array($database, ['mens_daydb', 'product'], true)) {
        throw new RuntimeException('Unsupported database.');
    }
    $config = [];
    foreach (['DB_HOST', 'DB_PORT', 'DB_USER', 'DB_PASSWORD', 'DB_SSL_CA'] as $name) {
        $value = getenv($name);
        if ($value === false || $value === '') {
            throw new RuntimeException('Missing database configuration.');
        }
        $config[$name] = $value;
    }
    if (!ctype_digit($config['DB_PORT']) || (int) $config['DB_PORT'] < 1 || (int) $config['DB_PORT'] > 65535
        || preg_match('/[;\s]/', $config['DB_HOST'])
        || !is_readable($config['DB_SSL_CA'])) {
        throw new RuntimeException('Invalid database configuration or unreadable CA certificate.');
    }
    return $config;
}

function databaseUnavailable(): never
{
    // Never expose driver exceptions, connection strings, or credentials.
    error_log('Database connection failed. Check runtime configuration, CA certificate, and Aiven connectivity.');
    http_response_code(503);
    header('Content-Type: application/json');
    exit(json_encode(['status' => 'error', 'success' => false, 'message' => 'Database temporarily unavailable.']));
}

function databaseMysqli(string $database): mysqli
{
    try {
        $config = databaseConfig($database);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $conn = mysqli_init();
        $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 10);
        $conn->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
        $conn->ssl_set(null, null, $config['DB_SSL_CA'], null, null);
        $conn->real_connect($config['DB_HOST'], $config['DB_USER'], $config['DB_PASSWORD'],
            $database, (int) $config['DB_PORT'], null, MYSQLI_CLIENT_SSL);
        $cipher = $conn->query("SHOW SESSION STATUS LIKE 'Ssl_cipher'")->fetch_row();
        if (empty($cipher[1])) {
            $conn->close();
            throw new RuntimeException('Encrypted database connection required.');
        }
        $conn->set_charset('utf8mb4');
        return $conn;
    } catch (Throwable $error) {
        databaseUnavailable();
    }
}

function databasePdo(string $database): PDO
{
    try {
        $config = databaseConfig($database);
        $conn = new PDO(
            'mysql:host=' . $config['DB_HOST'] . ';port=' . $config['DB_PORT'] . ';dbname=' . $database . ';charset=utf8mb4',
            $config['DB_USER'], $config['DB_PASSWORD'],
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_TIMEOUT => 10,
                PDO::MYSQL_ATTR_SSL_CA => $config['DB_SSL_CA'],
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true]
        );
        $cipher = $conn->query("SHOW SESSION STATUS LIKE 'Ssl_cipher'")->fetch(PDO::FETCH_NUM);
        if (empty($cipher[1])) {
            throw new RuntimeException('Encrypted database connection required.');
        }
        return $conn;
    } catch (Throwable $error) {
        databaseUnavailable();
    }
}
