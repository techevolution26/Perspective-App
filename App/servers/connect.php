<?php 

$host = "localhost";
$user = "admin";
$password = "@Whyalwaysme26";
$db = "SystemLogger";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error, 3, "errors.log");

    echo "Database connection error. Please try again later.";
    exit();
}