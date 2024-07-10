<?php
// Start the session
session_start();

// Destroy the session and unset all session variables
session_destroy();
unset($_SESSION['user']);

// Redirect back to the login page
echo "<script>window.location='login.php'</script>";
?>