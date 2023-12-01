<!DOCTYPE html>
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
      <button class="rectangle-parent" id="logout-button">
        <div class="frame-child3"></div>
        <b class="logout">LOGOUT</b>
      </button>
      <div class="frame2">
        <button class="component-parent" id="uploadButton">
          <div class="frame-child4"></div>
          <b class="upload-file">Upload File</b>
        <input type="file" id="fileInput" style="display: none;" />
        </button>
      </div>
      <div class="frame3">
        <b class="or">OR</b>
        <div class="frame-child5"></div>
        <div class="frame-child6"></div>
      </div>
      <textarea class="frame4" placeholder="Input data..."></textarea>
      <button class="frame5" disabled="{true}" id="test-button">
        <div class="frame-child7"></div>
        <b class="test">TEST</b>
      </button>
    </div>

    <script>
      document.getElementById('uploadButton').addEventListener('click', function () {
        document.getElementById('fileInput').click();
      });

      document.getElementById('fileInput').addEventListener('change', function () {
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
      </script>
  </body>
</html>
