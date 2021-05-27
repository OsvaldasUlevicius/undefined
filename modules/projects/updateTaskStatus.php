<?php

if (isset($_REQUEST["task"])) {
    # TODO remove connection to DB from here.
    // $db = mysqli_connect("localhost", "skaite_admin", "Robotukai123,", "skaite_undefined");

    $db = mysqli_connect("localhost", "root", "", "undefined");

    $task = $_REQUEST["task"];
    $columnStatus = $_REQUEST["columnStatus"];
    
    // Get the id of the column status.
    $getColumnStatusId = "SELECT * FROM task_statuses WHERE status='$columnStatus' LIMIT 1";
    $columnStatusIdResult = mysqli_query($db, $getColumnStatusId);
    $columnStatusId = mysqli_fetch_assoc($columnStatusIdResult)["id"];

    $currentTaskStatus = "SELECT * FROM tasks WHERE id='$task' LIMIT 1;";
    $currentStatusIdResult = mysqli_query($db, $currentTaskStatus);
    $currentStatusId = mysqli_fetch_assoc($currentStatusIdResult)["status"];
    
    // Change tasks tatus.
    if ($columnStatusId != $currentStatusId) {
        date_default_timezone_set('Europe/Vilnius');
        $datetime = date_create()->format('Y-m-d H:i:s');

        $statusQuery = "SELECT * FROM task_statuses WHERE id='$currentStatusId' LIMIT 1";
        $statusResult = mysqli_query($db, $statusQuery);
        $status = mysqli_fetch_assoc($statusResult);
        $oldStatus = $status["status"];

        $statusQuery = "SELECT * FROM task_statuses WHERE id='$columnStatusId' LIMIT 1";
        $statusResult = mysqli_query($db, $statusQuery);
        $status = mysqli_fetch_assoc($statusResult);
        $newStatus = $status["status"];

        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        $username = $_SESSION["username"];
        $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        $userId = $user["id"];

        $event = "Updated task (ID:".$task.") status from \"".$oldStatus."\" to \"".$newStatus."\"";
        $query = "UPDATE tasks SET status= '$columnStatusId', updated_at = '$datetime' WHERE id='$task';";
        $query .= "INSERT INTO events (happened_at, event, user_id, task_id) VALUES ('$datetime', '$event', $userId, $task);";
        mysqli_multi_query($db, $query);
    }
}
