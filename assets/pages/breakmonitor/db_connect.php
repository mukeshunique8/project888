<?php
$servername = "sql209.infinityfree.com";
$username = "if0_34412041";
$password = "aLhF4AUN9DKj";
$dbname = "if0_34412041_break";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
