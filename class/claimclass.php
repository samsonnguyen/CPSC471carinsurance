<?php
class Claim{
	/**
	 * Add a new claim
	 * @param unknown_type $array contains array of info
	 */
	function addNewClaim($array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Claim (Claim_No, "; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES (LAST_INSERT_ID(), ";
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		//Retrieve the newly inserted Claim_ID
		$claimid = mysql_query("SELECT LAST_INSERT_ID();") or die(mysql_error());//This will get the last insert's ID
		$claimid = mysql_fetch_row($claimid);
		//print($claimid[0]);
		return $claimid[0];//return the autoincrement value
	}

	/**
	 * Add a new third part
	 * @param unknown_type $array
	 */
	function addNewThirdParty($array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Third_Party ( "; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES ( ";
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	/**
	 * Add a mew Claims, array should have structure
	 * 	array['Client_ID']
	 * 	array['Claim_No'] = Claim number will always be unique in this table
	 *  array['VIN']
	 * @param unknown_type $array
	 */
	function addNewClaims($array){
		$keys = array_keys($array); //Return the keys of the array;
		$sql = "INSERT INTO Claims ( "; //Set the first part of the SQL query
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql.$keys[$i];
			} else {
				$sql = $sql.$keys[$i].",";
			}
		}
		$sql = $sql.") VALUES ( ";
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){//last value, do not include the comma
				$sql = $sql."'".$array[$keys[$i]]."');";
			} else {
				$sql = $sql."'".$array[$keys[$i]]."',";
			}
		}
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	/**
	 * Deletes a claim.
	 * Careful a Claim delete will cascade into Claims and thirdparty
	 * @param unknown_type $claimID
	 */
	function deleteClaim($claimID){
		$sql="DELETE FROM Claim WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		$sql="DELETE FROM Claims WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		$sql="DELETE FROM Third_Party WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}

	/**
	 * List the claim + thirdparty + claims
	 * Enter description here ...
	 * @param unknown_type $offset
	 * @param unknown_type $limit
	 */
	function listClaims($offset,$limit){
		$sql = "SELECT * FROM Claim ORDER BY Claim_No ASC LIMIT $offset, $limit ";
		print $sql;
		$data_p = mysql_query($sql);
		print "<table class=\"claim\"><tr><td class=\"td_claim\">Claim_No</td><td class=\"td_claim\">Amount</td>
		<td class=\"td_claim\">Date</td><td>Status</td><td class=\"td_claim\">At Fault</td><td class=\"thirdparty\">Name</td><td class=\"thirdparty\">Insurer</td><td class=\"thirdparty\">Phone</td><td class=\"claims\">Client ID</td><td class=\"claims\">VIN</td></tr>";
		while($info = mysql_fetch_array($data_p)){
			Print "<tr><td>";
			if (($info['Claim_No']!=null) || ($info['Claim_No']!=0)){
				print "<a href=\"claim.php?action=update&claim=".$info['Claim_No']."\">".$info['Claim_No']."</a>";
			} else {
				print $info['Claim_No'];
			}
			print "</td><td>".$info['Amount']."</td><td>".$info['Date']."</td><td>";
			switch($info['Status']){
				case '0':
					echo "Pending";
					break;
				case '1':
					echo "Completed";
					break;
				case '2':
					echo "Filed";
					break;
				case '3':
					echo "Declined";
					break;
			}

			print "</td><td>".$info['Client_At_Fault']."</td>";
			$sql = "SELECT Party_Name, Insurer_Name, Phone FROM Third_Party WHERE Claim_No='".$info['Claim_No']."';";
			//print $sql;
			$result = mysql_query($sql);
			if (is_resource($result)){
				$thirdpartyinfo = mysql_fetch_row($result);
			}
			print "<td>".$thirdpartyinfo['0']."</td><td>".$thirdpartyinfo['1']."</td><td>".$thirdpartyinfo['2']."</td>";
			$sql = "SELECT * FROM Claims WHERE Claim_No='".$info['Claim_No']."';";
			$result = mysql_query($sql);
			if (is_resource($result)){
				$claimsinfo = mysql_fetch_row($result);
			}
			print "<td>";
			if ($claimsinfo['0']!=null || $claimsinfo['0']>0){
				print "<a href=\"client.php?action=update&client=".$claimsinfo['0']."\">".$claimsinfo['0']."</a>";
			} else {
				print $claimsinfo['0'];
			}
			print "</td><td>";
			if ($claimsinfo['2']!=null){
				print "<a href=\"vehicle.php?action=update&vehicle=".$claimsinfo['2']."\">".$claimsinfo['2']."</a>";
			} else {
				print $claimsinfo['2'];
			}
			$this->printOptions($info['Claim_No']);//print the delete and edit links
			print "</tr>";
		}
		print "</table>";
	}

	/**
	 * Gets total amount of claims
	 * Enter description here ...
	 */
	function totalClaims(){
		$data = mysql_query("SELECT * FROM Claim") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
	}
	
	/**
	 * prints the option to delete and edit a claim/thirdparty/claims
	 * 
	 */
	function printOptions($claimID){
		print "<td><a href=\"claim.php?action=remove&claim=".$claimID."\">x</a></td>\n";
		print "<td><a href=\"claim.php?action=update&claim=".$claimID."\">Edit</a></td>\n";
	}

	/**
	 * Returns the an array Claims_No of all claims that have clientID = $clientID
	 * @param unknown_type $clientID
	 */
	function searchClaimsByClientID($clientID){
		$sql = "SELECT Claim_No FROM Claims WHERE Client_ID='$clientID'";
		$result = mysql_query($sql);
		$i = 0;
		$toReturn;
		while ($info = mysql_fetch_array($result,MYSQL_NUM)){ //Use num, because otherwise we'll get duplicates
			$toReturn[$i] = $info[0]; //Add the results into an array for us to read
			$i++;
		}
		return $toReturn;
	}
	
	/**
	 * Displays the form for editing the claim/thirdparty/claims
	 * Enter description here ...
	 * @param unknown_type $claimID
	 */
	function printUpdateForm($claimID){
		$sql = "SELECT * FROM Claim WHERE Claim_No='$claimID';";
		$result = mysql_query($sql);
		if (is_resource($result)){
			$claim = mysql_fetch_array($result, MYSQL_ASSOC); //Assume only one row
		}
		$sql = "SELECT * FROM Third_Party WHERE Claim_No='$claimID';";
		$result = mysql_query($sql);
		if (is_resource($result)){
			$thirdparty = mysql_fetch_array($result, MYSQL_ASSOC); //Assume only one row
		}
		$sql = "SELECT * FROM Claims WHERE Claim_No='$claimID';";
		$result = mysql_query($sql);
		if (is_resource($result)){
			$claims = mysql_fetch_array($result, MYSQL_ASSOC); //Assume only one row
		}
		include 'includes/editclaim.php';
	}

	/**
	 * Updates a claim with $claimID
	 * @param unknown_type $claimID
	 * @param unknown_type $array
	 */
	function updateClaim($claimID,$array){
		$sql="UPDATE Claim SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}
	/**
	 * Updates a thirdparty with $claimID
	 * @param unknown_type $claimID
	 * @param unknown_type $array
	 */
	function updateThirdParty($claimID,$array){
		$sql="UPDATE Third_Party SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}
	/**
	 * Updates a claims with $claimID
	 * @param unknown_type $claimID
	 * @param unknown_type $array
	 */
	function updateClaims($claimID,$array){
		$sql="UPDATE Claims SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		return true;//return true
	}
	
	/**
	 * Updates claim, claims and thirdparty. Return true is all updates are successful
	 * @param unknown_type $claimID
	 * @param unknown_type $newClaimInfo
	 * @param unknown_type $newThirdParty
	 * @param unknown_type $newClaims
	 */
	function updateAll($claimID, $newClaimInfo, $newThirdParty, $newClaims){
		if ($this->updateClaim($claimID,$newClaimInfo) &&
			$this->updateThirdParty($claimID, $newThirdParty) &&
			$this->updateClaims($claimID, $newClaims)){
				return true;
		} else {
			return false;
		}
	}
	
	/**
	 * Returns an array Claim_No of all claims that have VIN = $vin
	 * @param unknown_type $vin
	 */
	function searchClaimsByVIN($vin){
		$sql = "SELECT Claim_No FROM Claims WHERE VIN='$vin'";
		$result = mysql_query($sql);
		$i = 0;
		$toReturn;
		while ($info = mysql_fetch_array($result,MYSQL_NUM)){ //Use assoc, because otherwise we'll get duplicates
			$toReturn[$i] = $info[0]; //Add the results into an array for us to read
			$i++;
		}
		return $toReturn;
	}

	/**
	 * Returns an array of claims that match the claimsno in the argument
	 * Useful for multiple claims display
	 */
	function getClaims($claimNoArray){
		$toReturn;
		for ($i=0; $i<count($claimNoArray); $i++){ //for each claimNo
			$sql = "SELECT * FROM Claim WHERE Claim_No='".$claimNoArray[$i]."'";
			$result = mysql_query($sql);
			$toReturn[$i] = mysql_fetch_array($resultm, MYSQL_ASSOC); //Only need one row, since the Claim_No should be unique
		}
		return $toReturn; //return the resulting array
	}

	/**
	 * Return a single row from thirdpart with the Claim_No
	 * @param unknown_type $claimNo
	 */
	function getThirdParty($claimNo){
		$sql = "SELECT * FROM Third_Party WHERE Claim_No='$claimNo'";
		$result = mysql_query($sql);
		return mysql_fetch_array($result, MYSQL_ASSOC);
	}

}
?>