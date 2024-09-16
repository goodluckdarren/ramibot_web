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
        $sql = "SELECT DISTINCT `$selectedColumn` FROM button_list WHERE `$selectedColumn` IS NOT NULL AND `$selectedColumn` != ''";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "<ul>";    
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<li>" . htmlspecialchars($row[$selectedColumn]) . "</li>";
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
