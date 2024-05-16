<?php
require_once('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editIdNumber'])) {
    $idNumber = $_POST['editIdNumber'];
    $profession = $_POST['editProfession'];
    $lastName = $_POST['editLastName'];
    $givenName = $_POST['editGivenName'];
    $middleInitial = $_POST['editMiddleInitial'];
    $nickname = $_POST['editNickname'];

    // Prepare and execute UPDATE query
    $updateQuery = "UPDATE ramibot_faces SET Profession=?, Last_Name=?, Given_Name=?, MI=?, nickname=? WHERE ID_Number=?";
    $updateStmt = $con->prepare($updateQuery);
    $updateStmt->bind_param("ssssss", $profession, $lastName, $givenName, $middleInitial, $nickname, $idNumber);

    if ($updateStmt->execute()) {
        // Check if any rows were affected
        if ($updateStmt->affected_rows > 0) {
            echo "User details updated successfully.";
        } else {
            echo "No rows were affected. ID number may not exist in the database.";
        }
    } else {
        // Handle query execution errors
        echo "Error updating user details: " . $updateStmt->error;
    }

    $updateStmt->close();
} else {
    echo "Invalid request.";
}
?>
