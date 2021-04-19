<?php include('../modules/createProject.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
</head>
<body>
<form method="POST" action="createProject.php">
    <div>
        <label for="title">Project title</label>
        <input id="title" type="text" name="title" placeholder="Enter project title" maxlength="255" required>
    </div>
    <div>
        <label for="description">Project description</label>
        <input id="description" type="text" name="description" placeholder="Enter project description" maxlength="1000"
               required>
    </div>
    <div>
        <label for="status">Project status</label>
        <select id="status" name="status">
            <option value="1">In progress</option>
            <option value="2">Done</option>
        </select>
    </div>
    <div>
        </br>
        <input type="submit" name="createProject" value="Create">
    </div>
</form>
</body>
</html>
