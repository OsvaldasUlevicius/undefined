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
    <style>
        table {
            width: 90%;
            margin: 0 auto;
        }

        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
        }
    </style>
</head>
<body style="flex-direction: column;">
<?php include("../header_footer/header.php");?>

<form id="search-form" action="" method="POST">
    <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..."/>
    <button id="btn-search" class="btn" type="submit" name="search" value="search"><i class="icon fas fa-search"></i></button>
</form>
<table>
    <tr>
        <th>Task Id</th>
        <th>Title</th>
        <th>Description</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Actions</th>
    </tr>
    <?php $filteredTasks = isFiltered($db,$_GET["project_id"])?>
    <?php
    $errors = array();
    if (mysqli_fetch_assoc($filteredTasks) == 0){array_push($errors, "We didn't find any tasks following your search request.");include('../../modules/errors.php');};
    ?>
    <?php foreach ($filteredTasks as $task): ?>
        <tr>
            <td><?php echo $task["id"]; ?></td>
            <td><?php echo $task["title"]; ?></td>
            <td><?php echo $task["description"]; ?></td>
            <td><?php echo getPriority($task["priority"], $db); ?></td>
            <td><?php echo getStatus($task["status"], $db, $isProject=false); ?></td>
            <td><?php echo $task["created_at"]; ?></td>
            <td><?php echo $task["updated_at"]; ?></td>
            <td>
                <form method="GET" action="editTask.php">
                    <input type="hidden" name="taskId" value="<?php echo  $task["id"]; ?>">
                    <button type="submit" id="edit">Edit</button>
                </form>
                <form method="POST" action="taskList.php?project_id=<?php echo $_GET["project_id"]; ?>">
                  <input type="hidden" name="taskId" value="<?php echo  $task["id"]; ?>">
                  <button type="submit" id="delete">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>
    <form action="" method="GET">
        <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">
        <input type="submit" name="csvTasks" value="Export to CSV"/>
    </form>
    <a class="btn" href="createTask.php?project_id=<?php echo $_GET["project_id"]; ?>">
        Create task
    </a>
    <a href="projectList.php">Back to Project list</a>
</body>
</html>
