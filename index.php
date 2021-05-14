<?php  
    if(session_id() == '' || !isset($_SESSION)) {
        // session isn't started
        session_start();
    }
    if (isset($_SESSION["username"])) :
        header("location: templates/projects/projectList.php");
    else :
        header("location: templates/authentication/login.php");
    endif 
?>
