<?php
class Client{
	/*
	 * Add a new client TODO: NEED TO CHANGE THE DATABASE SCHEMA TO INCLUDE firstname, lastname, mname, address, postalcode, province 
	 */
	function addNewClient($FName, $MName, $LName, $Address, $City, $PostalCode,
							$Province, $Phone, $Bdate, $License_No, $Gender, $Age, $Company, $Policy_No){
		$sql = "INSERT INTO Client(FName,MName,LName,Adress,City,PostalCode,Province,Phone,Birthdate,License_No,
									Gender,Age,Company,Policy_No) VALUES ('$FName','$MName','$LName',$Address','$City','$PostalCode','$Province','$Phone','$Bdate','$License_No','$Gender','$Age','$Company','$Policy_No')";
		mysql_query($sql) or die(mysql_error());
	}
	
	function addNewClientByArray($array){
				print "<BR/>";
		
		$keys = array_keys($array); //Return the keys of the array;
		//print_r (count($keys));
		$sql = "INSERT INTO Client ("; //Set the first part of the SQL query
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
		echo $sql."<br />";
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
	 * Prints out a list of clients with a table
	 */
	function listClients($offset,$limit){
		$returnString = array();
		$sql = "SELECT * FROM Client LIMIT $offset, $limit";
		$data_p = mysql_query($sql);
		print "<table class=\"clients\"><tr><td>Client ID</td><td>Name</td><td>Policy Number</td></tr>";
		while($info = mysql_fetch_array( $data_p )){
			Print "<tr><td>".$info['Client_ID']."</td><td>".$info['FName']." ".$info['MName']." ".$info['LName']."</td><td>".$info['Policy_No']."</td></tr>";
		}
		print "</table>";
	}
	
	/*
	 * Returns the number of Clients
	 */
	function totalClients(){
		 $data = mysql_query("SELECT * FROM Client") or die(mysql_error());
		 return $rows = mysql_num_rows($data); 
	}
	
	function searchClient(){
		
	}
}
?>