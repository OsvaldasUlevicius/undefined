<div class="delete-popup">
    <img src="../../public/img/img_delete_project.png" alt="Bin image">
    <div class="delete-message">
        <h4>Are you sure you want to delete the project?</h4>
        <p>Please note that all project information, including the tasks, will be erased too</p>


        <form method="POST" action="projectList.php">
            <input type="hidden" name="projectId">
            <button class="auth-btn btn-light"  id="delete">
                Delete
            </button>
        </form>
        <span>Cancel</span>
    </div>
</div>
