/* =========================================================
   REUSABLE COMPONENTS
========================================================= */

const trimInput = ($input) => $($input).trim();

const showPopup = ($popupForm) => {
    $($popupForm).css("display", "flex");
    $($popupForm).siblings().css("opacity", "0.4");;
}

const hidePopup = ($popupForm) => {
    $($popupForm).hide();
    $($popupForm).siblings().css("opacity", "");
}


/* =========================================================
   DELETE POPUP
========================================================= */

// Show delete project popup upon clicking trash bin icon.
$(".trash").on("click", function() {
    let object = JSON.parse($(this).attr("data-value"));
    $.ajax({
        success: function () {
            $(".delete-popup form").attr("action", object.returnPage);
            if (object.objectType == "project") {
                $(".delete-popup form input[type=hidden]").attr("name", "projectId");
            } else if (object.objectType == "task") {
                $(".delete-popup form input[type=hidden]").attr("name", "delete-task-id");
                $(".delete-popup .delete-message h4").text("Are you sure you want to delete the task?");
                $(".delete-popup .delete-message p").text("");
            }
            $(".delete-popup input[type=hidden]").val(object.objectId);
            showPopup(".delete-popup");
        }
    });
})

// Hide delete project popup upon pressing cancel.
$(".delete-popup span").on("click", function() {
    hidePopup(".delete-popup");
})

/* =========================================================
   EDIT PROJECT POPUP
========================================================= */

$(".edit-project").on("click", function() {
    let $objectData = $(this).attr("data-value");
        if (typeof $objectData !== 'undefined' && $objectData !== false) {
        let $object = JSON.parse($(this).attr("data-value"));
        $.ajax({
            success: function () {
                $(".edit-project-form").attr("action", $object.returnPage);
                $(".edit-project-form input[type=hidden]").val($object.objectId);
                $(".edit-project-form #edit-project-title").val($object.objectTitle);
                $(".edit-project-form #edit-project-description").val($object.objectDescription);
                $(".edit-project-form #status").val($object.objectStatus);
            }
        });
        }
        showPopup(".edit-project-form");
})

// Hide edit project popup upon clicking cancel AND clean popup errors.
$(".edit-project-form .cancel-button").on("click", function() {
    hidePopup(".edit-project-form");
    $(".edit-project-form .errors").empty();
})

// Show edit project popup after reloading the page with wrongly submitted form AND show errors.
if ($(".edit-project-form .errors").hasClass("popup-errors")) {
    showPopup(".edit-project-form");
}

/* =========================================================
   PROJECT LIST
========================================================= */

// Show create new project popup upon pressing + icon.
$("#create-new-project-btn").on("click", function() {
    showPopup(".create-project-form");
})

// Show create new project popup after reloading the page with wrongly submitted form AND show errors.
if ($(".create-project-form .errors").hasClass("popup-errors")) {
    showPopup(".create-project-form");
}

// Hide create new project popup upon pressing AND clean popup errors.
$("#create-project-back span").on("click", function() {
    hidePopup(".create-project-form");
    $(".errors").empty();
})

/* =========================================================
   TASK LIST
========================================================= */

// Prefil form data with the selectad task info.
const setEditTaskFormFields = ($task) => {
    $.ajax({
        success: function () {
            $(".edit-task-form #taskId").val($task.taskId);
            $(".edit-task-form #edit-task-title").val($task.taskTitle);
            $(".edit-task-form #edit-task-description").val($task.taskDescription);
            $(".edit-task-form #priority").val($task.taskPriority);
            $(".edit-task-form #status").val($task.taskStatus);
            showPopup(".edit-task-form");
        }
    });
}

// Show edit task popup upon clicking edit button.
$(".ind-task-edit").on("click", function() {
    let $task = JSON.parse($(this).attr("data-value"));
    setEditTaskFormFields($task);
})

// Hide edit task popup upon clicking cancel AND clean popup errors.
$(".edit-task-form .cancel-button").on("click", function() {
    hidePopup(".edit-task-form");
    $(".edit-task-form .errors").empty();
})

// Show edit task popup after reloading the page with wrongly submitted form AND show errors.
if ($(".edit-task-form .errors").hasClass("popup-errors")) {
    let $task = JSON.parse($(".edit-task-form .errors").attr("data-value"));
    setEditTaskFormFields($task);
}

// Show create new task popup upon pressing + icon.
$("#create-new-task-btn").on("click", function() {
    showPopup(".create-task-form");
})

// Show create new task popup after reloading the page with wrongly submitted form AND show errors.
if ($(".create-task-form .errors").hasClass("popup-errors")) {
    showPopup(".create-task-form");
}

// Hide create new task popup upon pressing AND clean popup errors.
$(".create-task-form .cancel-btn").on("click", function() {
    hidePopup(".create-task-form");
    $(".create-task-form .errors").empty();
})
