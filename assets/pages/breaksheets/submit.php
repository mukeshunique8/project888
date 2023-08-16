<?php
session_start();

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

// Check if the user agent indicates a mobile device
function isMobileDevice() {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    return preg_match('/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i', $userAgent);
}

// Set session variable to block mobile submission if accessed from a mobile device
if (isMobileDevice() && !isset($_SESSION['blockMobileSubmission'])) {
    $_SESSION['blockMobileSubmission'] = true;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if the user is accessing from a mobile device and the session variable is set
    if (isMobileDevice() && isset($_SESSION['blockMobileSubmission'])) {
        // Prevent the form submission
        $response = array("status" => "error", "message" => "Form submission not allowed on mobile devices");
        echo json_encode($response);
        exit;
    }

    // Retrieve the form data
    $submittedEmployeeName = $_POST["employeeName"]; // Employee name submitted in the form
    $loggedInEmployeeName = $_SESSION["employeeName"]; // Employee name stored in the session
    $checkType = $_POST["checkType"];
    $timestamp = $_POST["timestamp"];

    // Get the user's last check type from the database
    $sql_get_last_checkType = "SELECT check_type FROM register WHERE employee_name = '$submittedEmployeeName' ORDER BY timestamp DESC LIMIT 1";
    $result_get_last_checkType = $conn->query($sql_get_last_checkType);
    if ($result_get_last_checkType && $result_get_last_checkType->num_rows > 0) {
        $row = $result_get_last_checkType->fetch_assoc();
        $lastCheckType = $row["check_type"];

        // Check if the user is trying to submit a duplicate check type
        if ($lastCheckType === $checkType) {
            // If the user is trying to submit the same check type again, send an error response
            $response = array("status" => "error", "message" => "You have already clicked $checkType.", "lastCheckType" => $lastCheckType);
            echo json_encode($response);
            exit; // Stop further processing
        }
    }

    // Check if the user is submitting a "Break Out"
    if ($checkType === "Break Out") {
        // Get the timestamp of the last "Break In" for the employee
        $sql_last_break_in_time = "SELECT timestamp FROM register WHERE employee_name = '$submittedEmployeeName' AND check_type = 'Break In' ORDER BY timestamp DESC LIMIT 1";
        $result_last_break_in_time = $conn->query($sql_last_break_in_time);

        if ($result_last_break_in_time && $result_last_break_in_time->num_rows > 0) {
            $row = $result_last_break_in_time->fetch_assoc();
            $lastBreakInTime = strtotime($row["timestamp"]);
            $currentTime = strtotime($timestamp);
            $timeDifference = $currentTime - $lastBreakInTime;

            // Check if less than 1 hour has passed since the last "Break In"
            $timeThreshold = 3600; // 1 hour in seconds
            if ($timeDifference < $timeThreshold) {
                // Calculate remaining time in minutes
                $remainingTime = ceil(($timeThreshold - $timeDifference) / 60); // Convert seconds to minutes and round up

                // Capture user information and timestamp for break attempt log
                $breakAttemptTimestamp = date("Y-m-d H:i:s", $currentTime); // Format timestamp for MySQL
                $sql_insert_attempt = "INSERT INTO break_attempt_log (employee_name, timestamp) VALUES ('$submittedEmployeeName', '$breakAttemptTimestamp')";
                if ($conn->query($sql_insert_attempt) !== TRUE) {
                    // Handle error if the attempt log insertion fails
                    // You can log an error message or take other actions as needed
                }

                // Return an error response indicating not allowed to submit "Break Out"
                $response = array(
                    "status" => "error",
                    "message" => "Break Out? Hold on, not so fast! You'll have to wait for approximately $remainingTime minutes.",
                    "lastCheckType" => $lastCheckType
                );
                echo json_encode($response);
                exit; // Stop further processing
            }
        }
    }

    // Prepare and execute the SQL query to insert data into the "register" table
$sql = "INSERT INTO register (employee_name, check_type, submitted_by,timestamp) VALUES ('$submittedEmployeeName', '$checkType', '$loggedInEmployeeName','$timestamp')";

    if ($conn->query($sql) === TRUE) {
        // If the data is inserted successfully, return a success response to the client
        $response = array("status" => "success", "message" => "Form submitted successfully", "lastCheckType" => $checkType);
        echo json_encode($response);
        exit; // Stop further processing
    } else {
        // If there's an error with the database insertion, return an error response to the client
        $response = array("status" => "error", "message" => "Error inserting data into the database");
        echo json_encode($response);
        exit; // Stop further processing
    }
} else {
    // Return an error response to the client if the form is not submitted correctly
    $response = array("status" => "error", "message" => "Invalid form submission");
    echo json_encode($response);
    exit; // Stop further processing
}

// Close the database connection
$conn->close();
?>
