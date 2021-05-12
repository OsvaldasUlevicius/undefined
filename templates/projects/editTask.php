<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/editTask.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
    <script>
        function onChange(id) {
            let input = document.getElementById(id);
            input.value = input.value.trim();
        }
    </script>
</head>
<body>
<form method="POST" action="editTask.php">
    <?php include('../../modules/errors.php'); ?>
    <input value="<?php echo $task["id"]; ?>" type="hidden" name="taskId">
    <label for="title">Task title</label>
    <input onchange="onChange('title')" id="title" type="text" name="title" placeholder="Enter task title" maxlength="255" value="<?php echo $task["title"]; ?>">
    <label for="description">Task description</label>
    <input onchange="onChange('description')" id="description" type="text" name="description" placeholder="Enter task description" maxlength="1000" value="<?php echo $task["description"]; ?>">
    <select id="priority" name="priority">
        <option value="1" <?php echo ($task["priority"] == 1 ? 'selected' : ''); ?>>Low</option>
        <option value="2" <?php echo ($task["priority"] == 2 ? 'selected' : ''); ?>>Medium</option>
        <option value="3" <?php echo ($task["priority"] == 3 ? 'selected' : ''); ?>>High</option>
    </select>
    <select id="status" name="status">
        <option value="1" <?php echo ($task["status"] == 1 ? 'selected' : ''); ?>>TODO</option>
        <option value="2" <?php echo ($task["status"] == 2 ? 'selected' : ''); ?>>In Progress</option>
        <option value="3" <?php echo ($task["status"] == 3 ? 'selected' : ''); ?>>Completed</option>
    </select>
    <input type="submit" name="editTask" value="Save">
</form>
<a class="cancel-button" href="taskList.php?project_id=<?php echo $task["project"]; ?>">Cancel</a>
</body>
</html>
