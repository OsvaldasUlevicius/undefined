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
<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Priority</th>
        <th>Status</th>
    </tr>
    <?php foreach (getTasks($db, $_GET["project_id"]) as $task): ?>
        <tr>
            <td><?php echo $task["title"]; ?></td>
            <td><?php echo $task["description"]; ?></td>
            <td><?php echo getPriority($task["priority"], $db); ?></td>
            <td><?php echo getStatus($task["status"], $db, $isProject=false); ?></td>
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
