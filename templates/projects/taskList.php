<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/taskList.php');

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
    <div class="container-table">
        <div class="table-head">
            <h4 class="th title" id="title">Project name</h4>
            <h4 class="th description" id="description">Description</h4>
            <h4 class="th total" id="task-count">Tasks total</h4>
            <h4 class="th left" id="task-left">Tasks left</h4>
            <h4 class="th status" id="status">Status</h4>
            <div></div>
        </div>


        <div class="task-wrapper">

            <div class="table-body table-body-tasks" style="padding: 15px 15px; row-gap: 15px">
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
                        <a class="btn" href="editProject.php?project_id=<?php echo $project["id"]; ?>">
                            <i class="icon edit far fa-edit"></i></a>
                        <form method="POST" action="projectList.php">
                            <input type="hidden" name="projectId" value="<?php echo  $project["id"]; ?>">
                            <button class="btn" type="submit" id="delete"><i
                                    class=" icon trash far fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>

                <section class="tasks-container">

                    <div id="tasks-to-do" class="tasks-to-do dropbox">
                        <div class="task-headers todo-header">
                        <h2>TODO</h2>
                        </div>

                        <?php foreach (getTasks($db, $_GET["project_id"]) as $task): ?>
                        <?php if($task["status"] == 1){include("../projects/taskCard.php");};?>
                        <?php endforeach ?>

                        <div class="tasks-bottom">
                            <a class="btn add-btn" id="create-new-task-btn"
                                href="createTask.php?project_id=<?php echo $_GET["project_id"]; ?>"></a>
                        </div>
                    </div>

                    <div id="tasks-in-progress" class="tasks-in-progress dropbox">
                        <div class="task-headers in-progress-header">
                            <h2>IN PROGRESS</h2>
                        </div>
                        <?php foreach (getTasks($db, $_GET["project_id"]) as $task): ?>
                        <?php if($task["status"] == 2){include("taskCard.php");};?>
                        <?php endforeach ?>
                    </div>

                    <div id="tasks-completed" class="tasks-completed dropbox">
                        <div class="task-headers completed-header">
                            <h2>COMPLETED</h2>
                        </div>
                        <?php foreach (getTasks($db, $_GET["project_id"]) as $task): ?>
                        <?php if($task["status"] == 3){include("taskCard.php");};?>
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

        <script>
        //drag n drop 
        let dropEl = ""
        for (const drag of document.querySelectorAll(".draggable")){
            drag.addEventListener("dragstart", e => {
                dropEl = e.target
                return dropEl
            })
        }
        for (const drop of document.querySelectorAll(".dropbox")){
            //whent dragEl is over a dropzone
            drop.addEventListener("dragover", e => {
                e.preventDefault();
            })
            //when dragEL is dropped onto drop zone
            drop.addEventListener("drop", e => {
                e.preventDefault();
                let dropzone = e.target.id
                document.getElementById(dropzone).appendChild(dropEl)
            })
        }
    </script>
</body>

</html>
