<?php

// Αρχικοποιήστε τη συνεδρία
session_start();

// Ελέγξτε εάν ο χρήστης είναι συνδεδεμένος, εάν όχι, ανακατευθύνετε τον στη σελίδα index
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
  header("location: index.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="js/custom.js"></script>
  <script type="text/javascript" src="data.js"></script>
  <script src="./func/mapped_img.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "> </script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.rawgit.com/theus/chart.css/v1.0.0/dist/chart.css" />
  <link rel="stylesheet" href="./style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ReportingTool</title>
</head>

<body>
  <a href="image.php">Ποσοστό Χρωμάτων</a>
  <a href="https://selectpdf.com/export-to-pdf/?" onclick="if(!this.urlAdded)href+='&url='+encodeURIComponent(location.href);this.urlAdded=1"><img src="https://selectpdf.com/buttons/save-as-pdf3.gif" /></a>
  <a href="logout.php">Έξοδος</a>

  <div id="background">
    <div class="main_container">
      <div class="menu">
        <div class="menu_element menu_action_button">
          <div></div>
          <div></div>
          <div></div>
        </div>
        <div class="menu_element menu_option">report 5</div>
        <div class="menu_element menu_option">report 4</div>
        <div class="menu_element menu_option">report 3</div>
        <div class="menu_element menu_option">report 2</div>
        <div class="menu_element menu_option">report 1</div>
        <div id="myModal" class="modal">
          <span class="close">&times;</span>
          <img class="modal-content" id="img01">
          <div id="caption"></div>
        </div>
      </div>
    </div>

    <form autocomplete="off">

      <div class="autocomplete" style="width:300px;">

        <input id="myInput" type="text" name="Search work of art" placeholder="Search work of art">
      </div>
    </form>
    <div class="img-zoom-container">
      <div class="row">
        </br>
      </div>
      <img width=100% height=100% border="10" id="myimage" src="./art_gallery.png">


    </div>
    <div id=templates></div>
    <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
    <span class="menu-toggle"></span>

</body>
</div>

</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript"></script>
<script src="./func/templates.js"></script>
<script src="./func/autocomplete.js"></script>
<script src="./main.js"></script>