<?php
// Existing checkout endpoints share validation and an atomic cart write.
function checkoutError(int $status, string $message): never {
    http_response_code($status);
    exit($message);
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    checkoutError(405, 'Method Not Allowed');
}
$data = json_decode(file_get_contents('php://input'), true);
if (!is_array($data) || !is_array($data['cart'] ?? null) || !$data['cart']) checkoutError(400, 'Invalid cart.');
$cart = $data['cart'];
$coupon = $data['coupon_applied'] ?? '';
$total = $data['total_price'] ?? null;
if (!is_string($coupon) || strlen($coupon) > 50 || !is_numeric($total)
    || !is_finite((float) $total) || (float) $total < 0 || (float) $total > 99999999.99) checkoutError(400, 'Invalid checkout details.');
foreach ($cart as $item) {
    if (!is_array($item) || !is_string($item['name'] ?? null) || $item['name'] === '' || strlen($item['name']) > 100
        || !is_string($item['color'] ?? null) || strlen($item['color']) > 50
        || !(is_int($item['qty'] ?? null) || is_string($item['qty'] ?? null))
        || filter_var($item['qty'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]]) === false) checkoutError(400, 'Invalid cart item.');
}
require_once __DIR__ . '/database.php';
$conn = databaseMysqli('product');
try {
    $conn->begin_transaction();
    $stmt = $conn->prepare('INSERT INTO transactions (data_name, data_color, quantity, coupon_applied, total_price) VALUES (?, ?, ?, ?, ?)');
    $total = (float) $total;
    foreach ($cart as $item) {
        $qty = (int) $item['qty'];
        $stmt->bind_param('ssisd', $item['name'], $item['color'], $qty, $coupon, $total);
        $stmt->execute();
    }
    $conn->commit();
    echo 'Transaction saved!';
} catch (Throwable $error) {
    try { $conn->rollback(); } catch (Throwable $ignored) {}
    checkoutError(500, 'Unable to save the transaction. Please try again.');
}
