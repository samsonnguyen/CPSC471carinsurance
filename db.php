<?php
/*
 * Database Constants, define the database here
 */
$db_host = "dbs4.cpsc.ucalgary.ca";
$db_username = "snguye";
$db_pass = "306100";
$db_database_name = "snguye";


/*
 * Connect to the database
 */
mysql_connect($db_host, $db_username, $db_pass) or die(mysql_error());
mysql_select_db($db_database_name) or die(mysql_error());


/*
 * Start session
 */
session_start();//Start php session
?>
