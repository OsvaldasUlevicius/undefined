<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body class="project-list">
<?php include("../header_footer/header.php");?>
<div class="logo-in-page">
        <img class="logo" src="../../public/img/logo-desktop.png" />
</div>
<h1>Choose A Project or create a new one</h1>
<form id="search-form" action="" method="GET">
    <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..."/>
    <button id="btn-search" class="btn" type="submit" name="search" value="search"><i class="icon fas fa-search"></i></button>
</form>
<div class="container-table">
    <div class="table-head">
        <h4 class="th title" id="title">Title</h4>
        <h4 class="th description" id="description">Description</h4>
        <h4 class="th total" id="task-count">Tasks total</h4>
        <h4 class="th left" id="task-left">Tasks left</h4>
        <h4 class="th status" id="status">Status</h4>
        <div></div>
    </div>
    <div class="table-body">
        <?php $projectsInformation = isFiltered($db); $errors = $projectsInformation["errors"]; include('../../modules/errors.php');?>
        <?php foreach ($projectsInformation["projects"] as $project): ?>
            <div class="table-row">
                <a class="project-name" href="taskList.php?project_id=<?php echo $project["id"]; ?>">
                    <?php echo(truncateWords( $project["title"], 2, $padding="..."))?>
                </a>
                    <p class="project-description"><?php echo(truncateWords($project["description"],5,$padding="..."))?></p>
                    <p class="tasks-count"><?php echo  countProjectTasks($project["id"], $db); ?></p>
                    <p class="tasks-left"><?php echo  countProjectTasks($project["id"], $db, $isFinished=true);; ?></p>
                    <?php $projectStatus = getStatus($project["status"], $db); ?>
                <span class="status status-box <?php echo strtolower($projectStatus);?>"><?php echo $projectStatus;?></span>
                <div class="edit-delete">
                <a class="btn" href="editProject.php?project_id=<?php echo $project["id"]; ?>">
                <i class="icon edit far fa-edit"></i></a>
                <form method="POST" action="projectList.php">
                    <input type="hidden" name="projectId" value="<?php echo  $project["id"]; ?>">
                    <button class="btn" type="submit" id="delete"><i class=" icon trash far fa-trash-alt"></i></button>
                </form>
                </div>
            </div>
            <?php endforeach ?>
    </div>
<div class="pagination-links">       
<?php include("../../modules/pagination_links.php"); ?>
</div>     
<a class="btn add-btn" id="create-new-project-btn" href="createProject.php"></a>
<form id="csv-form" action="projectList.php" method="GET">
    <input class="btn" type="submit" name="csvProjects" value="Export to CSV"/>
</form>
</div>
<?php include("../header_footer/footer.php");?>
</body>
</html>
