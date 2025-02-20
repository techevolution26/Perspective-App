<?php
include 'connect.php';
session_start(); 
session_regenerate_id(true); 

if (isset($_POST['signUp'])) {
    $username = $_POST['username'];
    $firstName = $_POST['fName'];
    $lastName = $_POST['lName'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['warning_message'] = "Email or Username already exists!";
        header("Location: ../pages/login.php");
        exit();
        // echo "Email or Username already exists!";
    } else {
        $insertStmt = $conn->prepare("INSERT INTO Users (username, firstName, lastName, email, password) VALUES (?, ?, ?, ?, ?)");
        $insertStmt->bind_param("sssss", $username, $firstName, $lastName, $email, $password);

        if ($insertStmt->execute()) {
            $_SESSION['success_message'] = "User Registration successful! Proceed to login.";
            header("Location: ../pages/login.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {

    if (isset($_POST['email'])) {
        $email = $_POST['email'];
    } else if (isset($_POST['username'])) {
        $email = $_POST['username']; 
    } else {
        echo "Email or Username is required.";
        exit();
    }
    
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $email, $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            if (isset($row['email'])) {
                $_SESSION['email'] = $row['email'];
            } else {
                $_SESSION['username'] = $row['username'];
            }
            header("Location: ../pages/dashboard.php");
            exit();
        } else {
            $_SESSION['error_message'] = "Invalid Username/Email or Password";
            header("Location:../pages/login.php");

            // echo "Invalid Username/Email or Password";
        }
    } else {
        $_SESSION['error_message'] = "Invalid Username/Email or Password";
        header("Location: ../pages/login.php");
        exit();
        // echo "Invalid Email or Password";
    }
}
?>
