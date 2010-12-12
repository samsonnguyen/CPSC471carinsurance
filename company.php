<?php
require 'db.php';
require 'config.php';
require $classfolder.'companyclass.php';
require $classfolder.'policyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()>='1')){
	$companyinstance = new Company();
	$policyinstance = new Policy();
	if ($_GET['action']=='add'){
		include $includesfolder.'addcompany.php';
	} else{
		//Company home, display stats?
		// TODO FIX!
//		include $includesfolder.'displaypolicystats.php';
	}	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
