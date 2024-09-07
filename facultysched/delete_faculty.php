<?php
    require_once('../database_connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sched_id = $_POST['sched_id'];

        // Update the img_url column to NULL or '' for the given sched_id
        $update_query = "UPDATE faculty_scheds SET img_url = '' WHERE sched_id = ?";
        $stmt = mysqli_prepare($con, $update_query);
        mysqli_stmt_bind_param($stmt, 'i', $sched_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Image column has been emptied successfully.';
        } else {
            echo "Error updating image column: " . mysqli_error($con);
        }
    }
?>
