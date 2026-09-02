<?php
// ✅ Enforce POST request only
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
}

$host = '127.0.0.1';
$user = 'root';
$pass = '';
$db = 'product';

// Database Connection
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    error_log("Database Connection Failed: " . $conn->connect_error);
    http_response_code(500);
    echo "Internal server error!";
    exit;
}

// Parse Input Data
$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['cart']) || !is_array($data['cart'])) {
    http_response_code(400);
    echo "Invalid data!";
    exit;
}

$cart = $data['cart'];
$coupon_applied = isset($data['coupon_applied']) ? trim($data['coupon_applied']) : '';
$total_price = isset($data['total_price']) ? floatval($data['total_price']) : 0.00;

// Validate Coupon and Total Price
$coupon_applied = is_string($coupon_applied) ? $coupon_applied : '';
$total_price = $total_price >= 0 ? $total_price : 0.00;

// Prepare SQL Statement
$stmt = $conn->prepare("INSERT INTO transactions (data_name, data_color, quantity, coupon_applied, total_price) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
    error_log("Prepare Failed: " . $conn->error);
    http_response_code(500);
    echo "Internal server error!";
    exit;
}

// Validate and Insert Each Cart Item
foreach ($cart as $item) {
    if (!isset($item['name'], $item['color'], $item['qty']) || !is_string($item['name']) || !is_string($item['color']) || !is_numeric($item['qty'])) {
        http_response_code(400);
        echo "Invalid cart item data!";
        exit;
    }

    $name = $item['name'];
    $color = $item['color'];
    $qty = intval($item['qty']);

    $stmt->bind_param("ssisd", $name, $color, $qty, $coupon_applied, $total_price);
    if (!$stmt->execute()) {
        error_log("Execute Failed: " . $stmt->error);
        http_response_code(500);
        echo "Internal server error!";
        exit;
    }
}

// Clean Up
$stmt->close();
$conn->close();

http_response_code(200);
echo "Transaction saved!";
?>