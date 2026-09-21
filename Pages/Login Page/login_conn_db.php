<?php
session_start();

// Sanitize input data
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

require_once dirname(__DIR__, 2) . '/config/database.php';
$conn = databaseMysqli('mens_daydb');

// Prepare a SQL query to check if the user exists
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Bind parameters
    $stmt->bind_param("ss", $username, $password);

    // Execute the query
    $stmt->execute();

    // Fetch the result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // User exists
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_admin'] = ($row['username'] === 'admin');
        echo json_encode(['status' => 'success', 'message' => "Welcome back, $username!"]);
    } else {
        // User does not exist
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password. Please try again.']);
        $_SESSION['is_admin'] = false;
    }

    // Close the statement
    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error preparing statement.']);
}

// Close the connection
$conn->close();
?>