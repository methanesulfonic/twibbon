<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Twibbon Microprocessor dan Microcontroller</title>
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js">
    </script>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    Jenis Twibbon
    <select id = "twibbonimg">
      <option value="img/melekteknologi.png">Microprocessor dan Microcontroller</option>
    </select>
    Photo <input type="file" id="photoimg" value=""> <br>
    Lebar <input type="range" id="width" value="450" min="0" max="900" step="1">
    
    Horizontal <input type="range" id="top" value="1" min="-100" max="200" step="1">
    Vertikal <input type="range" id="left" value="1" min="-100" max="200" step="1">

    <hr>

    <div class="card">
      <h2>Hasil Twibbon</h2>
      <div class="twibbon">
        <img src="" id = "twibbon" alt="">
        <img src="" id = "photo" alt="">
      </div>
      <a href="#" id = "download">Unduh Twibbon</a>
    </div>

    <script type="text/javascript">
      var photoimg = "";
      // Upload image to the directory
      $(document).ready(function() {
          $('#photoimg').change(function(){
              var formData = new FormData();
              var files = $('#photoimg')[0].files;
              formData.append('photo', files[0]);
              $.ajax({
                  url: "upload.php",
                  type: "POST",
                  data: formData,
                  contentType: false,
                  processData: false,
                  success: function(response){
                    photoimg = response;
                  }
              });
          });
      });


      
// Update the preview when sliders are adjusted
$('#width, #height, #top, #left').on('input', function() {
    preview();
});

// Initialize the preview
preview();

      function preview(){
    var twibbonimg = $('#twibbonimg').val();
    var width = $('#width').val() + 'px';
    var height = $('#width').val() + 'px';
    var top = $('#top').val() + 'px';
    var left = $('#left').val() + 'px';
    $("#photo").attr("src", photoimg);
    $('#twibbon').attr("src", twibbonimg);
    $('#photo').css("width", width);
    $('#photo').css("height", height);
    $('#photo').css("top", top);
    $('#photo').css("left", left);
      }

      // Download twibbon
      var element = $(".twibbon");
      $("#download").on('click', function(){
        html2canvas(element, {
          onrendered: function(canvas) {
            var imageData = canvas.toDataURL("image/png");
            var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");
            $("#download").attr("download", "image.png").attr("href", newData);
          }
        });
      });
    </script>
  </body>
</html>
