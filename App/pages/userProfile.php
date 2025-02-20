 <?php
    session_start();
    include("../servers/connect.php");

    if (!isset($_SESSION['email'])) {
        header("Location: login.php");
        exit();
    }

    $email = $_SESSION['email'];

    $query = $conn->prepare("SELECT username, firstName, lastName, bio, location FROM Users WHERE email =?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $username = $row['username'];
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $bio = $row['bio'];
        $location = $row['location'];
    } else {
        $username = '@';
        $firstName = 'User';
        $lastName = '';
        $bio = '';
        $location = '';
    }

    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title> Profile</title>
     <link rel="stylesheet" href="../styles/userProfile.css">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 </head>

 <body>
     <div class="profile-container">
         <div class="profile-header">
             <div class="profile-banner">
                 <img src="/SystemLogPhp/App/pages/img/offering.jpg" alt="Profile Banner">
             </div>

             <div class="profile-avatar">
                 <img src="/SystemLogPhp/App/pages/img/john.jpg" alt="Profile Avatar">
             </div>
         </div>

         <div class="profile-info">
             <h1 class="fullName"><?php echo htmlspecialchars($firstName . " " . $lastName); ?></h1>
             <h4 id="username"> <?php echo htmlspecialchars($username) ?></h4>

             <button class="edit-button">Edit Profile</button>

             <p class="bio"><?php echo htmlspecialchars($bio); ?></p>
             <a>
                 <p class="location"><?php echo htmlspecialchars($location); ?></p>
             </a>
             <p class="website">Website: www.johndoe.com</p>
         </div>

         <div class="posts">
             <h2>Posts</h2>
             <div class="post">
                 <p class="post-content">Just setting up my Pesrspective-app profile!</p>
                 <p class="post-time">1 hour ago</p>
             </div>
         </div>
     </div>

     <div class="modal" id="editModal">
         <div class="modal-content">
             <h2>Edit Profile</h2>
             <form id="userEditForm" >
                 <label for="username">Username</label>
                 <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">

                 <label for="name">Full Name</label>
                 <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($firstName . " " . $lastName); ?>">

                 <!-- <label for="fname">First Name</label>
                <input type="text" id="fName" name="fname" value="<?php echo htmlspecialchars($firstName); ?>">

                <label for="lname">last Name</label>
                <input type="text" id="lName" name="lname" value="<?php echo htmlspecialchars($lastName); ?>"> -->

                 <label for="bio">Bio</label>
                 <textarea id="bio" name="bio"><?php echo htmlspecialchars($bio) ?></textarea>

                 <label for="location">Location</label>
                 <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($location) ?>">

                 <button type="submit">Save Changes</button>
                 <button type="button" class="close-btn" onclick="closeModal()">Cancel</button>
             </form>
         </div>
     </div>

     <script src="/SystemLogPhp/App/js/userProfile.js"></script>
 </body>

 </html>

 <!-- action="../servers/updateProfile.php" method="POST" -->