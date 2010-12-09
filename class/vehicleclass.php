<?php
class Vehicle{
 	
	/**
	 * Add a new vehicle using an associative array.
	 * @param unknown_type $VIN
	 * @param unknown_type $Year
	 * @param unknown_type $License_Plate_No
	 * @param unknown_type $Client_ID
	 */
	function addNewVehicle($array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Vehicle ("; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES (";
		for ($i=0;$i<count($keys);$i++){	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		//print $sql."<br />";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	/**
	 * Returns a search result using the client id
	 * @param unknown_type $clientid
	 */
	function searchByClient($clientid){
		$sql = "SELECT * FROM Vehicle WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //while more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
	}
	
	/**
	 * Searches vehicles by VIN number, uses Like for wildcards
	 * @param unknown_type $vin
	 */
	function searchByVIN($vin){
		$sql = "SELECT * FROM Vehicle WHERE VIN LIKE '$vin'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn; //return 2D array
	}
	
	/**
	 * Searches vehicles by any type of info contained in an associative array
	 * Allows the use of wildcards
	 * @param unknown_type $array
	 */
	function searchByInfo($array){
		$sql = "SELECT * FROM Vehicle WHERE";
		$keys = array_keys($array);
		for ($i = 0; $i< count($keys); $i++){
			if ($i==0){
				$sql = $sql." ".$keys[$i]." LIKE '".$array[$keys[$i]]."'";
			} else {
				$sql = $sql." AND ".$keys[$i]." LIKE '".$array[$keys[$i]]."'";
			} 
		}
		//print $sql;
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //While more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn; //return 2D array of results
	}
	
	/**
	 * function that formats an array into a table.
	 * this should work for all 2D arrays.
	 * @param unknown_type $array
	 * @param boolean $printoptions Set whether to display delete, update, etc functions
	 */
	function display2DArray($array,$printoptionsflag){
		if($array==null){
			print "No vehicles were found!";
		} else {
			print "Vehicles<br/><table class=\"vehicles\"><tr>";
			$first = $array[0];
			$keys = array_keys($first); //Return the keys of the array, use first element;
			for ($i=0;$i<count($keys);$i++){
				print "<td>".$keys[$i]."</td>\n";
			}
			print "</tr>";
			for ($j=0;$j<count($array);$j++){
				print "<tr>";
				for ($i=0;$i<(count($keys));$i++){	
					print "<td>".$array[$j][$keys[$i]]."</td>\n";
				}
				if ($printoptionsflag){ //We want to print the options to delete, update, etc..
					$this->printOptions($array[$j]['VIN'], $array[$j]['Client_ID']);
				}
				print "</tr>\n";
			}
			print "</table>\n";
		}
	}
	
	/**
	 * Print out options to delete, or update the Vehicle
	 * @param $clientid
	 * @return unknown_type
	 */
	function printOptions($vehicleid,$clientid){
		print "<td><a href=\"vehicle.php?action=remove&vehicle=$vehicleid\">X</a></td>\n";
		print "<td><a href=\"vehicle.php?action=update&vehicle=$vehicleid\">Edit</a></td>\n";
		print "<td><a href=\"claim.php?action=add&vehicle=$vehicleid&clientid=$clientid\">New Claim</a></td>\n";
	}
	
	/**
	 * Outputs a form that contains values from the database, for use in updating existing vehicles
	 * Enter description here ...
	 * @param unknown_type $vehicleVIN
	 */
	function printUpdateForm($vehicleVIN){
		$sql = "SELECT * FROM Vehicle WHERE VIN='$vehicleVIN'"; //Get the vehicle
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		include 'includes/editvehicle.php'; 
	} //CLOSE print update form!!
	
	/**
	 * Updates vehicle data using an associative array
	 * @return unknown_type
	 */
	function updateVehicle($vehicleVIN, $array){
		$sql="UPDATE Vehicle SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE VIN='$vehicleVIN'";
		//print $sql."<br />\n";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	/**
	 * Removes a vehicle from the database based on VIN
	 */
	function deleteVehicle($vehicleVIN){
		$sql="DELETE FROM Vehicle WHERE VIN='$vehicleVIN'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	/**
	 * Returns the number of vehicles contained in the database
	 * @return unknown_type
	 */
	function totalVehicles(){
		$data = mysql_query("SELECT * FROM Vehicle") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
	}
	
	/**
	 * Prints out a simple list of vehicles, sort by client id and allow pagination, also display the option to update, delete, etc.
	 * @param offset Being where in the results
	 * @param limit Limit the number of results
	 */
	function listVehicles($offset,$limit){
		$returnString = array();
		$sql = "SELECT * FROM Vehicle ORDER BY Client_ID ASC LIMIT $offset, $limit ";
		$data_p = mysql_query($sql);
		print "<table class=\"vehicles\"><tr><td>Client ID</td><td>VIN</td><td>Year</td><td>Make</td><td>Model</td></tr>";
		while($info = mysql_fetch_array($data_p)){
			Print "<tr><td>";
			if (($info['Client_ID']!=null) || ($info['Client_ID']!=0)){
				print "<a href=\"client.php?action=update&client=".$info['Client_ID']."\">".$info['Client_ID']."</a>";
			} else {
				print $info['Client_ID'];
			}
			print "</td><td>".$info['VIN']."</td><td>".$info['Year']."</td><td>".$info['Make']."</td><td>".$info['Model']."</td>";
			$this->printOptions($info['VIN'], $info['Client_ID']);
			print "</tr>";
		}
		print "</table>";
	}
	
}//CLOSE vehicle class
?>
