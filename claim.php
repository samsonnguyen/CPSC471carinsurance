<?php
require 'db.php';
require 'config.php';
require 'class/claimclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

//check if the user is logged in and has correct permissions
if (isLoggedIn() && (getUserPermissions()=='1')){
	$claiminstance = new Claim();//Create new vehicle instance
	if ($_GET['action']=='add'){
		//Add new claim
		if (isset($_GET['form'])){
			$newClaimInfo['Amount'] = $_POST['fm-amount'];
			$newClaimInfo['Date'] = $_POST['fm-year'].$_POST['fm-month'].$_POST['fm-day'];
			$newClaimInfo['Description'] = $_POST['fm-description'];
			$newClaimInfo['Status'] = $_POST['fm-status'];
			$newClaimInfo['Client_At_Fault'] = $_POST['fm-atfault'];
			$newThirdParty['Party_Name'] = $_POST['fm-tp-name'];
			$newThirdParty['Insurer_Name'] = $_POST['fm-tp-insurer'];
			$newThirdParty['Phone'] = $_POST['fm-tp-phone'];
			$newThirdParty['Address'] = $_POST['fm-tp-address'];
			$newThirdParty['Insurer_Rep'] = $_POST['fm-tp-rep'];
			$newThirdParty['Vehicle_Year'] = $_POST['fm-tp-year'];
			$newThirdParty['Vehicle_Make'] = $_POST['fm-tp-make'];
			$newThirdParty['Vehicle_Model'] = $_POST['fm-tp-model'];
			$newThirdParty['Party_License_No'] = $_POST['fm-tp-license'];
			$newClaims['Client_ID']=$_POST['fm-cl-clientid'];
			$newClaims['VIN']=$_POST['fm-cl-vin'];
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
			//display add claim form
			include $includesfolder.'addclaim.php';
		}
	} else if ($_GET['action']=='remove'){
		//remove claim
		$claimID = $_GET['claim'];
		//Check the claimID
		if ($claimID==null || $claimID==0){
			print "Error, Claim ID cannot be null";
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
				$newClientInfo['FName'] = $_POST['fm-firstname'];
				$newClientInfo['MName'] = $_POST['fm-middlename'];
				$newClientInfo['LName'] = $_POST['fm-lastname'];
				$newClientInfo['Address'] = $_POST['fm-addr'];
				$newClientInfo['City'] = $_POST['fm-city'];
				$newClientInfo['PostalCode'] = $_POST['fm-postalcode'];
				$newClientInfo['Province'] = $_POST['fm-province'];
				$newClientInfo['Phone'] = $_POST['fm-telephone'];
				$newClientInfo['Birthdate'] = $_POST['fm-birthdate'];
				$newClientInfo['License_No'] = $_POST['fm-license_no'];
				$newClientInfo['Gender'] = $_POST['fm-gender'];
				$newClientInfo['Age'] = getAge($_POST['fm-birthdate']);
				$newClientInfo['Company'] = $_POST['fm-company'];
				$newClientInfo['Policy_No'] = $_POST['fm-policy'];
				if ($claiminstance->updateClaim($claimID,$newClientInfo)){
					print "Client ".$claimID." successfully updated<br />\n";
					print "<a href=\"client.php?action=update&client=".$claimID."\">Return</a>\n";
				} else {
					print "Error occured, please check your input";
				}
			} else {
				//Display an update form and get information
				$clientinstance->printUpdateForm($clientid);
				$vehicles = $vehicleinstance->searchByClient($clientid);
				$vehicleinstance->display2DArray($vehicles, true);
				print "<br /><a href=\"vehicle.php?action=add&client=".$clientid."\">Add a new vehicle for this client</a><br />\n";
			}
		}
	} else if ($_GET['action']=='search'){
		//Search for clients
		if ($_GET['form']=='clientid'){
			//Search by clientid
			$result = $clientinstance->searchbyId($_POST['fm-clientID']);
			$clientinstance->display2DArray($result,true);
		} else if ($_GET['form']=='info'){
			//search by info
			unset($temp);
			$temp['FName'] = $_POST['fm-firstname'];
			$temp['LName'] = $_POST['fm-lastname'];
			$temp['License_No'] = $_POST['fm-license_no'];
			$temp['City'] = $_POST['fm-city'];
			$temp['Province'] = $_POST['fm-province'];
			$temp['Policy_No'] = $_POST['fm-policy'];
			$temp['Phone'] = $_POST['fm-phone'];
			
			//Check FName 
			if ($temp['FName']==null || $temp['FName']==""){
				unset($temp['FName']);
			} else {
				$temp['FName'] = convertToLike($temp['FName']);
			}
			//Check FName 
			if ($temp['Policy_No']==null || $temp['Policy_No']==""){
				unset($temp['Policy_No']);
			} else {
				$temp['Policy_No'] = convertToLike($temp['Policy_No']);
			}
			//Check LName
			if ($temp['LName']==null || $temp['LName']==""){
				unset($temp['LName']);
			} else {
				$temp['LName'] = convertToLike($temp['LName']);
			}
			//Check License_No
			if ($temp['License_No']==null || $temp['License_No']==""){
				unset($temp['License_No']);
			} else {
				$temp['License_No'] = convertToLike($temp['License_No']);
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
			$clients = $clientinstance->searchByInfo($temp);
			$clientinstance->display2DArray($clients, true);
		} else {
			//display search form
			include $includesfolder.'searchclient.php';
		}

	} else if (isset($_GET['addclient'])){

		//Add a new client, should be called only through a form
		$newClientInfo['FName'] = $_POST['fm-firstname'];
		$newClientInfo['MName'] = $_POST['fm-middlename'];
		$newClientInfo['LName'] = $_POST['fm-lastname'];
		$newClientInfo['Address'] = $_POST['fm-addr'];
		$newClientInfo['City'] = $_POST['fm-city'];
		$newClientInfo['PostalCode'] = $_POST['fm-postalcode'];
		$newClientInfo['Province'] = $_POST['fm-province'];
		$newClientInfo['Phone'] = $_POST['fm-telephone'];
		$newClientInfo['Birthdate'] = $_POST['fm-birthdate'];
		$newClientInfo['License_No'] = $_POST['fm-license_no'];
		$newClientInfo['Gender'] = $_POST['fm-gender'];
		$newClientInfo['Age'] = getAge($_POST['fm-birthdate']);
		$newClientInfo['Company'] = $_POST['fm-company'];
		$newClientInfo['Policy_No'] = $_POST['fm-policy'];
		$clientinstance->addNewClientByArray($newClientInfo);
		print "Client has been added<br />\n";
	} else {
		//Client home, display stats?
		include $includesfolder.'displayclientstats.php';
	}
} else {
	//user not logged in or has incorrect permissions
	print 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>
