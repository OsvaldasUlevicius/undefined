<?php
$db = mysqli_connect("localhost", "root", "", "undefined");

$query = "SELECT * FROM projects";
$result = mysqli_query($db, $query);

$projects = [];

while ($row = $result->fetch_assoc()) {
    $tasksQuery = "SELECT * FROM tasks WHERE project=" . $row['id'];
    $tasksResult = mysqli_query($db, $tasksQuery);
    $row['tasksCount'] = 0;
    $row['notFinishedTasksCount'] = 0;

    while ($task = $tasksResult->fetch_assoc()) {
        $row['tasksCount'] += 1;
        if ($task['status'] != 3) {
            $row['notFinishedTasksCount'] += 1;
        }
    }

    $projects[] = $row;
}
?>
