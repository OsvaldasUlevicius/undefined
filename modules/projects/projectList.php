<?php

$errors = array();
$popupErrors = array();

// Delete Project
if (isset($_POST["projectId"])) {
    $projectId = mysqli_real_escape_string($db, $_POST["projectId"]);

    // Log delete project into event log.
    $projectName = getObjectName("projects", $projectId, "title", $db);
    logObjectActions($projectId, $db, "deleted project ".$projectName);

    # TODO LOG PROJECT TASKS DELETION ?
    $deleteProjectTasks = "DELETE FROM tasks WHERE project='$projectId'";
    $deleteProject = "DELETE FROM projects WHERE id='$projectId'";
    mysqli_query($db, $deleteProjectTasks);
    mysqli_query($db, $deleteProject);
}

// Create Project
if (isset($_POST["createProject"])) {

    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);

    // Check if both fields are filled in.
    if (empty($title)) { 
        array_push($popupErrors, "Title is required.");
    }
    if (empty($description)) { 
        array_push($popupErrors, "Description is required.");
    }

    // Search if the entered project title is already taken.
    $findProjects = "SELECT COUNT(*) FROM projects WHERE title='$title'";
    $projectCountResult = mysqli_query($db, $findProjects);
    $projectCount = mysqli_fetch_assoc($projectCountResult);
    if ($projectCount["COUNT(*)"] > 0) {
        array_push($popupErrors, "Project with the selected title already exists.");
    }

    if (count($popupErrors) == 0) {
        $query = "INSERT INTO projects (title, description, status) VALUES('$title', '$description', '1')";
        mysqli_query($db, $query);

        // Log project creation into event log.
        $getNewlyCreatedProject = "SELECT * FROM projects WHERE title='$title' LIMIT 1";
        $newlyCreatedProject = mysqli_query($db, $getNewlyCreatedProject);
        $project = mysqli_fetch_assoc($newlyCreatedProject);
        logObjectActions($project["id"], $db, "created project ".$title);

        // Redirect to the newly created project;
        header("location: ../../templates/projects/taskList.php?project_id=".$project["id"]);
    }
}

if (isset($_GET["search"])) {
    $projectsInformation = getProjects($db,$isFiltered=true);
} else {
    $projectsInformation = getProjects($db, $isFiltered=false, $errors);
}

function getProjects($db, $isFiltered=false, $errors = array()) {
    // $errors = array();

    // Find how many projects there are.
    if($isFiltered) {
        $valueToSearch = $_GET["valueToSearch"];
        $countTotalProjectsQuery = "SELECT COUNT(*) FROM projects WHERE title LIKE '%$valueToSearch%'";
    } else {
        $countTotalProjectsQuery = "SELECT COUNT(*) FROM projects";
    }
 
    $countTotalProjectsResult = mysqli_query($db, $countTotalProjectsQuery);
    $countProjects = mysqli_fetch_assoc($countTotalProjectsResult);
    $countTotalProjects = $countProjects["COUNT(*)"];
    if($countTotalProjects == 0) {
        array_push($errors, "Your search did not match any project titles.");
    }

    // Get total pages necessary.
    $projectsPerPage = 5;
    $totalPages = ceil($countTotalProjects / $projectsPerPage);

    // Get the current page or set a default.
    if (isset($_GET["currentPage"]) && is_numeric($_GET["currentPage"])) {
        $currentPage = (int) $_GET["currentPage"];
    } else {
        $currentPage = 1;
    }

    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }
    if ($currentPage < 1) {
        $currentPage = 1;
    } 

    // the offset of the list, based on current page .
    $offset = ($currentPage - 1) * $projectsPerPage;
    if ($isFiltered) {
        $getProjectsForThisPage = "SELECT * FROM projects WHERE title LIKE '%$valueToSearch%' ORDER BY ids LIMIT $offset, $projectsPerPage";
    } else {
        $getProjectsForThisPage = "SELECT * FROM projects ORDER BY id DESC LIMIT $offset, $projectsPerPage";
    }

   
    $paginatedProjects = mysqli_query($db, $getProjectsForThisPage);
    return array(
        "projects" => $paginatedProjects,
        "currentPage" => $currentPage,
        "totalPages" => $totalPages,
        "offset" => $offset,
        "errors" => $errors,
    );
}

if(isset($_GET["csvProjects"])){
    // database record to be exported
    $db_record = "projects";
    // filename for export
    $csv_filename = $db_record."_".date('Y-m-d').".csv";

    // create empty variable to be filled with export data
    $csv_export = "";

    // query to get data from database
    $query = mysqli_query($db, "SELECT * FROM ".$db_record);
    // returns the number of columns for the most recent query
    $field = mysqli_field_count($db);

    // add header to file
    $csv_export.="Project ID;Title; Description; Status;Tasks Total; Tasks Left;";

    // add newline between header and data (seems to work both on Linux & Windows servers)
    $csv_export.= '
    ';

    foreach ($query as $result) {
        $id = $result["id"];
        $title = $result["title"];
        $description = $result["description"];
        $status = getStatus($result["status"], $db);
        $tasksTotal = countProjectTasks($result["id"], $db);
        $tasksLeft = countProjectTasks($result["id"], $db, $isNotFinished=true);
        
        $csv_export.= "$id;$title;$description;$status;$tasksTotal;$tasksLeft;";
        $csv_export.= '
        ';
    }

    // Export the data and prompt a csv file for download
    header("Content-type: text/x-csv;");
    header("Content-Disposition: attachment; filename=".$csv_filename."");
    echo($csv_export);
    exit();
}
