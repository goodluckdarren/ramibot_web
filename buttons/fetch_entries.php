<?php
require_once('../database_connect.php');

// Check if $conn is defined and is a valid MySQLi object
if (!isset($con) || !$con instanceof mysqli) {
    die("Database connection failed.");
}

if (isset($_POST['category']) && !empty($_POST['category'])) {
    $selectedColumn = $_POST['category'];
    $columns = ['Main_Menu', 'Office_Schedule', 'Faculty_Schedule', 'SOE_Faculty', 'SOAR_Faculty', 'SOCIT_Faculty', 'SOM_Faculty', 'SOMA_Faculty', 'SHS_Faculty', 'GS_Faculty', 'Programs_Offered', 'School_Information', 'Other_Information', 'Accreditations_and_Certifications', 'Tuition_Fees', 'School_Calendar', 'School_Organizations', 'Floor_Maps'];
    
    if (in_array($selectedColumn, $columns)) {
        // Fetch all rows with the selected column
        $sql = "SELECT `$selectedColumn` FROM button_list WHERE `$selectedColumn` IS NOT NULL AND `$selectedColumn` != ''";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "<ul id='entries-list-container'>";    
            while ($row = mysqli_fetch_assoc($result)) {
                $entryValue = htmlspecialchars($row[$selectedColumn]);

                // Create an editable input field for each entry and a delete button
                echo "<li>";
                echo "<input type='text' class='editable-entry' name='entries[]' value='$entryValue'>";
                echo "<button type='button' class='delete-btn' data-column='$selectedColumn' data-value='$entryValue'>Delete</button>";
                echo "</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }
    } else {
        echo "<p>Invalid column selected.</p>";
    }
} else {
    echo "<p>No category selected.</p>";
}
?>
