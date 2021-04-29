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

<body>
    
    <div class="logo-top">
        <img class="logo" src="../../public/img/logo-desktop.png" />
    </div>

    <div id="login-wrapper">

        <h1>Login</h1>
        <h2>Type your username and password</h2>

        <form method="POST" action="login.php" id="login-form">

        <?php 
            session_start();
            include("../../modules/messages.php");
            include("../../modules/errors.php");
        ?>
    
            <div class="input-container-1">
                <!-- <label for="username">Username</label> -->
                <!-- <i class="far fa-envelope"></i> -->
                <img class="input-img" src="../../public/img/mail.svg" />
                <input type="email" name="username" id="login-username" placeholder="E-mail">
            </div>

            <div class="input-container-2">
                <!-- <label for="password">Password</label> -->
                <!-- <i class="fas fa-key"></i> -->
                <img class="input-img" src="../../public/img/key.svg" />
                <input type="password" name="password" id="login-password" placeholder="Password">
            </div>

            <div class="submit-button">
                <input type="submit" name="login" value="Log in" id="login-submit">
            </div>

        </form>
    </div>

    <div id="login-register">
        <h1>Register</h1>
        <h2>Don't have an account? Create one!</h2>
        <button id="signup"><a href="register.php">Register</a></button>
    </div>


</body>

</html>