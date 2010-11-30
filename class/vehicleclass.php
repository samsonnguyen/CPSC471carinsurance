<?php
class Vehicle{
 	
	/**
	 * Add a new vehicle
	 * Enter description here ...
	 * @param unknown_type $VIN
	 * @param unknown_type $Year
	 * @param unknown_type $License_Plate_No
	 * @param unknown_type $Client_ID
	 */
	function addNewVehicle($array){
		print "<BR/>";
		$keys = array_keys($array); //Return the keys of the array;
		//print_r (count($keys));
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
		print $sql."<br />";
		mysql_query($sql) or die(mysql_error());
	}
	
	function searchVehicleByClient($clientid){
		$sql = "SELECT * FROM Vehicle WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
	}
	
	/**
	 * function that formats an array into a table.
	 * this should work for all 2D arrays.
	 * @param unknown_type $array
	 * @param boolean $printoptions Set whether to display delete, update, etc functions
	 */
	function display2DArray($array,$printoptions){
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
				if ($printoptions){
					$this->printOptions($array[$j]['Client_ID']);
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
	function printOptions($vehicleid){
		print "<td><a href=\"vehicle.php?action=remove&vehicle=$vehicleid\">X</a></td><td> <a href=\"vehicle.php?action=update&vehicle=$vehicleid\">Update</a></td>\n";
	}
	
}