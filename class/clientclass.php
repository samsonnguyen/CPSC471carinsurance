<?php
class Client{
	var $error = null;//set initial error to null
	var $errorIndex = 0;

	/**
	 * Reads an array of keys and its values and inserts them into the database as a new Client.
	 */
	function addNewClientByArray($array){
		$keys = array_keys($array); //Return the keys of the array;
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
		//print $sql."<br />";
		mysql_query($sql) or die(mysql_error());
	}

	static function getAllClients($selection) {
		$clients = mysql_query("SELECT * FROM `Client`");// or die(mysql_error());
		if($clients != null){
			while($info = mysql_fetch_array($clients)){
				print("<option value=\"");
				if (($info['Client_ID']!=null) && ($info['Client_ID']!=0)){
					if($selection != null && $selection == $info['Client_ID'])
						print($info['Client_ID']."\" selected=\"selected\"> [ ");
					else
						print($info['Client_ID']."\"> [ ");
					// Assume size 10 for license
					print(str_pad($info['Client_ID'],5,"0",STR_PAD_LEFT)." ] LicNo: ");
					print(str_pad($info['License_No'],10,"0",STR_PAD_LEFT));
					print(" Name: ");
					print($info['FName']." ".$info['MName']." ".$info['LName']);
					print("</option>");
				} else {
					print("-1\">");
					print("ERROR");
					print("</option>");
				}
			}
		} else {
			print("<option value=\"\" selected=\"selected\">None Exist</option>");
		} 
	}
	
	/**
	 * Check if the client exists by client_id
	 */
	function clientExists($Client_ID){
		$sql="SELECT * FROM Client WHERE Client_ID='$Client_ID'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);
		if ($count==1){//Client exists
			return true;
		} else {//ID should be unique, therefore only one can be returned
			return false;
		}
	}

	/**
	 * Check if client exists by name
	 */
	function clientExistsByName($Name){
		$sql="SELECT * FROM Client WHERE Name='$Name'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count = mysql_num_rows($result);
		if ($count>=1){//Client exists, might be multiple results
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Prints out a simple list of clients with a table, we don't want to crowd the table with too much
	 */
	function listClients($offset,$limit){
		$returnString = array();
		$sql = "SELECT * FROM Client ORDER BY Client_ID ASC LIMIT $offset, $limit";
		$data_p = mysql_query($sql);
		print "<table class=\"clients\"><tr><td>Client ID</td><td>Name</td><td>License Number</td><td>Policy Number</td></tr>";
		while($info = mysql_fetch_array( $data_p )){
			print "<tr><td><a href='client.php?action=update&client=".$info['Client_ID']."'>".$info['Client_ID']."</a></td><td>";
			print $info['FName']." ".$info['MName']." ".$info['LName']."</td><td>";
			print $info['License_No']."</td><td>";
			print "<a href='policy.php?action=update&policy=".$info['Policy_No']."&type=";
			if($info['Company'] == 0 || $info['Company'] == null) { // Private Policy if true
				print "1'>P".$info['Policy_No']."</a></td>";
			} else { // Company Policy since false
				print "0'>C".$info['Policy_No']."</a></td>";
			}
			$this->printOptions($info['Client_ID']);
			print "</tr>";
		}
		print "</table>";
	}

	/**
	 * 
	 * Updates Clients of a company to a new company policy when the policy of that company changes.
	 * @param unknown_type $companyno
	 * @param unknown_type $newpolicyno
	 */
	static function updateCompanyPolicy($companyno, $newpolicyno) {
		$sql = "";
		$sql="UPDATE Client SET Policy_No='$newpolicyno'";
		$sql = $sql." WHERE Company='$companyno'";
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}
	
	/**
	 * Returns the number of total # of Clients
	 */
	function totalClients(){
		$data = mysql_query("SELECT * FROM Client") or die(mysql_error());
		return $rows = mysql_num_rows($data);
	}

	/**
	 * Search clients by ID, return an array of the result
	 */
	function searchbyId($clientid){
		$sql = "SELECT * FROM Client WHERE Client_ID = '$clientid'";
		$result = mysql_query($sql);
		$i = 0;
		$toReturn;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //Use assoc, because otherwise we'll get duplicates
			$toReturn[$i] = $info; //Add the results into an array for us to read
			$i++;
		}
		return $toReturn;
	}

	/**
	 * Search for clients using any attribute in the array, uses LIKE in mysql for wildcards
	 */
	function searchByInfo($array){
		$sql = "SELECT * FROM Client WHERE";
		$keys = array_keys($array);
		for ($i = 0; $i< count($keys); $i++){
			if ($i==0){
				$sql = $sql." ".$keys[$i]." LIKE '".$array[$keys[$i]]."'";
			} else {
				$sql = $sql." AND ".$keys[$i]." LIKE '".$array[$keys[$i]]."'";
			}
		}
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){//While more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
	}

	/**
	 * function that formats an array into a table.
	 * this should work for all 2D arrays.
	 * @param unknown_type $array
	 * @param boolean $printoptions Set whether to display delete, update, etc functions
	 */
	function display2DArray($array,$printoptionsflag){
		if($array==null){
			print "No results were found!";
		} else {
			print "<table class=\"clients\"><tr>";
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
				if ($printoptionsflag){
					$this->printOptions($array[$j]['Client_ID']);
				}
				print "</tr>\n";
			}
			print "</table>\n";
		}
	}

