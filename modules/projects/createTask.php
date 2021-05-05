<?php

$errors = array();

if (isset($_POST["createTask"])) {
    $project = mysqli_real_escape_string($db, $_POST['projectId']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $status = mysqli_real_escape_string($db, $_POST['status']);

    if (empty($title)) { array_push($errors, "Title is required."); }
    if (empty($description)) { array_push($errors, "Description is required."); }
    $datetime = date_create()->format('Y-m-d H:i:s');
    if (count($errors) == 0) {
        $query = "INSERT INTO tasks (project, title, description, priority, status, created_at, updated_at) VALUES('$project', '$title', '$description', '$priority', '$status', '$datetime', '$datetime')";
        mysqli_query($db, $query);
        header("location: ../../templates/projects/taskList.php?project_id=".$project);
    }
}
