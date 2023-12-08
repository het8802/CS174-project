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

  $clusterNumber = $_POST['cluster-number'];

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
  else {
    handleError("Enter data by either selecting a file or entering text manually");
  }
  
  if ($twoDArray){
    trainModel($twoDArray, $clusterNumber);
    header("Location: MacBookAir2.php");
    exit();
  }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir1.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-5">
      <div class="macbook-air-5-inner">
        <div class="frame-parent">
          <div class="frame1">
            <b class="k-means-clustering">K-Means Clustering</b>
          </div>
          <form action="MacBookAir1.php" method="post">
            <button class="logout-wrapper" id="logout-button" type="submit" name="logout-button">
              <b class="logout">LOGOUT</b>
            </button>
          </form>
        </div>
      </div>
      <form class="train-your-data-parent" action="MacBookAir1.php" method="post" enctype="multipart/form-data">
        <b class="train-your-data">Train your data</b>
        <div class="frame18-1-wrapper">
          <input
            class="frame18-1"
            id="model-name-text-field"
            placeholder="Number of clusters"
            type="text"
            name="cluster-number"
          />
        </div>
        <div class="frame18-1-wrapper">
          <label class="upload-file-wrapper">
            <b class="upload-file">Upload File</b>
            <input type="file" accept=".txt, .text/plain" id="fileInput" style="display: none;" name="file-upload"/>
          </label>
        </div>
        <div class="frame18-1-wrapper">
          <div class="or-parent">
            <b class="or">OR</b>
            <div class="frame-child2"></div>
            <div class="frame-child3"></div>
          </div>
        </div>
        <div class="frame18-1-wrapper">
          <div class="rectangle-parent">
            <textarea class="rectangle-textarea" name="input-data-text-area" placeholder="Input data..."></textarea>
          </div>
        </div>
        <div class="frame18-1-wrapper">
          <button class="train-wrapper" id="train-button" type="submit" name="submit">
            <b class="train">TRAIN</b>
          </button>
        </div>
        <div class="frame-wrapper2">
          <div class="frame-21-wrapper">
            <button class="frame-21" id="your-models-button" type="submit" name="your-models">
              <div class="frame-21-child"></div>
              <b class="your-models">YOUR MODELS</b>
            </button>
          </div>
        </div>
      </form>
    </div>
  </body>

  <script>
    document.getElementByClassName('train-your-data-parent').onsubmit = function() {
      var clusterTextField = document.getElementById('model-name-text-field');

      if (clusterTextField.value.trim() === '') {
        alert('The field cannot be empty. Please enter some number!');
      }
    }
  </script>
</html>


  <!-- <div class="macbook-air-1">
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

      <input class="frame7" placeholder="Number of Clusters" type="text" name="cluster-number"/>

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
  </div> -->


