<?php
require 'db.php';
require 'config.php';
require $classfolder.'claimclass.php';
require $classfolder.'clientclass.php';
require $classfolder.'vehicleclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

//check if the user is logged in and has correct permissions
if (isLoggedIn() && (getUserPermissions()>='2')){
	$claiminstance = new Claim();//Create new vehicle instance
	if ($_GET['action']=='add'){
		//Add new claim
		if (isset($_GET['form'])){
			$newClaimInfo['Amount'] = $_POST['fm-amount'];
			$newClaimInfo['Date'] = $_POST['fm-year']."-".$_POST['fm-month']."-".$_POST['fm-day'];
			$newClaimInfo['Description'] = $_POST['fm-description'];
			$newClaimInfo['Status'] = $_POST['fm-status'];
			$newClaimInfo['Client_At_Fault'] = $_POST['fm-atfault'];
			$newThirdParty['Party_Name'] = $_POST['fm-tp-name'];
			$newThirdParty['Insurer_Name'] = $_POST['fm-tp-insurer'];
			$newThirdParty['Phone'] = preg_replace("/[-\(\)\s]/","",$_POST['fm-tp-phone']);
			$newThirdParty['Address'] = $_POST['fm-tp-address'];
			$newThirdParty['Insurer_Rep'] = $_POST['fm-tp-rep'];
			$newThirdParty['Vehicle_Year'] = $_POST['fm-tp-year'];
			$newThirdParty['Vehicle_Make'] = $_POST['fm-tp-make'];
			$newThirdParty['Vehicle_Model'] = $_POST['fm-tp-model'];
			$newThirdParty['Party_License_No'] = $_POST['fm-tp-license'];
			$newClaims['Client_ID']=$_POST['fm-cl-clientid'];
			$newClaims['VIN']=$_POST['fm-cl-vin'];
			if ($claiminstance->validateData($newClaimInfo, $newThirdParty, $newClaims)){
				$claimid=$claiminstance->addNewClaim($newClaimInfo);
				if ($claimid>0){
					print "Claim ".$claimid." added successfully!<br />\n";
					$newThirdParty['Claim_No'] = $claimid;
					$newClaims['Claim_No'] = $claimid;
					if ($claiminstance->addNewThirdParty($newThirdParty)){
						//Successfully added third party
						print "Third Party was created successfully!<br />\n";
					} else {
						//Error adding thirdparty
						print "Unable to add a new thirdparty";
					}
					if ($claiminstance->addNewClaims($newClaims)){
						//Successfully added a new Claims
						print "Claim was created successfully!<br />\n";
					} else {
						//Error adding thirdparty
						print "Unable to link Claim to the client and/or Vehicle VIN";
					}
				} else {
					print "Error occured";
				}
			} else {
				//Error validating
				$claiminstance->displayError();
				include $includesfolder.'addclaim.php';
			}
		} else {
			//display add claim form
			include $includesfolder.'addclaim.php';
		}
	} else if ($_GET['action']=='remove'){
		//remove claim
		$claimID = $_GET['claim'];
		//Check the claim_no
		if ($claimID==null || $claimID==0){
			print "Error, Claim Number cannot be null";
		} else {
			if ($claiminstance->deleteClaim($claimID)){
				print "Claim deleted successfully!";
			} else {
				print "Claim cannot be deleted";
			}
		}
	} else if ($_GET['action']=='update'){
		//We want to perform an update
		$claimID = $_GET['claim'];
		if ($claimID==null || $claimID==0){
			print "Error, Claim ID cannot be null or 0";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
				//$claimID = $_POST['fm-claimid'];
				$newClaimInfo['Amount'] = $_POST['fm-amount'];
				$newClaimInfo['Date'] = $_POST['fm-year']."-".$_POST['fm-month']."-".$_POST['fm-day'];
				$newClaimInfo['Description'] = $_POST['fm-description'];
				$newClaimInfo['Status'] = $_POST['fm-status'];
				$newClaimInfo['Client_At_Fault'] = $_POST['fm-atfault'];
				$newThirdParty['Party_Name'] = $_POST['fm-tp-name'];
				$newThirdParty['Insurer_Name'] = $_POST['fm-tp-insurer'];
				$newThirdParty['Phone'] = preg_replace("/[-\(\)\s]/","",$_POST['fm-tp-phone']);
				$newThirdParty['Address'] = $_POST['fm-tp-address'];
				$newThirdParty['Insurer_Rep'] = $_POST['fm-tp-rep'];
				$newThirdParty['Vehicle_Year'] = $_POST['fm-tp-year'];
				$newThirdParty['Vehicle_Make'] = $_POST['fm-tp-make'];
				$newThirdParty['Vehicle_Model'] = $_POST['fm-tp-model'];
				$newThirdParty['Party_License_No'] = $_POST['fm-tp-license'];
				$newClaims['Client_ID']=$_POST['fm-cl-clientid'];
				$newClaims['VIN']=$_POST['fm-cl-vin'];
				if ($claiminstance->validateData($newClaimInfo, $newThirdParty, $newClaims)){
					if ($claiminstance->updateAll($claimID,$newClaimInfo, $newThirdParty, $newClaims)){
						print "Claim ".$claimID." successfully updated<br />\n";
						print "<a href=\"claim.php?action=update&claim=".$claimID."\">Return</a>\n";
					} else {
						print "Error occured, please check your input";
					}
				} else {
					//Validation error
					$claiminstance->displayError();
					$claiminstance->printUpdateForm($claimID);
				}
			} else {
				//Display an update form and get information
				$claiminstance->printUpdateForm($claimID);
			}
		}
	} else if ($_GET['action']=='search'){
		//Search for clients
		if ($_GET['form']=='claimno'){
			//Search by clientid
			$result = $claiminstance->searchbyClaimNo($_POST['fm-claimid']);
			$claiminstance->display2DArray($result,true); //
		} else if ($_GET['form']=='thirdparty'){
			//search by third party info
			unset($temp);
			if ($_POST['fm-tp-name']!=null || $_POST['fm-tp-name']!="")
				$temp['Party_Name'] = $_POST['fm-tp-name'];
			if ($_POST['fm-tp-insurer']!=null || $_POST['fm-tp-insurer']!="")
				$temp['Insurer_Name'] = $_POST['fm-tp-insurer'];
			if ($_POST['fm-tp-model']!=null || $_POST['fm-tp-model']!="")
				$temp['Vehicle_Model'] = $_POST['fm-tp-model'];
			if ($_POST['fm-tp-license']!=null || $_POST['fm-tp-license']!="")
				$temp['Party_License_No'] = $_POST['fm-tp-license'];
			$keys = array_keys($temp);		
			for ($i=0;$i<count($keys);$i++){
				//find and convert all astericks into mysql like format
				$temp[$keys[$i]] = convertToLike($temp[$keys[$i]]); 
			}
			$claims = $claiminstance->searchByInfo($temp);
			$claiminstance->display2DArray($claims, true);
		} else if ($_GET['form']=='client'){
			//search by client info
			unset($temp);
			if ($_POST['fm-cl-clientid']!=null && $_POST['fm-cl-clientid']!="")
				$temp['Client_ID'] = $_POST['fm-cl-clientid'];
			else
				$temp['Client_ID'] = "X";
			if ($_POST['fm-cl-vin']!=null && $_POST['fm-cl-vin']!="")
				$temp['VIN'] = $_POST['fm-cl-vin'];
			else
				$temp['VIN'] = "X";
			$keys = array_keys($temp);		
			for ($i=0;$i<count($keys);$i++){
				//find and convert all astericks into mysql like format
				$temp[$keys[$i]] = convertToLike($temp[$keys[$i]]); 
			}
			$claims = $claiminstance->searchByInfo($temp);
			$claiminstance->display2DArray($claims, true);
		} else {
			//display search form
			include $includesfolder.'searchclaim.php';
		}
	} else {
		//Client home, display stats?
		include $includesfolder.'displayclaimstats.php';
	}
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>
