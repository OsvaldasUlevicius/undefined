<form method="POST" action="taskList.php?project_id=<?php if (isset($_GET["project_id"])) { echo $_GET["project_id"]; }; ?>" class="edit-project-form">

    <div 
        <?php if (!empty($projectPopupErrors)): ?>
            <?php 
                $errors = $projectPopupErrors;
            ?>
            class="errors popup-errors" 
        <?php endif ?>
    ><?php include('../../modules/errors.php'); ?></div>

    <div class="edit-container-table">
        <div class="edit-table-head">
            <h4 class="th title">Project name</h4>
            <h4 class="th description">Description</h4>
        </div>

        <input value="<?php echo $project["id"]; ?>" type="hidden" name="projectId">
        <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter project title"
            maxlength="255" value="<?php echo $project["title"]; ?>">
        <input onchange="trimInput('description')" id="description" type="text" name="description"
            placeholder="Enter project description" maxlength="1000" value="<?php echo $project["description"]; ?>">

        <select id="status" name="status">
            <option value="2" <?php echo ($project["status"] == 2 ? 'selected' : ''); ?>>Completed</option>
            <option value="1" <?php echo ($project["status"] == 1 ? 'selected' : ''); ?>>Ongoing</option>
        </select>

        <input class="btn" type="submit" name="editProject" id="edit-project-btn" value="Save">

        <span class="cancel-button">Cancel</span>
    </div>
</form>