	/**
	 * Print out options to delete, or update the client
	 * @param $clientid
	 * @return unknown_type
	 */
	function printOptions($clientid){
		print "<td><a href=\"client.php?action=remove&client=$clientid\">X</a></td>\n";
		print "<td> <a href=\"client.php?action=update&client=$clientid\">Edit</a></td>\n";
		print "<td><a href=\"vehicle.php?action=add&client=$clientid\">Add vehicle</a></td>\n";
		print "<td><a href=\"tickets.php?action=add&client=$clientid\">Add ticket</a></td>\n";
	}

	/**
	 * Deletes a client based on client id, return true if it was successful
	 */
	function deleteClient($clientid){
		$sql="DELETE FROM Client WHERE Client_ID='$clientid'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	/**
	 * Prints a form containing the original values in the database for updating
	 * @param unknown_type $clientid
	 */
	function printUpdateForm($clientid){
		$sql = "SELECT * FROM Client WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
		include 'includes/editclient.php';
	} //CLOSE print update form

	/**
	 * update the client information using data contained in the array. The Array keys must be associative
	 * @return unknown_type
	 */
	function updateClient($clientid, $array){
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
	}

	/**
	 * Validate form data, returns true if all data meets the criteria
	 */
	function validateData($array){
		$errorFlag=true;
		$currentDate = getdate(); //get current date
		if (trim($array['FName'])==''){
			$this->appendErrorMsg("First Name is required");
			$errorFlag = false;
		}
		if (trim($array['LName'])==''){
			$this->appendErrorMsg("Last Name is required");
			$errorFlag = false;
		}
		if (trim($array['License_No'])==''){
			$this->appendErrorMsg("License number is required");
			$errorFlag = false;
		}
		if (trim($array['Birthdate'])==''){
			$this->appendErrorMsg("Birthdate cannot be blank");
			$errorFlag = false;
		} else if (!preg_match("/^[0-9]{4,4}[-][0-1]{1,2}?[0-9]{1,2}[-][0-3]{1,2}?[0-9]{1,2}$/", $array['Birthdate'])){
			$this->appendErrorMsg("Date should be in the format yyyy-mm-dd");
			$errorFlag = false;
		} else if (getAge($array['Birthdate'])<16 || getAge($array['Birthdate'])> 100){
			$this->appendErrorMsg("Sorry, we do not provide coverage to drivers under the age of 16 or over the age of 100");
			$errorFlag = false;
		}
		if (trim($array['PostalCode'])==''){
			$this->appendErrorMsg("Postal Code is required");
			$errorFlag = false;
		} else if (!preg_match("/^[A-Za-z]{1}\d{1}[A-Za-z]{1}\d{1}[A-Za-z]{1}\d{1}$/",$array['PostalCode'])){
			$this->appendErrorMsg("Postal Code should be in the format A1B2C3");
			$errorFlag = false;
		}
		if (trim($array['Phone'])==''){
			$this->appendErrorMsg("Phone number is required");
			$errorFlag = false;
		} else if (!preg_match("/^[0-9]{10}$/",$array['Phone'])){
			$this->appendErrorMsg("Phone number must be in the format xxx-xxx-xxxx or xxxxxxxxx");
			$errorFlag = false;
		}
		if (!preg_match("/^[0-9]{1,}$/", $array['Years_Exp'])){
			$this->appendErrorMsg("Please input the number of Years of Experience");
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
