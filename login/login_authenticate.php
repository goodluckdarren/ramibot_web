<?php
    require_once('../database_connect.php');
    require_once('../scripts/user_logs.php');

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute the query to get user by email
    $stmt = $con->prepare("SELECT ac.*, r.role_url
                            FROM admin_accounts ac
                            JOIN role_type r ON ac.role = r.role_id
                            WHERE ac.email = ? AND ac.password = ?");
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

        // Log successful login
        add_user_log($row['user_id'], "Logged in");

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['session_id'] = uniqid();
        header('Location: ' . $row['role_url']);
        exit;
    } else {
        $stmt = $con->prepare("SELECT * FROM admin_accounts WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Log invalid login attempt
            $row = $result->fetch_assoc();
            add_user_log($row['user_id'], "Failed login attempt");

            header('Location: login.php?error=invalid_credentials');
            exit;
        } else {
            header('Location: login.php?error=invalid_email');
            exit;
        }
    }
?>
