<?php
class Client{
	/*
	 * Add a new client TODO: NEED TO CHANGE THE DATABASE SCHEMA TO INCLUDE firstname, lastname, mname, address, postalcode, province 
	 */
	function addNewClient($Client_ID, $Address, $Phone, $Bdate, $Licence_No, $Gender, $Age, $Company, $Policy_No){
		$sql = "INSERT INTO Vehicle(Client_ID,Name,Phone,Birthdate,Licence_No,Gender,Age,Company,Policy_No) VALUES ('$Client_ID','$Address', '$Phone','$Bdate','$Licence_No','$Gender','$Age','$Company','$Policy_No')";
		mysql_query($sql) or die(mysql_error());
	}
	
	/*
	 * Check if the client exists by client_id
	 */
	function clientExists($Client_ID){
		$sql="SELECT * FROM Client WHERE Client_ID='$Client_ID'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);
		if ($count==1){//Client exists
			return true;
		} else {
			return false;
		}
	}

	/*
	 * Check if client exists by name
	 */
	function clientExistsByName($Name){
		$sql="SELECT * FROM Client WHERE Name='$Name'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);
		if ($count>=1){//Client exists
			return true;
		} else {
			return false;
		}
	}
	
	/*
	 * Update the vehicle according to VIN, the array should be like follows:
	 *   array['VIN'] = some vin
	 *   array['Make'] = some make
	 *   
	 *   The Array's index(keys) should match the database attribute name
	 */
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
	
	/*
	 * TODO
	 */
	function listClients(){
		//TODO
	}
}
?>