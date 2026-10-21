<?php
// Shared checkout logic: validation, SERVER-SIDE price computation, atomic write.

require_once __DIR__ . '/catalog.php';

function checkoutError(int $status, string $message): never {
    http_response_code($status);
    exit($message);
}

$forwardedProto = strtolower($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '');
$isHttps = (!empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
    || $forwardedProto === 'https';
if (!$isHttps) {
    checkoutError(426, 'HTTPS is required for checkout.');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    checkoutError(405, 'Method Not Allowed');
}

$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data) || !is_array($data['cart'] ?? null) || !$data['cart']) {
    checkoutError(400, 'Invalid cart.');
}

$cart        = $data['cart'];
$coupon      = $data['coupon_applied'] ?? '';
$clientTotal = $data['total_price'] ?? null; // Untrusted; used only to detect tampering.

if (!is_string($coupon) || strlen($coupon) > 50 || !is_numeric($clientTotal)) {
    checkoutError(400, 'Invalid checkout details.');
}

// ---- Validate cart items (structure only) ----
foreach ($cart as $item) {
    if (!is_array($item)
        || !is_string($item['name'] ?? null) || $item['name'] === '' || strlen($item['name']) > 100
        || !is_string($item['color'] ?? null) || strlen($item['color']) > 50
        || !(is_int($item['qty'] ?? null) || is_string($item['qty'] ?? null))
        || filter_var($item['qty'] ?? null, FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1, 'max_range' => MAX_QTY_PER_ITEM]]) === false) {
        checkoutError(400, 'Invalid cart item.');
    }
}

// ---- SERVER-SIDE PRICE COMPUTATION (the actual MITM defense) ----
$subtotal = 0.0;
foreach ($cart as $item) {
    $key = $item['name'] . '|' . $item['color'];
    if (!isset(PRODUCT_CATALOG[$key])) {
        checkoutError(400, 'Unknown product.');
    }
    $subtotal += PRODUCT_CATALOG[$key] * (int) $item['qty'];
}

$coupon = strtoupper(trim($coupon));
$discountPct = 0;
if ($coupon !== '') {
    if (!isset(VALID_COUPONS[$coupon])) {
        checkoutError(400, 'Invalid coupon.');
    }
    $discountPct = VALID_COUPONS[$coupon];
}

$total = round($subtotal * (1 - $discountPct / 100), 2);

// ---- TAMPER DETECTION (log for the demo / audit trail) ----
if (is_numeric($clientTotal) && abs((float) $clientTotal - $total) > 0.01) {
    error_log(sprintf(
        '[SECURITY] Price tampering detected from %s: client_total=%s server_total=%s',
        $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        $clientTotal,
        number_format($total, 2, '.', '')
    ));
    checkoutError(400, 'Checkout total mismatch. Please review your cart and try again.');
}

// ---- Atomic write using the SERVER-computed total ----
require_once __DIR__ . '/database.php';
$conn = databaseMysqli('product');

try {
    $conn->begin_transaction();
    $stmt = $conn->prepare(
        'INSERT INTO transactions (data_name, data_color, quantity, coupon_applied, total_price) VALUES (?, ?, ?, ?, ?)'
    );
    foreach ($cart as $item) {
        $qty = (int) $item['qty'];
        $stmt->bind_param('ssisd', $item['name'], $item['color'], $qty, $coupon, $total);
        $stmt->execute();
    }
    $conn->commit();
    echo 'Transaction saved! Total charged: $' . number_format($total, 2);
} catch (Throwable $error) {
    try { $conn->rollback(); } catch (Throwable $ignored) {}
    checkoutError(500, 'Unable to save the transaction. Please try again.');
}