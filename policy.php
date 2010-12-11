<?php 
require 'db.php';
require 'config.php';
require $classfolder.'policyclass.php';
require $classfolder.'companyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()>='1')){
	$policyinstance = new Policy();
	if ($_GET['action']=='add'){
		include $includesfolder.'addpolicy.php';
	} else if ($_GET['action']=='remove'){
/*		//remove policy
		$policyid = $_GET['policy'];
		//Check the policyID
		if ($policyid==null || $policyid==0){
			print "Error, policy cannot be null";
		} else {
			// TODO change before testing
			if ($policyinstance->deleteClient($policyid)){
				print "Policy deleted successfully!";
			} else {
				print "Policy cannot be deleted";
			}
		}*/
	} else if ($_GET['action']=='update'){
		
	} else if ($_GET['action']=='search'){
		include $includesfolder.'searchpolicy.php';
	} else if (isset($_GET['addprivatepolicy'])){
		//Add a new private policy, should be called only through a form
		$newPolicyInfo['Premium_Rate'] = $_POST['fm-premium'];
		$newPolicyInfo['Coverage'] = $_POST['fm-coverage'];
		$policyinstance->addNewPrivatePolicy($newPolicyInfo);
		print "Policy has been added<br />\n";
	} else if (isset($_GET['addcompanypolicy'])){
		//Add a new company policy, should be called only through a form
		$newPolicyInfo['Premium_Rate'] = $_POST['fm-premiumc'];
		$newPolicyInfo['Coverage'] = $_POST['fm-coveragec'];
		$newPolicyInfo['#_of_Employees'] = $_POST['fm-numofemp'];
		$policyinstance->addNewCompanyPolicy($newPolicyInfo);
		print "Policy has been added<br />\n";
	} else {
		//Client home, display stats?
		include $includesfolder.'displaypolicystats.php';
	}
	
	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
