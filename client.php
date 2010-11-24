<?php
require 'db.php';
require 'includes/functions.php';
require 'config.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='1')){
	if ($_GET['action']=='add'){
		//Add client
		include 'addclient.php';
	} else if ($_GET['action']=='remove'){
		//remove client
		echo 'remove client';
	} else if ($_GET['action']=='update'){
		//update client
		echo 'update client';
	} else {
		//Client home, display stats?
		echo 'client home';
	}
} else {
	echo 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>