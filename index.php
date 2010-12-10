<?php
require 'db.php';
require 'config.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';
include $classfolder.'premiumclass.php';

//Content starts here
//Content starts here
echo '<p>Welcome to the '.$sitename.' homepage</p>'."\n";

if(isLoggedIn()){ //User is logged in
	echo '<p>You are now logged in</p>'."\n";
	echo '<a href="logout.php">Logout</a>';
} else { //Use if not logged in present login form
	include $includesfolder.'login.php';
}

//content ends here, display the footer
include $includesfolder.'footer.php';
?>
