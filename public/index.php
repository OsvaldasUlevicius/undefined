<?php 
    session_start(); 

    if (!isset($_SESSION["username"])) {
        $_SESSION["msg"] = "You must log in first";
        header("location: ../templates/authentication/login.php");
    }
    if (isset($_GET["logout"])) {
        session_destroy();
        unset($_SESSION["username"]);
        header("location: ../templates/authentication/login.php");
    }
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
  	<?php if (isset($_SESSION["success"])) : ?>
      	<p>
          <?php 
          	echo $_SESSION["success"]; 
          	unset($_SESSION["success"]);
          ?>
      	</p>
  	<?php endif ?>

    <?php  if (isset($_SESSION["username"])) : ?>
    	<p>Welcome <?php echo $_SESSION["username"]; ?></p>
        <form method="GET" action="index.php">
            <input type="submit" name="logout" value="logout">
        </form>
        <a href="../templates/createProject.php">Create Project</a>
        <a href="../templates/projectList.php">Project List</a>
    <?php endif ?>
</body>
</html>
