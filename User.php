<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "Database.php";

$conn = connectDatabase();

function createAccount($username, $email, $password) {
    $salt = uniqid(); // Generate a unique salt
    $hashedPassword = hashPassword($password, $salt);

    //check if user already exists
    $user = executeQuery(
        "SELECT * FROM USERS WHERE username = ? AND email = ?", 
        [$username, $email],
        "ss"
    );

    if ($user) {
        handleError("User already exists!");
        die();
    }

    //check if the username already exists
    $oldUsername = executeQuery(
        "SELECT * FROM USERS WHERE username = ?",
        [$username],
        "s"
    );

    if ($oldUsername) {
        handleError("Username already exists! Please choose a different username.");
        die();
    }

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

function isValidUsername($username) {
    return preg_match('/^[a-zA-Z0-9_-]+$/', $username);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function isValidPassword($password) {
    if (strlen($password) < 8) {
        return false; // Length check
    }

    if (!preg_match('/[A-Z]/', $password)) {
        return false; // At least one uppercase letter
    }

    if (!preg_match('/[a-z]/', $password)) {
        return false; // At least one lowercase letter
    }

    if (!preg_match('/\d/', $password)) {
        return false; // At least one digit
    }

    if (!preg_match('/\W/', $password)) {
        return false; // At least one special character
    }

    return true;
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
}


function handleError($error) {
    // Handle errors (logging, displaying error messages, etc.)
    if (is_string($error)){
        echo '<script>alert("'.$error.'");</script>';
    }
}

function hashPassword($password, $salt) {
    return hash('sha256', $password . $salt);
}

//Function to validate the credentials entered by the user to signup
function validateConfirmPassword($password, $confPassword) {
    if ($password === $confPassword) {
        return true;
    }
}
?>
