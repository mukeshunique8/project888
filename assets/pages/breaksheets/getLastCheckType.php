<?php
// Database configuration
$servername = "sql209.infinityfree.com";
$username = "if0_34412041";
$password = "aLhF4AUN9DKj";
$dbname = "if0_34412041_break";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the employeeName parameter is set in the GET request
if (isset($_GET["employeeName"])) {

    // Retrieve the employee name from the GET request
    $employeeName = $_GET["employeeName"];

    // Get the user's last check type from the database
    $sql_get_last_checkType = "SELECT check_type FROM register WHERE employee_name = '$employeeName' ORDER BY timestamp DESC LIMIT 1";
    $result_get_last_checkType = $conn->query($sql_get_last_checkType);
    if ($result_get_last_checkType && $result_get_last_checkType->num_rows > 0) {
        $row = $result_get_last_checkType->fetch_assoc();
        $lastCheckType = $row["check_type"];

        // Return the last check type as a JSON response
        $response = array("status" => "success", "lastCheckType" => $lastCheckType);
        echo json_encode($response);
        exit; // Stop further processing
    }
}

// Return an error response if the employee name is not available or there's an issue with database retrieval
$response = array("status" => "error", "message" => "Error retrieving last check type");
echo json_encode($response);
exit; // Stop further processing

// Close the database connection
$conn->close();
?>
