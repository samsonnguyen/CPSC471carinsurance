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
	} elseif ($_GET['action']=='remove'){
		//Get type and policy
		$type = $_GET['type'];
		$policyid = $_GET['policy'];	
				
		//Check the policyID
		if ($policyid == null || $policyid==0){
			print "Error, policy cannot be null. (".$policyid.")";
		} elseif($type == null) {
			print "Error, policy type is undefined";	
		} else {
			if($type == 1) { // Private
				if ($policyinstance->deletePrivatePolicy($policyid)){
					print "Private Policy deleted successfully!";
				} else {
					print "Private Policy cannot be deleted";
				}
			}
			elseif($type == 0) { // Public
				if ($policyinstance->deleteCompanyPolicy($policyid)){
					print "Company Policy deleted successfully!";
				} else {
					print "Company Policy cannot be deleted";
				}
			}
			else {
				print "Policy type is unknown.";
			}
		}
	} elseif ($_GET['action']=='update') {
		//Get type and policy
		$type = $_GET['type'];
		$policyid = $_GET['policy'];
		//We want to perform an update
		if ($policyid == null || $policyid==0){
			print "Error, policy cannot be null. (".$policyid.")";
		} elseif($type == null) {
			print "Error, policy type is undefined";	
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
				$newPolicyInfo['Premium_Rate'] = $_POST['fm-premium'];
				$newPolicyInfo['Coverage'] = $_POST['fm-coverage'];
				if($type == 0) // Company
					$newPolicyInfo['Num_of_Employees'] = $_POST['fm-numofemp'];
				if ($policyinstance->validateData($newPolicyInfo)){
					if ($policyinstance->updatePolicy($policyid,$newPolicyInfo,$type)){
						print "Policy ".$policyid." successfully updated<br />\n";
						print "<a href='policy.php?action=update&policy=".$policyid."&type=".$type."'>Return to Edit Page</a>\n";
					} else {
						print "Error occured, please check your input";
					}
				} else {
					//Display an update form and get information
					$policyinstance->displayError();
					$policyinstance->printUpdateForm($policyid,$type);
				}
			} else {
				//Display an update form and get information
				$policyinstance->printUpdateForm($policyid,$type);
			}	
		}
	} elseif ($_GET['action']=='search'){
		if($_GET['query'] != null) {
			// This means we have something to search for!
			// WARNING: This search is nasty!
			$searchType = $_POST['fm-type'];
			$policyid = $_POST['fm-policyid'];
			$policyrate['min'] = $_POST['fm-minrate'];
			$policyrate['max'] = $_POST['fm-maxrate'];
			$policycover['min'] = $_POST['fm-mincover'];
			$policycover['max'] = $_POST['fm-maxcover'];
			$policyemp['min'] = $_POST['fm-minnumofemp'];
			$policyemp['max'] = $_POST['fm-maxnumofemp'];
			
			if($searchType == 'p' || $searchType == 'b') {
				$privatepolicies = $policyinstance->searchPrivatePolicy($policyid, $policyrate, $policycover);
				$policyinstance->display2DArray($privatepolicies, 1);
			}
			if($searchType == 'c' || $searchType == 'b') {
				$companypolicies = $policyinstance->searchCompanyPolicy($policyid, $policyrate, $policycover, $policyemp);
				$policyinstance->display2DArray($companypolicies, 0);
			}
		} else {
			// Not searching for something?
			include $includesfolder.'searchpolicy.php';
		}
	} elseif (isset($_GET['addprivatepolicy'])){
		//Add a new private policy, should be called only through a form
		$newPolicyInfo['Premium_Rate'] = $_POST['fm-premium'];
		$newPolicyInfo['Coverage'] = $_POST['fm-coverage'];
		if ($policyinstance->validateData($newPolicyInfo)){
			$policyinstance->addNewPrivatePolicy($newPolicyInfo);
			print "Policy has been added<br />\n";
		} else {
			$policyinstance->displayError(); //display validation errors
			include $includesfolder.'addpolicy.php'; //redisplay form
		}
	} elseif (isset($_GET['addcompanypolicy'])){
		//Add a new company policy, should be called only through a form
		$newPolicyInfo['Premium_Rate'] = $_POST['fm-premiumc'];
		$newPolicyInfo['Coverage'] = $_POST['fm-coveragec'];
		$newPolicyInfo['Num_of_Employees'] = $_POST['fm-numofemp'];
		if ($policyinstance->validateData($newPolicyInfo)){
			$policyinstance->addNewCompanyPolicy($newPolicyInfo);
			print "Policy has been added<br />\n";
		} else {
			$policyinstance->displayError(); //display validation errors
			include $includesfolder.'addpolicy.php'; //redisplay form
		}
	} else {
		//Policy home, display stats?
		include $includesfolder.'displaypolicystats.php';
	}
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
