<?php
// Your database connection credentials
$servername = "sql107.infinityfree.com";
$username = "epiz_33997892";
$password = "oja74jB2Q8ZypvG";
$dbname = "epiz_33997892_employeeregistration";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $email = $_POST["email"];

    // Check if the email exists in the database
    $sql = "SELECT * FROM employeeregistration WHERE mail_ID = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Email exists, generate a secure token and store it in the database
        $token = bin2hex(random_bytes(32));
        $expiration = time() + (60 * 60); // Token valid for 1 hour
        $sql = "INSERT INTO password_reset_tokens (email, token, expiration) VALUES ('$email', '$token', $expiration)";
        $conn->query($sql);

        // Send reset password link via email (you need to implement this part)
        // Example: sendResetPasswordEmail($email, $token);

        echo "Reset password link has been sent to your email address.";
    } else {
        echo "No user found with the provided email address.";
    }
}

$conn->close();
?>
