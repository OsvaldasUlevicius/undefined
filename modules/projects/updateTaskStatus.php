<?php

if (isset($_REQUEST["taskId"])) {
    # TODO remove connection to DB from here.
    $db = mysqli_connect("localhost", "root", "", "undefined");

    $taskId = $_REQUEST["taskId"];
    $columnStatus = $_REQUEST["columnStatus"];
    
    // Get the id of the column status.
    $getColumnStatusId = "SELECT * FROM task_statuses WHERE status='$columnStatus' LIMIT 1";
    $columnStatusIdResult = mysqli_query($db, $getColumnStatusId);
    $columnStatusId = mysqli_fetch_assoc($columnStatusIdResult)["id"];

    $currentTaskStatus = "SELECT * FROM tasks WHERE id='$taskId' LIMIT 1;";
    $currentStatusIdResult = mysqli_query($db, $currentTaskStatus);
    $currentStatusId = mysqli_fetch_assoc($currentStatusIdResult)["status"];

    // Change tasks tatus.
    if ($columnStatusId != $currentStatusId) {
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = "UPDATE tasks SET status= '$columnStatusId', updated_at = '$datetime' WHERE id='$taskId'";
        mysqli_query($db, $query);
    }
}
