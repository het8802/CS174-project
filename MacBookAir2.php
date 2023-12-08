<?php
require_once 'User.php';
require_once 'Model.php';

error_reporting(E_ALL);
ini_set('display_errors',1);
session_start();
checkLogin();

if (isset($_POST['logout-button'])) {
  logout();
}

if (isset($_POST['model-button'])) {
  $modelName = $_POST['model-name'];
  $modelData = fetchModel($_SESSION['user'], $modelName);

  $_SESSION['model-data'] = $modelData;
  header("Location: MacBookAir4.php");
  exit();
}

if (isset($_POST['submit'])) {
  $modelName = $_POST['model-name'];

  if (!$modelName) {
    handleError("Please enter a model name to continue!");
  }
  
  $model = $_SESSION['model-data'];
  if (saveTrainingDataInModels($model, $_SESSION['user'], $modelName)) {
    header("Location: MacBookAir4.php");
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

        <button class="frame8" id="save-button" type="submit" name="submit">
          <div class="frame-child10"></div>
          <b class="save">SAVE</b>
        </button>
        <div class="frame9">
          <b class="or1">OR</b>
          <div class="frame-child11"></div>
          <div class="frame-child12"></div>
        </div>
      </form>

      <?php
        $models = fetchModels($_SESSION['user']);
        $top = 591; // adjusting the top of each button

        foreach ($models as $model) {

            echo '<form method="post" action="MacBookAir2.php">';
            echo '  <input type="hidden" name="model-name" value="' . $model['model_name'] . '">';
            echo '  <button class="frame10" style="top: ' . $top . 'px" type="submit" name="model-button">';
            echo '    <div class="frame-child10"></div>';
            echo '    <b class="model-1">' . $model['model_name'] . '</b>';
            echo '  </button>';
            echo '</form>';

            $top += 86;
        }
      ?>

    </div>
  </body>

  <script>
    // Calculate the total content height
    const totalContentHeight = document.documentElement.scrollHeight;

    // Set an element's height using viewport units to match the content height
    const element = document.getElementByClassName('macbook-air-2');
    element.style.height = `${totalContentHeight}px`;

  </script>
</html>


