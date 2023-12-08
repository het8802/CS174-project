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
          <button class="logout-wrapper" id="logout-button">
            <b class="logout">LOGOUT</b>
          </button>
        </div>
      </header>
      <div class="frame-group">
        <div class="frame-div"></div>
        <footer class="frame-wrapper">
          <div class="frame-div">
            <button class="frame-21" id="your-models-button">
              <div class="frame-21-child"></div>
              <b class="your-models">YOUR MODELS</b>
            </button>
          </div>
        </footer>
      </div>
    </div>

    <script>
      var frame21 = document.getElementById("your-models-button");
      if (frame21) {
        frame21.addEventListener("click", function (e) {
          window.location.href = "./MacBookAir3.html";
        });
      }
      </script>
  </body>
</html>
