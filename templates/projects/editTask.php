<!-- <script>
    function onChange(id) {
        let input = document.getElementById(id);
        input.value = input.value.trim();
    }
</script> -->

    <form method="POST" action="taskList.php?project_id=<?php echo $task["project"]; ?>" class="edit-task-form">
        <div class="errors popup-errors" data-value='<?php echo json_encode($taskArray); ?>'>
            <?php if (!empty($popupErrors)): ?>
                <?php $taskArray=array(
                    "taskId" => intval($task["id"]), 
                    "taskTitle" => $task["title"], 
                    "taskDescription" =>  $task["description"],
                    "taskPriority" => intval($task["priority"]),
                    "taskStatus" => intval($task["status"])
                );
                    $errors = $popupErrors;
                ?>
            
            
            <?php endif ?>
                <?php include('../../modules/errors.php'); ?>
        </div>

    <div class="edit-container-table">

        <div class="create-edit-input-container">
            <input type="hidden" name="taskId" id="taskId">
            <h2 class="create-edit-heading">Task title</h2>
            <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter task title">
            <h2 class="create-edit-heading">Task description</h2>
            <input onchange="trimInput('description')" id="description" type="text" name="description" placeholder="Enter task description">
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
            <div id="back-to-tasks" class="btn cancel-btn cancel-button"><span>Cancel</span></div>
            <input id="create-task-btn" class="btn" type="submit" name="editTask" value="Save">
        </div>
    </div>
</form>

