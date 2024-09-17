<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info_id'])) {
    $info_id = $_POST['info_id'];

    // Fetch the image URL associated with the info_id
    $selectQuery = "SELECT img_url FROM apcinfo_img WHERE info_id = ?";
    $stmt = mysqli_prepare($con, $selectQuery);
    mysqli_stmt_bind_param($stmt, 'i', $info_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $imgUrl);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Delete the image file from the directory if it exists
    if (!empty($imgUrl) && file_exists($imgUrl)) {
        unlink($imgUrl);
    }

    // Delete the related data from apcinfo_img table
    $deleteQuery = "DELETE FROM apcinfo_img WHERE info_id = ?";
    $stmt = mysqli_prepare($con, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $info_id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo 'Image has been deleted successfully.';
        add_user_log($_SESSION['user_id'], "Deleted about APC image with ID '" . $info_id . "'");
    } else {
        echo "Error deleting image: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($con);
} else {
    echo "Invalid request.";
}
?>
