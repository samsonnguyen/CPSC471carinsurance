<?php
require 'db.php';
require 'config.php';
require $classfolder.'vehicleclass.php';
require $classfolder.'claimclass.php';
require $classfolder.'clientclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

//Check if the user and logged in and has permissions
if (isLoggedIn() && (getUserPermissions()>='1')){
	$vehicleinstance = new Vehicle();//Create new vehicle instance
	$claiminstance = new Claim();
	if ($_GET['action']=='add'){
		//Add vehicle
		if (isset($_GET['form'])){
			//Add data returned by the form
			$newVehicleInfo['VIN'] = $_POST['fm-vin'];
			$newVehicleInfo['Year'] = $_POST['fm-year'];
			$newVehicleInfo['Make'] = $_POST['fm-make'];
			$newVehicleInfo['Model'] = $_POST['fm-model'];
			$newVehicleInfo['Trim'] = $_POST['fm-trim'];
			$newVehicleInfo['Color'] = $_POST['fm-color'];
			$newVehicleInfo['Value'] = $_POST['fm-value'];
			$newVehicleInfo['License_Plate_No'] = $_POST['fm-licenseplate'];
			$newVehicleInfo['Ave_Daily_Miles'] = $_POST['fm-mileage'];
			$newVehicleInfo['Displacement'] = $_POST['fm-displacement'];
			$newVehicleInfo['Client_ID'] = $_POST['fm-clientid'];
			$newVehicleInfo['Type'] = $_POST['fm-type'];
			$newVehicleInfo['Commercial'] = $_POST['fm-commercial'];
			if ($vehicleinstance->validateData($newVehicleInfo)){//ERROR CHECK
				if ($vehicleinstance->addNewVehicle($newVehicleInfo)){
					print "Vehicle ".$_POST['fm-vin']." added successfully!\n";
				} else {
					print "Error occured";
				}
			} else {
				//Validation failed
				$vehicleinstance->displayError();
				include $includesfolder.'addvehicle.php'; //redisplay the form
			}
		} else {
			//Display add form
			include $includesfolder.'addvehicle.php'; //display add form
		}
	} else if ($_GET['action']=='remove'){
		//Remove the vehicle
		$vehicleVIN=$_GET['vehicle'];
		if ($vehicleVIN==null){
			print "Error, vehicle cannot be null";
		} else {
			if ($vehicleinstance->deleteVehicle($vehicleVIN)){
				print "Vehicle ".$vehicleVIN." removed successfully!";
			} else {
				print "ERROR: Vehicle ".$vehicleVIN." could not be removed!";
			}
		}
	} else if ($_GET['action']=='update'){
		//Update vehicle
		$vehicleVIN= $_GET['vehicle'];
		if ($vehicleVIN==null){
			print "Error, vehicle cannot be null";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
				$newVehicleInfo['VIN'] = $vehicleVIN; //ADD vin for validation check only
				$newVehicleInfo['Year'] = $_POST['fm-year'];
				$newVehicleInfo['Make'] = $_POST['fm-make'];
				$newVehicleInfo['Model'] = $_POST['fm-model'];
				$newVehicleInfo['Trim'] = $_POST['fm-trim'];
				$newVehicleInfo['Color'] = $_POST['fm-color'];
				$newVehicleInfo['Value'] = $_POST['fm-value'];
				$newVehicleInfo['License_Plate_No'] = $_POST['fm-licenseplate'];
				$newVehicleInfo['Ave_Daily_Miles'] = $_POST['fm-mileage'];
				$newVehicleInfo['Displacement'] = $_POST['fm-displacement'];
				$newVehicleInfo['Client_ID'] = $_POST['fm-clientid'];
				$newVehicleInfo['Type'] = $_POST['fm-type'];
				$newVehicleInfo['Commercial'] = $_POST['fm-commercial'];
				if ($vehicleinstance->validateData($newVehicleInfo)){
					if ($vehicleinstance->updateVehicle($vehicleVIN,$newVehicleInfo)){
						unset($newVehicleInfo['VIN']);//not needed in the sql
						print "Vehicle ".$vehicleVIN." successfully updated<br />\n";
						print "<a href=\"vehicle.php?action=update&vehicle=".$vehicleVIN."\">Return</a>\n";
					} else {
						print "Error occured while updating, please check your input";
					}
				} else {
					//Redisplay the update form with errors
					$vehicleinstance->displayError();
					$vehicleinstance->printUpdateForm($vehicleVIN);
				}
			} else {
				//We want to display an update form and get information
				$vehicleinstance->printUpdateForm($vehicleVIN);
				$temp['VIN'] = $vehicleVIN;
				$claims = $claiminstance->searchByInfo($temp);
				$claiminstance->display2DArray($claims, true);
				print "<br /><a href=\"claim.php?action=add&vehicle=".$vehicleVIN."&clientid=";
				print $vehicleinstance->getVehicleOwner($vehicleVIN)."\">Add a claim for this client</a><br />\n";
			}
		}
	} else if ($_GET['action']=='search'){
		if ($_GET['form']=='client'){
			//Search by client
			$vehicles = $vehicleinstance->searchByClient($_POST['fm-clientID']);
			$vehicleinstance->display2DArray($vehicles, true);
		} else if ($_GET['form']=='vin'){
			//Search by vin
			$vehicles = $vehicleinstance->searchByVIN(convertToLike($_POST['fm-vin']));
			$vehicleinstance->display2DArray($vehicles, true);
		} else if ($_GET['form']=='info'){
			//search by information
			$temp['Year'] = $_POST['fm-year'];
			$temp['Make'] = $_POST['fm-make'];
			$temp['Model'] = $_POST['fm-model'];
			//Check year
			if (strlen($temp['Year']) != 4){
				unset($temp['Year']);
			} else {
				$temp['Year'] = convertToLike($temp['Year']);
			}
			//check make
			if (strlen($temp['Make']) < 1){ //empty
				unset($temp['Make']);
			} else {
				$temp['Make'] = convertToLike($temp['Make']);
			}
			//check model
			if (strlen($temp['Model']) < 1){ //empty
				unset($temp['Model']);
			} else {
				$temp['Model'] = convertToLike($temp['Model']);
			}
			$vehicles = $vehicleinstance->searchByInfo($temp);
			$vehicleinstance->display2DArray($vehicles, true); //display the result
		} else {
			//No form data, we display a form
			include $includesfolder."searchvehicle.php";
		}
	} else {
		//Home, display a list of vehicles and some statistics
		include $includesfolder."displayvehiclestats.php";
	}
} else {
	//User is either not logged in, or has no permissions
	printAccessDeniedMsg();
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>
