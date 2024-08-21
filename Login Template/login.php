<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RAM Health</title>
        <link rel="stylesheet" href="../styles/login.css">
        <link rel="shortcut icon" href="../images/apc-logo.ico"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.3.0/css/all.css">
        <script src="../scripts/login.js"></script>
    </head>
    <body>
        <div class="login-box">
            <div class="header">
                <img class="apc-logo" src="../images/apc-logo.png" width="120px" height="120px"/>
                <div class="header-title">APC RAM Health</div>
            </div>
            <div class="login-form">
                <form class="form-container" action="login_authenticate.php" name="signin-form" method="POST" autocomplete="off">
                    <div class="input-container">
                        <input id="email_field" name="email" type="email" placeholder="Email" autocomplete="email" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="input-container">
                        <input id="password_field" name="password" type="password" placeholder="Password" autocomplete="password" required>
                        <i class="fas fa-eye" onclick="show_password()"></i>
                    </div>
                    <div class="popup" id="errorPopup">
                        <div class="popup-content">
                            <?php
                                if (isset($_GET['error'])) {
                                    $error = $_GET['error'];
                                    if ($error === 'disabled') {
                                        echo '<p class="disabled-message">Account is disabled. Please contact the administrator.</p>';
                                    } elseif ($error === 'invalid_credentials' || $error === 'invalid_email') {
                                        echo '<p class="invalid-message">Invalid email or password. Please try again.</p>';
                                    }
                                }
                            ?>
                            <span class="close-button" onclick="closePopup()">&times;</span>
                        </div>
                    </div>
                    <button type="submit" name="signin" class="signin-button button">
                    <span class="fas fa-sign-in-alt"></span>
                    Sign In
                    </button>
                </form>
            </div>
        </div>
    </body>
</html>