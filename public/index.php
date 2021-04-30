<?php 
    include("../modules/utils.php");
    checkIfLoggedIn($restrictAccess=false);
    header("location: ../templates/projects/projectList.php");
    logout();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php 
        include("../modules/messages.php");
    ?>
    <?php  if (isset($_SESSION["username"])) : ?>
        <p>Welcome <?php echo $_SESSION["username"]; ?></p>
        <form method="GET" action="index.php">
            <input type="submit" name="logout" value="logout">
        </form>
        <a href="../templates/projects/createProject.php">Create Project</a>
        <a href="../templates/projects/projectList.php">Project List</a>
    <?php endif ?>
</body>
</html>
