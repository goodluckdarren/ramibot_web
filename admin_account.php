<?php
    require_once('../database_connect.php');

    // get user name of admin_accounts
    if (isset($_SESSION['user_id'])) {
        $stmt = $con->prepare("SELECT username FROM admin_accounts WHERE user_id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $result = $stmt->get_result();
 
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
        }
        echo '<p class = "user-name">';
        echo $_SESSION['username'];
        echo '</p>';
    }
?>