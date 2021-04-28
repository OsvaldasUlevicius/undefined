<?php  if (count($errors) > 0) : ?>
    <?php foreach ($errors as $error) : ?>
        <p class="error"><?php echo $error ?></p>
    <?php endforeach ?>
<?php  endif ?>
