<?php include('../modules/projectList.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <style>
        table, th, td {
            border: 1px solid black;
        }
        table td {
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
    </style>
</head>
<body>
<table style="width:100%; table-layout: fixed;">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Status</th>
        <th>Task Count</th>
        <th>Not Finished Task Count</th>
    </tr>
    <?php
    foreach ($projects as $value) {
        echo "<tr>";
            echo "<td>" . $value['title'] . "</td>";
            echo "<td>" . $value['description'] . "</td>";
            echo "<td>" . $value['status'] . "</td>";
            echo "<td>" . $value['tasksCount'] . "</td>";
            echo "<td>" . $value['notFinishedTasksCount'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
</body>
</html>
