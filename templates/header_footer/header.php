<?php
include("../../modules/authentication/authentication.php");

?>
<nav>
<ul class="other-links">
<a href="../../index.php"><img src="../../public/img/logo-long.png" alt=""></a>
    <li><a class="nav-link" href="../admin/eventLog.php">Event log</a></li>
</ul>
<div class="nav-form">
    <p><span class="nav-text">You are logged in as </span><span class="nav-bold-text"><?php echo $_SESSION["username"]; ?></span></p>
<form method="GET" action="">
            <input type="submit" id="logout" name="logout" value="Log out">
        </form>
</div>
</nav>
