<?php

function getTasks($db, $projectId) {
    $query = "SELECT * FROM tasks WHERE project ='$projectId'";
    return mysqli_query($db, $query);
}

function getPriority($priorityId, $db, $isTask=true) {
    if ($isTask) {
        $priorityQuery = "SELECT * FROM task_priorities WHERE id='$priorityId' LIMIT 1";
    }
    $priorityResult = mysqli_query($db, $priorityQuery);
    $priority = mysqli_fetch_assoc($priorityResult);

	return $priority["priority"];
}
