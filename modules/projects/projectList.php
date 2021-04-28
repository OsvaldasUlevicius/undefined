<?php

if (isset($_POST["projectId"])) {
    $projectId = mysqli_real_escape_string($db, $_POST["projectId"]);
    $deleteProjectTasks = "DELETE FROM tasks WHERE project='$projectId'";
    $deleteProject = "DELETE FROM projects WHERE id='$projectId'";
    mysqli_query($db, $deleteProjectTasks);
    mysqli_query($db, $deleteProject);
}

function getProjects($db, $isFiltered=false) {
    // Find how many projects there are
    if($isFiltered){
        $valueToSearch = $_POST["valueToSearch"];
        $countTotalProjectsQuery = "SELECT COUNT(*) FROM projects WHERE title LIKE '%$valueToSearch%'";
    }else{
        $countTotalProjectsQuery = "SELECT COUNT(*) FROM projects";
    }
 
    $countTotalProjectsResult = mysqli_query($db, $countTotalProjectsQuery);
    $countProjects = mysqli_fetch_assoc($countTotalProjectsResult);
    $countTotalProjects = $countProjects["COUNT(*)"];

    // Get total pages necessary
    $projectsPerPage = 5;
    $totalPages = ceil($countTotalProjects / $projectsPerPage);

    // Get the current page or set a default
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

    // the offset of the list, based on current page 
    $offset = ($currentPage - 1) * $projectsPerPage;
    if($isFiltered){
        $getProjectsForThisPage = "SELECT * FROM projects WHERE title LIKE '%$valueToSearch%' LIMIT $offset, $projectsPerPage";
    }else{
         $getProjectsForThisPage = "SELECT * FROM projects LIMIT $offset, $projectsPerPage";
    }

   
    $paginatedProjects = mysqli_query($db, $getProjectsForThisPage);
    return array(
        "projects" => $paginatedProjects,
        "currentPage" => $currentPage,
        "totalPages" => $totalPages,
        "offset" => $offset,
    );
}

function countProjectTasks($projectId, $db, $isFinished=false) {
    if ($isFinished) {
        $countTasksQuery = "SELECT COUNT(*) FROM tasks WHERE project='$projectId' AND status != 3";
    } else {
        $countTasksQuery = "SELECT COUNT(*) FROM tasks WHERE project='$projectId'";
    }
    $taskCountResult = mysqli_query($db, $countTasksQuery);
    $taskCount = mysqli_fetch_assoc($taskCountResult);
    return $taskCount["COUNT(*)"] ;
}

function isFiltered($db){
    if(isset($_POST["search"])){
        $projectsInformation = getProjects($db,$isFiltered=true);
    }else{
        $projectsInformation = getProjects($db);
    }
    return $projectsInformation;
}
