<?php
require_once('../database_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the required fields are set
    if (isset($_POST['emailInput']) && isset($_POST['usernameInput']) && isset($_POST['passwordInput']) && isset($_POST['roleInput']) && isset($_POST['statusInput'])) {
        $email = $_POST['emailInput'];
        $username = $_POST['usernameInput'];
        $password = password_hash($_POST['passwordInput'], PASSWORD_DEFAULT); // Hash the password
        $role = $_POST['roleInput'];
        $user_status = $_POST['statusInput']; // Assuming 1 for enabled, 0 for disabled

        // Insert the new user into the database
        $sql = "INSERT INTO admin_accounts (email, username, password, role, user_status) VALUES (?, ?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        
        // Check if the statement was prepared successfully
        if ($stmt) {
            $stmt->bind_param("ssssi", $email, $username, $password, $role, $user_status);

            if ($stmt->execute()) {
                echo "User added successfully.";
                echo '<br><button onclick="goBack()">Okay</button>';
                echo '<script>function goBack() { window.history.back(); }</script>';

            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement: " . $con->error;
        }
    } else {
        echo "Error: Missing required fields.";
    }

    $con->close();
}
?>
