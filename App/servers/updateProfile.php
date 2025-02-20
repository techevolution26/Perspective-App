<?php
session_start();
include("../servers/connect.php");

if(!isset($_SESSION['email'])) {
    echo json_encode(['sucess'=>false, 'message'=> 'User not logged in']);
    exit();

}

$email = $_SESSION['email'];
$name =isset($_POST['name']) ? $_POST['name'] : '';
$bio = isset($_POST['bio']) ? $_POST['bio'] : '';
$location = isset($_POST['location']) ? $_POST['location'] : '';

$nameSplit = explode (" ", $name, 2);
$firstName = $nameSplit[0];
$lastName = isset($nameSplit[1]) ? $nameSplit[1]: '';

$query =$conn->prepare("UPDATE Users SET firstName = ?, lastName = ?, bio = ?, location = ? WHERE email = ?");
$query->bind_param("sssss", $firstName, $lastName, $bio, $location, $email);

if ($query->execute()) {
    echo json_encode(['sucess'=>true, 'message'=> 'Profile updated successfully']);
} else {
    echo json_encode(['sucess'=>false, 'message'=> 'Profile update failed']);
}

?>