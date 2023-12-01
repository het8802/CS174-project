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
      <button class="rectangle-container" id="logout-button">
        <div class="frame-child16"></div>
        <b class="logout2">LOGOUT</b>
      </button>
      <b class="train-your-data">Train your data</b>

      <form method="post" action="MacBookAir1.php" enctype="multipart/form-data">
        <button class="frame13" id="uploadButton">
          <div class="frame-child17"></div>
          <b class="upload-file1">Upload File</b>
        </button>
        <input type="file" id="fileInput" style="display: none;" name="file-upload"/>
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
      </form>
      <button class="frame17" id="your-models-button">
        <div class="frame-child21"></div>
        <b class="your-models">YOUR MODELS</b>
      </button>
    </div>

    <script>
      document.getElementById('uploadButton').addEventListener('click', function () {
        document.getElementById('fileInput').click();
      });

      document.getElementById('fileInput').addEventListener('click', function () {
          // Handle the selected file
          var selectedFile = this.files[0];
          console.log('Selected file:', selectedFile.name);
      });

      var frameButton = document.getElementById("logout-button");
      if (frameButton) {
        frameButton.addEventListener("click", function (e) {
          window.location.href = "./Login.html";
        });
      }
      
      var frame1 = document.getElementById("train-button");
      if (frame1) {
        frame1.addEventListener("click", function (e) {
          window.location.href = "./MacBookAir2.html";
        });
      }
      
      var frame2 = document.getElementById("your-models-button");
      if (frame2) {
        frame2.addEventListener("click", function (e) {
          window.location.href = "./MacBookAir3.html";
        });
      }
      </script>
  </body>
</html>

<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$file = $_FILES['file-upload']['tmp_name'];
                    
require_once "Model.php";

if (isset($_POST['submit'])) {
  echo "submit button pressed";
}
$text = $_POST['input-data-text-area'];

if ($text) {
  var_dump($_POST); 
  processText($text);
}
else {
  processFile($file);
}
?>