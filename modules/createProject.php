<?php

$db = mysqli_connect("localhost", "root", "", "undefined");

if (isset($_POST["createProject"])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    $status = mysqli_real_escape_string($db, $_POST['status']);

    $query = "INSERT INTO projects (title, description, status) VALUES('$title', '$description', '$status')";
    mysqli_query($db, $query);
}

?>
