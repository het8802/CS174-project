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

if (isset($_POST['back-button'])){
  header('Location: MacBookAir3.php');
  exit;
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
  echo "model data: <br>";
  print_r($_SESSION['model-data']);
  $testResults = testModel($twoDArray, $_SESSION['model-data']);
  header("Location: MacBookAir5.php");
  exit();
}
?>


<!-- <!DOCTYPE html>
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
</html> -->

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir4.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-7">
      <header class="macbook-air-7-inner">
        <div class="frame-parent3">
          <div class="frame6">
            <b class="k-means-clustering2">K-Means Clustering</b>
          </div>
          <form action="MacBookAir4.php" method="post">
            <button class="frame-button" name="logout-button" type="submit">
              <b class="logout3">LOGOUT</b>
            </button>
          </form>
        </div>
      </header>
      <form class="test-your-data-parent" method="post" enctype="multipart/form-data" action="MacBookAir4.php">
        <b class="test-your-data">Test your data</b>
        <div class="frame-wrapper7">
          <label class="upload-file-container">
            <b class="upload-file1">Upload File</b>
            <input type="file" accept=".txt, .text/plain" name="file-upload"  id="fileInput" style="display: none;" name='file-upload'/>
          </label>
        </div>
        <div class="frame-wrapper7">
          <div class="or-container">
            <b class="or2">OR</b>
            <div class="frame-child6"></div>
            <div class="frame-child7"></div>
          </div>
        </div>
        <div class="frame-wrapper7">
          <textarea type="text" class="frame-textarea" name="input-data-text-area" placeholder="Input data..."></textarea>
        </div>
        <div class="frame-wrapper7">
          <button class="test-container" id="train-button" type="submit" name="submit">
            <b class="test1">TEST</b>
          </button>
        </div>
        <div class="frame-wrapper11">
          <div class="frame-21-wrapper1">
            <button class="frame-215" type="submit" name="back-button">
              <b class="back2">BACK</b>
            </button>
          </div>
        </div>
      </form>
    </div>

    <script>
      var frame21 = document.getElementById("your-models-button");
      if (frame21) {
        frame21.addEventListener("click", function (e) {
          alert("script");
          window.location.href = "./MacBookAir2.php";
        });
      }
      </script>
  </body>
</html>


