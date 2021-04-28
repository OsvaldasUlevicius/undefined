<?php if (isset($_SESSION["message"])) : ?>
    <p class="msg">
        <?php 
            echo $_SESSION["message"]; 
            unset($_SESSION["message"]);
        ?>
    </p>
<?php endif ?>
