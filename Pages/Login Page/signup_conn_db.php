<?php
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password1', FILTER_SANITIZE_STRING);

    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "mens_daydb";
    $conn = "";

        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    
    if ($conn->connect_error){
        die('Connect Error(' . $conn->connect_errno .' )' . $conn->connect_error);
    }
    else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) 
                                VALUES (?,?,?)");
    }

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