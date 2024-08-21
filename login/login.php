<?php require_once('../database_connect.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ADMIBOT</title>
    <link rel="stylesheet" href="../styles/login.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
    <script src="../scripts/login.js"></script>
</head>

<body class="login-page">
    <div class="logo">
        <img id="nu-apc-logo.png" src="../login/nu-apc-logo.png" width="300px" height="150px">
    </div>

    <div class="login-box">
        <div class="justified-center">
            ADMIN LOGIN
        </div>
        <form class="form-container" action="login_authenticate.php" name="signin-form" method="POST" autocomplete="off">
            <div class="input-container">
                <input id="email_field" name="email" type="email" placeholder="Email Address" autocomplete="email" required>
                <i class="fas fa-envelope"></i>
            </div>
            <div class="input-container">
                <input id="password_field" name="password" type="password" placeholder="Password" autocomplete="password" required>
                <i class="fas fa-eye" onclick="showPassword()"></i>
            </div>
            <div class="forgot-password">
                <a href="" id="password-reset"> forgot password? </a>
            </div>
            <div class="popup" id="errorPopup">
                <div class="popup-content">
                    <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error === 'disabled') {
                            echo '<p class="disabled-message">Account is disabled. Please contact the administrator.</p>';
                        } elseif ($error === 'invalid_credentials') {
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