<?php 

if (isset($task)) { ?>

<div id="<?php echo $task["id"];?>" class="individual-task draggable">
    <span class="task-title"> <?php echo $task["title"]; ?> </span>
    <p class="task-description"> <?php echo $task["description"]; ?> </p>
    <span class="task-priority"><?php echo getPriority($task["priority"], $db); ?> </span>
    <span class="task-created-date">Date created: <?php echo $task["created_at"]; ?> </span>
    <span class="task-id">ID: <?php echo $task["id"]; ?> </p>

        <?php $taskArray=array(
            "taskId" => intval($task["id"]), 
            "taskTitle" => $task["title"], 
            "taskDescription" =>  $task["description"],
            "taskPriority" => intval($task["priority"]),
            "taskStatus" => intval($task["status"])
            );
        ?>
        <span class="btn ind-task-edit" data-value='<?php echo json_encode($taskArray); ?>'>
            <i class="icon edit far fa-edit"></i>
        </span>
        <?php $deletePopupInfo = array("objectType" => "task", "objectId" => intval($task["id"]), "returnPage" => "taskList.php?project_id=".$_GET["project_id"]); ?>
        <i class="icon trash far fa-trash-alt ind-task-dlt btn" data-value='<?php echo json_encode($deletePopupInfo)?>' class="ind-task-dlt"></i>

</div>

<?php
}

?>
