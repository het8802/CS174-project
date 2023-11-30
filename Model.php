<?php
require_once "DatabaseConfig.php";
require_once "Database.php";
// private $trainedModel;
$conn = connectDatabase();


function trainModel($data) {
    // Assuming $data is already in the required format for the Python script
    // Execute Python script to train the model
    $result = shell_exec('python train_model.py ' . escapeshellarg(json_encode($data)));
    echo "result: ". $result;
    $trainedModel = json_decode($result, true);
    echo $trainedModel;
    // $saveTrainingDataInModels($data);
}

function testModel($file) {
    // Assuming $data is already in the required format for the Python script
    // Execute Python script to test the model
    echo "<br>test model reached";
    // $command = escapeshellcmd("python3 train_model.py");
    $result = shell_exec("python3 train_model.py");
    //  . escapeshellarg(json_encode($data)));
    // return json_decode($result, true);
    echo $result;
}

function saveTrainingDataInModels($data) {
    // Assuming $data is a JSON string
    $stmt = $conn->prepare("INSERT INTO MODELS (trainingData) VALUES (?)");
    $stmt->execute([$data]);

    executeQuery(
        "INSERT INTO MODELS (trainingData) VALUES (?)",
        [$data],
        "s"
    );
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
    testModel($twoDArray);
}

?>
