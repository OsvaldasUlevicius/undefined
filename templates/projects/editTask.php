<!-- <script>
    function onChange(id) {
        let input = document.getElementById(id);
        input.value = input.value.trim();
    }
</script> -->

<form method="POST" action="taskList.php?project_id=<?php echo $task["project"]; ?>" class="edit-task-form">
    <div 
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
            class="errors popup-errors" 
            data-value='<?php echo json_encode($taskArray); ?>'
        <?php endif ?>
    ><?php include('../../modules/errors.php'); ?></div>
    <input type="hidden" name="taskId" id="taskId">
    <label for="title">Task title</label>
    <input onchange="trimInput('title')" id="title" type="text" name="title" placeholder="Enter task title" maxlength="255">
    <label for="description">Task description</label>
    <input onchange="trimInput('description')" id="description" type="text" name="description" placeholder="Enter task description" maxlength="1000">
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
    <input type="submit" name="editTask" value="Save">
    <span class="cancel-button">Cancel</span>
</form>

