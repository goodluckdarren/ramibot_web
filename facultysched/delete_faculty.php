<?php
require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sched_id']) && isset($_POST['action'])) {
        $schedId = $_POST['sched_id'];
        $action = $_POST['action'];

        if ($action == 'delete_image') {
            // Query to delete only the image URL
            $updateQuery = "UPDATE faculty_scheds SET img_url = NULL WHERE sched_id = ?";
            $stmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmt, "i", $schedId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Image URL deleted successfully.";
            } else {
                echo "Error deleting image URL: " . mysqli_error($con);
            }

        } elseif ($action == 'delete_row') {
            // Query to delete the entire row
            $deleteQuery = "DELETE FROM faculty_scheds WHERE sched_id = ?";
            $stmt = mysqli_prepare($con, $deleteQuery);
            mysqli_stmt_bind_param($stmt, "i", $schedId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Schedule deleted successfully.";
            } else {
                echo "Error deleting schedule: " . mysqli_error($con);
            }
        }

        // Close the statement and database connection
        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>
