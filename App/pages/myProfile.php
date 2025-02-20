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
    <title>Dropdown Menu</title>
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../styles/myProfile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    
    <div class="dropdown">
        <div class="profile">
            <img src="/SystemLogPhp/App/pages/img/john.jpg" alt="Profile">
            <div class="profile-info">
                <h4><?php echo htmlspecialchars($firstName. " " .$lastName); ?></h4>
                <p>Kilifi, Kenya</p>
            </div>
        </div>
        <div class="dropdown-menu">
            <a href="/SystemLogPhp/App/pages/userProfile.php"><span><i class="fa-solid fa-address-card"></i> User Profile</span></a>
            <a href="#"><span><i class="fas fa-inbox"></i> Inbox</span> <span class="notification">3</span></a>
            <a href="#"><span><i class="fa-solid fa-handshake"></i> Following</span></a>
            <a href="#"><span><i class="fas fa-cog"></i> Setting</span></a>
            <a href="/SystemLogPhp/App/pages/login.php"><span><i class="fa-solid fa-power-off"></i> Log out</span></a>

        </div>
    </div>

</body>
</html>
