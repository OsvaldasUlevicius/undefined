<?php


$errors = array();

if (isset($_POST["createProject"])) {

    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    if (empty($title)) { array_push($errors, "Title is required."); }
    if (empty($description)) { array_push($errors, "Description is required."); }

    $findProjects = "SELECT COUNT(*) FROM projects WHERE title='$title'";
    $projectCountResult = mysqli_query($db, $findProjects);
    $projectCount = mysqli_fetch_assoc($projectCountResult);
    if ($projectCount["COUNT(*)"] > 0) {
        array_push($errors, "Project with the selected title already exists.");
    }

    if (count($errors) == 0) {
        $query = "INSERT INTO projects (title, description, status) VALUES('$title', '$description', '1')";
        mysqli_query($db, $query);

        $getNewlyCreatedProject = "SELECT * FROM projects WHERE title='$title' LIMIT 1";
        $newlyCreatedProject = mysqli_query($db, $getNewlyCreatedProject);
        $project = mysqli_fetch_assoc($newlyCreatedProject);

        logObjectActions($project["id"], $db, "created project");

        header("location: ../../templates/projects/taskList.php?project_id=".$project["id"]);
    }
}

