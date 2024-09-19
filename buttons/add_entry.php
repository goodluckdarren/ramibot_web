<?php
require_once '../database_connect.php';
require_once('../scripts/user_logs.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['column']) && isset($_POST['value'])) {
    $column = $_POST['column'];
    $value = $_POST['value'];

    $allowed_columns = [
        'Main_Menu',
        'Office_Schedule',
        'Faculty_Schedule',
        'SOE_Faculty',
        'SOAR_Faculty',
        'SOCIT_Faculty',
        'SOM_Faculty',
        'SOMA_Faculty',
        'SHS_Faculty',
        'GS_Faculty',
        'Programs_Offered',
        'School_Information',
        'Other_Information',
        'Accreditations_and_Certifications',
        'Tuition_Fees',
        'School_Calendar',
        'School_Organizations',
        'Floor_Maps'
    ];

    if (!in_array($column, $allowed_columns)) {
        echo "Invalid column name.";
        exit;
    }

    $stmt = $con->prepare("INSERT INTO button_list ($column) VALUES (?)");
    if (!$stmt) {
        echo "Prepare failed: " . $con->error;
        exit;
    }
    $stmt->bind_param("s", $value);

    if ($stmt->execute()) {
        echo "Entry added successfully!";
        add_user_log($_SESSION['user_id'], "Added entry '" . $value . "' to column '" . $column . "'");
    } else {
        echo "Execute failed: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
