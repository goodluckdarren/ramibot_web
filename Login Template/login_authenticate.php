<?php
    require_once('../scripts/database_connect.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $con->prepare("SELECT u.*, ul.employee_id, ul.employee_email, ul.employee_password, 
                            r.role_url 
            FROM user u
            JOIN user_list ul ON u.employee_id = ul.employee_id
            JOIN role_type r ON u.user_role = r.role_id 
            WHERE ul.employee_email = ? AND ul.employee_password = ?");
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $role_url = $row['role_url'];
        if ($row['user_status'] == 0) {
            header('Location: login.php?error=disabled');
            exit;
        }
        $_SESSION['employee_id'] = $row['employee_id'];
        $_SESSION['session_id'] = uniqid();
        header('Location: ../Home/homepage.php');
        exit;
    }
    else {
        $stmt = $con->prepare("SELECT * FROM user_list WHERE employee_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            header('Location: login.php?error=invalid_credentials');
            exit;
        } else {
            header('Location: login.php?error=invalid_email');
            exit;
        }
    }
?>
