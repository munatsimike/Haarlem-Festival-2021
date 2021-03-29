<?php
// Initialize the session
if ( ! isset($_SESSION)) session_start();
 
// Unset all of the session variables
unset($_SESSION['loggedin']);
unset($_SESSION['username']);

// Redirect to login page
header("location: ../../index.php");
exit;
?>