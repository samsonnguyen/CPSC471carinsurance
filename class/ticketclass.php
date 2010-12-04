<?php
class Ticket{

		function addNewTicket($array){

		//print "<BR/>";
		$keys = array_keys($array); //Return the keys of the array;
		//print_r (count($keys));
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
		//print $sql."<br />";
		mysql_query($sql) or die(mysql_error());
		return true;

		}

		
		//delete a ticket from the databse	
		function deleteTicket($infraction_no){
		$sql="DELETE FROM Ticket WHERE Infraction_No='$infraction_no'";
		mysql_query($sql) or die(mysql_error());
		return true;
		}
		
		//update ticket information
		function updateTicket($infraction_no,$newTicketInfo){
		echo 'update ticket';
		}
		
		//prints the form for update
		function printUpdateForm($infraction_no){
		echo 'print update form';
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
				print "<a href=\"ticket.php?action=update&ticket=".$info['Infraction_No']."\">".$info['Infraction_No']."</a>";
			} else {
				print $info['Infraction_No'];
			}
			print "</td><td>".$info['Client_ID']."</td><td>".$info['Officer_Name']."</td><td>".$info['Officer_No']."</td><td>".$info['Classification']."</td><td>".$info["Date"]."</td>";
			$this->printOptions($info['Infraction_No']);
			print "</tr>";
		}
		print "</table>";
		}

		function printOptions($infraction_no){
		print "<td><a href=\"tickets.php?action=remove&ticket=$infraction_no\">X</a></td><td> <a href=\"tickets.php?action=update&ticket=$infraction_no\">Update</a></td>\n";
		}

		function totalTickets(){

		$data = mysql_query("SELECT * FROM Ticket") or die(mysql_error());
		return mysql_num_rows($data); //count the number of results and return
		}



}


?>
