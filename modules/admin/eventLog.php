<?php

function getEvents($db, $isFiltered=false) {
    $errors = array();

    // Find how many events there are
    if($isFiltered){
        $valueToSearch = $_GET["valueToSearch"];
        $countTotalEventsQuery = "SELECT COUNT(*) FROM events WHERE event LIKE '%$valueToSearch%'";
    }else{
        $countTotalEventsQuery = "SELECT COUNT(*) FROM events";
    }
 
    $countTotalEventsResult = mysqli_query($db, $countTotalEventsQuery);
    $countEvents = mysqli_fetch_assoc($countTotalEventsResult);
    $countTotalEvents = $countEvents["COUNT(*)"];
    if($countTotalEvents == 0) {
        array_push($errors, "Your search did not match any events");
    }

    // Get total pages necessary
    $eventsPerPage = 10;
    $totalPages = ceil($countTotalEvents / $eventsPerPage);

    // Get the current page or set a default
    if (isset($_GET["currentPage"]) && is_numeric($_GET["currentPage"])) {
        $currentPage = (int) $_GET["currentPage"];
    } else {
        $currentPage = 1;
    }

    if ($currentPage > $totalPages) {
        $currentPage = $totalPages;
    }
    if ($currentPage < 1) {
        $currentPage = 1;
    } 

    // the offset of the list, based on current page 
    $offset = ($currentPage - 1) * $eventsPerPage;
    if ($isFiltered) {
        $getEventsForThisPage = "SELECT * FROM events ORDER BY happened_at WHERE event LIKE '%$valueToSearch%' LIMIT $offset, $eventsPerPage";
    } else{
         $getEventsForThisPage = "SELECT * FROM events ORDER BY happened_at DESC LIMIT $offset, $eventsPerPage";
    }

   
    $paginatedEvents = mysqli_query($db, $getEventsForThisPage);
    return array(
        "events" => $paginatedEvents,
        "currentPage" => $currentPage,
        "totalPages" => $totalPages,
        "offset" => $offset,
        "errors" => $errors,
    );
}
