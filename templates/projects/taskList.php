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

    <h1 class="task-proj-heading"><?php echo getProjectName($_GET["project_id"], $db)?></h1>
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
                    <a class="project-name">Project No 1</a>
                    <p class="project-description">Create a project management system</p>
                    <p class="tasks-count">3</p>
                    <p class="tasks-left">1</p>
                    <span class="status status-box ongoing">Ongoing</span>

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

                    <div class="tasks-to-do">
                        <div class="task-headers todo-header">
                            <h2>TODO</h2>
                        </div>

                        <div class="tasks-bottom">
                            <a class="btn add-btn" id="create-new-task-btn"
                                href="createTask.php?project_id=<?php echo $_GET["project_id"]; ?>"></a>
                        </div>
                    </div>

                    <div class="tasks-in-progress">
                        <div class="task-headers in-progress-header">
                            <h2>IN PROGRESS
                        </div>
                    </div>

                    <div class=" tasks-completed">
                        <div class="task-headers completed-header">
                            <h2>COMPLETED</h2>
                        </div>
                    </div>

                </section>


                <?php foreach (getTasks($db, $_GET["project_id"]) as $task): ?>


                <div class="individual-task">
                    <span class="task-title"> <?php echo $task["title"]; ?> </span>
                    <p class="task-description"> <?php echo $task["description"]; ?> </p>
                    <span class="task-priority"><?php echo getPriority($task["priority"], $db); ?> </span>
                    <span class="task-status"><?php echo getStatus($task["status"], $db, $isProject=false); ?> </span>
                    <!-- <span class="status status-box <?php echo strtolower($taskStatus);?>"><?php echo $taskStatus;?>
                    </span> -->
                    <span class="task-created-date"><?php echo $task["created_at"]; ?> </span>
                    <span class="task-updated-date"><?php echo $task["updated_at"]; ?> </span>
                    <span class="task-id">ID: 12BDE</p>


                        <a class="btn ind-task-edit" href="editProject.php?project_id=<?php echo $project["id"]; ?>">
                            <i class="icon edit far fa-edit"></i></a>
                        <div>
                            <form method="POST" action="taskList.php?project_id=<?php echo $_GET["project_id"]; ?>">
                                <input type="hidden" name="taskId" value="<?php echo  $task["id"]; ?>">
                                <button style="padding: 0 0 3px 3px; margin: 0 0 5px 0" class="btn ind-task-dlt"
                                    type="submit" id="delete"><i class=" icon trash far fa-trash-alt"></i></button>
                            </form>
                        </div>
                </div>

                <?php endforeach ?>

                <form id="csv-form-tasks" action="" method="GET">
                    <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">
                    <input class="btn" type="submit" name="csvTasks" value="Export to CSV" />
                </form>


                <div id="back-to-projects" class="back-to-proj-tasks">
                    <a href="projectList.php">Back to projects <i class="far fa-arrow-alt-circle-right"></i></a>
                </div>
            </div>

        </div>

</body>

</html>