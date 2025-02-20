<?php
session_start(); 

// Check if the success message exists in the session
if (isset($_SESSION['success_message'])) {
    echo "<div class='success-message'>";
    echo $_SESSION['success_message'];
    echo "</div>";

    unset($_SESSION['success_message']);
} else {

  if (isset($_SESSION['error_message'])) {
    echo "<div class='error-message' style='color:red; text-align:center; font-size:20px; margin-top:50px;'>";
    echo $_SESSION['error_message'];
    echo "</div>";

    unset($_SESSION['error_message']);
} else{
  if(isset($_SESSION['warning_message'])){
    echo "<div class='warning-message' style='color:red; text-align:center; font-size:20px; margin-top:50px;'>";
    echo $_SESSION['warning_message'];
    echo "</div>";

    unset($_SESSION['warning_message']);
  }
}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register & Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="/SystemLogPhp/App/styles/pages.css">

</head>

<body>
    
    <div class="container" id="signup" style="display:none;">
      <h1 class="form-title">Register</h1>
      <form method="post" action="../servers/register.php">
      <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="username" id="username" placeholder="Username" required>
           <label for="username">Username</label>
        </div>

        <div class="input-group">
           <i class="fas fa-user"></i>
           <input type="text" name="fName" id="fName" placeholder="First Name" required>
           <label for="fname">First Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-user"></i>
            <input type="text" name="lName" id="lName" placeholder="Last Name" required>
            <label for="lName">Last Name</label>
        </div>
        <div class="input-group">
            <i class="fas fa-envelope"></i>
            <input type="email" name="email" id="email" placeholder="Email" required>
            <label for="email">Email</label>
        </div>
        <div class="input-group">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
            <label for="password">Password</label>
        </div>
       <input type="submit" class="btn" value="Sign Up" name="signUp">
      </form>
      <p class="or">
        ----------or--------
      </p>
      <div class="icons">
        <i class="fab fa-google"></i>
        <i class="fab fa-facebook"></i>
      </div>
      <div class="links">
        <p>Already Have Account ?</p>
        <button id="signInButton">Sign In</button>
      </div>
    </div>

    <div class="container" id="signIn">
        <h1 class="form-title">Sign In</h1>
        <form method="post" action="../servers/register.php">
          <div class="input-group">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" id="email" placeholder="Email" required>
              <label for="email">Email</label>
          </div>
          <div class="input-group">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" id="password" placeholder="Password" required>
              <label for="password">Password</label>
          </div>
          <p class="recover">
            <a href="#">Recover Password</a>
          </p>
         <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>

        <p class="or">
          ----------or--------
        </p>

        <div class="icons">
          <i class="fab fa-google"></i>
          <i class="fab fa-facebook"></i>
        </div>

        <div class="links">
          <p>Don't have account yet?</p>
          <button id="signUpButton">Sign Up</button>
        </div>
      </div>
      <script src="/SystemLogPhp/App/js/login.js"></script>
</body>
</html>