<?php
	require '../class/clientclass.php';
	
	$clientinstance = new Client();
	
	echo $clientinstance->listClients(); //Call function in client class //TODO THIS will NOT work since it
										// will return the mysql resource, we need to parse the mysql resource first
										// and still need to format the output.\
										// But this demonstrates how to call a function within a class.

?>