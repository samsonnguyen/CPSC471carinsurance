<?php 
class Policy {
	function addNewPrivatePolicy($array) {
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO `Private_Policy` (`Policy_No`, "; //Set the first part of the SQL query
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."`".$keys[$i]."`";
			} else {
				$sql = $sql."`".$keys[$i]."`,";
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
		//INSERT INTO Private_Policy (Policy_No, Premium_Rate,Coverage) VALUES (LAST_INSERT_ID(), '4321','1');Policy has been added
		mysql_query($sql) or die(mysql_error());
		//Retrieve the newly inserted Policy_ID
		$policyid = mysql_query("SELECT LAST_INSERT_ID();") or die(mysql_error()); //This will get the last insert's ID
		$policyid = mysql_fetch_row($policyid);
		//print($claimid[0]);
		return $policyid[0];//return the autoincrement value
	}
	
	function addNewCompanyPolicy($array) {
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO `Company_Policy` (`Policy_No`, "; //Set the first part of the SQL query
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."`".$keys[$i]."`";
			} else {
				$sql = $sql."`".$keys[$i]."`,";
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
		//INSERT INTO Company_Policy (Policy_No, Premium_Rate,Coverage,Num_of_Employees) VALUES (LAST_INSERT_ID(), '4321','1','43');You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1
		mysql_query($sql) or die(mysql_error());
		//Retrieve the newly inserted Policy_ID
		$policyid = mysql_query("SELECT LAST_INSERT_ID();") or die(mysql_error()); //This will get the last insert's ID
		$policyid = mysql_fetch_row($policyid);
		//print($claimid[0]);
		return $policyid[0];//return the autoincrement value
	}
	
	function deletePrivatePolicy($policyID){
		$sql="DELETE FROM Private_Policy WHERE Policy_No='$policyID'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	function deleteCompanyPolicy($policyID){
		$sql="DELETE FROM Company_Policy WHERE Policy_No='$policyID'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	function listPrivatePolicy($offset,$limit){
		echo "<legend>PRIVATE</legend>";
		$returnString = array();
		$type = 1; // PRIVATE
		$sql = "SELECT * FROM Private_Policy ORDER BY Policy_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);
		print "<table class=\"policy\"><tr><td>Policy Number</td><td>Premium Rate</td><td>Coverage</td></tr>";
		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if($info['Policy_No']!=null)
				print $info['Policy_No'];
			print "</td><td>".$info['Premium_Rate']."</td><td>".$info['Coverage']."</td>";
			$this->printOptions($info['Policy_No'],$type);
			print "</tr>";
		}
		print "</table>";
	}
	
	function listCompanyPolicy($offset,$limit){
		echo "<legend>COMPANY</legend>";
		$returnString = array();
		$type = 0; // PUBLIC
		$sql = "SELECT * FROM Company_Policy ORDER BY Policy_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);
		print "<table class=\"policy\"><tr><td>Policy Number</td><td>Premium Rate</td><td>Coverage</td><td># of Employees</tr>";
		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if($info['Policy_No']!=null)
				print $info['Policy_No'];
			print "</td><td>".$info['Premium_Rate']."</td><td>".$info['Coverage']."</td><td>".$info['Num_of_Employees']."</td>";
			$this->printOptions($info['Policy_No'],$type);
			print "</tr>";
		}
		print "</table>";
	}
	
	/**
	 * Print out options to delete, or update the client.
	 * type = 1 for private, type = 0 for company
	 * @param $policyid
	 * @param $type
	 * @return unknown_type
	 */
	function printOptions($policyid,$type){
		print "<td><a href=\"policy.php?action=remove&policy=$policyid&type=$type\">X</a></td><td> <a href=\"policy.php?action=update&policy=$policyid&type=$type\">Edit</a></td>\n";
	}
	
	/**
	 * Prints a form containing the original values in the database for updating
	 * type = 1 for private, type = 0 for company
	 * @param unknown_type $policyid
	 * @param int $type
	 */
	function printUpdateForm($policyid,$type){
		if($type == 1)
			$sql = "SELECT * FROM `Private_Policy` WHERE Policy_No='$policyid'";
		elseif($type == 0) 
			$sql = "SELECT * FROM `Company_Policy` WHERE Policy_No='$policyid'";
		else {
			print("Error, Undefined type: ".$type."!");
			return false;
		}
		print($sql."<br />\n");
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		include 'includes/editpolicy.php';
	} //CLOSE print update form
	
	/**
	 * update the Policy information using data contained in the array and the policy type. The Array keys must be associative
	 * @return unknown_type
	 */
	
	function updatePolicy($policyid, $array, $type){
		if($type == 1) // Private
			$sql="UPDATE `Private_Policy` SET ";
		elseif($type == 0) // Company
			$sql="UPDATE `Company_Policy` SET ";
		else{
			print("Error, Undefined type: ".$type."!");
			return false;
		}
		
		/*if($this->policyExists($policyid, $type) == false) {
			print("Error, Policy doesn't exist!");
			return false;
		}*/
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0; $i<count($keys); $i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Policy_No='$policyid'";
		//print $sql."<br />\n";
		print($sql."<br />\n");
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}
	
	/**
	 * Check if the policy exists by Policy_ID and Type
	 */
	function policyExists($Policy_ID,$type){
		if($type != 0 && $type != 1)
			return false;
		if($type == 0)
			$sql = "SELECT * FROM `Company_Policy` WHERE Policy_ID='$Policy_ID'";
		else
			$sql = "SELECT * FROM `Private_Policy` WHERE Policy_ID='$Policy_ID'";
		$result = mysql_query($sql);
		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);
		if ($count == 1){//Client exists
			return true;
		}//ID should be unique, therefore only one can be returned
		return false;
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
