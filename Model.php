<?php
require_once "DatabaseConfig.php";
require_once "Database.php";
error_reporting(E_ALL);
ini_set('display_errors',1);
// private $trainedModel;
$conn = connectDatabase();


function trainModel($data) {
    // Assuming $data is already in the required format for the Python script
    // Execute Python script to train the model
    // print_r($data);
    $command = '/opt/homebrew/bin/python3 ./train_model.py ' . escapeshellarg(json_encode($data)) . ' 2>&1';
    $result = shell_exec($command);

    // Separate JSON from warnings/errors
    if (preg_match('/\{.*\}/', $result, $matches)) {
        $jsonResult = $matches[0];
        $trainedModel = json_decode($jsonResult, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "JSON decoding error: " . json_last_error_msg();
        } else {
            echo "<br>trained model: ";
            print_r($trainedModel);
        }
    } else {
        echo "No JSON found in the output";
    }

    // Storing JSON string in session
    $_SESSION['model-data'] = $jsonResult;
    header("Location: MacBookAir2.php");
}

function testModel($file) {
    // Assuming $data is already in the required format for the Python script
    // Execute Python script to test the model
    echo "<br>test model reached";
    // $command = escapeshellcmd("python3 train_model.py");
    $result = shell_exec("python3 test_model.py"). escapeshellarg(json_encode($data));
    // return json_decode($result, true);
    echo $result;
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
    }
    header("Location: MacBookAir4.php");
    exit();
}

function processFile($file) {
    // Process the file and convert it to a 2D array
    // Placeholder for file processing
    $ffile = fopen($file, 'r');

    while(!feof($ffile)) {
        $line = fgets($ffile);
        echo $line."<br>";
    }
    fclose($ffile);
}

function processText($string) {
    // Process the string and convert it to a 2D array
    // Placeholder for text processing

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
            $row[] = (int)$number;
        }

        // Add the row to the 2D array
        $twoDArray[] = $row;
    }
    trainModel($twoDArray);
}

?>
