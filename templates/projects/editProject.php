<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/projects/editProject.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />
    <script>
        function onChange(id) {
            let input = document.getElementById(id);
            input.value = input.value.trim();
        }
    </script>
</head>

<body>
    <form method="POST" action="editProject.php">

        <?php include('../../modules/errors.php'); ?>

        <div class="edit-container-table">
            <div class="edit-table-head">
                <h4 class="th title">Project name</h4>
                <h4 class="th description">Description</h4>
            </div>

            <input value="<?php echo $project["id"]; ?>" type="hidden" name="projectId">
            <input onchange="onChange('title')" id="title" type="text" name="title" placeholder="Enter project title"
                maxlength="255" value="<?php echo $project["title"]; ?>">
            <input onchange="onChange('description')" id="description" type="text" name="description"
                placeholder="Enter project description" maxlength="1000" value="<?php echo $project["description"]; ?>">

            <select id="status" name="status">
                <option value="2" <?php echo ($project["status"] == 2 ? 'selected' : ''); ?>>Completed</option>
                <option value="1" <?php echo ($project["status"] == 1 ? 'selected' : ''); ?>>Ongoing</option>
            </select>

            <input class="btn" type="submit" name="editProject" id="edit-project-btn" value="Save">

            <div id="back-to-projects">
                <a href="projectList.php">Back to projects <i class="far fa-arrow-alt-circle-right"></i></a>
            </div>
        </div>
    </form>
</body>

</html>