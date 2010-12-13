<?php
class company {
	
	function addNewCompany($array) {
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO `Company` ("; //Set the first part of the SQL query
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."`".$keys[$i]."`";
			} else {
				$sql = $sql."`".$keys[$i]."`,";
			}
		}
		$sql = $sql.") VALUES (";
		for ($i=0; $i<count($keys); $i++) {	
			if ($i==(count($keys)-1)){ //last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	function deleteCompany($companyno){
		$sql="DELETE FROM `Company` WHERE Commercial_License_No='$companyno'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	// TODO Test
	static function getAllCompanies($selection){
		$companies = mysql_query("SELECT * FROM `Company`");// or die(mysql_error());
		if($companies != null){
			while($info = mysql_fetch_array($companies)){
				echo("<option value=\"");
				if (($info['Commercial_License_No']!=null) && ($info['Commercial_License_No']!=0)){
					if($selection != null && $selection == $info['Commercial_License_No'])
					echo($info['Commercial_License_No']."\" selected=\"selected\"> [ ");
					else
						echo($info['Commercial_License_No']."\"> [ ");
					// Assume size 10 for license
					for($i = floor(log10($info['Commercial_License_No']) + 1);$i < 10;$i++) { print("0"); }
					echo($info['Commercial_License_No']." ]");
					echo(" Name: ");
					echo($info['CName']);
					echo("</option>");
				} else {
					echo("-1\">");
					echo("ERROR");
					echo("</option>");
				}
			}
		} else {
			echo("<option value=\"\" selected=\"selected\">None Exist</option>");
		} 
	}
	
	function searchCompanies($companyno,$policyid,$info){
		$flag = '0';
		$sql = "SELECT * FROM `Company` WHERE ";
		// Company Number
		if($companyno != null && $companyno != '0') {
			$sql = $sql."Commercial_License_No='$companyno' ";
			$flag = '1';
		} 			
		
		// Policy Number
		if($policyid != null && $policyid != '0') {
			$sql = $sql."Policy_No='$policyid' ";
			$flag = '1';
		} 
		
		// Company Information
		if($info != null) {
			$keys = array_keys($info);
			for ($i = 0; $i< count($keys); $i++){
				if ($i==0){
					$sql = $sql." ".$keys[$i]." LIKE '".$info[$keys[$i]]."'";
				} else {
					$sql = $sql." AND '".$keys[$i]."' LIKE '".$info[$keys[$i]]."'";
				}
			}	
			$flag = '1'; // This is probably unneeded but just in case.
		}
		if($flag == '0') { // Nothing was entered
			$sql = "SELECT * FROM `Company`";
		}
		return mysql_query($sql);
	}
	
	function display2DArray($result){
		$flag = '0';
		if($result==null) {
			print "No results were found!<br />";
			return;
		} else {
			while($info = mysql_fetch_array($result)){
				if($flag == '0') {
					$flag = '1';
					print "<table class=\"company\"><tr>";
					print "<td><b>Com Lic Number</b></td>";
					print "<td><b>Name</b></td>";
					print "<td><b>Address</b></td>";
					print "<td><b>City</b></td>";
					print "<td><b>Postal Code</b></td>";
					print "<td><b>Province</b></td>";
					print "<td><b>Phone</b></td>";
					print "<td><b>Manager</b></td>";
					print "<td><b>Policy</b></td>";
					print "</tr>";
				}
				Print "<tr>";
				if (($info['Commercial_License_No']!=null) && ($info['Commercial_License_No']!=0)){
					print "<td><a href='company.php?action=update&company=".$info['Commercial_License_No']."'>".$info['Commercial_License_No']."</a>\n</td>";
				} else {
					print "<td>".$info['Commercial_License_No']."</td>";
				}
				print "<td>".$info['CName']."</td>";
				print "<td>".$info['Address']."</td>";
				print "<td>".$info['City']."</td>";
				print "<td>".$info['PostalCode']."</td>";
				print "<td>".$info['Province']."</td>";
				print "<td>".$info['Phone']."</td>";
				print "<td>".$info['Manager']."</td>";
				print "<td><a href='policy.php?action=update&policy=".$info['Policy_No']."&type=0'>".$info['Policy_No']."</a>\n</td>";
				$this->printOptions($info['Commercial_License_No']);
				print "</tr>";
			}
			print "</table>";
		}
		if($flag == '0') {
			print "No results were found!<br />";
		}
	}
	
	function listCompanies($offset,$limit){
		$type = 1; // PRIVATE
		$sql = "SELECT * FROM `Company` ORDER BY Commercial_License_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);
		print "<table class=\"company\"><tr>";
		print "<td><b>Com Lic Number</b></td>";
		print "<td><b>Name</b></td>";
		print "<td><b>Address</b></td>";
		print "<td><b>City</b></td>";
		print "<td><b>Postal Code</b></td>";
		print "<td><b>Province</b></td>";
		print "<td><b>Phone</b></td>";
		print "<td><b>Manager</b></td>";
		print "<td><b>Policy</b></td>";
		print "</tr>";
		while($info = mysql_fetch_array($result)){
			Print "<tr>";
			if (($info['Commercial_License_No']!=null) && ($info['Commercial_License_No']!=0)){
				print "<td><a href='company.php?action=update&company=".$info['Commercial_License_No']."'>".$info['Commercial_License_No']."</a>\n</td>";
			} else {
				print "<td>".$info['Commercial_License_No']."</td>";
			}
			print "<td>".$info['CName']."</td>";
			print "<td>".$info['Address']."</td>";
			print "<td>".$info['City']."</td>";
			print "<td>".$info['PostalCode']."</td>";
			print "<td>".$info['Province']."</td>";
			print "<td>".$info['Phone']."</td>";
			print "<td>".$info['Manager']."</td>";
			print "<td><a href='policy.php?action=update&policy=".$info['Policy_No']."&type=0'>".$info['Policy_No']."</a>\n</td>";
			$this->printOptions($info['Commercial_License_No']);
			print "</tr>";
		}
		print "</table>";
	}
	
	function printOptions($companyno){
		print "<td><a href=\"company.php?action=remove&company=$companyno\">X</a></td><td> <a href=\"company.php?action=update&company=$companyno\">Edit</a></td>\n";
	}
	
	function printUpdateForm($companyno){
		$sql = "SELECT * FROM `Company` WHERE Commercial_License_No='$companyno'";
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		include 'includes/editcompany.php';
	}
	
	function updateCompany($companyno, $array){
		if($this->companyExists($companyno) == false) {
			print("Error, Company doesn't exist!");
			return false;
		}
		$sql="UPDATE `Company` SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0; $i<count($keys); $i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Commercial_License_No='$companyno'";
		//print $sql."<br />\n";
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}
	
	function companyExists($companyno){
		$sql = "SELECT * FROM `Company` WHERE Commercial_License_No='$companyno'";
		$result = mysql_query($sql);
		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);
		if ($count == 1){//Client exists
			return true;
		}//ID should be unique, therefore only one can be returned
		return false;
	}
	
	function totalCompanies(){
		$temp = mysql_query("SELECT * FROM Company") or die(mysql_error());
		return mysql_num_rows($temp);
	}
} //CLOSE policy class
?>