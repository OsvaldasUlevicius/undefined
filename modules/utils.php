<?php

$db = mysqli_connect("localhost", "root", "", "undefined");

date_default_timezone_set('Europe/Vilnius');

$cssFileLocation = "../../public/css/style.css";

function checkIfLoggedIn($restrictAccess=true) {
    if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
    }

    if (!isset($_SESSION["username"])) {
        if ($restrictAccess) {
            $_SESSION["message"] = "You must be logged in to view that page!";
            header("location: ../../templates/authentication/login.php");
        } else {
            header("location: ../templates/authentication/login.php");
        }
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

function getObjectName($table, $objectId, $nameField, $db) {
    $objectQuery = "SELECT * FROM ".$table." WHERE id='$objectId' LIMIT 1";
    $objectResult = mysqli_query($db, $objectQuery);
    if (mysqli_num_rows($objectResult)==NULL) {
        return "Object does not exist.";
    } else {
        return mysqli_fetch_assoc($objectResult)[$nameField];
    }
}

function truncateWords($input, $numwords, $padding=""){
    $output = strtok($input, " \n");
    while(--$numwords > 0) $output .= " " . strtok(" \n");
    if($output != $input) $output .= $padding;
    return $output;
}

function logObjectActions($objectId, $db, $event, $isProject=true) {
    if ($isProject) {
        $selectedField = "project_id";
    } else {
        $selectedField = "task_id";
    }
    $datetime = date_create()->format('Y-m-d H:i:s');
    $userId = getCurrentUser($db);
    $eventQuery = "INSERT INTO events (happened_at, event, user_id, ".$selectedField.") VALUES ('$datetime', '$event', '$userId', '$objectId')";
    mysqli_query($db, $eventQuery);
}

function checkIfObjectExists($table, $objectId, $db) {
    $objectQuery = "SELECT * FROM ".$table." WHERE id='$objectId' LIMIT 1";
    $objectResult = mysqli_query($db, $objectQuery);
    // TODO Find a better to return true...
    if (mysqli_num_rows($objectResult)!=NULL) {
        return True;
    }
}

function getCurrentUser($db) {
    if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
    }
    $username = $_SESSION["username"];
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $userId = $user["id"];
    return $userId;
}
