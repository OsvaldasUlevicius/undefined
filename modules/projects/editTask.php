<?php

if (isset($_POST["editTask"])) {
    $popupErrors = array();
    $taskId = mysqli_real_escape_string($db, $_POST["taskId"]);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $datetime = date_create()->format('Y-m-d H:i:s');
    if (empty($title)) { array_push($popupErrors, "Title is required."); }
    if (empty($description)) { array_push($popupErrors, "Description is required."); }

    if (strlen($title) > 255) { 
        array_push($popupErrors, "The title exceeds 255 character limit.");
    }

    if (strlen($description) > 1000) { 
        array_push($popupErrors, "Description exceeds 1000 character limit.");
    }

    if (count($popupErrors) == 0) {
        $query = "UPDATE tasks SET title= '$title', description = '$description', priority = '$priority', status = '$status', updated_at = '$datetime'  WHERE id='$taskId'";
        $res = mysqli_query($db, $query);

        $findTask = "SELECT * FROM tasks WHERE id='$taskId'";
        $findTaskResult = mysqli_query($db, $findTask);
        $task = mysqli_fetch_assoc($findTaskResult);

        header("location: ../../templates/projects/taskList.php?project_id=".$task['project']);
    } else {
        $findTask = "SELECT * FROM tasks WHERE id='$taskId'";
        $findTaskResult = mysqli_query($db, $findTask);
        $task = mysqli_fetch_assoc($findTaskResult);
    }
}

