<?php

// Delete task.
if (isset($_POST["taskId"])) {
    // Log delete task into event log.
    $taskName = getObjectName("tasks", $_POST["taskId"], "title", $db);
    logObjectActions($_POST["taskId"], $db, "deleted task ".$taskName);

    $taskId = mysqli_real_escape_string($db, $_POST["taskId"]);
    $deleteTask = "DELETE FROM tasks WHERE id='$taskId'";
    mysqli_query($db, $deleteTask);
}

if(isset($_GET["csvTasks"])){
    // database record to be exported
    $db_record = "tasks";
    // filename for export
    $csv_filename = $db_record."_".date('Y-m-d').".csv";

    // create empty variable to be filled with export data
    $csv_export = "";

    // query to get data from database
    $query = mysqli_query($db, "SELECT * FROM ".$db_record." WHERE project=".$_GET["projectId"]);
    // returns the number of columns for the most recent query
    $field = mysqli_field_count($db);

    // add header to file
    $csv_export.="Task ID; Project; Title; Description; Priority; Status;";

    // newline (seems to work both on Linux & Windows servers)
    $csv_export.= '
    ';

    foreach ($query as $result) {
        $id = $result["id"];
        $project = getObjectName("projects", $result["project"], "title", $db);
        $title = $result["title"];
        $description = $result["description"];
        $priority = getPriority($result["priority"], $db);
        $status = getStatus($result["status"], $db, $isProject=false);

        $csv_export.= "$id;$project;$title;$description;$priority;$status";
        $csv_export.= '
        ';
    }


    // Export the data and prompt a csv file for download
    header("Content-type: text/x-csv");
    header("Content-Disposition: attachment; filename=".$csv_filename."");
    echo($csv_export);
    exit();
}

// Search tasks.
if (isset($_POST["search"])) {
    $filteredTasks = getTasks($db, $_GET["project_id"], $isFiltered=true);
} else {
    $filteredTasks = getTasks($db, $_GET["project_id"]);
}

function getTasks($db, $projectId, $isFiltered=false) {
    if ($isFiltered) {
        $valueToSearch = $_POST["valueToSearch"];
        // TODO order by when filtered
        $query = "SELECT * FROM tasks WHERE project=$projectId AND (title LIKE '%$valueToSearch%' OR description LIKE '%$valueToSearch%')";
    } else {
        $query = "SELECT * FROM tasks WHERE project ='$projectId' ORDER BY updated_at ";
    }
    return mysqli_query($db, $query);
}


function getPriority($priorityId, $db) {
    $priorityQuery = "SELECT * FROM task_priorities WHERE id='$priorityId' LIMIT 1";
    $priorityResult = mysqli_query($db, $priorityQuery);
    $priority = mysqli_fetch_assoc($priorityResult);
	return $priority["priority"];
}
