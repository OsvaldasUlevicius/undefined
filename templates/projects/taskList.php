<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/taskList.php');
include('../../modules/projects/updateTaskStatus.php');
include("taskCard.php");
include('../../modules/projects/editTask.php');
include('../../modules/projects/createTask.php');
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
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
        <script src="../../public/js/script.js" defer></script>
</head>

<body class="task-list">
    <?php include("../header_footer/header.php");?>

    <div class="logo-in-page">
        <img class="task-proj-logo" src="../../public/img/logo-img.png" /><br><br>
        <img class="task-proj-logo" src="../../public/img/logo-text.png" />
    </div>
    

    <h1 class="task-proj-heading"><?php echo getObjectName("projects", $_GET["project_id"], "title", $db)?></h1>
    <form id="search-form" action="" method="POST">
        <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..." />
        <button id="btn-search" class="btn" type="submit" name="search" value="search"><i
                class="icon fas fa-search"></i></button>
    </form>

    <div id="back-to-projects-top" class="back-to-proj-tasks">
        <a href="projectList.php">Back to projects</a>
    </div>

    <div class="container-table">
        <div class="table-head">
            <h4 class="th title" id="title">Project name</h4>
            <h4 class="th description" id="description">Description</h4>
            <h4 class="th total" id="task-count">Tasks total</h4>
            <h4 class="th left" id="task-left">Tasks left</h4>
            <h4 class="th status" id="status-top">Status</h4>
            <div></div>
        </div>


        <div class="task-wrapper">

            <div class="table-body table-body-tasks">
                <div class="table-row" style="border:none">
                    <?php $currentProjectInfo=getProjectInfo($_GET["project_id"], $db)?>
                    <a class="project-name"><?php echo $currentProjectInfo["title"]; ?></a>
                    <p class="project-description"><?php echo $currentProjectInfo["description"]; ?></p>
                    <p class="tasks-count"><?php echo  countProjectTasks($_GET["project_id"], $db); ?></p>
                    <p class="tasks-left"><?php echo  countProjectTasks($_GET["project_id"], $db, $isFinished=true); ?></p>
                    <?php $projectStatus = getStatus($currentProjectInfo["status"], $db); ?>
                    <span
                        class="status status-box <?php echo strtolower($projectStatus);?>"><?php echo $projectStatus;?>
                    </span>

                    <div class="edit-delete">
                        <i class="btn icon edit far fa-edit edit-project"></i>
                        <?php $deleteProjectPopupInfo = array("objectType" => "project", "objectId" => intval($_GET["project_id"]), "returnPage" => "projectList.php"); ?>
                        <i class="btn icon trash far fa-trash-alt" data-value='<?php echo json_encode($deleteProjectPopupInfo)?>'></i>
                        </form>
                    </div>
                </div>

                <section class="tasks-container">

                    <div data-value="TODO" class="tasks-to-do dropbox" onMouseOver="drag();">
                        <div class="task-headers todo-header">
                        <h2>TODO</h2>
                        </div>

                        <?php foreach ($filteredTasks as $task): ?>
                        <?php 
                            if (getStatus($task["status"], $db, $isProject=false) == "TODO") {
                                include("taskCard.php");
                            }
                        ?>
                        <?php endforeach ?>

                        <div class="tasks-bottom">
                            <div class="btn add-btn tooltip" id="create-new-task-btn"><span class="tooltiptext">Create new task</span></div>
                        </div>
                    </div>

                    <div data-value="In Progress" class="tasks-in-progress dropbox" onMouseOver="drag();">
                        <div class="task-headers in-progress-header">
                            <h2>IN PROGRESS</h2>
                        </div>
                        <?php foreach ($filteredTasks as $task): ?>
                            <?php 
                            if (getStatus($task["status"], $db, $isProject=false) == "In Progress") {
                                include("taskCard.php"); 
                            }
                            ?>
                        <?php endforeach ?>
                    </div>

                    <div data-value="Completed" class="tasks-completed dropbox" onMouseOver="drag();">
                        <div class="task-headers completed-header">
                            <h2>COMPLETED</h2>
                        </div>
                        <?php foreach ($filteredTasks as $task): ?>
                            <?php 
                            if (getStatus($task["status"], $db, $isProject=false) == "Completed") {
                                include("taskCard.php"); 
                            }
                            ?>
                        <?php endforeach ?>
                    </div>

                </section>

                <form id="csv-form-tasks" action="" method="GET">
                    <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">
                    <input class="btn" type="submit" name="csvTasks" value="Export to CSV" />
                </form>


                <div id="back-to-projects" class="back-to-proj-tasks">
                    <a href="projectList.php">Back to projects <i class="far fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
    <?php 
        include("editTask.php");
        include("createTask.php");
        include("deletePopup.php");
        include("editProject.php");
        include("../header_footer/footer.php");
    ?>


<script>
//initialize the drag and drop functions.
function drag() {

    $(".dropbox .individual-task").draggable({
        appendTo: "body",
        // helper: "clone",
        revert: "invalid",
        cursor: "grab"
    });

    $(".dropbox").droppable({
        activeClass: "dropbox-call",
        hoverClass: "dropbox-hovered",
        // accept: ":not(.ui-sortable-helper)",
        drop: function (event, ui) {
            let task = ui.draggable.attr("id");
            let column = $(this).attr("data-value");
            $.ajax({
                url: "../../modules/projects/updateTaskStatus.php",
                type: "POST",
                data: {
                    task: task,
                    columnStatus: column
                },
                success: function (html) {
                    location.reload();
                }
            });
        }
    });
}

</script>
</body>

</html>
