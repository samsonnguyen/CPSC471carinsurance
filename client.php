<?php
require 'db.php';
require 'config.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';


if (isLoggedIn() && (getUserPermissions()=='1')){
	if ($_GET['action']=='add'){
		//display add client form
		include $includesfolder.'addclient.php';
	} else if ($_GET['action']=='remove'){
		//remove client
		echo 'remove client';
	} else if ($_GET['action']=='update'){
		//update client
		echo 'update client';
	} else {
		//Client home, display stats?
		include $includesfolder.'displayclientstats.php';
		echo 'client home';
	}
} else {
	echo 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>