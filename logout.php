<?php
session_start();
// Clear session variables
// (You can add any additional session variables you're using)
// For example: unset($_SESSION['user_authenticated']);

// Destroy the session
session_destroy();

// Redirect to the login page
header("Location: index.html");
exit();
?>
