<?php
require 'db.php';
require 'config.php';
require 'class/ticketclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';


	if (isLoggedIn() && (getUserPermissions()=='1')){
		if($_GET['action']=='add'){
			echo 'add ticket';

		}else if($_GET['action']=='search'){
			echo 'search ticket';
		}else { 
			echo 'tickets';
		}
}
?>
