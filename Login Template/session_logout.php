<?php
    require_once('../scripts/database_connect.php');
    
    $roles = array();
    
    $stmt = $con->prepare("SELECT * FROM role_type");
    $stmt->execute();
    $result = $stmt->get_result();
    
    while ($row = $result->fetch_assoc()) {
        $roles[$row['role_name']] = $row['role_url'];
    }
    
    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: login.php");
        exit;
    }
?>
