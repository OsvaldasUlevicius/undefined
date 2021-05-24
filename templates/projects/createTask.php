<form method="POST" action="taskList.php?project_id=<?php echo $_GET["project_id"]; ?>" class="create-task-form">
    <div 
        <?php 
            if(session_id() == '' || !isset($_SESSION)) {
                // session isn't started
                session_start();
            }
            if (!empty($_SESSION['popupErrors'])): ?>
            <?php 
                $errors =$_SESSION['popupErrors'];
                unset($_SESSION['popupErrors']);
            ?>
            class="errors popup-errors" 
        <?php endif ?>
    ><?php include('../../modules/errors.php'); ?></div>

    <input value="<?php echo $_GET["project_id"]; ?>" type="hidden" name="projectId">

    <div class="create-container-table">
        
        <div class="create-table-head">
            <h4 class="th title">Task title</h4>
            <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter task title"
                maxlength="255">
            <h4 class="th description">Task description</h4>
            <input onchange="trimInput('description')" id="description" type="text" name="description"
                placeholder="Enter task description" maxlength="1000">
        </div>
        
        <select id="priority" name="priority">
            <option value="1">Low</option>
            <option value="2">Medium</option>
            <option value="3">High</option>
        </select>
        <select id="status" name="status">
            <option value="1">TODO</option>
            <option value="2">In Progress</option>
            <option value="3">Completed</option>
        </select>

        <input id="create-task-btn" class="btn" type="submit" name="createTask" value="Complete">

        <div id="back-to-tasks">Cancel</div>
    </div>
</form>

