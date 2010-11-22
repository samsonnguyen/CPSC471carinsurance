<?php
require 'db.php';
require 'includes/functions.php';
require 'config.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='1')){
	if ($_GET['action']=='add'){
		//Add vehicle
		echo 'add vehicle';
	} else if ($_GET['action']=='remove'){
		//remove vehicle
		echo 'remove vehicle';
	} else if ($_GET['action']=='update'){
		//update vehicle
		echo 'update vehicle';
	} else {
		//Vehicle home, display stats?
		if (isset($_GET['update'])){
			//perform database update operations using POST
		}
		echo 'Vehicle home';
	}
} else {
	echo 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>