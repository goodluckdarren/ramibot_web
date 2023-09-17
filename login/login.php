<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>ADMIBOT</title>
        <link rel="stylesheet" href="../login.css">


    </head>
    <body class="login-page">
        <div class="blur"></div>
        <div class="logo">
            <img id="nu-apc-logo.png" src="../nu-apc-logo.png" width="300px" height="150px">
        </div>
        <div class="login-box" >
            <div class="justified-center">
                Admin Login
            </div>
            <form class="sign-in-form" name="signin-form" method="POST" autocomplete="off">
                <input class="email-input" id="email_field" name="email" type="email" placeholder="Email Address" autocomplete="email" autofocus required>
            <i class="fas fa-envelope"></i>
            <input id="password_field" name="password" type="password" placeholder="Password" autocomplete="password" required>
            <i class="fas fa-eye" onclick="show_password()"></i>
         </form>
         <div class="forgot-password">
                <a href="" id="password-reset"> forgot password? </a>
         </div>
            <button type="submit" name="login" class="signin-button button">
               <span class="fas fa-sign-in-alt"></span>
               Log In
            </button>
        </div>
    </body>
</html>