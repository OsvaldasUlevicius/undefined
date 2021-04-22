<?php

$db = mysqli_connect("localhost", "root", "", "undefined");

if (isset($_POST["createProject"])) {
    $title = mysqli_real_escape_string($db, $_POST['title']);
    $projectQuery = "SELECT * FROM projects WHERE title=\"" . $title . "\"";
    $result = mysqli_query($db, $projectQuery);
    $projectCount = mysqli_num_rows($result);
    if ($projectCount == 0) {
        $description = mysqli_real_escape_string($db, $_POST['description']);

        $query = "INSERT INTO projects (title, description, status) VALUES('$title', '$description', '1')";
        mysqli_query($db, $query);
    } else {
        $error = "Project with this name already exists";
    }
}

?>
