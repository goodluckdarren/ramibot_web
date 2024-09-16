<?php
require_once('../database_connect.php');

if (isset($_POST['column']) && isset($_POST['value'])) {
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Prepare the SQL statement to delete the specific value from the column
    $sql = "DELETE FROM button_list WHERE `$column` = ?";
    $stmt = mysqli_prepare($con, $sql);
    
    if ($stmt === false) {
        die("Error preparing the query: " . mysqli_error($con));
    }

    // Bind the value (we use 's' for string since values will be text)
    mysqli_stmt_bind_param($stmt, 's', $value);

    if (mysqli_stmt_execute($stmt)) {
        echo "Entry deleted successfully.";
    } else {
        echo "Error deleting entry: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
