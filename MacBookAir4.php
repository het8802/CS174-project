<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir4.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-4">
      <b class="test-your-data">Test your data</b>
      <div class="frame1">
        <div class="frame-child2"></div>
        <b class="k-means-clustering">K-Means Clustering</b>
      </div>
      <form method="post" enctype="multipart/form-data" action="MacBookAir4.php">
        <button class="rectangle-parent" id="logout-button" name="logout-button" type="submit">
          <div class="frame-child3"></div>
          <b class="logout">LOGOUT</b>
        </button>
        <div class="frame2">
          <label class="component-parent" id="uploadButton">
            <div class="frame-child4"></div>
            <b class="upload-file">Upload File</b>
            <input type="file" accept=".txt, .text/plain" id="fileInput" style="display: none;" name='file-upload'/>
          </label>
        </div>
        <div class="frame3">
          <b class="or">OR</b>
          <div class="frame-child5"></div>
          <div class="frame-child6"></div>
        </div>
        <textarea class="frame4" placeholder="Input data..." name='input-data-text-area'></textarea>
        <button class="frame5" id="test-button" type="submit" name='submit'>
          <div class="frame-child7"></div>
          <b class="test">TEST</b>
        </button>
      </form>
    </div>
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_error', 1);

require_once 'User.php';
require_once 'Model.php';

session_start();
checkLogin();

if (isset($_POST['logout-button'])) {
  logout();
}

if (isset($_POST['submit'])) {
  
  $file = $_FILES['file-upload']['tmp_name'];
  
  $text = $_POST['input-data-text-area'];

  if (!$file && !$text) {
    handleError("Please enter data either by uploading text file or entering data manually in the text area");
  }
  
  $twoDArray;
  if ($text) {
    $twoDArray = processText($text);
  }
  
  else {
    $twoDArray = processFile($file);
  }
  $model = json_decode($_SESSION['model-data'], true)['centroids']; //convert the string to json first and then access the centroids
  
  testModel($twoDArray, $model);
}
?>