<?php
require 'db.php';
require 'class/vehicleclass.php';
require 'config.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

if (isLoggedIn() && (getUserPermissions()=='1')){
	$vehicleinstance = new Vehicle();//Create new vehicle instance
	if ($_GET['action']=='add'){
		//Add vehicle
		if (isset($_GET['form'])){
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
			$newVehicleInfo['Type'] = getAge($_POST['fm-type']);
			$newVehicleInfo['Commercial'] = $_POST['fm-commercial'];
			if ($vehicleinstance->addNewVehicle($newVehicleInfo)){
				print "Vehicle ".$_POST['fm-vin']." added successfully!\n";
			} else {
				print "Error occured";
			}
		} else {
			// Display the add form
			include $includesfolder.'addvehicle.php';
		}
	} else if ($_GET['action']=='remove'){
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
		$vehicleVIN= $_GET['vehicle'];
		if ($vehicleVIN==null){
			print "Error, vehicle cannot be null";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
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
				$newVehicleInfo['Type'] = getAge($_POST['fm-type']);
				$newVehicleInfo['Commercial'] = $_POST['fm-commercial'];
				
				if ($vehicleinstance->updateVehicle($vehicleVIN,$newVehicleInfo)){
					print "Vehicle ".$vehicleVIN." successfully updated<br />\n";
					print "<a href=\"vehicle.php?action=update&vehicle=".$vehicleVIN."\">Return</a>\n";
				} else {
					print "Error occured, please check your input";
				}
			} else {
				//We cant to display an update form and get information
				$vehicleinstance->printUpdateForm($vehicleVIN);
			}
		}
	} else if ($_GET['action']=='search'){
		if ($_GET['form']=='client'){
			//Search by client
			$vehicles = $vehicleinstance->searchVehicleByClient($_POST['fm-clientID']);
			$vehicleinstance->display2DArray($vehicles, true);
		} else if ($_GET['form']=='vin'){
			//Search by vin
			$vehicles = $vehicleinstance->searchVehicleByVIN(convertToLike($_POST['fm-vin']));
			$vehicleinstance->display2DArray($vehicles, true);
		} else if ($_GET['form']=='info'){
			//search by information
			$temp['year'] = $_POST['fm-year'];
			$temp['make'] = $_POST['fm-make'];
			$temp['model'] = $_POST['fm-model'];

			/**
			 * Perform wildcard changed for like format in mysql:
			 * * => %, if * at the end
			 * * => _, if not at the end 
			 */
			$currentDate = getdate();
			//Check year
			if (strlen($temp['year']) != 4){
				unset($temp['year']);
			} else {
				$temp['year'] = convertToLike($temp['year']);
			}
			//check make
			if (strlen($temp['make']) < 1){ //empty
				unset($temp['make']);
			} else {
				$temp['make'] = convertToLike($temp['make']);
			}
			//check model
			if (strlen($temp['model']) < 1){ //empty
				unset($temp['model']);
			} else {
				$temp['model'] = convertToLike($temp['model']);
			}
			$vehicles = $vehicleinstance->searchVehicleByInfo($temp);
			$vehicleinstance->display2DArray($vehicles, true); //display the result
		} else {
			include $includesfolder."searchvehicle.php";
		}
	} else {
		//Home, display a list of vehicles and some statistics
		include $includesfolder."displayvehiclestats.php";
	}
} else {
	print 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>
