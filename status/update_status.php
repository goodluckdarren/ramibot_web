<?php
require_once('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statusType = $_POST['statusType'];

    if ($statusType === 'lidar') {
        // Update LIDAR status in the database
        $updateStatusStmt = $con->prepare("UPDATE admin_control SET LIDAR_start = 1 WHERE ID = 1");
    } elseif ($statusType === 'positioning') {
        // Update Positioning status in the database
        $updateStatusStmt = $con->prepare("UPDATE admin_control SET Ramibot_Return = 1 WHERE ID = 1");
    }

    if ($updateStatusStmt->execute()) {
        echo "Status updated successfully";
    } else {
        echo "Error updating status: " . $updateStatusStmt->error;
    }

    $updateStatusStmt->close();
}

$con->close();
?>
