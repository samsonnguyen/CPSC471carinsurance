<?php
require 'db.php';
require 'config.php';
require $classfolder.'managerclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='2')){
		  $managerinstance = new Manager();	//create new manager instance
	
if ($_GET['action']=='add'){
	if (isset($_GET['form'])){
	$newEmpInfo['Username'] = $_POST['fm-username'];	
	$newEmpInfo['Password'] = $_POST['fm-password'];
	$newEmpInfo['Permissions'] = $_POST['fm-permissions'];	
	if ($managerinstance->addNewEmployee($newEmpInfo)>0){
				print "Employee ".$_POST['fm-username']." added successfully!\n";
			} else {
				print "Error occured";
			}
	}else{
	include $includesfolder.'addemployee.php';}

	} else if ($_GET['action']=='remove'){
		
	} else if ($_GET['action']=='update'){
		
	} else if ($_GET['action']=='search'){
		
	} /* else if (isset($_GET['addclient'])){
		
	} */ else {
		//Manager home, display Employees stats
		include $includesfolder.'displayemployeestats.php';
	}


} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}
include $includesfolder.'footer.php';
?>
