<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir1.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-1">
      <div class="frame12">
        <div class="frame-child15"></div>
        <b class="k-means-clustering2">K-Means Clustering</b>
      </div>
      <form method="post" action="MacBookAir1.php" enctype="multipart/form-data">
        <button class="rectangle-container" id="logout-button" type="submit" name="logout-button">
          <div class="frame-child16"></div>
          <b class="logout2">LOGOUT</b>
        </button>
        <b class="train-your-data">Train your data</b>

        <label class="frame13" id="uploadButton">
          <div class="frame-child17"></div>
          <b class="upload-file1">Upload File</b>
          <input type="file" accept=".txt, .text/plain" id="fileInput" style="display: none;" name="file-upload"/>
        </label>
        <div class="frame14">
          <b class="or2">OR</b>
          <div class="frame-child18"></div>
          <div class="frame-child19"></div>
        </div>
        <div class="frame15">
          <textarea class="rectangle-textarea" id="input-data-text-area" placeholder="Input data..." name="input-data-text-area"></textarea>
        </div>
        <button class="frame16" id="train-button" type="submit" name="submit">
          <div class="frame-child20"></div>
          <b class="train">TRAIN</b>
        </button>
        <button class="frame17" id="your-models-button" type="submit" name="your-models">
          <div class="frame-child21"></div>
          <b class="your-models">YOUR MODELS</b>
        </button>
      </form>
    </div>
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once "User.php";
require_once "Model.php";
session_start();
checkLogin();

if (isset($_POST['logout-button'])) {
  logout();
}

if (isset($_POST['your-models'])) {
  header("Location: MacBookAir3.php");
}

if (isset($_POST['submit'])) {
  $file = $_FILES['file-upload']['tmp_name'];         
  
  $text = $_POST['input-data-text-area'];

  if (!$file && !$text) {
    handleError("Please enter data by either selecting a text file or entering text manually in the text area");
  }
  
  $twoDArray;
  if ($text) {
    $twoDArray = processText($text);
  }
  else if($file) {
    $twoDArray = processFile($file);
    print_r($twoDArray);
  }
  else if(isset($_POST['submit'])){
    handleError("Enter data by either selecting a file or entering text manually");
  }
  
  if ($twoDArray){
    trainModel($twoDArray);
    print_r($_SESSION['model-data']);
    header("Location: MacBookAir2.php");
    exit();
  }
}
?>