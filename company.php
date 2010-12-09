<?php
require 'db.php';
require 'config.php';
require $classfolder.'companyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()>='1')){
	if ($_GET['action']=='add'){
		include $includesfolder.'addcompany.php';
	} else if ($_GET['action']=='remove'){
		
	} else if ($_GET['action']=='update'){
		
	} else if ($_GET['action']=='search'){
		include $includesfolder.'searchcompany.php';
	} /* else if (isset($_GET['addclient'])){
		
	} */ else {
		//Client home, display stats?
		include $includesfolder.'displaypolicystats.php';
	}	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
