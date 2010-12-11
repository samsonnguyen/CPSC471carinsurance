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
		//INSERT INTO Company_Policy (Policy_No, Premium_Rate,Coverage,#_of_Employees) VALUES (LAST_INSERT_ID(), '4321','1','43');You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1
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
		echo "<legend>PRIVATE</legend>";
		$returnString = array();
		$type = true; // PRIVATE
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
		$type = false; // PUBLIC
		$sql = "SELECT * FROM Company_Policy ORDER BY Policy_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);
		print "<table class=\"policy\"><tr><td>Policy Number</td><td>Premium Rate</td><td>Coverage</td><td># of Employees</tr>";
		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if($info['Policy_No']!=null)
				print $info['Policy_No'];
			print "</td><td>".$info['Premium_Rate']."</td><td>".$info['Coverage']."</td><td>".$info['#_of_Employees']."</td>";
			$this->printOptions($info['Policy_No'],$type);
			print "</tr>";
		}
		print "</table>";
	}
	
	/**
	 * Print out options to delete, or update the client.
	 * type = true for private, type = false for company
	 * @param $policyid
	 * @param boolean $type
	 * @return unknown_type
	 */
	function printOptions($policyid,$type){
		if($type){
			print "<td><a href=\"client.php?action=remove&privatepolicy=$policyid\">X</a></td><td> <a href=\"client.php?action=update&privatepolicy=$policyid\">Edit</a></td>\n";
		}
		else {
			print "<td><a href=\"client.php?action=remove&companypolicy=$policyid\">X</a></td><td> <a href=\"client.php?action=update&companypolicy=$policyid\">Edit</a></td>\n";
		}
	}
	
	/**
	 * Prints a form containing the original values in the database for updating
	 * @param unknown_type $policyid
	 */
	function printUpdateForm($policyid){
		$sql = "SELECT * FROM Client WHERE Client_ID='$policyid'";
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		include 'includes/editpolicy.php';
	} //CLOSE print update form
	
	/**
	 * update the client information using data contained in the array. The Array keys must be associative
	 * @return unknown_type
	 */
	/*function updateClient($clientid, $array){
		$sql="UPDATE Client SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Client_ID='$clientid'";
		//print $sql."<br />\n";
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}*/
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
