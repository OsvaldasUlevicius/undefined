<form method="POST" action="taskList.php?project_id=<?php if (isset($_GET["project_id"])) { echo $_GET["project_id"]; }; ?>" class="edit-project-form">

    <div class="create-container-table">

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

        <div class="create-edit-input-container">
                <h2 class="create-edit-heading">Project name</h2>
                <input value="<?php echo $project["id"]; ?>" type="hidden" name="projectId">
                <input onchange="trimInput('title')" id="edit-project-title" type="text" name="title" placeholder="Enter project title"
            value="<?php echo $project["title"]; ?>">
                <h2 class="create-edit-heading">Description</h2>
                <textarea onchange="trimInput('description')" id="edit-project-description" type="text" name="description"
            placeholder="Enter project description"><?php echo $project["description"]; ?></textarea>
        </div>
    
        <div class="status-container">
            <span>Status: </span>
            <select id="status" name="status">
                <option value="2" <?php echo ($project["status"] == 2 ? 'selected' : ''); ?>>Completed</option>
                <option value="1" <?php echo ($project["status"] == 1 ? 'selected' : ''); ?>>Ongoing</option>
            </select>
        </div>

        <div class="cancel-complete">
            <div id="edit-project-back" class="btn cancel-btn cancel-button"><span class="cancel-button">Cancel</span></div>
            <input class="btn" type="submit" name="editProject" id="edit-project-btn" value="Save">
        </div>
    </div>
</form>
