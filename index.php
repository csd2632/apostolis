<?php
$isloggedin = false;
// Αρχικοποιήστε τη συνεδρία
if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
  // session isn't started
  session_start();
}

// Ελέγξτε εάν ο χρήστης είναι ήδη συνδεδεμένος, αν ναι, ανακατευθύνετε τον στην αρχική σελίδα
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  $isloggedin = true;
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
              if (session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
                // session isn't started
                session_start();
              }
              // Αποθήκευση δεδομένων σε μεταβλητές περιόδου σύνδεσης
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;

              // Αλλαγή της μεταβλητής σε loggin in user
              $isloggedin = true;
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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.rawgit.com/theus/chart.css/v1.0.0/dist/chart.css" />
  <link rel="stylesheet" href="./style.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="modal fade" id="logInPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel"><text>Σύνδεση</text></h4>
        </div>
        <div class="modal-body">
          <?php
          if (!empty($login_err)) {
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
          }

          ?>

          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

            <div class="form-group">
              <label for="loginUserName" class="text-left col-form-label"><text>Όνομα Χρήστη:</text></label>
              <input id="loginUserName" class="form-control" type="text" name="username" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>>

            </div>
            <div class="form-group">
              <label for="loginPassword" class="col-form-label"><text>Κωδικός:</text></label>
              <input class="form-control text-center" id="loginPassword" type="password" name="password" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>">
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            Close
          </button>
          <input type="submit" class="btn btn-primary" value="Σύνδεση">
          </form>

        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">

          <li class="nav-item mx-3"><button class="btn btn-muted navbar-btn text-light" id="signUpButton" data-toggle="modal" data-target="#registerPopUp" <?php echo ($isloggedin == true) ? 'hidden' : ''; ?>>
              <text>Sign Up</text></button>
          </li>
          <li class="nav-item mx-1"><button class="btn btn-muted navbar-btn text-light" id="logInButton" data-toggle="modal" data-target="#logInPopUp" <?php echo ($isloggedin == true) ? 'hidden' : ''; ?>><text>Login</text></button></li>
          <a id="logoutLink" href="logout.php" hidden></a>
          <li class="nav-item mx-1" <?php echo ($isloggedin == false) ? 'hidden' : ''; ?>><button class="btn btn-danger navbar-btn" onclick="logOut()">Έξοδος</button></li>
          <li class="nav-item mx-1"><button class="btn btn-warning navbar-btn" onclick="Impressionism()">Impressionism</button></li>
          <li class="nav-item mx-1"><button class="btn btn-success navbar-btn" onclick="Surrealism()">Surrealism</button></li>
          <li class="nav-item mx-1"><button class="btn btn-info navbar-btn" id="printPdfButton">Print Screen</button></li>

        </ul>
      </div>

    </nav>


    <form class="col-md-offset-3" autocomplete="off">


      <div class="autocomplete" style="width:300px;">

        <input id="myInput" type="text" name="Search work of art" placeholder="Search work of art">
      </div>
    </form>
    <!-- <nav class="navbar navbar-expand-lg navbar-fixed-top">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">ART GALLERY</a>
      </div>
      <div></div>
      <ul class="nav navbar-nav">
        <li class="nav-item active"><a href="#">Home</a></li>
        <li class="nav-item"><button class="btn btn-danger navbar-btn" onclick="Impressionism()">Impressionism</button></li>
        <li class="nav-item"><button class="btn btn-danger navbar-btn" onclick="Surrealism()">Surrealism</button></li>
        <li class="nav-item"><button class="btn btn-primary navbar-btn" id="printPdfButton">Print Screen As Pdf</button></li>

      </ul>
      <div class="nav navbar-nav">
        <form class="nav-item autocomplete" autocomplete="off">
          <input id="myInput" type="text" name="Search work of art" placeholder="Search work of art">
        </form>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li class="nav-item"><button class="btn btn-muted navbar-btn" id="signUpButton" data-toggle="modal" data-target="#registerPopUp"><span class="glyphicon glyphicon-user"></span> Sign Up</button></li>
        <li class="nav-item"><button class="btn btn-muted navbar-btn"><span class="glyphicon glyphicon-log-in"></span> Login</button></li>
      </ul>

    </nav> -->




    <div id=templates></div>
    <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
    <span class="menu-toggle"></span>
    <div id=templates></div>
    <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
    <span class="menu-toggle"></span>



    <!-- modals  -->
    <!-- <div class="modal fade" id="registerPopUp" tabindex="-1" role="dialog" aria-labelledby="registerArea" hidden>
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
    </div> -->
  </div>




  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="data.js"></script>
  <script src="./func/mapped_img.js"></script>
  <script type="text/javascript"></script>
  <script type="text/javascript"></script>
  <script src="./func/templates.js"></script>
  <script src="./func/autocomplete.js"></script>
  <script src="./main.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>


</html>