<?php 
include("../../modules/utils.php");
include('../../modules/authentication/server.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"> -->
</head>

<body class="login-register-body">

    <img class="logo-top" src="../../public/img/logo-desktop.png" />

    <div class="auth-wrap">
        <div class="auth-wrapper" id="login-wrapper">

            <h1 class="log-reg-heading">Login</h1>
            <h2 class="log-reg-heading">Enter your username and password</h2>

            <form method="POST" action="login.php" id="login-form">

            <?php 
            session_start();
            include("../../modules/messages.php");
            include("../../modules/errors.php");
            ?>

                <div class="log-reg-input-container">
                    <!-- <label for="username">Username</label> -->
                    <!-- <i class="far fa-envelope"></i> -->
                    <img class="input-img" src="../../public/img/mail.svg" />
                    <input class="auth-input" type="email" name="username" id="login-username" placeholder="E-mail">
                </div>

                <div class="log-reg-input-container">
                    <!-- <label for="password">Password</label> -->
                    <!-- <i class="fas fa-key"></i> -->
                    <img class="input-img" src="../../public/img/key.svg" />
                    <input class="auth-input" type="password" name="password" id="login-password" placeholder="Password">
                </div>

                <div class="submit-button">
                    <input class="auth-btn btn-dark" type="submit" name="login" value="Log in" id="login-submit">
                </div>

            </form>
        </div>

        <div class="auth-wrapper" id="login-register">
            <h1 class="log-reg-heading">Register</h1>
            <h2 class="log-reg-heading">Don't have an account? Create one!</h2>
            <a href="register.php"><button class="auth-btn btn-light" id="signup">Register</button></a>
        </div>
    </div>

</body>

</html>