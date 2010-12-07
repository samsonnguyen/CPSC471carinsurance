<?php
require 'db.php';
require 'config.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

//Content starts here
if(isLoggedIn()){ //User is logged in
	echo '<p><b>Welcome to the '.$sitename.' homepage.</b></p>'."\n";
	echo '<p>You are now logged in</p>'."\n";
	echo '<a href="logout.php">Logout</a>';
} else {  
	if ($_GET['action']=='invalid'){ //Attempted to use menu before logging in
		echo '<p><i><span style="color:red">Please log in before accessing menus.</span></i></p>'."\n";
	} else {
		echo '<p><b>Welcome to the '.$sitename.' homepage.</b></p>'."\n";
	}
	//Use if not logged in present login form
	include $includesfolder.'login.php';
}

//content ends here, display the footer
include $includesfolder.'footer.php';
?>
