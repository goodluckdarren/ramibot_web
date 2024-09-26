<?php
require_once('../database_connect.php');
require_once('../scripts/user_logs.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['category']) && isset($_POST['entries'])) {
        $category = $_POST['category'];
        $entries = json_decode($_POST['entries'], true);

        if (!is_array($entries)) {
            echo "Invalid data format for entries.";
            exit;
        }

        // Verify if the column exists in the database
        $result = $con->query("DESCRIBE button_list");
        $columns = [];
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        if (!in_array($category, $columns)) {
            echo "Column '$category' does not exist.";
            exit;
        }

        // Insert new entries only if they do not already exist
        $insert_query = $con->prepare("INSERT INTO button_list ($category) VALUES (?) ON DUPLICATE KEY UPDATE $category=$category");
        if (!$insert_query) {
            echo "Prepare failed: " . $con->error;
            exit;
        }

        foreach ($entries as $entry) {
            if (!empty($entry)) {
                $insert_query->bind_param("s", $entry);
                if (!$insert_query->execute()) {
                    echo "Error inserting entries: " . $insert_query->error;
                    exit;
                }
            }
        }

        echo "Entries updated successfully.";
        add_user_log($_SESSION['user_id'], "Updated entries in column '$category'");
    } else {
        echo "Invalid request: Missing category or entries.";
    }
} else {
    echo "Invalid request method.";
}
?>
