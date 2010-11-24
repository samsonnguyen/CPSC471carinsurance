<?php

	function addNewClient($Client_ID, $Address, $Phone, $Bdate, $Licence_No, $Gender, $Age, $Company, $Policy_No){
		$sql = "INSERT INTO Vehicle(Client_ID,Name,Phone,Birthdate,Licence_No,Gender,Age,Company,Policy_No) VALUES ('$Client_ID','$Address', '$Phone','$Bdate','$Licence_No','$Gender','$Age','$Company','$Policy_No')";
		mysql_query($sql) or die(mysql_error());
	}
	
	/*create functions for update delete 
	* also link to addclient.php
	*/
	
?>