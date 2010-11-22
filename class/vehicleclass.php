<?php
class Vehicle{
	var $clientID;
	var $vehicles; //holds query result

	/*
	 * Must construct this class with the query that selects the vehicles to return
	 */
	function __construct($client) {
		$clientID=$client;
		$sql="SELECT * FROM Vehicle WHERE CLient_ID = '$client'";
		$vehicles = mysql_query($sql);
	}
	 
	/*
	 * Returns vehicles from the class
	 */
	function getVehicles(){
		$toReturn[];
		$i= 0;
		while ($row = mysql_fetch_assoc($result)) {
			$toReturn[$i]=$row;
			$i++;
		}
		return $toReturn;
	}
	
	function addNewVehicle($VIN, $Year, $License_Plate_No,$Client_ID){
		$sql = "INSERT INTO Vehicle(VIN,Year,License_Plate_No,Client_ID) VALUES ('$VIN','$Year', '$License_Plate_No','$Client_ID')";
		mysql_query($sql) or die(mysql_error());
	}
	
	function updateVehicle($VIN, $array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "UPDATE Vehicle SET"; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){	
			if ($i=(count($keys)-1)){//last value, do not include the comma
				$sql = $sql." $keys[$i] = '$array[$i]' WHERE VIN='$VIN'";
			} else {
				$sql = $sql." $keys[$i] = '$array[$i]'";
			}
		}
		echo ($sql);
		mysql_query($sql);
	}
}