<?php
include "utils.php";

$username = "";
$errors = array(); 

if (isset($_POST["register"])) {
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password1 = mysqli_real_escape_string($db, $_POST["password1"]);
    $password2 = mysqli_real_escape_string($db, $_POST["password2"]);

    if (empty($username)) { array_push($errors, "Username is required"); }
    if (empty($password1)) { array_push($errors, "Password is required"); }
    if ($password1 != $password2) {
        array_push($errors, "The passwords that you have entered do not match.");
    }

    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
  
    if ($user) {
        if ($user["username"] === $username) {
        array_push($errors, "Username already exists.");
        }
    }

    foreach (checkPasswordStrength($password1, $password2) as $error) {
        array_push($errors, $error);
    }

    if (count($errors) == 0) {
        $password = password_hash($password1, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password) VALUES('$username', '$password')";
        mysqli_query($db, $query);
        session_start();
        $_SESSION["message"] = "Registration successful! You can now log in.";
        header("location: ../../templates/authentication/login.php");
    }
}

if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($db, $_POST["username"]);
    $password = mysqli_real_escape_string($db, $_POST["password"]);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username='$username'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
            $passwordInDb = $row["password"];
            if (password_verify($password, $passwordInDb)){
                session_start();
                $_SESSION["username"] = $username;
                $_SESSION["message"] = "You are now logged in";
                header("location: ../../public/index.php");
            } else {
                array_push($errors, "The username or password is incorrect.");
            }
        } else {
            array_push($errors, "The username or password is incorrect.");
        }
    }
  }
  
  ?>
