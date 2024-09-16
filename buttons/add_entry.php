<?php
require_once '../database_connect.php';

if (isset($_POST['column']) && isset($_POST['value'])) {
    $column = $_POST['column'];
    $value = $_POST['value'];

    // Prepare and bind
    $stmt = $con->prepare("INSERT INTO button_list (`$column`) VALUES (?)");
    $stmt->bind_param("s", $value);

    if ($stmt->execute()) {
        echo "Entry added successfully!";
    } else {
        echo "Error: " . mysqli_error($con);
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
