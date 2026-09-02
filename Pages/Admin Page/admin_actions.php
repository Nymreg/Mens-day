<?php
// admin_actions.php

// Database configuration (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mens_daydb";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]));
}

// Set response content type to JSON
header('Content-Type: application/json');

// --- Function Definitions ---

function listAccounts($conn) {
    $sql = "SELECT id, username, email FROM users";
    $result = $conn->query($sql);
    $accounts = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $accounts[] = $row;
        }
        echo json_encode($accounts);
    } else {
        echo json_encode([]);
    }
}

function addAccount($conn) {
    error_log("Entering addAccount function");
    error_log("Content-Type: " . ($_SERVER['HTTP_CONTENT_TYPE'] ?? 'Not set')); // Log Content-Type

    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true); // Decode JSON into an associative array

    error_log("Decoded JSON data (add): " . json_encode($data)); // Log decoded data

    $username = $data['username'] ?? ''; // Access 'username' from the decoded array
    $email = $data['email'] ?? ''; // Access 'email'
    $password = $data['password'] ?? ''; // Access 'password'

    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode(["success" => false, "message" => "Username, email, and password are required"]);
        return;
    }

    // Basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["success" => false, "message" => "Invalid email format"]);
        return;
    }

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo json_encode(["success" => false, "message" => "Username or email already exists"]);
        $stmt->close();
        return;
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Account created successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error creating account: " . $stmt->error]);
    }

    $stmt->close();
}

function deleteAccount($conn) {
    error_log("Entering deleteAccount function");
    error_log("Content-Type: " . ($_SERVER['HTTP_CONTENT_TYPE'] ?? 'Not set')); // Log Content-Type

    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true); // Decode JSON

    error_log("Decoded JSON data (delete): " . json_encode($data)); // Log decoded data

    $find = $data['find'] ?? []; // Access 'find' from the decoded data
    error_log("\$find: " . json_encode($find));

    if (empty($find) || (empty($find['username']) && empty($find['email']))) {
        echo json_encode(["success" => false, "message" => "Please provide a username or email to find the account to delete"]);
        return;
    }

    $conditions = [];
    $params = [];
    $types = "";

    if (!empty($find['username'])) {
        $conditions[] = "username = ?";
        $params[] = $find['username'];
        $types .= "s";
    }

    if (!empty($find['email'])) {
        $conditions[] = "email = ?";
        $params[] = $find['email'];
        $types .= "s";
    }

    $whereClause = "WHERE " . implode(" OR ", $conditions);

    $sql = "DELETE FROM users " . $whereClause;
    error_log("\$sql: " . $sql);

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Error preparing delete statement: " . $conn->error);
        echo json_encode(["success" => false, "message" => "Error preparing delete statement: " . $conn->error]);
        return;
    }

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        error_log("Affected rows: " . $stmt->affected_rows);
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Account deleted successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "No account found matching the criteria"]);
        }
    } else {
        error_log("Error executing delete statement: " . $stmt->error);
        echo json_encode(["success" => false, "message" => "Error deleting account: " . $stmt->error]);
    }

    $stmt->close();
}

function updateAccountInline($conn) {
    error_log("Entering updateAccountInline function");
    error_log("Content-Type: " . ($_SERVER['HTTP_CONTENT_TYPE'] ?? 'Not set'));

    $request_body = file_get_contents('php://input');
    $data = json_decode($request_body, true); // Decode JSON into an associative array

    error_log("Decoded JSON data: " . json_encode($data)); // Log the decoded data

    $id = $data['id'] ?? ''; // Access 'id' from the decoded array
    $username = $data['username'] ?? ''; // Access 'username'
    $email = $data['email'] ?? ''; // Access 'email'

    error_log("ID received: " . $id . ", Type: " . gettype($id));

    if (empty($id)) {
        echo json_encode(["success" => false, "message" => "Account ID is required for updating"]);
        return;
    }

    $setClauses = [];
    $params = [];
    $types = "";

    if (!empty($username)) {
        $setClauses[] = "username = ?";
        $params[] = $username;
        $types .= "s";
    }
    if (!empty($email)) {
        $setClauses[] = "email = ?";
        $params[] = $email;
        $types .= "s";
    }

    $sql = "UPDATE users SET " . implode(", ", $setClauses) . " WHERE id = ?";
    $params[] = $id;
    $types .= "i";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode(["success" => false, "message" => "Error preparing update statement: " . $conn->error]);
        return;
    }

    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Account updated successfully"]);
        } else {
            echo json_encode(["success" => false, "message" => "No account found with that ID"]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Error updating account: " . $stmt->error]);
    }

    $stmt->close();
}

// --- Action Handling ---

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'list':
        listAccounts($conn);
        break;
    case 'add':
        addAccount($conn);
        break;
    case 'delete':
        deleteAccount($conn);
        break;
    case 'update_inline':
        updateAccountInline($conn);
        break;
    default:
        echo json_encode(["success" => false, "message" => "Invalid action"]);
}

// --- Close Connection ---
$conn->close();

?>