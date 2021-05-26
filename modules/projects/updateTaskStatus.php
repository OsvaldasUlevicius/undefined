<?php

if (isset($_REQUEST["task"])) {
    # TODO remove connection to DB from here.
<<<<<<< HEAD
    $db = mysqli_connect("localhost", "skaite_admin", "Robotukai123,", "skaite_undefined");
    // $db = mysqli_connect("localhost", "root", "", "undefined");
=======
    // $db = mysqli_connect("localhost", "skaite_admin", "Robotukai123,", "skaite_undefined");
    $db = mysqli_connect("localhost", "root", "", "undefined");
>>>>>>> a4723655741cbdc43a1b7a776ca5995a09ddafe9

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
        $datetime = date_create()->format('Y-m-d H:i:s');
        $query = "UPDATE tasks SET status= '$columnStatusId', updated_at = '$datetime' WHERE id='$task'";
        mysqli_query($db, $query);
    }
}
