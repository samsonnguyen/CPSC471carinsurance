<?php
require 'db.php';
require 'functions.php';

include 'header.php';
//Content here
echo '<p>Welcome to the '.$sitename.' homepage</p>'."\n";

if(isLoggedIn()){
	echo '<p>You are now logged in</p>'."\n";
	echo '<a href="logout.php">Logout</a>';
} else {
	echo 'you are not logged in'."\n";
	include 'login.php';
}
include 'footer.php';
?>
