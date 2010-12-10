<?php
class Manager{

		function addNewEmployee($array) {
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Employees ("; //Set the first part of the SQL query
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
		//print $sql."<br />";
		mysql_query($sql) or die(mysql_error());
		return true;
	}


		function listEmployees($offset,$limit){
		$returnString = array();
		$sql = "SELECT * FROM Employees ORDER BY Employee_ID ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);

		print "<table class=\"employees\"><tr><td>Employee ID</td><td>Username</td><td>Password</td><td>Permissions</td></tr>";

		while($info = mysql_fetch_array($result)){			
			print "</td><td>".$info['Employee_ID']."</td><td>".$info['Username']."</td><td>".$info['Password']."</td><td>".$info["Permissions"]."</td>";
			$this->printOptions($info['Employee_ID']);
			print "</tr>";
		}
		print "</table>";
		}

		function printOptions($id){
		print "<td><a href=\"manager.php?action=remove&id=$id\">X</a></td><td> <a href=\"manager.php?action=update&id=$id\">Edit</a></td>\n";
		}


		function totalEmployees(){
		$data = mysql_query("SELECT * FROM Employees") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
		}

}

?>