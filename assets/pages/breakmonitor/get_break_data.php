<?php
require_once 'db_connect.php';

// Get the current date
$currentDate = date('Y-m-d');

// Calculate the start and end timestamps for the desired period
$startTimestamp = strtotime($currentDate . ' 19:00:00');
$endTimestamp = strtotime($currentDate . ' +1 day 07:00:00');

// Convert timestamps to Y-m-d H:i:s format for SQL query
$startDateTime = date('Y-m-d H:i:s', $startTimestamp);
$endDateTime = date('Y-m-d H:i:s', $endTimestamp);

$sql = "SELECT * FROM register WHERE timestamp BETWEEN '$startDateTime' AND '$endDateTime' ORDER BY timestamp DESC";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($data);
?>
