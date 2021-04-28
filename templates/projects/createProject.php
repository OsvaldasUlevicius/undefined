<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/createProject.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
    <script>
        function onChange(id) {
            let input = document.getElementById(id);
            input.value = input.value.trim();
        }
    </script>
</head>
<body>
<form method="POST" action="createProject.php">
    <?php include('../../modules/errors.php'); ?>
    <label for="title">Project title</label>
    <input onchange="onChange('title')" id="title" type="text" name="title" placeholder="Enter project title" maxlength="255">
    <label for="description">Project description</label>
    <input onchange="onChange('description')" id="description" type="text" name="description" placeholder="Enter project description" maxlength="1000">
    <input type="submit" name="createProject" value="Create">
</form>
</body>
</html>
