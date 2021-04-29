<?php

function getTasks($db, $projectId) {
    $query = "SELECT * FROM tasks WHERE project ='$projectId'";
    return mysqli_query($db, $query);
}

function getPriority($priorityId, $db, $isTask=true) {
    if ($isTask) {
        $priorityQuery = "SELECT * FROM task_priorities WHERE id='$priorityId' LIMIT 1";
    }
    $priorityResult = mysqli_query($db, $priorityQuery);
    $priority = mysqli_fetch_assoc($priorityResult);

	return $priority["priority"];
}
if(isset($_GET['csvTasks'])){
// database record to be exported
$db_record = 'tasks';
// optional where query
$where = 'WHERE 1 ORDER BY 1';
// filename for export
$csv_filename = 'db_export_'.$db_record.'_'.date('Y-m-d').'.csv';
// database variables
$hostname = "localhost";
$user = "root";
$password = "";
$database = "undefined";
$port = 3306;

$conn = mysqli_connect($hostname, $user, $password, $database, $port);
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// create empty variable to be filled with export data
$csv_export = '';

// query to get data from database
$query = mysqli_query($conn, "SELECT * FROM ".$db_record." ".$where);
$field = mysqli_field_count($conn);

// create line with field names
for($i = 0; $i < $field; $i++) {
    $csv_export.= mysqli_fetch_field_direct($query, $i)->name.';';
}

// newline (seems to work both on Linux & Windows servers)
$csv_export.= '
';

// loop through database query and fill export variable
while($row = mysqli_fetch_array($query)) {
    // create line with field values
    for($i = 0; $i < $field; $i++) {
        $csv_export.= '"'.$row[mysqli_fetch_field_direct($query, $i)->name].'";';
    }
    $csv_export.= '
';
}

// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
}
