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
	
	function searchPrivatePolicy($policyid, $policyrate, $policycover){
		$flag = 0;
		$sql = "SELECT * FROM `Private_Policy` WHERE ";
		if($policyid != null) {
			$sql = $sql."Policy_No='$policyid' ";
			$flag = 1;
		} 
		
		if($policyrate['min'] != null && $policyrate['max'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyrate['min'] <= '0') {
				println("Error: Policy Min Rate less than zero");
				return null;
			}				
			if($policyrate['max'] <= '0') {
				println("Error: Policy Max Rate less than zero");
				return null;
			}	
			
			if($policyrate['min']==$policyrate['max']) {
				$sql = $sql."Premium_Rate='".$policyrate['min']."' ";
			} elseif ($policyrate['min']>$policyrate['max']){
				println("Error: Policy Rate Max less than Policy Rate Min");
				return null;
			} else {
				$sql = $sql."Premium_Rate BETWEEN '".$policyrate['min']."' AND ".$policyrate['max']."' ";
			}
			$flag = 1;
		} elseif($policyrate['min'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyrate['min'] <= '0') {
				println("Error: Policy Min Rate less than zero");
				return null;
			}
			$sql = $sql."Premium_Rate>='".$policyrate['min']."' ";
			$flag = 1;
		} elseif($policyrate['max'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyrate['max'] <= '0') {
				println("Error: Policy Max Rate less than zero");
				return null;
			}
			$sql = $sql."Premium_Rate<='".$policyrate['max']."' ";
			$flag = 1;
		}
		
		if($policycover['min'] != '-1' && $policycover['max'] != '-1') {
			if($flag == '1')
				$sql = $sql."&& ";
			if($policycover['min']==$policycover['max']) {
				$sql = $sql."Coverage='".$policycover['min']."' ";
			} elseif ($policycover['min']>$policycover['max']){
				println("Error: Policy Cover Max less than Policy Cover Min");
				return null;
			} else {
				$sql = $sql."Coverage BETWEEN '".$policycover['min']."' AND ".$policycover['max']."' ";
			}
			$flag = 1;
		} elseif($policycover['min'] != '-1') {
			if($flag == '1')
				$sql = $sql."&& ";
			
			$sql = $sql."Coverage>='".$policycover['min']."' ";
			$flag = 1;
		} elseif($policycover['max'] != '-1') {
			if($flag == '1')
				$sql = $sql."&& ";
			$sql = $sql."Coverage<='".$policycover['max']."' ";
			$flag = 1;
		}  
		
		if($flag == '0') { // Nothing was entered
			$sql = "SELECT * FROM `Private_Policy`";
		}
		return mysql_query($sql);
	}
	
	function getAllCompanyPolicy(){
		return mysql_query("SELECT * FROM `Company_Policy`");
	}
	
	function searchCompanyPolicy($policyid, $policyrate, $policycover, $policyemp){
		$flag = 0;
		$sql = "SELECT * FROM `Company_Policy` WHERE ";
		if($policyid != null) {
			$sql = $sql."Policy_No='$policyid' ";
			$flag = 1;
		} 
		
		if($policyrate['min'] != null && $policyrate['max'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyrate['min'] <= '0') {
				println("Error: Policy Min Rate less than zero");
				return null;
			}				
			if($policyrate['max'] <= '0') {
				println("Error: Policy Max Rate less than zero");
				return null;
			}	
			
			if($policyrate['min']==$policyrate['max']) {
				$sql = $sql."Premium_Rate='".$policyrate['min']."' ";
			} elseif ($policyrate['min']>$policyrate['max']){
				println("Error: Policy Rate Max less than Policy Rate Min");
				return null;
			} else {
				$sql = $sql."Premium_Rate BETWEEN '".$policyrate['min']."' AND ".$policyrate['max']."' ";
			}
			$flag = 1;
		} elseif($policyrate['min'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyrate['min'] <= '0') {
				println("Error: Policy Min Rate less than zero");
				return null;
			}
			$sql = $sql."Premium_Rate>='".$policyrate['min']."' ";
			$flag = 1;
		} elseif($policyrate['max'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyrate['max'] <= '0') {
				println("Error: Policy Max Rate less than zero");
				return null;
			}
			$sql = $sql."Premium_Rate<='".$policyrate['max']."' ";
			$flag = 1;
		}
		
		if($policycover['min'] != '-1' && $policycover['max'] != '-1') {
			if($flag == '1')
				$sql = $sql."&& ";
			if($policycover['min']==$policycover['max']) {
				$sql = $sql."Coverage='".$policycover['min']."' ";
			} elseif ($policycover['min']>$policycover['max']){
				println("Error: Policy Cover Max less than Policy Cover Min");
				return null;
			} else {
				$sql = $sql."Coverage BETWEEN '".$policycover['min']."' AND ".$policycover['max']."' ";
			}
			$flag = 1;
		} elseif($policycover['min'] != '-1') {
			if($flag == '1')
				$sql = $sql."&& ";
			
			$sql = $sql."Coverage>='".$policycover['min']."' ";
			$flag = 1;
		} elseif($policycover['max'] != '-1') {
			if($flag == '1')
				$sql = $sql."&& ";
			$sql = $sql."Coverage<='".$policycover['max']."' ";
			$flag = 1;
		}  
		
	
		if($policyemp['min'] != null && $policyemp['max'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyemp['min'] <= '0') {
				println("Error: Policy Min emp less than zero");
				return null;
			}				
			if($policyemp['max'] <= '0') {
				println("Error: Policy Max emp less than zero");
				return null;
			}	
			
			if($policyemp['min']==$policyemp['max']) {
				$sql = $sql."Num_of_Employees='".$policyemp['min']."' ";
			} elseif ($policyemp['min']>$policyemp['max']){
				println("Error: Policy emp Max less than Policy emp Min");
				return null;
			} else {
				$sql = $sql."Num_of_Employees BETWEEN '".$policyemp['min']."' AND ".$policyemp['max']."' ";
			}
			$flag = 1;
		} elseif($policyemp['min'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyemp['min'] <= '0') {
				println("Error: Policy Min emp less than zero");
				return null;
			}
			$sql = $sql."Num_of_Employees>='".$policyemp['min']."' ";
			$flag = 1;
		} elseif($policyemp['max'] != null) {
			if($flag == '1')
				$sql = $sql."&& ";
				
			if($policyemp['max'] <= '0') {
				println("Error: Policy Max emp less than zero");
				return null;
			}
			$sql = $sql."Num_of_Employees<='".$policyemp['max']."' ";
			$flag = 1;
		}		
		
		if($flag == '0') { // Nothing was entered
			$sql = "SELECT * FROM `Company_Policy`";
		}
		return mysql_query($sql);
	}

	/**
	 * function that formats an array into a table.
	 * this should work for all 2D arrays.
	 * @param unknown_type $array
	 * @param boolean $printoptions Set whether to display delete, update, etc functions
	 */
	function display2DArray($result, $type){
		if($result==null){
			print "No results were found!<br />";
		} else {
			if($type == 1) {
				print("<legend>Private Policy</legend>");
			} elseif ($type == 0) {
				print("<legend>Company Policy</legend>");
			}
			print "<table class=\"policy\"><tr><td><b>Policy Number</b></td><td><b>Premium Rate</b></td><td><b>Coverage</b></td>";
			if($type == 1) {
				print("</tr>");
			} else {
				print("<td><b>Num of Employees</b></td></tr>");
			}
			while($info = mysql_fetch_array($result)){
				Print "<tr><td>";
				if (($info['Policy_No']!=null) || ($info['Policy_No']!=0)){
					print "<a href='policy.php?action=update&policy=".$info['Policy_No']."&type=1'>".$info['Policy_No']."</a>\n";
				} else {
					print $info['Policy_No'];
				}
				print "</td><td>".$info['Premium_Rate']."</td><td>".$info['Coverage']."</td>";
				if($type == 0) {
					print("<td>".$info['Num_of_Employees']."</td>");
				}
				$this->printOptions($info['Policy_No'],$type);
				print "</tr>";
			}
			print "</table>";
		}
	}
	
	function listPrivatePolicy($offset,$limit){
		echo "<legend>PRIVATE</legend>";
		$returnString = array();
		$type = 1; // PRIVATE
		$sql = "SELECT * FROM Private_Policy ORDER BY Policy_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);
		print "<table class=\"policy\"><tr><td><b>Policy Number</b></td><td><b>Premium Rate</b></td><td><b>Coverage</b></td></tr>";
		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if (($info['Policy_No']!=null) || ($info['Policy_No']!=0)){
				print "<a href='policy.php?action=update&policy=".$info['Policy_No']."&type=1'>".$info['Policy_No']."</a>\n";
			} else {
				print $info['Policy_No'];
			}
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
		print "<table class=\"policy\"><tr><td><b>Policy Number</b></td><td><b>Premium Rate</b></td><td><b>Coverage</b></td><td><b>Num of Employees</b></tr>";
		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if (($info['Policy_No']!=null) || ($info['Policy_No']!=0)){
				print "<a href='policy.php?action=update&policy=".$info['Policy_No']."&type=0'>".$info['Policy_No']."</a>\n";
			} else {
				print $info['Policy_No'];
			}
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
		
		if($this->policyExists($policyid, $type) == false) {
			print("Error, Policy doesn't exist!");
			return false;
		}
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
			$sql = "SELECT * FROM `Company_Policy` WHERE Policy_No='$Policy_ID'";
		else
			$sql = "SELECT * FROM `Private_Policy` WHERE Policy_No='$Policy_ID'";
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
