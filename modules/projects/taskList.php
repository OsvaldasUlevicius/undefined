<?php

function getTasks($db, $projectId, $isFiltered=false) {
    if($isFiltered){
        $valueToSearch = $_POST["valueToSearch"];
        $query = "SELECT * FROM `tasks` WHERE `project`=$projectId AND (`title` LIKE '%$valueToSearch%' OR `description` LIKE '%$valueToSearch%')";
    }else{
    $query = "SELECT * FROM tasks WHERE project ='$projectId'";}

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

if (isset($_POST["taskId"])) {
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
        $project = getProjectName($result["project"], $db);
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
function isFiltered($db,$projectId){
    if(isset($_POST["search"])){
        $tasks = getTasks($db,$projectId,$isFiltered=true);
    }else{
        $tasks = getTasks($db,$projectId);
    }
    return $tasks;
}