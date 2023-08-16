<?php
// Start session
session_start();

// Check if the user is not authenticated
if (!isset($_SESSION['user_authenticated'])) {
    // Redirect to the login page
    header("Location: ../../index.html");
    exit();
}

// After successful authentication
$employeeName = $_SESSION['employeeName']; // Retrieve the employee name from the session
?>

