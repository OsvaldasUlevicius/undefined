<?php 

if (isset($task)) { ?>
<?php $taskPriority = getPriority($task["priority"], $db); ?>
<div id="<?php echo $task["id"];?>" 
    class="
        individual-task 
        draggable
        <?php 
            if ($taskPriority == "Medium") { echo "task-medium"; }
            else if ($taskPriority == "Low") { echo "task-low"; }
        ?>
    ">
    <span class="task-title tooltip"><span class="tooltiptext"><?php echo $task["title"];?></span> <?php echo truncate($task["title"], array("wordWidth" => 4, "characterWidth" => 30)); ?> </span>
    <p class="task-description tooltip"><span class="tooltiptext"><?php echo $task["description"];?></span> <?php echo truncate($task["description"], array("wordWidth" => 4, "characterWidth" => 100)); ?> </p>
    <span class="task-priority"><?php if ($taskPriority == "Medium") { echo "Med"; } else { echo $taskPriority; } ?> </span>
    <span class="task-created-date">Date created: <?php echo $task["created_at"]; ?> <span class="task-id tooltip">ID: <?php echo $task["id"]; ?><span class="tooltiptext">ID: <?php echo $task["id"];?></span> </span></span>
    
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
        <i class="icon trash far fa-trash-alt ind-task-dlt btn" data-value='<?php echo json_encode($deletePopupInfo)?>'></i>

</div>

<?php
}

?>
