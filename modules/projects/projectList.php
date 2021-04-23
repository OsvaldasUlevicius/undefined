<?php

function getProjects($db) {
    $query = "SELECT * FROM projects";
    return mysqli_query($db, $query);
}

function countProjectTasks($projectId, $db, $isFinished=false) {
    if ($isFinished) {
        $countTasksQuery = "SELECT COUNT(*) FROM tasks WHERE project='$projectId' AND status != 3";
    } else {
        $countTasksQuery = "SELECT COUNT(*) FROM tasks WHERE project='$projectId'";
    }
    $taskCountResult = mysqli_query($db, $countTasksQuery);
    $taskCount = mysqli_fetch_assoc($taskCountResult);
    return $taskCount["COUNT(*)"] ;
}
