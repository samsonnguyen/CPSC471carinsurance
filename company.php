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
		$companyno = $_GET['company'];
		
		//Check the company no
		if ($companyno == null || $companyno==0){
			print "Error, company cannot be null. (".$companyno.")";
		} else {
			if ($companyinstance->deleteCompany($companyno)){
				print "Company deleted successfully!";
			} else {
				print "Company cannot be deleted";
			}
		}
	} elseif ($_GET['action']=='update') {
		$companyno = $_GET['company'];
		
		//Check the company no
		if ($companyno == null || $companyno==0){
			print "Error, company cannot be null. (".$companyno.")";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
				$newCompanyInfo['Commercial_License_No'] = $_POST['fm-comlicno'];
				$newCompanyInfo['CName'] = $_POST['fm-name'];
				$newCompanyInfo['Address'] = $_POST['fm-addr'];
				$newCompanyInfo['City'] = $_POST['fm-city'];
				$newCompanyInfo['PostalCode'] = preg_replace("/[\s]/", "", $_POST['fm-postalcode']); //Strip spaces
				$newCompanyInfo['Province'] = $_POST['fm-province'];
				$newCompanyInfo['Phone'] = preg_replace("/[-\(\)\s]/","",$_POST['fm-telephone']); //Strip unwanted characters
				$newCompanyInfo['Manager'] = $_POST['fm-manager'];
				$newCompanyInfo['Policy_No'] = $_POST['fm-policy'];
				if ($companyinstance->updateCompany($companyno,$newCompanyInfo)){
					print "Company ".$companyno." successfully updated<br />\n";
					print "<a href='company.php?action=update&company=".$companyno."'>Return to Edit Page</a>\n";
				} else {
					print "Error occured, please check your input";
				}
			} else {
				//Display an update form and get information
				$companyinstance->printUpdateForm($companyno);
//				$vehicles = $vehicleinstance->searchByClient($clientid);
//				$vehicleinstance->display2DArray($vehicles, true);
//				print "<br /><a href=\"vehicle.php?action=add&client=".$clientid."\">Add a new vehicle for this client</a><br />\n";
//				$tickets = $ticketinstance->searchByClient($clientid);
//				$ticketinstance->display2DArray($tickets, true);
//				print "<br /><a href=\"tickets.php?action=add&client=".$clientid."\">Add a ticket for this client</a><br />\n";
			}	
		}
	} elseif ($_GET['action']=='search'){
		if ($_GET['form']=='comlicno'){
			$result = $companyinstance->searchCompanies($_POST['fm-comlicno'],null,null);
			$companyinstance->display2DArray($result,true);
		} elseif ($_GET['form']=='policy') {
			$result = $companyinstance->searchCompanies(null,$_POST['fm-policy'],null);
			$companyinstance->display2DArray($result,true);			
		} elseif ($_GET['form']=='info') {
			unset($temp);
			$temp['CName'] = $_POST['fm-name'];
			$temp['Manager'] = $_POST['fm-manager'];
			$temp['City'] = $_POST['fm-city'];
			$temp['Province'] = $_POST['fm-province'];
			$temp['Phone'] = $_POST['fm-phone'];
				
			//Check Name
			if ($temp['CName']==null || $temp['CName']==""){
				unset($temp['CName']);
			} else {
				$temp['CName'] = convertToLike($temp['CName']);
			}
			//Check Manager
			if ($temp['Manager']==null || $temp['Manager']==""){
				unset($temp['Manager']);
			} else {
				$temp['Manager'] = convertToLike($temp['Manager']);
			}
			//Check City
			if ($temp['City']==null || $temp['City']==""){
				unset($temp['City']);
			} else {
				$temp['City'] = convertToLike($temp['City']);
			}
			//Check Phone
			if ($temp['Phone']==null || $temp['Phone']==""){
				unset($temp['Phone']);
			} else {
				$temp['Phone'] = convertToLike($temp['Phone']);
			}
			if ($temp['Province']==""){
				unset($temp['Province']);
			}
			$result = $companyinstance->searchCompanies(null,null,$temp);
			$companyinstance->display2DArray($result,true);				
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
		include $includesfolder.'displaycompanystats.php';
	}	
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

include $includesfolder.'footer.php';
?>
