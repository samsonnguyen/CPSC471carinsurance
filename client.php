<?php
require 'db.php';
require 'config.php';
require 'class/clientclass.php';
require 'class/vehicleclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';


if (isLoggedIn() && (getUserPermissions()=='1')){
	$clientinstance = new Client(); //Create new client instance
	$vehicleinstance = new Vehicle();//Create new vehicle instance
	if ($_GET['action']=='add'){
		//display add client form
		include $includesfolder.'addclient.php';
	} else if ($_GET['action']=='remove'){
		//remove client
		$clientid = $_GET['client'];
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
				$newClientInfo['PostalCode'] = $_POST['fm-postalcode'];
				$newClientInfo['Province'] = $_POST['fm-province'];
				$newClientInfo['Phone'] = $_POST['fm-telephone'];
				$newClientInfo['Birthdate'] = $_POST['fm-birthdate'];
				$newClientInfo['License_No'] = $_POST['fm-license_no'];
				$newClientInfo['Gender'] = $_POST['fm-gender'];
				$newClientInfo['Age'] = getAge($_POST['fm-birthdate']);
				$newClientInfo['Company'] = $_POST['fm-company'];
				$newClientInfo['Policy_No'] = $_POST['fm-policy'];
				if ($clientinstance->updateClient($clientid,$newClientInfo)){
					print "Client ".$clientid." successfully updated<br />\n";
					print "<a href=\"client.php?action=update&client=".$clientid."\">Return</a>\n";
				} else {
					print "Error occured, please check your input";
				}
			} else {
				//We cant to display an update form and get information
				$clientinstance->printUpdateForm($clientid);
				$vehicles = $vehicleinstance->searchVehicleByClient($clientid);
				$vehicleinstance->display2DArray($vehicles, true);
				print "<br /><a href=\"vehicle.php?action=add&client=".$clientid."\">Add a new vehicle for this client</a><br />\n";
			}
		}
	} else if ($_GET['action']=='search'){
		//initiates form for searching
		include $includesfolder.'searchclient.php';
	} else if (isset($_GET['searchid'])){
		//the search by id function option
		$result = $clientinstance->searchbyId($_POST['fm-clientID']);
		$clientinstance->display2DArray($result,true);
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
	print 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>