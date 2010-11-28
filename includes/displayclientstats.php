<?php
//Construct client class
$clientinstance = new Client();

//Checks if pagenum is set, if not set page to 1
if (!(isset($pagenum))) { 
	$pagenum = 1; 
} 

//Count number of clients
$rows = $clientinstance->totalClients();
//This is the number of results displayed per page 
$page_rows = 10; 

//Calculate last page
$last = ceil($rows/$page_rows); 

 
//make sure the page number isn't below one, or more than our maximum pages 
if ($pagenum < 1){
	$pagenum = 1;
} elseif ($pagenum > $last){ 
	$pagenum = $last; 
} 

//This sets the range to display in our query 
$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows; 


//Display the table of clients
$clientinstance->listClients($max);


 
// This shows the user what page they are on, and the total number of pages
echo " --Page $pagenum of $last-- <p>";

 
// First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page.

if ($pagenum == 1){
} else {
	echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";
	echo " ";
 	$previous = $pagenum-1;
 	echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";
} 
//This does the same as above, only checking if we are on the last page, and then generating the Next and Last links

if ($pagenum == $last){
} else {
	$next = $pagenum+1;
	echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";
	echo " ";
	echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> ";
} 

?>