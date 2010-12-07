<?php
require 'db.php';
require 'config.php';
require $classfolder.'ticketclass.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';


	if (isLoggedIn() && (getUserPermissions()=='1')){
		$ticketinstance = new Ticket();	//create new ticket instance
		if ($_GET['action']=='add'){
			if (isset($_GET['form'])){
				$newTicketInfo['Client_ID'] = $_POST['fm-clientid'];
				$newTicketInfo['Infraction_No'] = $_POST['fm-infraction_no'];
				$newTicketInfo['Officer_Name'] = $_POST['fm-officer_name'];
				$newTicketInfo['Officer_No'] = $_POST['fm-officer_no'];
				$newTicketInfo['Classification'] = $_POST['fm-classification'];
				$newTicketInfo['Date'] = $_POST['fm-year'].$_POST['fm-month'].$_POST['fm-day'];
				if ($ticketinstance->addNewTicket($newTicketInfo)>0){
					print "Ticket ".$_POST['fm-Infraction_Number']." added successfully!\n";
				} else {
					print "Error occured";
				}
			} else {
				include $includesfolder.'addticket.php';
			}	
		}
		else if ($_GET['action']=='remove'){
		//Remove the ticket
		$infraction_no=$_GET['ticket'];
		if ($infraction_no==null){
			print "Error, ticket cannot be null";
		} else {
			if ($ticketinstance->deleteTicket($infraction_no)){
				print "Ticket ".$infraction_no." removed successfully!";
			} else {
				print "ERROR: Ticket ".$infraction_no." could not be removed!";
			}
		}
	


		} else if ($_GET['action']=='update'){
		//Update ticket
		$infraction_no= $_GET['ticket'];
		if ($infraction_no==null){
			print "Error, ticket cannot be null";
		} else {
			if (isset($_GET['form'])){
				//This is a return call from the form, we do an update on the database
			$newTicketInfo['Client_ID'] = $_POST['fm-clientid'];
			$newTicketInfo['Infraction_No'] = $_POST['fm-infraction_no'];
			$newTicketInfo['Officer_Name'] = $_POST['fm-officer_name'];
			$newTicketInfo['Officer_No'] = $_POST['fm-officer_no'];
			$newTicketInfo['Classification'] = $_POST['fm-classification'];
			$newTicketInfo['Date'] = $_POST['fm-date'];
				
				if ($ticketinstance->updateTicket($infraction_no,$newTicketInfo)){
					print "Ticket ".$infraction_no." successfully updated<br />\n";
					print "<a href=\"tickets.php?action=update&ticket=".$infraction_no."\">Return</a>\n";
				} else {
					print "Error occured, please check your input";
				}
			} else {
				//We cant to display an update form and get information
				$ticketinstance->printUpdateForm($infraction_no);
			}
		}
	}

	else if ($_GET['action']=='search'){
		if ($_GET['form']=='client'){
			//Search by client
			$tickets = $ticketinstance->searchByClient($_POST['fm-clientID']);
			$ticketinstance->display2DArray($tickets, true);
		} else if ($_GET['form']=='infraction_no'){
			//Search by infraction number
			$tickets = $ticketinstance->searchByinfraction_no($_POST['fm-infraction_no']);
			$ticketinstance->display2DArray($tickets, true);
		}else if ($_GET['form']=='info'){
			//search by information
			$temp['Officer_Name'] = $_POST['fm-officer_name'];
			$temp['Officer_No'] = $_POST['fm-officer_no'];
			$temp['Classification'] = $_POST['fm-classification'];
			$temp['Date'] = $_POST['fm-date'];
			//Check officer name
			if (strlen($temp['Officer_Name']) < 1){
				unset($temp['Officer_Name']);
			} else {
				$temp['Officer_Name'] = convertToLike($temp['Officer_Name']);
			}
			//check chech officer number
			if (strlen($temp['Officer_No']) < 1){ //empty
				unset($temp['Officer_No']);
			} else {
				$temp['Officer_No'] = convertToLike($temp['Officer_No']);
			}
			//check classification
			if (strlen($temp['Classification']) < 1){ //empty
				unset($temp['Classification']);
			} else {
				$temp['Classification'] = convertToLike($temp['Classification']);
			}
			//check date
			if (strlen($temp['Date']) < 1){ //empty
				unset($temp['Date']);
			} else {
				$temp['Date'] = convertToLike($temp['Date']);
			}
			$tickets = $ticketinstance->searchByInfo($temp);
			$ticketinstance->display2DArray($tickets, true); //display the result
		}
		else {
			//No form data, we display a form
			include $includesfolder."searchticket.php";
		}
	}		
	else {
		//Home, display a list of tickets and some statistics
		include $includesfolder."displayticketstats.php";
		}
		
		} else {
	//User is either not logged in, or has no permissions
	echo '<p><i><span style="color:red">Access Denied</span></i></p>'."\n";
	}
?>
