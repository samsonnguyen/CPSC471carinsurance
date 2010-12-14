<?php
require 'db.php';
require 'config.php';
require $classfolder.'clientclass.php';
require $classfolder.'vehicleclass.php';
require $classfolder.'ticketclass.php';
require $classfolder.'policyclass.php';
require $classfolder.'companyclass.php';
require $classfolder.'claimclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

//check if the user is logged in and has correct permissions
if (isLoggedIn() && (getUserPermissions()>='1')){
	$clientinstance = new Client(); //Create new client instance
	$vehicleinstance = new Vehicle();//Create new vehicle instance
	$ticketinstance = new Ticket();//Create new ticket instance
	$policyinstance = new Policy();//Create new policy instance
	$companyinstance = new company(); // Create new company instance
	$claiminstance = new Claim(); // Create new claim instance
	if ($_GET['action']=='add'){
		//display add client form
		include $includesfolder.'addclient.php';
	} else if ($_GET['action']=='remove'){
		//remove client
		$clientid = $_GET['client'];
		//Check the clientID
		if ($clientid==null || $clientid==0){
			print "Error, client cannot be null";
		} else {
			if ($clientinstance->deleteClient($clientid)){
				print "Client deleted successfully!";
			} else {
				print "Client cannot be deleted";
			}
		}
	} else if ($_GET['action']=='update'){
		//We want to perform an update
		$clientid = $_GET['client'];
		if ($clientid==null || $clientid==0){
			print "Error, client cannot be null";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
				$newClientInfo['FName'] = $_POST['fm-firstname'];
				$newClientInfo['MName'] = $_POST['fm-middlename'];
				$newClientInfo['LName'] = $_POST['fm-lastname'];
				$newClientInfo['Address'] = $_POST['fm-addr'];
				$newClientInfo['City'] = $_POST['fm-city'];
				$newClientInfo['PostalCode'] = preg_replace("/[\s]/", "", $_POST['fm-postalcode']); //Strip spaces
				$newClientInfo['Province'] = $_POST['fm-province'];
				$newClientInfo['Phone'] = preg_replace("/[-\(\)\s]/","",$_POST['fm-telephone']); //Strip unwanted characters
			//	print $newClientInfo['Phone'];
				$newClientInfo['Birthdate'] = $_POST['fm-birthdate'];
				$newClientInfo['License_No'] = $_POST['fm-license_no'];
				$newClientInfo['Gender'] = $_POST['fm-gender'];
				$newClientInfo['Age'] = getAge($_POST['fm-birthdate']);
				$temppolicy = $_POST['fm-policy'];
				$tempcompany =  $_POST['fm-company'];
				if( $temppolicy == "X") { // No policy therefore assume company policy
					if($tempcompany != "X") { // If company exists (i.e. not blank)
						$result = $companyinstance->searchCompanies($tempcompany, null, null);
						$info = mysql_fetch_array($result);
						$newClientInfo['Policy_No'] = $info['Policy_No'];
						$newClientInfo['Company'] = $info['Commercial_License_No'];
					} else { // Otherwise error
						print "Error, must have a policy";
						return;
					}
				} else { // Policy is set therefore not part of a company plan
					$newClientInfo['Policy_No'] = $temppolicy;
					$newClientInfo['Company'] = null;
				}						
				$newClientInfo['Years_Exp'] = $_POST['fm-yearsexp'];
				$newClientInfo['Training'] = $_POST['fm-training'];
				if ($clientinstance->validateData($newClientInfo)){//ERROR CHECK
					if ($clientinstance->updateClient($clientid,$newClientInfo)){
						print "Client ".$clientid." successfully updated<br />\n";
						print "<a href=\"client.php?action=update&client=".$clientid."\">Return</a>\n";
					} else{
						print "An error occured while updating, please check your inputs";
					}
				} else {
					//Error validating the input
					$clientinstance->displayError();
					$clientinstance->printUpdateForm($clientid);
					$vehicles = $vehicleinstance->searchByClient($clientid);
					$vehicleinstance->display2DArray($vehicles, true);
					print "<br /><a href=\"vehicle.php?action=add&client=".$clientid."\">Add a new vehicle for this client</a><br />\n";
					$tickets = $ticketinstance->searchByClient($clientid);
					$ticketinstance->display2DArray($tickets, true);
					print "<br /><a href=\"tickets.php?action=add&client=".$clientid."\">Add a ticket for this client</a><br />\n";
				}
			} else {
				//Display an update form and get information
				$clientinstance->printUpdateForm($clientid);
				$vehicles = $vehicleinstance->searchByClient($clientid);
				$vehicleinstance->display2DArray($vehicles, true);
				print "<br /><a href=\"vehicle.php?action=add&client=".$clientid."\">Add a new vehicle for this client</a><br />\n";
				$tickets = $ticketinstance->searchByClient($clientid);
				$ticketinstance->display2DArray($tickets, true);
				print "<br /><a href=\"tickets.php?action=add&client=".$clientid."\">Add a ticket for this client</a><br />\n";
				
				$temp['Client_ID'] = $clientid;
				$claims = $claiminstance->searchByInfo($temp);
				$claiminstance->display2DArray($claims, true);
				print "<br /><a href=\"claim.php?action=add&clientid=".$clientid."\">Add a claim for this client</a><br />\n";
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
		} else if ($_GET['form']=='policy'){
			unset($temp);//Make sure temp is clear
			$temp['Policy_No'] = convertToLike($_POST['fm-policyp']);
			$temp['Company'] = convertToLike($_POST['fm-policyc']);
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
		$newClientInfo['PostalCode'] = preg_replace("/[\s]/", "", $_POST['fm-postalcode']); //Strip spaces
		$newClientInfo['Province'] = $_POST['fm-province'];
		$newClientInfo['Phone'] = preg_replace("/[-\(\)\s]/","",$_POST['fm-telephone']); //Strip unwanted characters
		$newClientInfo['Birthdate'] = $_POST['fm-birthdate'];
		$newClientInfo['License_No'] = $_POST['fm-license_no'];
		$newClientInfo['Gender'] = $_POST['fm-gender'];
		$newClientInfo['Age'] = getAge($_POST['fm-birthdate']);
		$temppolicy = $_POST['fm-policy'];
		$tempcompany =  $_POST['fm-company'];
		if( $temppolicy == "X") { // No policy therefore assume company policy
			if($tempcompany != "X") { // If company exists (i.e. not blank)
				$result = $companyinstance->searchCompanies($tempcompany, null, null);
				$info = mysql_fetch_array($result);
				$newClientInfo['Policy_No'] = $info['Policy_No'];
				$newClientInfo['Company'] = $info['Commercial_License_No'];
			} else { // Otherwise error
				print "Error, must have a policy";
				return;
			}
		} else { // Policy is set therefore not part of a company plan
			$newClientInfo['Policy_No'] = $temppolicy;
			$newClientInfo['Company'] = null;
		}						
		$newClientInfo['Years_Exp'] = $_POST['fm-yearsexp'];
		$newClientInfo['Training'] = $_POST['fm-training'];
		if ($clientinstance->validateData($newClientInfo)){//ERROR CHECK
			$clientinstance->addNewClientByArray($newClientInfo);
			print "Client has been added<br />\n";
		} else {
			$clientinstance->displayError();
			include $includesfolder.'addclient.php'; //redisplay the form
		}
	} else {
		//Client home, display stats?
		include $includesfolder.'displayclientstats.php';
	}
} else {
	//user not logged in or has incorrect permissions
	printAccessDeniedMsg();
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>
