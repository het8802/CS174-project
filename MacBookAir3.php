<?php
require_once "User.php";
require_once "Model.php";
error_reporting(E_ALL);
ini_set('display_errors',1);

session_start();

if (isset($_POST['logout-button'])) {
  logout();
}

if (isset($_POST['model-button'])) {
  $modelName = $_POST['model-name'];
  $model = fetchModel($_SESSION['user'], $modelName);
  print_r($model);
  $modelData = $model['centroids'];
  print_r($modelData);

  $_SESSION['model-data'] = $modelData;
  header("Location: MacBookAir4.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="./global.css" />
    <link rel="stylesheet" href="./MacBookAir3.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-3" method="post" action="MacBookAir3.php">
      <header class="frame-group">
        <div class="your-models-wrapper">
          <b class="your-models1">Your Models</b>
        </div>
        <form action="MacBookAir3.php" method="post">
          <button class="logout-container" type="submit" name="logout-button">
            <b class="logout1">LOGOUT</b>
          </button>
        </form>
    </header>
      <div class="macbook-air-3-inner">
        <div class="frame-parent1">
        <?php $models = fetchModels($_SESSION['user']); ?>
        <?php foreach ($models as $model): ?>
            <button class="frame1">
                <b class="back"><?php echo htmlspecialchars($model['model_name']); ?></b>
            </button>
        <?php endforeach; ?>
        </div>
      </div>
      <div class="macbook-air-3-child">
        <div class="frame-21-container">
          <button class="frame-211" id="your-models-button">
            <b class="back">BACK</b>
          </button>
        </div>
      </div>
    </div>

    <script>
      var frame21 = document.getElementById("your-models-button");
      if (frame21) {
        frame21.addEventListener("click", function (e) {
          window.location.href = "./MacBookAir1.php";
        });
      }
      </script>
  </body>
</html>
