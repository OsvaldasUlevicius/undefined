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

    <div class="create-container-table" id="projects-create">

        <div class="create-edit-input-container">
            <h2 class="create-edit-heading">Project name</h2>
            <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter project title">
            <h2 class="create-edit-heading">Description</h2>
            <textarea onchange="trimInput('description')" id="description" type="text" name="description"
            placeholder="Enter description"></textarea>
        </div>

    <div class="cancel-complete">
        <div id="back-to-projects" class="btn cancel-btn cancel-button"><span>Cancel</span></div>
        <input class="btn" id="create-project-btn" type="submit" name="createProject" value="Complete">
    </div>
 </div>

</form>

