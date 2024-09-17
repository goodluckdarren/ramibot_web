<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

if (isset($_POST['entries']) && isset($_POST['category'])) {
    $entries = $_POST['entries'];  // Array of all the entry values
    $category = $_POST['category'];

    // Prepare SQL to delete all the current entries in the selected column
    $delete_sql = "DELETE FROM button_list WHERE `$category` IS NOT NULL";
    if (!mysqli_query($con, $delete_sql)) {
        die("Error deleting entries: " . mysqli_error($con));
    }

    // Insert new entries
    foreach ($entries as $entry) {
        // Avoid inserting empty entries
        if (!empty(trim($entry))) {
            $stmt = $con->prepare("INSERT INTO button_list (`$category`) VALUES (?)");
            $stmt->bind_param("s", $entry);
            
            if ($stmt->execute()) {
                // Optionally add user log
                add_user_log($_SESSION['user_id'], "Updated entry '" . $entry . "' in column '" . $category . "'");
            } else {
                echo "Error: " . mysqli_error($con);
            }
            $stmt->close();
        }
    }

    echo "Entries updated successfully.";
} else {
    echo "Invalid request.";
}
?>
