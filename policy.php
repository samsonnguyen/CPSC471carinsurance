<?php 
require 'db.php';
require 'config.php';
require $classfolder.'policyclass.php';
require $classfolder.'companyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='1')){
	$policyinstance = new Policy();
	if ($_GET['action']=='add'){
		
	} else if ($_GET['action']=='remove'){
		
	} else if ($_GET['action']=='update'){
		
	} else if ($_GET['action']=='search'){
		
	} /* else if (isset($_GET['addclient'])){
		
	} */ else {
		//Client home, display stats?
//		include $includesfolder.'displayclientstats.php';
	}
	
	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>