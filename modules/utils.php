<?php

$db = mysqli_connect("localhost", "root", "", "undefined");

$cssFileLocation = "../../public/css/style.css";

function checkIfLoggedIn($restrictAccess=true) {
    session_start();

    if (!isset($_SESSION["username"])) {
        if ($restrictAccess) {
            $_SESSION["message"] = "You must be logged in to view that page!";
        }
        header("location: ../../templates/authentication/login.php");
    }
}

function logout() {
    if (isset($_GET["logout"])) {
        session_destroy();
        unset($_SESSION["username"]);
        header("location: ../templates/authentication/login.php");
    }
}

function getStatus($statusId, $db, $isProject=true) {

    if ($isProject) {
        $statusQuery = "SELECT * FROM project_statuses WHERE id='$statusId' LIMIT 1";
    } else {
        $statusQuery = "SELECT * FROM task_statuses WHERE id='$statusId' LIMIT 1";
    }
    
    $statusResult = mysqli_query($db, $statusQuery);
    $status = mysqli_fetch_assoc($statusResult);

	return $status["status"];
}
