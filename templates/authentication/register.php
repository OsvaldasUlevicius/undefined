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
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</script>
</head>

<body>
    <div class="logo-top">
        <img class="logo" src="../../public/img/logo-desktop.png" />
    </div>

    <div id="register-wrapper">

        <h1>Register</h1>
        <h2>Type your e-mail and password</h2>

        <form method="POST" action="register.php" id="register-form">
            <?php include('../../modules/errors.php'); ?>

            <div class="input-container-1">
                <!-- <label for="username">Username</label> -->
                <!-- <i class="far fa-envelope"></i> -->
                <img class="input-img" src="../../public/img/mail.png" />
                <input type="email" name="username" value="<?php echo $username; ?>" id="register-username"
                    placeholder="E-mail">
            </div>

            <div class="input-container-2">
                <!-- <label for="password">Password</label> -->
                <!-- <i class="fas fa-key"></i> -->
                <img class="input-img" src="../../public/img/key.png" />
                <input type="password" name="password1" id="register-password1" placeholder="Create password">
            </div>

            <div class="input-container-2">
                <!-- <label for="password">Password</label> -->
                <!-- <i class="fas fa-key"></i> -->
                <img class="input-img" src="../../public/img/key.png" />
                <input type="password" name="password2" id="register-password2" placeholder="Repeat new password">
            </div>

            <div class="register-button">
                <input type="submit" name="register" value="Register" id="register-submit">
            </div>

            <div class="member-button">
                <p class="member-login">Already a member? <a href="login.php">Login here!</a></p>
            </div>

            <!-- <label for="username">Username</label>
            <input type="email" name="username" value="<?php echo $username; ?>" id="register-username">
            <label for="password1">Create password</label>
            <input type="password" name="password1" id="register-password1">
            <label for="password2">Repeat new password</label>
            <input type="password" name="password2" id="register-password2">
            <input type="submit" name="register" value="Sign Up" id="register-submit">
            <a href="login.php">Log In!</a> -->
    </div>
    </form>
</body>

</html>