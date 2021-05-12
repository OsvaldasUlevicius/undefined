<?php 
include("../../modules/utils.php");
checkIfLoggedIn();
include('../../modules/admin/eventLog.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create new project</title>
    <link rel="stylesheet" type="text/css" href="<?php echo $cssFileLocation; ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
</head>
<body class="eventlog">
<?php include("../header_footer/header.php");?>
<div class="logo-in-page">
    <img class="logo" src="../../public/img/logo-desktop.png" />
</div>
<h1>Events</h1>
<!-- <form id="search-form" action="" method="GET">
    <input id="input-search" type="text" name="valueToSearch" placeholder="Type a keyword to search..."/>
    <button id="btn-search" class="btn" type="submit" name="search" value="search"><i class="icon fas fa-search"></i></button>
</form> -->
<div class="container-table">
    <div class="table-head">
        <h4>Event</h4>
        <h4>Object</h4>
        <h4>User</h4>
        <h4>Date</h4>
    </div>
    <div class="table-body">
        <?php $events = getEvents($db); ?>
        <?php foreach ($events["events"] as $event): ?>
            <div class="table-row">
                <p><?php echo $event["event"] ?></p>
                <?php if ($event["task_id"]): ?>
                    <p><?php echo $event["task_id"]; ?></p>
                <?php elseif ($event["project_id"]): ?>
                    <p><?php echo getProjectName($event["project_id"], $db); ?></p>
                <?php else : ?>
                    <p><?php echo getUserName($event["user_id"], $db); ?></p>
                <?php endif ?>
                <p><?php echo getUserName($event["user_id"], $db); ?></p>
                <p><?php echo $event["happened_at"]; ?></p>
            </div>
            <?php endforeach ?>
    </div>

    <div class="pagination-links">
        <?php include("../../modules/pagination_links.php"); ?>
    </div>     
</div>

<?php include("../header_footer/footer.php");?>
</body>
</html>
