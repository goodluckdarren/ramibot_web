<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['calendar_id'])) {
        $calendar_id = $_POST['calendar_id'];

        $selectQuery = "SELECT img_url FROM calendars_img WHERE calendar_id = ?";
        $stmt = mysqli_prepare($con, $selectQuery);
        mysqli_stmt_bind_param($stmt, 'i', $calendar_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $imgUrl);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if (!empty($imgUrl) && file_exists($imgUrl)) {
            unlink($imgUrl);
        }

        $deleteQuery = "DELETE FROM calendars_img WHERE calendar_id = ?";
        $stmt = mysqli_prepare($con, $deleteQuery);
        mysqli_stmt_bind_param($stmt, 'i', $calendar_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo 'Image has been deleted successfully.';
            add_user_log($_SESSION['user_id'], "Deleted calendar image with ID '" . $calendar_id . "'");
        } else {
            echo "Error deleting image: " . mysqli_error($con);
        }

        mysqli_stmt_close($stmt);
        mysqli_close($con);
    } else {
        echo "Invalid request.";
    }
} else {
    echo "Invalid request method.";
}
?>
