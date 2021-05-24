<?php

if (isset($_POST["createTask"])) {
    $popupErrors = array();
    $project = mysqli_real_escape_string($db, $_POST['projectId']);
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $priority = mysqli_real_escape_string($db, $_POST['priority']);
    $status = mysqli_real_escape_string($db, $_POST['status']);

    // Check that all required fields are filled in.
    if (empty($project)) { 
        array_push($popupErrors, "The task has to be assigned to a project."); 
    }
    if (empty($title)) { 
        array_push($popupErrors, "Title is required."); 
    }
    if (empty($description)) { 
        array_push($popupErrors, "Description is required."); 
    }

    if (strlen($title) > 255) { 
        array_push($popupErrors, "The title exceeds 255 character limit.");
    }

    if (strlen($description) > 1000) { 
        array_push($popupErrors, "Description exceeds 1000 character limit.");
    }

    if (count($popupErrors) == 0) {
        $datetime = date_create()->format('Y-m-d H:i:s');
        $createNewTaskQuery = "INSERT INTO tasks (project, title, description, priority, status, created_at, updated_at) VALUES('$project', '$title', '$description', '$priority', '$status', '$datetime', '$datetime')";
        mysqli_query($db, $createNewTaskQuery);

        // Log task creation into event log.
        $getNewlyCreatedTask = "SELECT * FROM tasks WHERE title='$title' LIMIT 1";
        $newlyCreatedTask = mysqli_query($db, $getNewlyCreatedTask);
        $task = mysqli_fetch_assoc($newlyCreatedTask);
        logObjectActions($task["id"], $db, "created task ".$title, $isProject=false);
    } else {
        if(session_id() == '' || !isset($_SESSION)) {
            // session isn't started
            session_start();
        }
        $_SESSION['popupErrors'] = $popupErrors;
        // Redirect to the task project;
    }
    header("location: ../../templates/projects/taskList.php?project_id=".$project);

}
