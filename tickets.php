<?php
require 'db.php';
require 'config.php';
require 'class/ticketclass.php';
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
			if ($ticketinstance->addNewTicket($newTicketInfo)){
				print "Ticket ".$_POST['fm-Infraction_Number']." added successfully!\n";
			} else {
				print "Error occured";
			}
			
		}else {
			include $includesfolder.'addticket.php';

		}


		}else if($_GET['action']=='search'){
			echo 'search ticket';
		


		}else if ($_GET['action']=='remove'){
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
			$newTicketInfo['Date'] = $_POST['fm-year'].$_POST['fm-month'].$_POST['fm-day'];
				
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
	

		else {
		//Home, display a list of tickets and some statistics
		include $includesfolder."displayticketstats.php";
		}
	}

	else {
	//User is either not logged in, or has no permissions
	echo 'Access denied';
	}
?>
