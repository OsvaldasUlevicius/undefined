<?php 
include("../../modules/utils.php");
include('../../modules/authentication/authentication.php');
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

<body class="login-register-body">

    <img class="logo-top" src="../../public/img/logo-desktop.png" />
    <div class="auth-wrap">
        <div class="auth-wrapper" id="register-wrapper">

            <h1 class="log-reg-heading">Register</h1>
            <h2 class="log-reg-heading">Choose your username and password</h2>
            <?php include('../../modules/errors.php'); ?>

            <form method="POST" action="register.php" id="register-form">


                <div class="log-reg-input-container">
                    <!-- <label for="username">Username</label> -->
                    <!-- <i class="far fa-envelope"></i> -->
                    <img class="input-img" src="../../public/img/mail.svg" />
                    <input class="auth-input" type="email" name="username" value="<?php echo $username; ?>" id="register-username"
                        placeholder="E-mail">
                </div>

                <div class="log-reg-input-container tooltip">
                    <span class="tooltiptext">Password must be between 8 and 30 characters<br>Password must contain at least one number digit (0 - 9)<br>Password must contain at least one lowercase letter (a - z)<br>Password must contain at least one uppercase, or capital, letter (A - Z)<br>Password must contain at least one special character ($, #, @, !,%,^,&,*, etc.)</span>
                    <!-- <label for="password">Password</label> -->
                    <!-- <i class="fas fa-key"></i> -->
                    <img class="input-img" src="../../public/img/key.svg" />
                    <input class="auth-input" type="password" name="password1" id="register-password1" placeholder="Create password">
                </div>

                <div class="log-reg-input-container tooltip">
                    <span class="tooltiptext">Passwords must match</span>
                    <!-- <label for="password">Password</label> -->
                    <!-- <i class="fas fa-key"></i> -->
                    <img class="input-img" src="../../public/img/key.svg" />
                    <input class="auth-input" type="password" name="password2" id="register-password2" placeholder="Repeat new password">
                </div>

                <div class="register-button">
                    <input class="auth-btn btn-dark" type="submit" name="register" value="Register"
                        id="register-submit">
                </div>

                <div class="member-login">
                    <p id="member-login">Already a member? <a href="login.php">Login here</a></p>
                </div>

        </div>
    </div>
    </form>
</body>

</html>
