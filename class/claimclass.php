<?php
class Claim{
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
	
	
	function deleteClaim($claimID){
		$sql="DELETE FROM Claim WHERE Claim_No='$claimID'";
		mysql_query($sql) or die(mysql_error());
		return true;
	}
	
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
			print "</tr>";
		}
		print "</table>";
	}
	
	function totalClaims(){
		$data = mysql_query("SELECT * FROM Claim") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
	}
}
?>