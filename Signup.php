<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./Signup.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
  </head>
  <body>
    <div class="signup">
      <form method="post" action="Signup.php" class="frame18" id="signup-form">
        <div class="sign-up-parent">
          <b class="sign-up">SIGN UP</b>
          <button class="sign-up-wrapper" id="signup-button" type="submit" name="submit">
            <b class="sign-up1">Sign Up</b>
          </button>
        </div>
        <input
          class="frame-input"
          id="password-text-field"
          name="password"
          placeholder="Password"
          type="password"
        />

        <input
          class="frame-child22"
          id="conf-password-text-field"
          name="conf-password"
          placeholder="Confirm Password"
          type="password"
        />

        <input
          class="frame-child23"
          id="username-text-field"
          name="username"
          placeholder="Username"
          type="text"
        />

        <input
          class="frame-child24"
          id="email-text-field"
          name="email"
          placeholder="Email"
          type="email"
        />
      </form>
      <div class="frame19">
        <div class="frame-child25"></div>
        <b class="cluster-based-unsupervised-container1">
          <p class="cluster-based1">Cluster based</p>
          <p class="cluster-based1">Unsupervised</p>
          <p class="cluster-based1">learning</p>
        </b>
      </div>
      <a class="login-instead" id="login-option-link" href="./index.php"
        >Login Instead?</a
      >
    </div>

    
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'User.php';
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confPassword = $_POST['conf-password'];

if (isset($_POST['submit']) && validateCredentials($username, $email, $password, $confPassword)) {
  $user = createAccount($username, $email, $password);
}
?>