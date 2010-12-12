<?php
require 'db.php';
require 'config.php';
require $classfolder.'companyclass.php';
require $classfolder.'policyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()>='1')){
	$companyinstance = new Company();
//	$policyinstance = new Policy();
	if ($_GET['action']=='add'){
		include $includesfolder.'addcompany.php';
	} elseif ($_GET['action']=='remove') {
		// TODO Incomplete
	} elseif ($_GET['action']=='update') {
		// TODO Incomplete
	} elseif ($_GET['action']=='search'){
		if($_GET['query'] != null) {
			// TODO Incomplete
		} else {
			// Not searching for something?
			include $includesfolder.'searchcompany.php';
		}
	} elseif (isset($_GET['addcompany'])){
		// TODO Incomplete
	} else{
		//Company home, display stats?
		// TODO Incomplete
		include $includesfolder.'displaypolicystats.php';
	}	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
