<?php
    function add_user_log($user_id, $action) {
        global $con;
        $stmt = $con->prepare("INSERT INTO user_logs (user_id, action) VALUES (?, ?)");
        $stmt->bind_param("is", $user_id, $action);
        $stmt->execute();
    }
?>

