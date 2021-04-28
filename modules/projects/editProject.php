<?php

$errors = array();

if (isset($_GET["project_id"])) {
    $projectId = mysqli_real_escape_string($db, $_GET["project_id"]);
    $findProject = "SELECT * FROM projects WHERE id='$projectId'";
    $findProjectResult = mysqli_query($db, $findProject);
    $project = mysqli_fetch_assoc($findProjectResult);
}

if (isset($_POST["editProject"])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $projectId = mysqli_real_escape_string($db, $_POST['projectId']);

    if (empty($title)) { array_push($errors, "Title is required."); }
    if (empty($description)) { array_push($errors, "Description is required."); }

    if (count($errors) == 0) {
        $query = "UPDATE projects SET title= '$title', description = '$description', status = '$status' WHERE id='$projectId'";
        $res = mysqli_query($db, $query);
        header("location: ../../templates/projects/taskList.php?project_id=".$projectId);
    } else {
        $findProject = "SELECT * FROM projects WHERE id='$projectId'";
        $findProjectResult = mysqli_query($db, $findProject);
        $project = mysqli_fetch_assoc($findProjectResult);
    }
}

