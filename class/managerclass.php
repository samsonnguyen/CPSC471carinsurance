<?php
class Manager{
	var $error;
	var $errorIndex = 0;
	
	/**
	 * Print a form to update the base price
	 * @param unknown_type $price
	 */
	function PrintBasePriceForm($price){
		?>
		<div id="container"><!-- p id="fm-intro" required for 'hide optional fields' function -->
			<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
			<form name="printbasepriceform" method="post" action="manager.php?action=setbase&form">
				<fieldset>
					<legend>Set Base Price</legend>
					<div class="fm-req">
						<label for="fm-username">Base Price:</label>
						<input id="fm-newbase" name="fm-newbase" type="text"<?php print "value=\"".$price."\"";?> />
					</div>
				</fieldset>
				<div id="fm-submit" class="fm-req">
					<input name="Submit" value="Submit" type="submit" />
				</div>
			</form>
		</div>
	<?php
	}

	/**
	 * Add a new employee
	 * @param unknown_type $array
	 */
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


	/**
	 * delete an employee from the databse
	 * @param unknown_type $emp_id
	 */
	function deleteEmployee($emp_id){
		$sql="DELETE FROM Employees WHERE Employee_ID='$emp_id'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}



	/**
	 * search employee by employee id
	 * @param unknown_type $emp_id
	 */
	function searchByID($emp_id){
		$sql = "SELECT * FROM Employees WHERE Employee_ID='$emp_id'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //while more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
	}

	/**
	 * search employee by username
	 * @param unknown_type $username
	 */
	function searchByUsername($username){
		$sql = "SELECT * FROM Employees WHERE Username LIKE '$username'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //while more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
	}

	/**
	 * search employee by username
	 * @param unknown_type $permission
	 */
	function searchByPermissions($permission){
		$sql = "SELECT * FROM Employees WHERE Permissions='$permission'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //while more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
	}

	/**
	 * Display's a 2D arrayas a table
	 * @param unknown_type $array
	 * @param unknown_type $printoptionsflag
	 */
	function display2DArray($array, $printoptionsflag){
		if($array==null){
			print "No employees were found!";
		} else {
			print "Employees<br/><table class=\"employees\"><tr>";
			$first = $array[0];
			$keys = array_keys($first); //Return the keys of the array, use first element;
			for ($i=0;$i<count($keys);$i++){
				print "<td>".$keys[$i]."</td>\n";
			}
			print "</tr>";
			for ($j=0;$j<count($array);$j++){
				print "<tr>";
				for ($i=0;$i<(count($keys));$i++){
					print "<td>".$array[$j][$keys[$i]]."</td>\n";
				}
				if ($printoptionsflag){ //We want to print the options to delete, update, etc..
					$this->printOptions($array[$j]['Employee_ID']);
				}
				print "</tr>\n";
			}
			print "</table>\n";
		}
	}

	/**
	 * update employee information return true if the query was a success
	 * @param unknown_type $emp_id
	 * @param unknown_type $array
	 */
	function updateEmployee($emp_id,$array){
		$sql="UPDATE Employees SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Employee_ID='$emp_id'";
		//print $sql."<br />\n";
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	/**
	 * prints the form for update
	 * @param unknown_type $emp_id
	 */
	function printUpdateForm($emp_id){
		$sql = "SELECT * FROM Employees WHERE Employee_ID='$emp_id'"; //Get the employee
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		?>
		<div id="container">
			<!-- p id="fm-intro" required for 'hide optional fields' function -->
			<p id="fm-intro">Fields in <strong>bold</strong> are required.</p>
			<form name="addemployee-form" method="post" action="manager.php?action=update&form&id=<?php print $emp_id;?>">
				<fieldset>
				<legend>Login Information</legend>
				<div class="fm-req">
					<label for="fm-username">Username:</label>
					<input id="fm-username" name="fm-username" type="text" <?php print "value=\"".$info['Username']."\"";?> />
				</div>
				<div class="fm-req">
					<label for="fm-password">Password:</label>
					<input name="fm-password" id="fm-password" type="password" <?php print "value=\"".$info['Password']."\"";?> />
				</div>
				<div class="fm-req">
			      <label for="fm-permissions">Permission:</label>
			      <select id="fm-permissions" name="fm-permissions">
					<option value='1' <?php if($info['Permissions'] == '1') { print"selected"; } ?>>Employee</option>
					<option value='2' <?php if($info['Permissions'] == '2') { print"selected"; } ?>>Supervisor</option>
					<option value='3' <?php if($info['Permissions'] == '3') { print"selected"; } ?>>Manager</option>
			      </select>
			    </div>
				</fieldset>
				<div id="fm-submit" class="fm-req">
					<input name="Submit" value="Submit" type="submit" />
				</div>
			</form>
			</div>
		<?php
	}

	/**
	 * List all employees
	 * @param unknown_type $offset
	 * @param unknown_type $limit
	 */
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

	/**
	 * Print the option to delete or edit an employee
	 * @param unknown_type $id
	 */
	function printOptions($id){
		print "<td><a href=\"manager.php?action=remove&id=$id\">X</a></td><td> <a href=\"manager.php?action=update&id=$id\">Edit</a></td>\n";
	}

	/**
	 * Returns the total number of employees
	 */
	function totalEmployees(){
		$data = mysql_query("SELECT * FROM Employees") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
	}
	
	/**
	 * Validate form data, returns true if all data meets the criteria
	 */
	function validateEmployeerData($array){
		$errorFlag=true;
		if (trim($array['Username'])==''){
			$this->appendErrorMsg("Username is required");
			$errorFlag = false;
		}
		if (trim($array['Password'])==''){
			$this->appendErrorMsg("Password is required");
			$errorFlag = false;
		}
		return $errorFlag;
	}

	function validatePriceData($price){
		$errorFlag = true;
		if (!preg_match("/^[0-9]{1,}$/", $price)){
			$this->appendErrorMsg("Price must be numeric");
			$errorFlag = false;
		}
		return $errorFlag;
	}
	/**
	 * Append an error message to be displayed
	 * @param unknown_type $string
	 */
	function appendErrorMsg($string){
		$this->error[$this->errorIndex] = $string;
		$this->errorIndex++;
	}

	/**
	 * Displays errors if validation fails
	 */
	function displayError(){
		print "<div class=\"validationerror\">";
		for ($i=0;$i<count($this->error);$i++){
			println($this->error[$i]);
		}
		print "</div>";
	}
}
?>
