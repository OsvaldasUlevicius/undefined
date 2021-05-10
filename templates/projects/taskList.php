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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>

<body class="task-list">
    <?php include("../header_footer/header.php");?>

    <div class="logo-in-page">
        <img class="logo" src="../../public/img/logo-desktop.png" />
    </div>

    <h1><?php echo getProjectName($_GET["project_id"], $db)?></h1>
    <form id="search-form" action="" method="GET">
        <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..." />
        <button id="btn-search" class="btn" type="submit" name="search" value="search"><i
                class="icon fas fa-search"></i></button>
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


    <div class="task-wrapper">

        <?php foreach (getTasks($db, $_GET["project_id"]) as $task): ?>

        <tr>
            <td><?php echo $task["title"]; ?></td>
            <td><?php echo $task["description"]; ?></td>
            <td><?php echo getPriority($task["priority"], $db); ?></td>
            <td><?php echo getStatus($task["status"], $db, $isProject=false); ?></td>
            <span class="status status-box <?php echo strtolower($projectStatus);?>"><?php echo $projectStatus;?></span>
            <td><?php echo $task["created_at"]; ?></td>
            <td><?php echo $task["updated_at"]; ?></td>

                <div class="edit-delete">
                <a class="btn" href="editProject.php?project_id=<?php echo $project["id"]; ?>">
                <i class="icon edit far fa-edit"></i></a> 
            <td>
                <form method="POST" action="taskList.php?project_id=<?php echo $_GET["project_id"]; ?>">
                    <input type="hidden" name="taskId" value="<?php echo  $task["id"]; ?>">
                    <button class="btn" type="submit" id="delete"><i class=" icon trash far fa-trash-alt"></i></button>
                </form>
                </div>
            </td>
        </tr>
        
        <?php endforeach ?>
        </table>

        <form id="csv-form-tasks" action="" method="GET">
            <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">
            <input class="btn" type="submit" name="csvTasks" value="Export to CSV"/>
        </form>

        <a class="btn add-btn" id="create-new-task-btn" href="createTask.php?project_id=<?php echo $_GET["project_id"]; ?>"></a>
        <div id="back-to-projects">
                <a href="projectList.php">Back to projects <i class="far fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </body>

</html>