<?php
require 'db.php';
require 'config.php';
require $classfolder.'companyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()>='1')){
	
	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
