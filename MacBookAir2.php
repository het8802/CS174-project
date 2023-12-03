<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir2.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-2">
      <b class="model-trained">Model Trained</b>
      <b class="choose-a-model">Choose a model</b>
      <div class="frame6">
        <div class="frame-child8"></div>
        <b class="k-means-clustering1">K-Means Clustering</b>
      </div>
      
      <form method="post" action="MacBookAir2.php">
        <button class="rectangle-group" id="logout-button" name="logout-button" type="submit">
          <div class="frame-child9"></div>
          <b class="logout1">LOGOUT</b>
        </button>
        <input
          class="frame7"
          id="model-name-text-field"
          placeholder="Name your model"
          type="text"
          name="model-name"
        />

        <button class="frame8" id="save-button" type="submit" value="submit">
          <div class="frame-child10"></div>
          <b class="save">SAVE</b>
        </button>
      </form>
      <div class="frame9">
        <b class="or1">OR</b>
        <div class="frame-child11"></div>
        <div class="frame-child12"></div>
      </div>
      <button class="frame10" id="frame2">
        <div class="frame-child10"></div>
        <b class="model-1">Model 1</b>
      </button>
      <button class="frame11" id="frame3">
        <div class="frame-child10"></div>
        <b class="model-1">Model 2</b>
      </button>
    </div>

    <script>
      // var frameButton = document.getElementById("logout-button");
      // if (frameButton) {
      //   frameButton.addEventListener("click", function (e) {
      //     window.location.href = "./Login.html";
      //   });
      // }
      
      // var frame1 = document.getElementById("save-button");
      // if (frame1) {
      //   frame1.addEventListener("click", function (e) {
      //     window.location.href = "./MacBookAir4.php";
      //   });
      // }
      
      // var frame2 = document.getElementById("frame2");
      // if (frame2) {
      //   frame2.addEventListener("click", function (e) {
      //     window.location.href = "./MacBookAir4.php";
      //   });
      // }
      
      // var frame3 = document.getElementById("frame3");
      // if (frame3) {
      //   frame3.addEventListener("click", function (e) {
      //     window.location.href = "./MacBookAir4.php";
      //   });
      // }
      </script>
  </body>
</html>


<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

require_once 'User.php';
require_once 'Model.php';
session_start();
checkLogin();

if (isset($_POST['logout-button'])) {
  logout();
}

$modelName = $_POST['model-name'];

if ($modelName) {
  print_r($_SESSION['model-data']);
  
  $model = json_decode($_SESSION['model-data'], true)['centroids']; //convert the string to json first and then access the centroids
  echo "<br>";
  print_r($model);
  saveTrainingDataInModels(json_encode($model), $_SESSION['user'], $modelName);
}
?>