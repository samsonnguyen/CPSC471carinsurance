<?php
class Claim{
	function addNewClaim($array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Claim (Claim_No, "; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES (LAST_INSERT_ID(), ";
		for ($i=0;$i<count($keys);$i++){	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		//Retrieve the newly inserted Claim_ID
		$claimid = mysql_query("SELECT LAST_INSERT_ID();") or die(mysql_error());//This will get the last insert's ID
		$claimid = mysql_fetch_row($claimid);
		//print($claimid[0]);
		return $claimid[0];//return the autoincrement value
	}
	
	function addNewThirdParty($array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Third_Party ( "; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES ( ";
		for ($i=0;$i<count($keys);$i++){	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		return true;
	}
}
?>