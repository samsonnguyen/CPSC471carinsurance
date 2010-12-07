<?php
class Ticket{


		/**
	 * Add a new ticket using an associative array.
	 * @param unknown_type $Client_ID
	 * @param unknown_type $Infraction_No
	 * @param unknown_type $Officer_Name
	 * @param unknown_type $Date
	 */
		function addNewTicket($array){

	
		$keys = array_keys($array); //Return the keys of the array;
	
		$sql = "INSERT INTO Ticket ("; //Set the first part of the SQL query
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
		
		mysql_query($sql) or die(mysql_error());
		return true;

		}

		
		


		//display result in an array
		function display2DArray($array, $printoptionsflag){
			if($array==null){
			print "No tickets were found!";
		} else {
			print "Tickets<br/><table class=\"tickets\"><tr>";
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
					$this->printOptions($array[$j]['Infraction_No']);
				}
				print "</tr>\n";
			}
			print "</table>\n";
		}
		}


		//search ticket by client id
		function searchByClient($clientid){
		$sql = "SELECT * FROM Ticket WHERE Client_ID='$clientid'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //while more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
		}


		
		//search tickets by infraction number
		function searchByinfraction_no($infraction_no){
		$sql = "SELECT * FROM Ticket WHERE Infraction_No='$infraction_no'";
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //while more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn;
		}
		

		
		//search client by information
		function searchByInfo($array){
		$sql = "SELECT * FROM Ticket WHERE";
		$keys = array_keys($array);
		for ($i = 0; $i< count($keys); $i++){
			$sql = $sql." ".$keys[$i]." LIKE '".$array[$keys[$i]]."'"; 
		}
		//print $sql;
		$result = mysql_query($sql) or die(mysql_error());
		$i = 0;
		while ($info = mysql_fetch_array($result,MYSQL_ASSOC)){ //While more results
			$toReturn[$i] = $info;
			$i++;
		}
		return $toReturn; //return 2D array of results
		}
		
		
		
		
		//delete a ticket from the databse	
		function deleteTicket($infraction_no){
		$sql="DELETE FROM Ticket WHERE Infraction_No='$infraction_no'";
		mysql_query($sql) or die(mysql_error());
		return true;
		}
		
		//update ticket information
		//@param return true if the query was a success
		function updateTicket($infraction_no,$array){
		$sql="UPDATE Ticket SET ";
		$keys = array_keys($array); //Return the keys of the array, use first element;
		for ($i=0;$i<count($keys);$i++){
			if ($i==(count($keys)-1)){ //last value, omit the comma
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."'";
			} else {
				$sql = $sql.$keys[$i]."='".$array[$keys[$i]]."', ";
			}
		}
		$sql = $sql." WHERE Infraction_No='$infraction_no'";
		//print $sql."<br />\n";
		mysql_query($sql) or die(mysql_error());
		return true;
		}
		
		
		
		//prints the form for update
		function printUpdateForm($infraction_no){
		$sql = "SELECT * FROM Ticket WHERE Infraction_No='$infraction_no'"; //Get the vehicle
		$result = mysql_query($sql) or die(mysql_error());
		$info = mysql_fetch_array($result,MYSQL_ASSOC);
?>
<div id="container">
  <!-- p id="fm-intro" required for 'hide optional fields' function -->
  <p id="fm-intro">Fields in <strong>bold</strong> are required.</p>

  <form name="addticket" id="fm-form" method="post" action="tickets.php?action=update&form&ticket=<?php print $infraction_no;?>" >
    <fieldset>
    <legend>Ticket Information</legend>
    <div class="fm-req">
      <label for="fm-clientid"><a href="client.php?action=update&client=<?php print $info['Client_ID']?>">Client ID:</a></label>
      <input id="fm-clientid" name="fm-clientid" type="text"
      <?php print "value=\"".$info['Client_ID']."\"";?>/>
    </div>
    <div class="fm-req">

      <label for="fm-infraction_no">Infraction Number:</label>
      <input id="fm-infraction_no" name="fm-infraction_no" type="text" <?php print "value=\"".$info['Infraction_No']."\"";?>/>
    </div>
    <div class="fm-req">
      <label for="fm-officer_name">Officer Name:</label>
      <input name="fm-officer_name" id="fm-officer_name" type="text" <?php print "value=\"".$info['Officer_Name']."\"";?>/>
    </div>
    <div class="fm-opt">
      <label for="fm-officer_no">Officer Number:</label>
      <input name="fm-officer_no" id="fm-officer_no" type="text" <?php print "value=\"".$info['Officer_No']."\"";?>/>
    </div>
    <div class="fm-opt">
    	<label for="fm-classification">Classification:</label>
    	<input name="fm-classification" id="fm-classification" type="text" title="" <?php print "value=\"".$info['Classification']."\"";?>/>
    </div>
	
	   <div class="fm-req">
    	<label for="fm-date">Date:</label>
    	<input name="fm-date" id="fm-date" type="text" title="" <?php print "value=\"".$info['Date']."\"";?>/>
    </div>
	
    </fieldset>
    <div id="fm-submit" class="fm-req">
      <input name="Submit" value="Submit" type="submit" />
    </div>
  </form>
</div>
<?php 
		}
		


		//list the tickets in a table format
		/**
	 	* Prints out a simple list of tickets, sort by infraction number, also display the option to update, 		 	  delete, etc.
	 	* @param offset Being where in the results
	 	* @param limit Limit the number of results
	 	*/
		function listTickets($offset,$limit){
		$returnString = array();
		$sql = "SELECT * FROM Ticket ORDER BY Infraction_No ASC LIMIT $offset, $limit";
		$result = mysql_query($sql);

		print "<table class=\"tickets\"><tr><td>Infraction Number</td><td>Client ID</td><td>Officer Name</td><td>Officer Number</td><td>Classification</td><td>Date</td></tr>";

		while($info = mysql_fetch_array($result)){
			Print "<tr><td>";
			if (($info['Infraction_No']!=null) || ($info['Infraction_No']!=0)){
				print "<a href=\"tickets.php?action=update&ticket=".$info['Infraction_No']."\">".$info['Infraction_No']."</a>";
			} else {
				print $info['Infraction_No'];
			}
			print "</td><td>";
			if (($info['Client_ID']!=null) || ($info['Client_ID']!=0)){
				print "<a href=\"client.php?action=update&client=".$info['Client_ID']."\">".$info['Client_ID']."</a>";
			} else {
				print $info['Client_ID'];
			}			
			print "</td><td>".$info['Officer_Name']."</td><td>".$info['Officer_No']."</td><td>".$info['Classification']."</td><td>".$info["Date"]."</td>";
			$this->printOptions($info['Infraction_No']);
			print "</tr>";
		}
		print "</table>";
		}
		





		//prints a link to the remove and edit options
		function printOptions($infraction_no){
		print "<td><a href=\"tickets.php?action=remove&ticket=$infraction_no\">X</a></td><td> <a href=\"tickets.php?action=update&ticket=$infraction_no\">Edit</a></td>\n";
		}




		//counts the number of tickets in the database
		function totalTickets(){

		$data = mysql_query("SELECT * FROM Ticket") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
		}



}


?>
