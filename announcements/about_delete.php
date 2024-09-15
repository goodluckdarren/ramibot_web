<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['info_id'])) {
    $info_id = $_POST['info_id'];

    $delete_query = "DELETE FROM apcinfo_img WHERE info_id = ?";
    $stmt = mysqli_prepare($con, $delete_query);    
    mysqli_stmt_bind_param($stmt, 'i', $info_id);
    mysqli_stmt_execute($stmt);
    $fileName = $_FILES['fileInput']['name'];       


    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo 'Image has been deleted successfully.';
        add_user_log($_SESSION['user_id'], "Deleted about APC image '" . $fileName . "'");  
    } else {
        echo "Error deleting image: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Invalid request.";
}
?>
