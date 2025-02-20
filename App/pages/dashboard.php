<?php
session_start();
include("../servers/connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$query = $conn->prepare("SELECT firstName, lastName FROM Users WHERE email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {

    $row = $result->fetch_assoc();
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
} else {

    $firstName = 'User';
    $lastName = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../styles/dashboard.css">
</head>
<body>

    <div id="profile-container">
      <?php include("../pages/myProfile.php"); ?> 
    </div>

    <div>
    </div>
    <div style="text-align:center; padding:15%;"class="dash-container">
        <p style="font-size:50px; font-weight:bold;">
            Hello, <?php echo htmlspecialchars($firstName . ', ' . $lastName); ?> 
        </p>

    </div>


</body>
</html>

