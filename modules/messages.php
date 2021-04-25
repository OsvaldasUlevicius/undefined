<?php if (isset($_SESSION["message"])) : ?>
    <p>
        <?php 
            echo $_SESSION["message"]; 
            unset($_SESSION["message"]);
        ?>
    </p>
<?php endif ?>
