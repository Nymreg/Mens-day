<?php
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);

    require_once dirname(__DIR__, 2) . '/config/database.php';
    $conn = databaseMysqli('mens_daydb');
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");

    if($stmt === false){
        die ('Prepare failed: ' . $conn->error);
    }

    $stmt-> bind_param("sss", $username, $email, $password);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        // Error during registration
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>