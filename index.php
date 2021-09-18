<?php

// Αρχικοποιήστε τη συνεδρία
session_start();


// Ελέγξτε εάν ο χρήστης είναι ήδη συνδεδεμένος, αν ναι, ανακατευθύνετε τον στην αρχική σελίδα
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  header("location: home.php");
  exit;
}

// Συμπερίληψη αρχείου διαμόρφωσης
require_once "config.php";

// Ορισμός μεταβλητών και αρχικοποίηση με κενές τιμές
$username = $password = "";
$username_err = $password_err = $login_err = "";


// Επεξεργασία δεδομένων φόρμας όταν υποβάλλεται η φόρμα
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Ελέγξτε αν το όνομα χρήστη είναι κενό
  if (empty(trim($_POST["username"]))) {
    $username_err = "Παρακαλώ εισάγετε το όνομα χρήστη.";
  } else {
    $username = trim($_POST["username"]);
  }

  // Ελέγξτε αν ο κωδικός πρόσβασης είναι κενός
  if (empty(trim($_POST["password"]))) {
    $password_err = "Παρακαλώ εισάγετε τον κωδικό σας.";
  } else {
    $password = trim($_POST["password"]);
  }


  // Επικύρωση διαπιστευτηρίων
  if (empty($username_err) && empty($password_err)) {
    // Προετοιμάστε μια επιλεγμένη δήλωση
    $sql = "SELECT id, username, password FROM account WHERE username = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      // Συνδέστε μεταβλητές στην προετοιμασμένη πρόταση ως παραμέτρους
      mysqli_stmt_bind_param($stmt, "s", $param_username);

      // Ορισμός παραμέτρων
      $param_username = $username;


      // Προσπάθεια εκτέλεσης της προετοιμασμένης δήλωσης
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        // Ελέγξτε εάν υπάρχει όνομα χρήστη, αν ναι, επαληθεύστε τον κωδικό πρόσβασης
        if (mysqli_stmt_num_rows($stmt) == 1) {

          // Συνδέστε μεταβλητές αποτελεσμάτων
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {

              // Ο κωδικός πρόσβασης είναι σωστός, οπότε ξεκινήστε μια νέα συνεδρία
              session_start();

              // Αποθήκευση δεδομένων σε μεταβλητές περιόδου σύνδεσης
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;

              // Ανακατεύθυνση χρήστη στην αρχική σελίδα
              header("location: home.php");
            } else {

              // Ο κωδικός πρόσβασης δεν είναι έγκυρος, εμφανίστε ένα γενικό μήνυμα σφάλματος
              $login_err = "Μη έγκυρο όνομα ή κωδικός.";
            }
          }
        } else {

          // Το όνομα χρήστη δεν υπάρχει, εμφανίστε ένα γενικό μήνυμα σφάλματος
          $login_err = "Μη έγκυρο όνομα ή κωδικός.";
        }
      } else {
        echo "Κάτι πήγε στραβά. Παρακαλώ δοκιμάστε ξανά αργότερα.";
      }

      // Κλείσιμο δήλωσης
      mysqli_stmt_close($stmt);
    }
  }

  // Κλείσιμο σύνδεσης
  mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js" integrity="sha512-tVYBzEItJit9HXaWTPo8vveXlkK62LbA+wez9IgzjTmFNLMBO1BEYladBw2wnM3YURZSMUyhayPCoLtjGh84NQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
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
</head>

<body>

  <div id="background">
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">ART GALLERY</a>
        </div>
        <ul class="nav navbar-nav">
          <li class="active"><a href="#">Home</a></li>
          <button class="btn btn-danger navbar-btn" onclick="Impressionism()">Impressionism</button>
          <button class="btn btn-danger navbar-btn" onclick="Surrealism()">Surrealism</button>
          <button class="btn btn-primary navbar-btn" id="printPdfButton">Print Screen As Pdf</button>

        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><button class="btn btn-muted navbar-btn" id="signUpButton" data-toggle="modal" data-target="#registerPopUp"><span class="glyphicon glyphicon-user"></span> Sign Up</button></li>
          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>

      </div>
    </nav>


    <form class="col-md-offset-3" autocomplete="off">
      <div>

      </div>
      <div>
        ......
        .....
        .....
      </div>
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
  </div>
  <div id=templates></div>
  <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
  <span class="menu-toggle"></span>
  <?php
  if (!empty($login_err)) {
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
  }
  ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <label>Όνομα</label> <br>
    <input type="text" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>">
    <span><?php echo $username_err; ?></span>
    <br>
    <label>Κωδικός</label> <br>
    <input type="password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>>
    <span><?php echo $password_err; ?></span>
    <br> <br> <br>

    <input type="submit" value="Σύνδεση">

  </form>


  <!-- modals  -->
  <div class="modal fade" id="registerPopUp" tabindex="-1" role="dialog" aria-labelledby="registerArea" hidden>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registerArea">New message</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Recipient:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">Message:</label>
              <input type="text" class="form-control" id="recipient-name">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send message</button>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript"></script>
<script src="./func/templates.js"></script>
<script src="./func/autocomplete.js"></script>
<script src="./main.js"></script>