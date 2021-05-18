<?php 

if (isset($task)) { ?>

<div id="<?php echo $task["id"];?>" class="individual-task draggable">
    <span class="task-title"> <?php echo $task["title"]; ?> </span>
    <p class="task-description"> <?php echo $task["description"]; ?> </p>
    <span class="task-priority"><?php echo getPriority($task["priority"], $db); ?> </span>
    <span class="task-created-date">Date created: <?php echo $task["created_at"]; ?> </span>
    <span class="task-id">ID: <?php echo $task["id"]; ?> </p>


        <a class="btn ind-task-edit" href="editProject.php?project_id=<?php echo $project["id"]; ?>">
            <i class="icon edit far fa-edit"></i></a>
        <div>
            <form method="POST" action="taskList.php?project_id=<?php echo $_GET["project_id"]; ?>">
                <input type="hidden" name="taskId" value="<?php echo  $task["id"]; ?>">
                <button style="padding: 0 0 3px 3px; margin: 0 0 5px 0" class="btn ind-task-dlt"
                    type="submit" id="delete"><i class=" icon trash far fa-trash-alt"></i></button>
            </form>
        </div>
</div>

<?php
}

?>
