<?php

// Get current project information on editProject.php page.
if (isset($_GET["project_id"])) {
    $projectId = mysqli_real_escape_string($db, $_GET["project_id"]);
    $findProject = "SELECT * FROM projects WHERE id='$projectId'";
    $findProjectResult = mysqli_query($db, $findProject);
    $project = mysqli_fetch_assoc($findProjectResult);
}

if (isset($_POST["editProject"])) {
    $projectPopupErrors = array();
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $status = mysqli_real_escape_string($db, $_POST['status']);
    $projectId = mysqli_real_escape_string($db, $_POST['projectId']);

    // Check that all required fields are filled in.
    if (empty($projectId)) {
        array_push($projectPopupErrors, "Project has to be chosen.");
    }
    if (empty($title)) { 
        array_push($projectPopupErrors, "Title is required.");
    }
    if (empty($description)) { 
        array_push($projectPopupErrors, "Description is required.");
    }

    if (strlen($title) > 255) { 
        array_push($projectPopupErrors, "The title exceeds 255 character limit.");
    }

    if (strlen($description) > 1000) { 
        array_push($projectPopupErrors, "Description exceeds 1000 character limit.");
    }

    if (count($projectPopupErrors) == 0) {
        // Log edit project into event log.
        // TODO Make it more sophisticated (old data -> new data)
        logObjectActions($projectId, $db, "edited project ".$title);

        $query = "UPDATE projects SET title= '$title', description = '$description', status = '$status' WHERE id='$projectId'";
        mysqli_query($db, $query);
        header("location: ../../templates/projects/taskList.php?project_id=".$projectId);
    } else {
        // Reload the page and get current project information.
        $findProject = "SELECT * FROM projects WHERE id='$projectId'";
        $findProjectResult = mysqli_query($db, $findProject);
        $project = mysqli_fetch_assoc($findProjectResult);
    }
}

