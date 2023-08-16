<?php
require_once 'db_connect.php';

// Retrieve total break counts for each employee in the desired period
$currentDate = date('Y-m-d');
$startTimestamp = strtotime($currentDate . ' 19:00:00');
$endTimestamp = strtotime($currentDate . ' +1 day 07:00:00');
$startDateTime = date('Y-m-d H:i:s', $startTimestamp);
$endDateTime = date('Y-m-d H:i:s', $endTimestamp);

$sqlCounts = "SELECT employee_name, COUNT(*) AS num_breaks FROM register WHERE timestamp BETWEEN '$startDateTime' AND '$endDateTime' GROUP BY employee_name";
$resultCounts = $conn->query($sqlCounts);

$breakCounts = array();

if ($resultCounts->num_rows > 0) {
    while ($row = $resultCounts->fetch_assoc()) {
        $employeeName = $row['employee_name'];
        $numBreaks = $row['num_breaks'] / 2; // Divide the total number of breaks by 2
        
        // Check if numBreaks is an odd number
        if ($numBreaks == (int)$numBreaks) {
            $breakCounts[$employeeName] = $numBreaks;
        } else {
            $breakCounts[$employeeName] = "Offline";
        }
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($breakCounts);
?>
