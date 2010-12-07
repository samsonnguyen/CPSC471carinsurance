<?php
require 'db.php';
require 'config.php';
require $classfolder.'companyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='1')){
	
	
} else {
	//user not logged in or has incorrect permissions
	echo '<p><i><span style="color:red">Access Denied</span></i></p>'."\n";
}

include $includesfolder.'footer.php';
?>
