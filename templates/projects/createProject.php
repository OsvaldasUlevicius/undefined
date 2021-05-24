<form method="POST" action="projectList.php" class="create-project-form">

    <div class="errors 
        <?php if (!empty($popupErrors)) {
            echo "popup-errors";
        }
        ?>"
    >
        <?php
        $errors = $popupErrors;
        include('../../modules/errors.php'); 
        ?>
    </div>

    <div class="create-container-table">
        <div class="create-table-head">
            <h4 class="th title">Project name</h4>
            <h4 class="th description">Description</h4>
        </div>

        <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter project title"
            maxlength="255">
        <input onchange="trimInput('description')" id="description" type="text" name="description"
            placeholder="Enter description" maxlength="1000">
        <input class="btn" id="create-project-btn" type="submit" name="createProject" value="Complete">

        <div id="back-to-projects">
            <span>Cancel</span>
        </div>
    </div>

</form>

