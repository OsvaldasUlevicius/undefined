<?php
$range = 3;
if (isset($projectsInformation)) {
   $currentPage = $projectsInformation["currentPage"];
   $totalPages = $projectsInformation["totalPages"];
} else {
   $currentPage = $events["currentPage"];
   $totalPages = $events["totalPages"];
}


// if not on page 1, don't show back links
if ($currentPage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentPage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentPage - $range); $x < (($currentPage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalPages)) {
      // if we're on current page...
      if ($x == $currentPage) {
         // 'highlight' it but don't make a link
         echo " <b>$x</b> ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for

// if not on last page, show forward and last page links        
if ($currentPage != $totalPages) {
   // get next page
   $nextpage = $currentPage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$totalPages'>>></a> ";
} // end if
/****** end build pagination links ******/
?>
