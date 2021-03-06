<?php

// Αρχικοποιήστε τη συνεδρία
session_start();
 

// Ελέγξτε εάν ο χρήστης είναι ήδη συνδεδεμένος, αν ναι, ανακατευθύνετε τον στην αρχική σελίδα
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: home.php");
    exit;
}
 
// Συμπερίληψη αρχείου διαμόρφωσης
require_once "config.php";
 
// Ορισμός μεταβλητών και αρχικοποίηση με κενές τιμές
$username = $password = "";
$username_err = $password_err = $login_err = "";
 

// Επεξεργασία δεδομένων φόρμας όταν υποβάλλεται η φόρμα
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
// Ελέγξτε αν το όνομα χρήστη είναι κενό
    if(empty(trim($_POST["username"]))){
        $username_err = "Παρακαλώ εισάγετε το όνομα χρήστη.";
    } else{
        $username = trim($_POST["username"]);
    }
    
// Ελέγξτε αν ο κωδικός πρόσβασης είναι κενός
    if(empty(trim($_POST["password"]))){
        $password_err = "Παρακαλώ εισάγετε τον κωδικό σας.";
    } else{
        $password = trim($_POST["password"]);
    }
    

// Επικύρωση διαπιστευτηρίων
    if(empty($username_err) && empty($password_err)){
// Προετοιμάστε μια επιλεγμένη δήλωση
        $sql = "SELECT id, username, password FROM account WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
// Συνδέστε μεταβλητές στην προετοιμασμένη πρόταση ως παραμέτρους
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
// Ορισμός παραμέτρων
            $param_username = $username;
            

// Προσπάθεια εκτέλεσης της προετοιμασμένης δήλωσης
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);

// Ελέγξτε εάν υπάρχει όνομα χρήστη, αν ναι, επαληθεύστε τον κωδικό πρόσβασης
                if(mysqli_stmt_num_rows($stmt) == 1){                    

// Συνδέστε μεταβλητές αποτελεσμάτων
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){

// Ο κωδικός πρόσβασης είναι σωστός, οπότε ξεκινήστε μια νέα συνεδρία
                            session_start();
                            
// Αποθήκευση δεδομένων σε μεταβλητές περιόδου σύνδεσης
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
// Ανακατεύθυνση χρήστη στην αρχική σελίδα
                            header("location: home.php");
                        } else{

// Ο κωδικός πρόσβασης δεν είναι έγκυρος, εμφανίστε ένα γενικό μήνυμα σφάλματος
                            $login_err = "Μη έγκυρο όνομα ή κωδικός.";
                        }
                    }
                } else{

// Το όνομα χρήστη δεν υπάρχει, εμφανίστε ένα γενικό μήνυμα σφάλματος
                    $login_err = "Μη έγκυρο όνομα ή κωδικός.";
                }
            } else{
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="js/custom.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="js/custom.js"></script>
    <script type="text/javascript" src="data.js"></script>
    <script src="./func/mapped_img.js"></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "> </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.rawgit.com/theus/chart.css/v1.0.0/dist/chart.css" />
    <link rel="stylesheet" href="./style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

    <a href="https://selectpdf.com/export-to-pdf/?" onclick="if(!this.urlAdded)href+='&url='+encodeURIComponent(location.href);this.urlAdded=1"><img src="https://selectpdf.com/buttons/save-as-pdf3.gif"/></a>
  
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

    <form autocomplete="off" >
      
      <div class="autocomplete" style="width:300px;">
        
        <input id="myInput" type="text" name="Search work of art" placeholder="Search work of art">
      </div>
    </form>
    <div class="img-zoom-container"> 
      <div class="row">
      </br>
    </div>
    <img width=100% height=100%  border ="10" id="myimage" src="./art_gallery.png">
     
       
  </div>
    <div id = templates></div>
    <div id="columnchart_values" style="width: 900px; height: 300px;"></div> 
    <span class="menu-toggle"></span>
	<?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  
                <label>Όνομα</label> <br>
                <input type="text" name="username"  <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?> value="<?php echo $username; ?>">
                <span><?php echo $username_err; ?></span>
        <br>
                <label>Κωδικός</label> <br>
                <input type="password" name="password"  <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>>
                <span><?php echo $password_err; ?></span>
             <br> <br> <br>
            
                <input type="submit" value="Σύνδεση">
        
        </form>
  </body>

</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript"></script>
<script type="text/javascript"></script>
<script src="./func/templates.js"></script>
<script src="./func/autocomplete.js"></script>
<script src="./main.js"></script>


