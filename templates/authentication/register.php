<?php include('../../modules/authentication/server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>
<body>
    <form method="POST" action="register.php" id="register-form">
        <?php include('../../modules/authentication/errors.php'); ?>
        <label for="username">Username</label>
        <input type="email" name="username" value="<?php echo $username; ?>" id="register-username">
        <label for="password1">Create password</label>
        <input type="password" name="password1" id="register-password1">
        <label for="password2">Repeat new password</label>
        <input type="password" name="password2" id="register-password2">
        <input type="submit" name="register" value="Sign Up" id="register-submit">
        <a href="login.php">Log In!</a>
    </form>
</body>
</html>
