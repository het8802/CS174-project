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
      <button class="frame-button" id="logout-button">
        <div class="frame-child27"></div>
        <b class="logout3">LOGOUT</b>
      </button>
      <button class="frame21" id="your-models-button">
        <div class="frame-child28"></div>
        <b class="model-11">Model 1</b>
      </button>
      <button class="frame22" id="your-models-button">
        <div class="frame-child28"></div>
        <b class="model-11">Model 2</b>
      </button>
      <button class="frame23" id="your-models-button">
        <div class="frame-child28"></div>
        <b class="model-11">Model 3</b>
      </button>
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
