<?php
require 'db.php';
require 'includes/functions.php';
require 'config.php';
include $includesfolder.'header.php';

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
