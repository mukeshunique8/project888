<?php
require_once 'db_connect.php';

$currentTime = time();
$todayEvening = strtotime('today 19:00:00', $currentTime);
$nextDayMorning = strtotime('tomorrow 06:00:00', $currentTime);

$sqlBreaks = "SELECT id, employee_name, check_type, timestamp FROM register WHERE timestamp >= FROM_UNIXTIME($todayEvening) AND timestamp < FROM_UNIXTIME($nextDayMorning) ORDER BY employee_name, timestamp";
$resultBreaks = $conn->query($sqlBreaks);

$employeeData = array();

if ($resultBreaks->num_rows > 0) {
    while ($row = $resultBreaks->fetch_assoc()) {
        $employeeName = $row['employee_name'];
        $checkType = $row['check_type'];
        $timestamp = strtotime($row['timestamp']);

        if (!isset($employeeData[$employeeName])) {
            $employeeData[$employeeName] = array(
                'totalDuration' => 0,
                'lastBreakStart' => null,
            );
        }

        if ($checkType === 'Break Out') {
            $employeeData[$employeeName]['lastBreakStart'] = $timestamp;
        } elseif ($checkType === 'Break In' && $employeeData[$employeeName]['lastBreakStart'] !== null) {
            $breakStartTimestamp = $employeeData[$employeeName]['lastBreakStart'];
            $duration = $timestamp - $breakStartTimestamp;
            $employeeData[$employeeName]['totalDuration'] += $duration;
            $employeeData[$employeeName]['lastBreakStart'] = null;
        }
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($employeeData);
?>
