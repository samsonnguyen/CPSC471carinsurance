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
	} else {
		//Home, display a list of vehicles and some statistics
		include $includesfolder."displayvehiclestats.php";
	}
} else {
	echo 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>
