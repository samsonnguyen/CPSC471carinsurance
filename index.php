<?php
require 'db.php';
require 'includes/functions.php';
require 'config.php';
include $includesfolder.'header.php';

//Content starts here
echo '<p>Welcome to the '.$sitename.' homepage.</p>'."\n";

if(isLoggedIn()){ //User is logged in
	echo '<p>You are now logged in</p>'."\n";
	echo '<a href="logout.php">Logout</a>';
} else {  
	if ($_GET['action']=='invalid'){ //Attempted to use menu before logging in
		echo '<p><span style="color:red">Please log in before accessing menus.</span></p>'."\n";
	}
	//Use if not logged in present login form
	include $includesfolder.'login.php';
}

//content ends here, display the footer
include $includesfolder.'footer.php';
?>
