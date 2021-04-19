<?php include('../../modules/authentication/server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>
<body>
    <?php 
        if (isset($_SESSION["success"])) : ?>
        <p>
            <?php 
                echo $_SESSION["success"]; 
                unset($_SESSION["success"]);
            ?>
        </p>
  	<?php endif ?>
    <form method="POST" action="login.php" id="login-form"> 
        <?php include("../../modules/authentication/errors.php"); ?>
        <label for="username">Username</label>
        <input type="email" name="username" id="login-username">
        <label for="password">Password</label>
        <input type="password" name="password" id="login-password">
        <input type="submit" name="login" value="Login" id="login-submit">
        <a href="register.php">Sign up!</a>
    </form>
</body>
</html>
