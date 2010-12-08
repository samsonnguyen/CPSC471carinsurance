<?php
class Client{
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
		$sql = "SELECT * FROM Client LIMIT $offset, $limit";
		$data_p = mysql_query($sql);
		print "<table class=\"clients\"><tr><td>Client ID</td><td>Name</td><td>Policy Number</td></tr>";
		while($info = mysql_fetch_array( $data_p )){
			Print "<tr><td>".$info['Client_ID']."</td><td>".$info['FName']." ".$info['MName']." ".$info['LName']."</td><td>".$info['Policy_No']."</td>";
			$this->printOptions($info['Client_ID']);
			print "</tr>";
		}
		print "</table>";
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
			$sql = $sql." ".$keys[$i]." LIKE '".$array[$keys[$i]]."'"; 
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
		print "<td><a href=\"client.php?action=remove&client=$clientid\">X</a></td><td> <a href=\"client.php?action=update&client=$clientid\">Edit</a></td>\n";
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
?>
		
<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addclient" id="fm-form" method="post" action="client.php?action=update&client=<?php print $clientid?>&form" >
    <fieldset>
    <legend>Personal information</legend>
    <div class="fm-opt">
    	<label for="fm-clientid">Client ID:</label>
    	<input name="fm-clientid" disabled id="fm-clientid" type="text" value="<?php print $clientid;?>"/>
    </div>
    <div class="fm-req">
      <label for="fm-firstname">First name:</label>
      <input name="fm-firstname" id="fm-firstname" type="text" value="<?php print $info['FName'];?>"/>
    </div>
    <div class="fm-opt">

      <label for="fm-middlename">Middle name:</label>
      <input id="fm-middlename" name="fm-middlename" type="text" value="<?php print $info['MName'];?>"/>
    </div>
    <div class="fm-req">
      <label for="fm-lastname">Last name:</label>
      <input name="fm-lastname" id="fm-lastname" type="text" value="<?php print $info['LName'];?>"/>
    </div>
    <div class="fm-req">
    	<label for="fm-license_no">License Number:</label>
    	<input name="fm-license_no" id="fm-license_no" type="text" value="<?php print $info['License_No'];?>"/>
    </div>
     <div class="fm-req">
    	<label for="fm-birthdate">Birthdate:</label>
    	<input name="fm-birthdate" id="fm-birthdate" type="text" title="Enter Birthdate in yyy-mm-dd format" value="<?php print $info['Birthdate'];?>"/>
    </div>
    <div class="fm-multi">
      <div class="fm-gender">
      	<span>Gender</span>
        <label for="fm-gender-male">
        <input name="fm-gender" type="radio" id="fm-gender-male" value="m" <?php if($info['Gender']=='m'){ print "checked=\"checked\"";} ?> />
        Male</label>
        <label for="fm-gender-female">
        <input id="fm-gender-female" name="fm-gender" type="radio" value="f" <?php if($info['Gender']=='f'){ print "checked=\"checked\"";} ?>/>
        Female</label>
      </div>
    </div>
    </fieldset>

    <fieldset>
    <legend>Address </legend>
    <div class="fm-opt">
      <label for="fm-addr">Address:</label>
      <input id="fm-addr" name="fm-addr" type="text" value="<?php print $info['Address'];?>"/>
    </div>
    <div class="fm-opt">
      <label for="fm-city">City or Town:</label>

      <input id="fm-city" name="fm-city" type="text" value="<?php print $info['City'];?>"/>
    </div>
    <div class="fm-opt">
      <label for="fm-province">Province:</label>
      <select id="fm-province" name="fm-province">
        <option value="" <?php if ($info['Province']=="") {print "selected";}?>>Choose a province</option>
        <option value="AB" <?php if ($info['Province']=="AB") {print "selected";}?>>Alberta</option>
        <option value="BC" <?php if ($info['Province']=="BC") {print "selected";}?>>British Columbia</option>
        <option value="NB" <?php if ($info['Province']=="NB") {print "selected";}?>>New Brunswick</option>
        <option value="NF" <?php if ($info['Province']=="NF") {print "selected";}?>>Newfoundland</option>
        <option value="NT" <?php if ($info['Province']=="NT") {print "selected";}?>>Northwest Territories</option>
        <option value="NS" <?php if ($info['Province']=="NS") {print "selected";}?>>Nova Scotia</option>
        <option value="ON" <?php if ($info['Province']=="ON") {print "selected";}?>>Ontario</option>
        <option value="PE" <?php if ($info['Province']=="PE") {print "selected";}?>>Prince Edward Island</option>
        <option value="PQ" <?php if ($info['Province']=="PQ") {print "selected";}?>>Quebec</option>
        <option value="SK" <?php if ($info['Province']=="SK") {print "selected";}?>>Saskatchewan</option>
        <option value="YT" <?php if ($info['Province']=="YT") {print "selected";}?>>Yukon Territory</option>
      </select>
    </div>
    <div class="fm-req">
      <label for="fm-postalcode">Zip code:</label>
      <input id="fm-postalcode" name="fm-postalcode" type="text" value="<?php print $info['PostalCode'];?>"/>
    </div>
    </fieldset>
    <fieldset>

    <legend>Contact information</legend>
    <div class="fm-req">
      <label for="fm-telephone">Telephone:</label>
      <input id="fm-telephone" name="fm-telephone" type="text" title="Enter Phone Number in xxxxxxxxxx format" value="<?php print $info['Phone'];?>"/>
    </div>
    </fieldset>
    <fieldset>
    <legend>Policy Information</legend>
    <div class="fm-req">
    	<label for="fm-policy">Policy Number</label>
    	<input id="fm-policy" name="fm-policy" type="text" value="<?php print $info['Policy_No'];?>"/>
    </div>
    <div class="fm-opt">
    	<label for="fm-company">Company</label>
    	<input id="fm-company" name="fm-company" type="text" value="<?php print $info['Company'];?>"/>
    </div>
    </fieldset>
        <fieldset>
    <legend>Driving History</legend>
    <div class="fm-req">
    	<label for="fm-yearsexp">Driving Experience (Years):</label>
    	<input name="fm-yearsexp" id="fm-yearsexp" type="text" title="Enter Birthdate in yyy-mm-dd format" value="<?php print $info['Years_Exp'];?>"/>
    </div>
    <div class="fm-multi">
      <div class="fm-training">
      	<span>Driver training</span>
        <label for="fm-trainingno">
        <input name="fm-training" type="radio" id="fm-trainingno" value="0" <?php if($info['Training']=='0'){ print "checked";} ?> />
        No</label>
        <label for="fm-trainingyes">
        <input id="fm-trainingyes" name="fm-training" type="radio" value="1" <?php if($info['Training']=='1'){ print "checked";} ?> />
        Yes</label>
      </div>
    </div>
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />

    </div>
  </form>
</div>

<?php 
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
	
}
?>
