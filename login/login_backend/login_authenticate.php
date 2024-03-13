<?php
    require_once('login_database_connect.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT ac.*
            FROM admin_accounts ac
            WHERE ac.email = ? AND ac.password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['user_id'];
        header('Location: ../../userfiles/new_user_files.php');
        exit;
    }
    else {
        // $stmt = $con->prepare("SELECT * FROM user_list WHERE employee_email = ?");
        // $stmt->bind_param("s", $email);
        // $stmt->execute();
        // $result = $stmt->get_result();

        // if ($result->num_rows > 0) {
        //     header('Location: login.php?error=invalid_credentials');
        //     exit;
        // } else {
        //     header('Location: login.php?error=invalid_email');
        //     exit;
        // }
    }
?>
