<?php
require 'db.php';
require 'config.php';
require 'class/companyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='1')){
	
	
} else {
	//user not logged in or has incorrect permissions
	print 'Access Denied';
}

include $includesfolder.'footer.php';
?>
