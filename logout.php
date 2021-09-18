<?php

session_start();
 

// Καταργήστε τη ρύθμιση όλων των μεταβλητών συνεδρίας
$_SESSION = array();
// Καταστρέψτε την περίοδο σύνδεσης.
session_destroy();
 
// Ανακατεύθυνση στη σελίδα index
header("location: index.php");
exit;
?>