<nav>
<ul class="other-links">
<a href="#"><img src="../../public/img/logo-long.png" alt=""></a>
    <li><a class="nav-link" href="">Home</a></li>
    <li><a class="nav-link" href="">About us</a></li>
</ul>
<div class="nav-form">
        <p>You are logged in as a <span><?php echo $_SESSION["username"]; ?></span></p>
<form method="GET" action="">
            <input type="submit" id="logout" name="logout" value="Logout">
        </form>
</div>
</nav>