<?php

$db = mysqli_connect("localhost", "root", "", "undefined");

$cssFileLocation = "../../public/css/style.css";

function checkIfLoggedIn($restrictAccess=true) {
    session_start();

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

function getProjectName($projectId, $db) {
    $projectQuery = "SELECT * FROM projects WHERE id='$projectId' LIMIT 1";
    $projectResult = mysqli_query($db, $projectQuery);
    $project = mysqli_fetch_assoc($projectResult);

    return $project["title"];
}

function getUserName($userId, $db) {
    $userQuery = "SELECT * FROM users WHERE id='$userId' LIMIT 1";
    $userResult = mysqli_query($db, $userQuery);
    $user = mysqli_fetch_assoc($userResult);

    return $user["username"];
}

function getTaskName($taskId, $db) {
    $taskQuery = "SELECT * FROM tasks WHERE id='$taskId' LIMIT 1";
    $taskResult = mysqli_query($db, $taskQuery);
    $task = mysqli_fetch_assoc($taskResult);

    return $task["title"];
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

function getCurrentUser($db) {
    session_start();
    $username = $_SESSION["username"];
    $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $userId = $user["id"];
    return $userId;
}
