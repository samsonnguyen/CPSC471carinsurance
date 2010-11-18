<?php
/*
 * Check if the use is logged in using session data
 */
function isLoggedIn(){
	if(isset($_SESSION['user'])){
		return true; //User logged int
	} else{
		return false; //User not logged in
	}
}


?>