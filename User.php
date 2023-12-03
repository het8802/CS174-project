<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "Database.php";
require_once "DatabaseConfig.php";

$username;
$email;
$hashedPassword;
$salt;
$modelsList;
$conn = connectDatabase();

function createAccount($username, $email, $password) {
    $salt = uniqid(); // Generate a unique salt
    $hashedPassword = hashPassword($password, $salt);

    // Insert the new user into the database
    executeQuery(
        "INSERT INTO USERS (username, email, password, salt) VALUES (?, ?, ?, ?)", 
        [$username, $email, $hashedPassword, $salt],
        "ssss"
    );
    startSession($username);
}

function validateLogin($username, $email, $password) {

    $user = executeQuery(
        "SELECT * FROM USERS WHERE username = ? AND email = ?", 
        [$username, $email],
        "ss"
    );
    $user = $user[0];

    // Verify password
    if ($user && hash('sha256', $password . $user['salt']) === $user['password']) {
        startSession($username);
        return true;
    } else {
        handleError("Invalid credentials");
        return false;
    }
}

function checkLogin() {
    if (!isset($_SESSION['user'])) {
        header("Location: index.php");
    }
}

function logout() {
    session_destroy();
    header("Location: index.php");
}

function startSession($username) {
    session_start();
    $_SESSION['user'] = $username;
    echo $_SESSION['user'];
    header("Location: MacBookAir1.php");
}


function handleError($error) {
    // Handle errors (logging, displaying error messages, etc.)
    // This is a placeholder; in production, you'd want to do more than just die.
    die($error);
}

function hashPassword($password, $salt) {
    return hash('sha256', $password . $salt);
}
?>
