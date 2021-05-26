<form method="POST" action="taskList.php?project_id=<?php if (isset($_GET["project_id"])) { echo $_GET["project_id"]; }; ?>" class="edit-project-form">

<<<<<<< HEAD

    <div class="errors 
        <?php if (!empty($projectPopupErrors)) {
            echo "popup-errors";
        }
        ?>"
    >
        <?php
        if (!empty($projectPopupErrors)) {
            $errors = $projectPopupErrors;
            include('../../modules/errors.php'); 
        }
        ?>
    </div>

    <div class="edit-container-table">

        <div class="create-edit-input-container">
                <h2 class="create-edit-heading">Project name</h2>
                <input value="<?php echo $project["id"]; ?>" type="hidden" name="projectId">
                <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter project title"
            value="<?php echo $project["title"]; ?>">
                <h2 class="create-edit-heading">Description</h2>
                <textarea onchange="trimInput('description')" id="description" type="text" name="description"
            placeholder="Enter project description" value="<?php echo $project["description"]; ?>"></textarea>
=======

    <div class="errors 
        <?php if (!empty($projectPopupErrors)) {
            echo "popup-errors";
        }
        ?>"
    >
        <?php
        if (!empty($projectPopupErrors)) {
            $errors = $projectPopupErrors;
            include('../../modules/errors.php'); 
        }
        ?>
    </div>

    <div class="edit-container-table">

        <div class="create-edit-input-container">
            <div class="edit-table-head">
                <h2 class="create-edit-heading">Project name</h2>
                <input value="<?php echo $project["id"]; ?>" type="hidden" name="projectId">
                <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter project title"
                value="<?php echo $project["title"]; ?>">
                <h2 class="create-edit-heading">Description</h2>
                <textarea onchange="trimInput('description')" id="description" type="text" name="description"
                placeholder="Enter project description" value="<?php echo $project["description"]; ?>"></textarea>
            </div>
>>>>>>> a4723655741cbdc43a1b7a776ca5995a09ddafe9
        </div>
    
        <div class="status-container">
            <span>Status: </span>
            <select id="status" name="status">
                <option value="2" <?php echo ($project["status"] == 2 ? 'selected' : ''); ?>>Completed</option>
                <option value="1" <?php echo ($project["status"] == 1 ? 'selected' : ''); ?>>Ongoing</option>
            </select>
        </div>

        <div class="cancel-complete">
            <div id="back-to-projects" class="btn cancel-btn cancel-button"><span class="cancel-button">Cancel</span></div>
            <input class="btn" type="submit" name="editProject" id="edit-project-btn" value="Save">
        </div>
    </div>
</form>
