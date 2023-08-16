<?php
// Start session (if not already started)
session_start();

// Check if the user is already logged in (check for the session variable)
if (isset($_SESSION['user_authenticated'])) {
    // Redirect the user directly to the dashboard page
    header("Location: assets/dashboard/dashboard.php");
    exit();
}

// Replace these with your actual database credentials
$servername = "sql209.infinityfree.com";
$username = "if0_34412041";
$password = "aLhF4AUN9DKj";
$dbname = "if0_34412041_employeeregistrationtable";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$employeeId = $_POST['employeeID'];
$password = $_POST['employeePassword'];

// Query to check if user exists with the given employee_ID
$sql = "SELECT * FROM employeeregistration WHERE employee_ID = '$employeeId'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $storedPassword = $row['password'];
    $employeeName = $row['employee_name'];
    $mailID = $row['mail_ID'];
    
       $profileImageRelativePath = $row['profile_image']; // Retrieve the relative path from the database
        $profileImageURL = "https://focusweb.lovestoblog.com/assets/register/" . $profileImageRelativePath; // Construct the absolute URL


    // Verify the entered password against the hashed password in the database
    if (password_verify($password, $storedPassword)) {
        // Valid credentials, set the session variables
        $_SESSION['user_authenticated'] = true;
        $_SESSION['employeeName'] = $employeeName;
        $_SESSION['employeeID'] = $employeeId;
               $_SESSION['mailID'] = $mailID; // Store email (mail_ID)
        $_SESSION['profileImageURL'] = $profileImageURL; // Store profile image URL

        // Redirect to the dashboard page
        header("Location: assets/dashboard/dashboard.php");
        exit();
    } else {
        // Invalid credentials, redirect back to the login page with an error message
        header("Location: index.html?error=1");
        exit();
    }
} else {
    // Invalid credentials, redirect back to the login page with an error message
    header("Location: index.html?error=1");
    exit();
}

$conn->close();
?>
