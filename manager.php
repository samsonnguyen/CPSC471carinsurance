<?php
require 'db.php';
require 'config.php';
require $classfolder.'managerclass.php';
require $classfolder.'premiumclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';
//test change
if (isLoggedIn() && (getUserPermissions()>='2')){
		$managerinstance = new Manager();	//create new manager instance
		$premiuminstance = new premiumClass();

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


		} else if($_GET['action']=='setbase'){
		if(isset($_GET['form'])){
		$premiuminstance->setBasePrice($_POST['fm-newbase']);
		print 'New base price is '.$premiuminstance->getBasePrice().".";
		}else { 
		print 'CURRENT BASE PRICE IS '.$premiuminstance->getBasePrice().".";
		$managerinstance->PrintBasePriceForm($premiuminstance->getBasePrice());	
		}
	

	}else if ($_GET['action']=='remove'){
		//Remove the employee
		$emp_id=$_GET['id'];
		if ($emp_id==null){
			print "Error, employee cannot be null";
		} else {
			if ($managerinstance->deleteEmployee($emp_id)){
				print "Employee ".$emp_id." removed successfully!";
				
			} else {
				print "ERROR: Employee ".$emp_id." could not be removed!";	
			}
 		}
	} else if ($_GET['action']=='update'){
		//Update employee
		$emp_id= $_GET['id'];
		if ($emp_id==null){
			print "Error, employee cannot be null";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
					$newEmpInfo['Username'] = $_POST['fm-username'];	
					$newEmpInfo['Password'] = $_POST['fm-password'];
					$newEmpInfo['Permissions'] = $_POST['fm-permissions'];	

				if ($managerinstance->updateEmployee($emp_id,$newEmpInfo)){
					print "Employee ".$emp_id." successfully updated<br />\n";
					print "<a href=\"manager.php?action=update&ticket=".$emp_id."\">Return</a>\n";
				} else {
					print "Error occured, please check your input";
				}
			} else {
				//We cant to display an update form and get information
				$managerinstance->printUpdateForm($emp_id);
			}
		}
	} else if ($_GET['action']=='search'){
		if ($_GET['form']=='id'){
			//Search by client
			$employees = $managerinstance->searchByID($_POST['fm-employee_id']);
			$managerinstance->display2DArray($employees, true);
		} else if ($_GET['form']=='username'){
			//Search by username
			$employees = $managerinstance->searchByUsername($_POST['fm-username']);
			$managerinstance->display2DArray($employees, true);
		} else if ($_GET['form']=='permissions'){
			//Search by permission level (2 = manager)
			$employees = $managerinstance->searchByPermissions($_POST['fm-permissions']);
			$managerinstance->display2DArray($employees, true);
		} else {
			//No form data, we display a form
			include $includesfolder."searchemployee.php";
		} 
	}else {
		//Manager home, display Employees stats
		include $includesfolder.'displayemployeestats.php';
		
}


} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}
include $includesfolder.'footer.php';
?>
