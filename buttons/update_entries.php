<?php
require_once('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['category']) && isset($_POST['entries'])) {
        $category = $_POST['category'];
        $entries = $_POST['entries'];

        // Clear out all existing entries in the selected column
        $delete_query = "UPDATE button_list SET `$category` = NULL";
        if (!$con->query($delete_query)) {
            echo "Error clearing old entries: " . $con->error;
            exit;
        }

        // Re-insert the updated entries
        foreach ($entries as $entry) {
            if (!empty($entry)) {
                // Prepare and insert the new entry
                $insert_query = $con->prepare("INSERT INTO button_list (`$category`) VALUES (?)");
                $insert_query->bind_param("s", $entry);
                
                if (!$insert_query->execute()) {
                    echo "Error inserting entries: " . $con->error;
                    exit;
                }
            }
        }

        echo "Entries updated successfully.";
    } else {
        echo "Invalid request: Missing category or entries.";
    }
} else {
    echo "Invalid request method.";
}
?>
