<?php

$errors = array();

if (isset($_GET["taskId"])) {
    $taskId = mysqli_real_escape_string($db, $_GET["taskId"]);
    $findTask = "SELECT * FROM tasks WHERE id='$taskId'";
    $findTaskResult = mysqli_query($db, $findTask);
    $task = mysqli_fetch_assoc($findTaskResult);
}

if (isset($_POST["editTask"])) {
    $taskId = mysqli_real_escape_string($db, $_POST["taskId"]);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $datetime = date_create()->format('Y-m-d H:i:s');
    if (empty($title)) { array_push($errors, "Title is required."); }
    if (empty($description)) { array_push($errors, "Description is required."); }

    if (count($errors) == 0) {
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

