<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/createTask.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new task</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script>
        function onChange(id) {
            let input = document.getElementById(id);
            input.value = input.value.trim();
        }
    </script>
</head>

<body>
    <form method="POST" action="createTask.php?project_id=<?php echo $_GET["project_id"]; ?>">
        <?php include('../../modules/errors.php'); ?>
        <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">

        <div class="create-container-table">
            
            <div class="create-table-head">
                <h4 class="th title">Task title</h4>
                <input onchange="onChange('title')" id="title" type="text" name="title" placeholder="Enter task title"
                    maxlength="255">
                <h4 class="th description">Task description</h4>
                <input onchange="onChange('description')" id="description" type="text" name="description"
                    placeholder="Enter task description" maxlength="1000">
            </div>
            
            <select id="priority" name="priority">
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
            </select>
            <select id="status" name="status">
                <option value="1">TODO</option>
                <option value="2">In Progress</option>
                <option value="3">Completed</option>
            </select>

            <input id="create-task-btn" class="btn" type="submit" name="createTask" value="Complete">

            <div id="back-to-tasks">
                <a href="taskList.php">Back to tasks <i class="far fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </form>
</body>

</html>