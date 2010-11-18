<?php
require 'db.php';
require 'includes/functions.php';
require 'config.php';

include $includesfolder.'header.php';
//Content here
echo '<p>Welcome to the '.$sitename.' homepage</p>'."\n";

if(isLoggedIn()){
	echo '<p>You are now logged in</p>'."\n";
	echo '<a href="logout.php">Logout</a>';
} else {
	include $includesfolder.'login.php';
}
include $includesfolder.'footer.php';
?>
