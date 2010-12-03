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

		}}else if($_GET['action']=='search'){
			echo 'search ticket';
		}else { 
			echo 'tickets';
		}
}
?>
