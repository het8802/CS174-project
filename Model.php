<?php
require_once "DatabaseConfig.php";
require_once "Database.php";
require_once "User.php";
error_reporting(E_ALL);
ini_set('display_errors',1);

$conn = connectDatabase();


function trainModel($data, $clusterNumber) {
    // Assuming $data is already in the required format for the Python script
    // Execute Python script to train the model


    $command = '/opt/homebrew/bin/python3 ./train_model.py ' . escapeshellarg(json_encode($data)) . " ". escapeshellarg(json_encode($clusterNumber)) . ' 2>&1';
    $result = shell_exec($command);

    // Separate JSON from warnings/errors
    if (preg_match('/\{.*\}/', $result, $matches)) {
        $jsonResult = $matches[0];
        $trainedModel = json_decode($jsonResult, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decoding error: " . json_last_error_msg();
            return;
        } else {
            echo "<br>trained model: ";
        }
    } else {
        echo "No JSON found in the output";
        print_r($result);
    }

    // Storing JSON string in session
    $modelData = $trainedModel['centroids'];
    $_SESSION['model-data'] = json_encode($modelData);
}

function testModel($data, $model) {
    // Assuming $data is already in the required format for the Python script
    // Execute Python script to test the model

    $command = "/opt/homebrew/bin/python3 ./test_model.py " . escapeshellarg(json_encode($data)) . " " . escapeshellarg($model);

    $result = shell_exec($command);

    // Separate JSON from warnings/errors
    if (preg_match('/\{.*\}/', $result, $matches)) {
        $jsonResult = $matches[0];
        $testResults = json_decode($jsonResult, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decoding error: " . json_last_error_msg();
            return;
        } 
    } else {
        echo "No JSON found in the output<br>";
        handleError($result);
    }
    return $testResults;
}

function saveTrainingDataInModels($data, $username, $modelName) {
    // Assuming $data is a JSON string
    
    $model = executeQuery(
        "SELECT * FROM MODELS WHERE username = ? AND model_name = ?",
        [$username, $modelName],
        "ss"
    );
    
    if (!$model) {
        executeQuery(
            "INSERT INTO MODELS (username, centroids, model_name) VALUES (?, ?, ?)",
            [$username, $data, $modelName],
            "sss"
        );
        return True;
    }
    else {
        handleError("Model name already exists. Please choose a different name!");
        return False;
    }
}

// Process the file and convert it to a 2D array
function processFile($file) {
    return processText(file_get_contents($file));
}

function processText($string) {
    // Process the string and convert it to a 2D array
    $string = trim($string);

    // Split the input string into lines
    $lines = explode("\n", $string);

    // Initialize an empty 2D array
    $twoDArray = [];

    // Iterate through each line
    foreach ($lines as $line) {
        // Split the line into numbers using space as the delimiter
        $numbers = explode(" ", $line);

        // Initialize a temporary array for the row
        $row = [];

        // Convert each number to an integer and add it to the row
        foreach ($numbers as $number) {
            if(is_numeric($number)){
                $row[] = (int)$number;
            } else{
                handleError("Please enter numeric data!");
            }
        }

        // Add the row to the 2D array
        $twoDArray[] = $row;
    }
    return $twoDArray;
}

function fetchModels($username) {
    $models = executeQuery(
        "SELECT model_name FROM MODELS WHERE username = ?",
        [$username],
        "s"
    );
    return $models;
}

function fetchModel($username, $modelName) {
    $model = executeQuery(
        "SELECT centroids FROM MODELS WHERE username = ? AND model_name = ?",
        [$username, $modelName],
        "ss"
    );
    print_r($model[0]);
    return $model[0];   //executeQuery return one data point but in 2D format, we return 1D array
}

?>
