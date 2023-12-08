<?php
require_once "User.php";
require_once "Model.php";
session_start();
checkLogin();

if (isset($_POST['logout-button'])) {
    logout();
}
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir5.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-6">
      <header class="macbook-air-6-inner">
        <div class="frame-parent">
          <div class="frame1">
            <b class="k-means-clustering">K-Means Clustering</b>
          </div>
          <form action="MacBookAir5.php" method="post">
            <button class="logout-wrapper" type="submit" name="logout-button">
                <b class="logout">LOGOUT</b>
            </button>
          </form>
        </div>
      </header>
      <div class="frame-group">
        <div class="frame-div">
        
        <?php
        $testResults = $_SESSION['test-results'];

        $testData = $_SESSION['test-data'];

        $centroids = $_SESSION['model-data'];
        $centroids = json_decode($centroids);
        foreach (array_keys($testData) as $i) {
            echo "<br>The data point ". json_encode($testData[$i]). 
            " belongs to Cluster with centroid: ". 
            json_encode($centroids[$testResults[$i]]);
        }
        ?>
        </div>
      </div>
    </div>

  </body>
</html>
