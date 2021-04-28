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
</head>
<body>
<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Task Count</th>
        <th>Not Finished Task Count</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>
    <?php $projectsInformation = getProjects($db); ?>
    <?php foreach ($projectsInformation["projects"] as $project): ?>
        <tr>
            <td>
                <a href="taskList.php?project_id=<?php echo $project["id"]; ?>">
                    <?php echo $project["title"] ?>
                </a>
            </td>
            <td><?php echo  $project["description"]; ?></td>
            <td><?php echo getStatus($project["status"], $db); ?></td>
            <td><?php echo  countProjectTasks($project["id"], $db); ?></td>
            <td><?php echo  countProjectTasks($project["id"], $db, $isFinished=true);; ?></td>
            <td>
                <a href="editProject.php?project_id=<?php echo $project["id"]; ?>">
                    Edit
                </a>
            </td>
            <td>
                <form method="POST" action="projectList.php">
                    <input type="hidden" name="projectId" value="<?php echo  $project["id"]; ?>">
                    <button type="submit" id="delete">DELETE</button>
                </form>
            </td>
        </tr>
    <?php endforeach ?>
</table>
<?php include("../../modules/pagination_links.php"); ?>
</body>
</html>
