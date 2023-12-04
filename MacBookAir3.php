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
  $modelData = fetchModel($_SESSION['user'], $modelName);

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
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap"
    />
  </head>
  <body>
    <div class="macbook-air-3">
      <div class="frame20">
        <div class="frame-child26"></div>
        <b class="your-models1">Your Models</b>
      </div>
      <form action="MacBookAir3.php" method="post">
        <button class="frame-button" id="logout-button" name="logout-button" type="submit">
          <div class="frame-child27"></div>
          <b class="logout3">LOGOUT</b>
        </button>
      </form>

        <?php
          $models = fetchModels($_SESSION['user']);
          $top = 218; // adjusting the top of each button

          foreach ($models as $model) {

              echo '<form method="post" action="MacBookAir3.php">';
              echo '  <input type="hidden" name="model-name" value="' . $model['model_name'] . '">';
              echo '<button name="model-button" type="submit" class="frame21" style="top: ' . $top . 'px;">';
              echo '  <div class="frame-child28"></div>';
              echo '  <b class="model-11">' . $model['model_name'] . '</b>';
              echo '</button>';
              echo '</form>';

              $top += 86;
          }
        ?>

    </div>

    <script>
      var frameButton = document.getElementById("logout-button");
      if (frameButton) {
        frameButton.addEventListener("click", function (e) {
          window.location.href = "./Login.html";
        });
      }
      </script>
  </body>
</html>

