<form method="POST" action="taskList.php?project_id=<?php echo $_GET["project_id"]; ?>" class="create-task-form">

    <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">

    <div class="create-container-table">
        <div class="errors 
            <?php 
                if(session_id() == '' || !isset($_SESSION)) {
                    // session isn't started
                    session_start();
                }
                if (!empty($_SESSION['popupErrors'])): ?>
                <?php 
                    $errors = $_SESSION['popupErrors'];
                    unset($_SESSION['popupErrors']);
                ?>
                <?php echo "popup-errors"; ?>
                <?php endif ?>
        "><?php include('../../modules/errors.php'); ?></div>
        
        <div class="create-edit-input-container">
            <h2 class="create-edit-heading">Task title</h2>
            <input onchange="trimInput('title')" id="create-task-title" type="text" name="title" placeholder="Enter task title">
            <h2 class="create-edit-heading">Task description</h2>
            <textarea onchange="trimInput('description')" id="create-task-description" type="text" name="description"
                placeholder="Enter task description"></textarea>
        </div>
        
        <div class="priority-container">
            <span>Priority:</span>
            <select id="priority" name="priority">
                <option value="1">Low</option>
                <option value="2">Medium</option>
                <option value="3">High</option>
            </select>
        </div>

        <div class="status-container">
            <span>Status:</span>
            <select id="status" name="status">
                <option value="1">TODO</option>
                <option value="2">In Progress</option>
                <option value="3">Completed</option>
            </select>
        </div>
        
        <div class="cancel-complete">
            <div id="create-task-back" class="btn cancel-btn"><span>Cancel</span></div>
            <input id="create-task-btn" class="btn" type="submit" name="createTask" value="Complete">
        </div>
    </div>
</form>
