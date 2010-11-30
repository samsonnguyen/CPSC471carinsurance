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
			$vehicleinstance->addNewVehicle($newVehicleInfo);
		} else {
			// Display the add form
			include $includesfolder.'addvehicle.php';
		}
	} else if ($_GET['action']=='remove'){
		//remove vehicle
		echo 'remove vehicle';
	} else if ($_GET['action']=='update'){
		//update vehicle
		echo 'update vehicle';
	} else {
		//Vehicle home, display stats?
		if (isset($_GET['update'])){
			//perform database update operations using POST
		}
		echo 'Vehicle home';
	}
} else {
	echo 'Access denied';
}

//content ends here, display the footer
include $includesfolder.'footer.php';

?>