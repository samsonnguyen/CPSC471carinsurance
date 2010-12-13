<?php
require 'db.php';
require 'config.php';
require $classfolder.'companyclass.php';
require $classfolder.'policyclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()>='1')){
	$companyinstance = new Company();
//	$policyinstance = new Policy();
	if ($_GET['action']=='add'){
		include $includesfolder.'addcompany.php';
	} elseif ($_GET['action']=='remove') {
		// TODO Incomplete
	} elseif ($_GET['action']=='update') {
		// TODO Incomplete
	} elseif ($_GET['action']=='search'){
		if($_GET['query'] != null) {
			// TODO Incomplete
		} else {
			// Not searching for something?
			include $includesfolder.'searchcompany.php';
		}
	} elseif (isset($_GET['addcompany'])){
		$newCompanyInfo['Commercial_License_No'] = $_POST['fm-comlicno'];
		$newCompanyInfo['Name'] = $_POST['fm-name'];
		$newCompanyInfo['Address'] = $_POST['fm-addr'];
		$newCompanyInfo['City'] = $_POST['fm-city'];
		$newCompanyInfo['PostalCode'] = preg_replace("/[\s]/", "", $_POST['fm-postalcode']); //Strip spaces
		$newCompanyInfo['Province'] = $_POST['fm-province'];
		$newCompanyInfo['Phone'] = preg_replace("/[-\(\)\s]/","",$_POST['fm-telephone']); //Strip unwanted characters
		$newCompanyInfo['Manager'] = $_POST['fm-manager'];
		$newCompanyInfo['Policy_No'] = $_POST['fm-policy'];
		$companyinstance->addNewCompany($newCompanyInfo);
		print "Company has been added<br />\n";
	} else{
		//Company home, display stats?
		// TODO Semi-Complete
		include $includesfolder.'displaycompanystats.php';
	}	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
