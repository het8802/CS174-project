<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./index.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
  </head>
  <body>
    <div class="login">
      <form method="post" class="login-parent" id="login-form" action="index.php">
        <b class="login1">Login</b>
        <input
          class="frame-child"
          id="password-text-field"
          name="password"
          placeholder="Password"
          type="password"
        />

        <input
          class="frame-item"
          id="login-username-text"
          name="username"
          placeholder="Username"
          type="text"
        />

        <input
          class="frame-inner"
          id="email-text-field"
          name="email"
          placeholder="Email"
          type="email"
        />

        <button class="login-now-wrapper" id="login-button" type="submit" name="submit">
          <b class="login-now">Login Now</b>
        </button>
      </form>
      <div class="frame">
        <div class="rectangle-div"></div>
        <img class="rectangle-icon" alt="" src="./public/rectangle-4@2x.png" />

        <div class="frame-child1"></div>
        <b class="cluster-based-unsupervised-container">
          <p class="cluster-based">Cluster based</p>
          <p class="cluster-based">Unsupervised</p>
          <p class="cluster-based">learning</p>
        </b>
      </div>
      <a class="signup-instead" id="signup-option-link" href="./Signup.php"
        >SignUp Instead?</a
      >
    </div>

    <script>
      // var frameButton = document.getElementById("login-button");
      // if (frameButton) {
      //   frameButton.addEventListener("click", function (e) {
      //     window.location.href = "./MacBookAir1.html";
      //   });
      // }
      </script>
  </body>
</html>

<?php


error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "User.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
if (isset($_POST['submit']) && validateLogin($username, $email, $password)){
  echo "User detected";
}
?>