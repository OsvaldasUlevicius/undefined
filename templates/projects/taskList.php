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
</head>
<body>
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
</body>
</html>
