<?php
session_start();

// Note: FILTER_SANITIZE_STRING is deprecated and does NOT prevent SQL injection.
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Database connection details
$db_server = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "mens_daydb";

// Create a database connection
$conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// INSECURE: Directly concatenating user input into the SQL string
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";

// Execute the query directly without preparation
$result = mysqli_query($conn, $sql);

if ($result) {
    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_admin'] = ($row['username'] === 'admin');
        echo json_encode(['status' => 'success', 'message' => "Welcome back, $username!"]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password. Please try again.']);
        $_SESSION['is_admin'] = false;
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Query error: ' . mysqli_error($conn)]);
}

// Close the connection
$conn->close();
?>