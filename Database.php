<?php
error_reporting(E_ALL);

require_once 'DatabaseConfig.php';

$connection;

function connectDatabase() {
    echo "establishing connection...";
    global $hostname, $username_db, $password_db, $database, $connection;
    $connection = new mysqli($hostname, $username_db, $password_db, $database);
    if($connection->connect_error){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    return $connection;
}

function closeConnection() {
    global $connection;
    $connection = null;
}

function executeQuery($query, $params = [], $paramTypes = "") {
    //prepare statement
    global $connection;
    $stmt = $connection->prepare($query);

    //check if there are params to bind
    if (!empty($params)) {
        $stmt->bind_param($paramTypes, ...$params);
    }
    $stmt->execute($params);

    if (preg_match('/^\s*(INSERT)\s/i', $query)) {
        // It's a query that shouldn't return a result set
        return;
    }
    
    //Get the result
    $result = $stmt->get_result();

    // Fetch data
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

?>
