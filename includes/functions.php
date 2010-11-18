<?php
/*
 * Check if the use is logged in using session data
 */
function isLoggedIn(){
	if(isset($_SESSION['user'])){
		return true;
	} else{
		return false;
	}
}