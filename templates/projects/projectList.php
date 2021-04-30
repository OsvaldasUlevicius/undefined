<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
logOut();
include('../../modules/projects/projectList.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
</head>
<body class="project-list">
<nav>
<a href="#"><img src="../../public/img/logo-long.png" alt=""></a>
<div class="nav-form">
        <p>You are logged in as a <span><?php echo $_SESSION["username"]; ?></span></p>
<form method="GET" action="">
            <input type="submit" id="logout" name="logout" value="Logout">
        </form>
</div>
</nav>
<div class="logo-in-page">
        <img class="logo" src="../../public/img/logo-desktop.png" />
</div>
<h1>Choose A Project or create a new one</h1>
<form id="search-form" action="" method="GET">
    <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..."/>
    <button id="btn-search" class="btn" type="submit" name="search" value="search"><img src="../../public/img/search.png"></button>
</form>
<div class="container-table">
    <div class="table-head">
        <div class="th title"><h4 id="title">Title</h4></div>
        <div class="th description"><h4 id="description">Description</h4></div>
        <div class="th total"><h4 id="task-count">Tasks total</h4></div>
        <div class="th"><h4 id="task-left">Tasks left</h4></div>
        <div class="th status"><h4 id="status">Status</h4></div>
    </div>
    <div class="table-body">
        <?php $projectsInformation = isFiltered($db); $errors = $projectsInformation["errors"]; include('../../modules/errors.php');?>
        <?php foreach ($projectsInformation["projects"] as $project): ?>
            <div class="table-row">
                <div class="project-name">
                <a href="taskList.php?project_id=<?php echo $project["id"]; ?>">
                    <?php echo(truncateWords( $project["title"], 2, $padding="..."))?>
                </a>
                </div>
                <div class="project-description">
                    <p><?php echo(truncateWords($project["description"],5,$padding="..."))?></p>
                </div>
                <div class="tasks-count">
                    <p><?php echo  countProjectTasks($project["id"], $db); ?></p>
                </div>
                <div class="tasks-left">
                    <p><?php echo  countProjectTasks($project["id"], $db, $isFinished=true);; ?></p>
                </div>
                <div class="status">
                    <span><?php checkStatus(getStatus($project["status"], $db)); ?></span>
                </div>
                <div class="edit-delete">
                <a class="btn" href="editProject.php?project_id=<?php echo $project["id"]; ?>">
                    <img src="../../public/img/edit.png"></a>
                    <form method="POST" action="projectList.php">
                    <input type="hidden" name="projectId" value="<?php echo  $project["id"]; ?>">
                    <button class="btn" type="submit" id="delete"><img src="../../public/img/trash.png"></button>
                </form>
                </div>
            </div>
            <?php endforeach ?>
    </div>
<div class="pagination-links">       
<?php include("../../modules/pagination_links.php"); ?>
</div>     
<a class="btn" id="create-new-project-btn" href="createProject.php"><img src="../../public/img/create-new-project-btn.png"></a>
<form id="csv-form" action="" method="get">
<input class="btn" type="submit" name="csvProjects" value="Export to CSV"/>
</div>
</body>
</html>
