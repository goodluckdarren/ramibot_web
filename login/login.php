<?php require_once('../database_connect.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/login.css">
</head>

<body class="login-page">
    <div class="logo">
        <img id="nu-apc-logo.png" src="../login/nu-apc-logo.png" width="300px" height="150px">
    </div>

    <div class="login-box">
        <div class="justified-center">
            ADMIN LOGIN
        </div>
        <form action="login_authenticate.php" name="signin-form" method="POST" autocomplete="off">
            <input class="email-input" id="email_field" name="email" type="email" placeholder="Email Address" autocomplete="email" required>
                <i class="fas fa-envelope"></i>
            <input id="password_field" name="password" type="password" placeholder="Password" autocomplete="password" required>
                <i class="fas fa-eye" onclick="show_password()"></i>
            <div class="forgot-password">
                <a href="" id="password-reset"> forgot password? </a>
            </div>
            <div class="popup" id="errorPopup">
                <div class="popup-content">
                    <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error === 'invalid_credentials' || $error === 'invalid_email') {
                            echo '<p class="invalid-message">Invalid email or password. Please try again.</p>';
                        }
                    }
                    ?>
                    <span class="close-button" onclick="closePopup()">&times;</span>
                </div>
            </div>
            <button type="submit" name="login" class="signin-button button">
                <span class="fas fa-sign-in-alt"></span>
                Log In
            </button>
        </form>
    </div>
</body>

</html>