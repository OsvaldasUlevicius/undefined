<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/projectList.php');
include('../../modules/projects/editProject.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../../public/js/script.js" defer></script>
    </head>

<body class="project-list">
    <?php include("../header_footer/header.php");?>

    <div class="logo-in-page">
        <img class="task-proj-logo" src="../../public/img/logo-img.png" /><br><br>
        <img class="task-proj-logo" src="../../public/img/logo-text.png" />
    </div>

    <h1 class="task-proj-heading">Choose a project or create a new one</h1>

    <form id="search-form" action="" method="GET">
        <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..." />
        <button id="btn-search" class="btn" type="submit" name="search" value="search"><i class="icon fas fa-search"></i></button>
    </form>

    <div class="container-table">
        <div class="table-head">
            <h4 class="th title" id="title">Project name</h4>
            <h4 class="th description" id="description">Description</h4>
            <h4 class="th total" id="task-count">Tasks total</h4>
            <h4 class="th left" id="task-left">Tasks left</h4>
            <h4 class="th status" id="status-top">Status</h4>
            <div></div>
        </div>

        <div class="table-body">
            <?php include('../../modules/errors.php'); ?>
            
            <?php $errors = $projectsInformation["errors"]; include('../../modules/errors.php');?>
            <?php foreach ($projectsInformation["projects"] as $project): ?>
            
            <div class="table-row">
                <a class="project-name tooltip" href="taskList.php?project_id=<?php echo $project["id"]; ?>">
                    <span class="tooltiptext"><?php echo $project["title"];?></span>
                    <?php echo truncate($project["title"], array("wordWidth" => 5, "characterWidth" => 30)); ?>
                </a>

                <p class="project-description tooltip"><?php echo truncate($project["description"], array("wordWidth" => 10, "characterWidth" => 100)); ?>
                <span class="tooltiptext"><?php echo $project["description"]; ?></span>
            </p>
                <p class="tasks-count"><?php echo  countProjectTasks($project["id"], $db); ?></p>
                <p class="tasks-left"><?php echo  countProjectTasks($project["id"], $db, $isFinished=true); ?></p>

                <?php $projectStatus = getStatus($project["status"], $db); ?>

                <span
                    class="status status-box <?php echo strtolower($projectStatus);?>"><?php echo $projectStatus;?>
                </span>
                
                <div class="edit-delete">
                    <?php $editPopupInfo = array(
                        "objectId" => intval(intval($project["id"])), 
                        "returnPage" => "taskList.php?project_id=".$project["id"],
                        "objectTitle" => $project["title"],
                        "objectDescription" => $project["description"],
                        "objectStatus" => $project["status"],); ?>
                    <?php $deletePopupInfo = array("objectType" => "project", "objectId" => intval($project["id"]), "returnPage" => "projectList.php"); ?>
                        <i class="btn icon edit far fa-edit edit-project" data-value='<?php echo json_encode($editPopupInfo); ?>'></i>
                        <i class="btn icon trash far fa-trash-alt" data-value='<?php echo json_encode($deletePopupInfo); ?>'></i>
                </div>
            </div>
            <?php endforeach ?>
        </div>

        <div class="pagination-links">
            <?php include("../../modules/pagination_links.php"); ?>
        </div>

        <div class="btn add-btn tooltip" id="create-new-project-btn"><span class="tooltiptext">Create new project</span></div>
        <form id="csv-form" action="projectList.php" method="GET">
            <input class="btn" type="submit" name="csvProjects" value="Export to CSV" />
        </form>
    </div>
    <?php include("../header_footer/footer.php");?>
    <?php 
    include("deletePopup.php"); 
    include("createProject.php");
    include("editProject.php");
    ?>
    <?php include ("createProject.php"); ?>
    <script>
       const rows = document.querySelectorAll(".table-row");
       rows.forEach(row => {
        row.addEventListener("click", (e)=>{
            if(e.path[1].classList.contains("edit-delete")){}
            else{
                window.location = e.path[1].firstElementChild.href
            }
            
        })
       });
    </script>

</body>
</html>
