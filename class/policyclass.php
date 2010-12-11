<?php 
class Policy {
	function addNewPrivatePolicy($array) {
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Private_Policy (Policy_No, "; //Set the first part of the SQL query
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES (LAST_INSERT_ID(), ";
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){ //last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		//Retrieve the newly inserted Policy_ID
		$policyid = mysql_query("SELECT LAST_INSERT_ID();") or die(mysql_error()); //This will get the last insert's ID
		$policyid = mysql_fetch_row($policyid);
		//print($claimid[0]);
		return $policyid[0];//return the autoincrement value
		
	}
	
	function addNewCompanyPolicy($array) {
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Company_Policy (Policy_No, "; //Set the first part of the SQL query
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES (LAST_INSERT_ID(), ";
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){ //last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		//Retrieve the newly inserted Policy_ID
		$policyid = mysql_query("SELECT LAST_INSERT_ID();") or die(mysql_error()); //This will get the last insert's ID
		$policyid = mysql_fetch_row($policyid);
		//print($claimid[0]);
		return $policyid[0];//return the autoincrement value
	}
	
	function deletePrivatePolicy($policyID){
		$sql="DELETE FROM Private_Policy WHERE Claim_No='$policyID'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	function deleteCompanyPolicy($policyID){
		$sql="DELETE FROM Company_Policy WHERE Claim_No='$policyID'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	function listPrivatePolicy($offset,$limit){
		// TODO Got to figure this one out still
		print "PRIVATE";
		$returnString = array();
		$sql = "SELECT * FROM Private_Policy ORDER BY Policy_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);

		print "<table class=\"policy\"><tr><td>Policy Number</td><td>Premium Rate</td><td>Coverage</td></tr>";

		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if($info['Policy_No']!=null)
				print $info['Policy_No'];
			
			print "</td><td>".$info['Premium_Rate']."</td><td>".$info['Coverage']."</td>";
			print "</tr>";
		}
		print "</table>";
	}
	
	function listCompanyPolicy($offset,$limit){
		// TODO Got to figure this one out still
		print "COMPANY";
		$returnString = array();
		$sql = "SELECT * FROM Company_Policy ORDER BY Policy_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);

		print "<table class=\"policy\"><tr><td>Policy Number</td><td>Premium Rate</td><td>Coverage</td><td>Num of EMployees</tr>";

		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if($info['Policy_No']!=null)
				print $info['Policy_No'];
			
			print "</td><td>".$info['Premium_Rate']."</td><td>".$info['Coverage']."</td><td>".$info['#-of_employees']."</td>";
			print "</tr>";
		}
		print "</table>";
	}
	function totalPolicies(){
		$data = mysql_query("SELECT * FROM Private_Policy") or die(mysql_error());
		$data2 = mysql_query("SELECT * FROM Company_Policy") or die(mysql_error());
		return (mysql_num_rows($data) + mysql_num_rows($data2)); //count the number of results and return
	}
	
	function totalPrivatePolicies(){
		$data = mysql_query("SELECT * FROM Private_Policy") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
	}
	
	function totalCompanyPolicies(){
		$data = mysql_query("SELECT * FROM Company_Policy") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
	}
} //CLOSE policy class
?>
