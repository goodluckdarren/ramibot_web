<?php
require_once '../database_connect.php';
require_once '../scripts/user_logs.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['sched_id']) && isset($_POST['action'])) {
        $schedId = $_POST['sched_id'];
        $action = $_POST['action'];

        // First, fetch the image URL for deletion
        $selectQuery = "SELECT img_url FROM faculty_scheds WHERE sched_id = ?";
        $stmt = mysqli_prepare($con, $selectQuery);
        mysqli_stmt_bind_param($stmt, "i", $schedId);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $imgUrl);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        // Proceed based on the action specified
        if ($action == 'delete_image') {
            if (!empty($imgUrl) && file_exists($imgUrl)) {
                // Delete the image from the directory
                unlink($imgUrl);
            }

            // Query to remove the image URL from the database
            $updateQuery = "UPDATE faculty_scheds SET img_url = NULL WHERE sched_id = ?";
            $stmt = mysqli_prepare($con, $updateQuery);
            mysqli_stmt_bind_param($stmt, "i", $schedId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Image URL deleted and image file removed successfully.";
            } else {
                echo "Error deleting image URL: " . mysqli_error($con);
            }

        } elseif ($action == 'delete_row') {
            if (!empty($imgUrl) && file_exists($imgUrl)) {
                // Delete the image from the directory before deleting the row
                unlink($imgUrl);
            }

            // Query to delete the entire row
            $deleteQuery = "DELETE FROM faculty_scheds WHERE sched_id = ?";
            $stmt = mysqli_prepare($con, $deleteQuery);
            mysqli_stmt_bind_param($stmt, "i", $schedId);

            if (mysqli_stmt_execute($stmt)) {
                echo "Schedule and associated image deleted successfully.";
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
