<?php
class Vehicle{
 	
	/**
	 * Add a new vehicle
	 * Enter description here ...
	 * @param unknown_type $VIN
	 * @param unknown_type $Year
	 * @param unknown_type $License_Plate_No
	 * @param unknown_type $Client_ID
	 */
	function addNewVehicle($array){
		//print "<BR/>";
		$keys = array_keys($array); //Return the keys of the array;
		//print_r (count($keys));
		$sql = "INSERT INTO Vehicle ("; //Set the first part of the SQL query
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
	
	function searchVehicleByClient($clientid){
		$sql = "SELECT * FROM Vehicle WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){
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
	function display2DArray($array,$printoptions){
		if($array==null){
			print "No vehicles were found!";
		} else {
			print "Vehicles<br/><table class=\"vehicles\"><tr>";
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
				if ($printoptions){
					$this->printOptions($array[$j]['VIN']);
				}
				print "</tr>\n";
			}
			print "</table>\n";
		}
	}
	
	/**
	 * Print out options to delete, or update the Vehicle
	 * @param $clientid
	 * @return unknown_type
	 */
	function printOptions($vehicleid){
		print "<td><a href=\"vehicle.php?action=remove&vehicle=$vehicleid\">X</a></td><td> <a href=\"vehicle.php?action=update&vehicle=$vehicleid\">Update</a></td>\n";
	}
	
	function printUpdateForm($vehicleVIN){
		$sql = "SELECT * FROM Vehicle WHERE VIN='$vehicleVIN'";
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
?>
<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addvehicle" id="fm-form" method="post" action="vehicle.php?action=update&form&vehicle=<?php print $vehicleVIN;?>" >
    <fieldset>
    <legend>Vehicle Information</legend>
    <div class="fm-req">
      <label for="fm-vin">VIN Number:</label>
      <input name="fm-vin" id="fm-vin" type="text" disabled <?php print "value=\"$vehicleVIN\"";?>/>
    </div>
    <div class="fm-req">

      <label for="fm-year">Year:</label>
      <input id="fm-year" name="fm-year" type="text" <?php print "value=\"".$info['Year']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-make">Make:</label>
      <input name="fm-make" id="fm-make" type="text" <?php print "value=\"".$info['Make']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-model">Model:</label>
      <input name="fm-model" id="fm-model" type="text" <?php print "value=\"".$info['Model']."\"";?>/>
    </div>
    <div class="fm-opt">
    	<label for="fm-trim">Trim:</label>
    	<input name="fm-trim" id="fm-trim" type="text" title="Trim (eg. base, sport, GS-R, LS, RS etc)" <?php print "value=\"".$info['Trim']."\"";?>/>
    </div>
     <div class="fm-opt">
    	<label for="fm-color">Color:</label>
    	<input name="fm-color" id="fm-color" type="text" title="Color max 10 characters" <?php print "value=\"".$info['Color']."\"";?>/>
    </div>
    <div class="fm-opt">
    	<label for="fm-value">Est. Value:</label>
    	<input name="fm-value" id="fm-value" type="text" <?php print "value=\"".$info['Value']."\"";?>/>
    </div>
    <div class="fm-licenseplate">
    	<label for="fm-licenseplate">License Plate No:</label>
    	<input name="fm-licenseplate" id="fm-licenseplate" type="text" <?php print "value=\"".$info['License_Plate_No']."\"";?>/>
    </div>
    <div class="fm-displacement">
    	<label for="fm-displacement">Displacement:</label>
    	<input name="fm-displacement" id="fm-displacement" type="text" <?php print "value=\"".$info['Displacement']."\"";?>/>
    </div>
    </fieldset>

    <fieldset>
    <legend>Vehicle Owner</legend>
    <div class="fm-req">
      <label for="fm-clientid">Client ID:</label>
      <input id="fm-clientid" name="fm-clientid" type="text"
      <?php print "value=\"".$info['Client_ID']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-mileage">Average Daily Miles:</label>
      <input id="fm-mileage" name="fm-mileage" type="text" <?php print "value=\"".$info['Ave_Daily_Miles']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-type">Type:</label>
      <select id="fm-type" name="fm-type">
        <option value="">Choose a type</option>
        <option value="1" <?php if ($info['Type']=="1") print "selected";?>>Passenger Car</option>
        <option value="2" <?php if ($info['Type']=="2") print "selected";?>>Minivan</option>
        <option value="3" <?php if ($info['Type']=="3") print "selected";?>>Truck</option>
        <option value="4" <?php if ($info['Type']=="4") print "selected";?>>Motorcyle</option>
        <option value="5" <?php if ($info['Type']=="5") print "selected";?>>Commercial Truck</option>
        <option value="6" <?php if ($info['Type']=="6") print "selected";?>>Other</option>
      </select>
    </div>
   <div class="fm-multi">
      <div class="fm-commercial">
      	<span>Commercial Vehicle</span>
        <label for="fm-commercial-false">
        <input name="fm-commercial" type="radio" id="fm-commericla-false" value="0" <?php if($info['Commercial']==0){print "checked";}?> />
       	No</label>
        <label for="fm-commercial-true">
        <input id="fm-commercial-true" name="fm-commercial" type="radio" value="1" <?php if($info['Commercial']==1){print "checked";}?> />
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
	 * update the client information
	 * @return unknown_type
	 */
	function updateVehicle($vehicleVIN, $array){
		$sql="UPDATE Vehicle SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE VIN='$vehicleVIN'";
		//print $sql."<br />\n";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	/**
	 * Removes a vehicle from the database
	 */
	function deleteVehicle($vehicleVIN){
		$sql="DELETE FROM Vehicle WHERE VIN='$vehicleVIN'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
	/**
	 * Returns the number of vehicles contained in the database
	 * @return unknown_type
	 */
	function totalVehicles(){
		$data = mysql_query("SELECT * FROM Vehicle") or die(mysql_error());
		return $rows = mysql_num_rows($data); 
	}
	
	/*
	 * Prints out a simple list of vehicles, sort by client id
	 */
	function listVehicles($offset,$limit){
		$returnString = array();
		$sql = "SELECT * FROM Vehicle ORDER BY Client_ID ASC LIMIT $offset, $limit ";
		$data_p = mysql_query($sql);
		print "<table class=\"vehicles\"><tr><td>Client ID</td><td>VIN</td><td>Year</td><td>Make</td><td>Model</td></tr>";
		while($info = mysql_fetch_array($data_p)){
			Print "<tr><td>".$info['Client_ID']."</td><td>".$info['VIN']."</td><td>".$info['Year']."</td><td>".$info['Make']."</td><td>".$info['Model']."</td>";
			$this->printOptions($info['VIN']);
			print "</tr>";
		}
		print "</table>";
	}
	
}//CLOSE vehicle class
?>