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
    $token = $_POST["token"];
    $newPassword = $_POST["newPassword"];

    // Check if the token exists in the database and is not expired
    $currentTime = time();
    $sql = "SELECT * FROM password_reset_tokens WHERE token = '$token' AND expiration > $currentTime";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Token is valid, update the password in the database
        $row = $result->fetch_assoc();
        $email = $row["email"];
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        $sql = "UPDATE employeeregistration SET password = '$hashedPassword' WHERE mail_ID = '$email'";
        $conn->query($sql);

        // Remove the used token from the database
        $sql = "DELETE FROM password_reset_tokens WHERE token = '$token'";
        $conn->query($sql);

        echo "Password has been successfully reset.";
    } else {
        echo "Invalid or expired token.";
    }
}

$conn->close();
?>
