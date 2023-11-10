<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ADMIBOT</title>
        <link rel="stylesheet" href="new_login.css">
   </head>
   <body class="login-page">
        <div class="bg-image">
            <div class="blur"></div>
        </div>
        <div class="login-form">
            <div class="login-header">
                <form action="login_authenticate.php" name="signin-form" method="POST" autocomplete="off">
                    <?php
                    if (isset($_GET['error'])) {
                        $error = $_GET['error'];
                        if ($error === 'disabled') {
                            echo '<p class="disabled-message">Account is disabled.<br>Please contact the administrator.</p>';
                        } elseif ($error === 'invalid_credentials') {
                            echo '<p class="invalid-message">Invalid email or password. Please try again.</p>';
                        } elseif ($error === 'invalid_email') {
                            echo '<p class="invalid-message">Invalid email or password. Please try again.</p>';
                        }
                    }
                    ?>
                    <input id="email_field" name="email" type="email" placeholder="Email" autocomplete="email" autofocus required>
                    <i class="fas fa-envelope"></i>
                    <input id="password_field" name="password" type="password" placeholder="Password" autocomplete="password" required>
                    <i class="fas fa-eye" onclick="show_password()"></i>
                    <button type="submit" name="signin" class="signin-button button">
                    <span class="fas fa-sign-in-alt"></span>
                    Sign In
                    </button>
                </form>
            </div>
        </div>
   </body>
</html>