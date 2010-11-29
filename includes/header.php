<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<title>CPSC471 Car insurance managment</title>
	<link rel="stylesheet" type="text/css" href="css/page.css" />
</head>
<body>
<!--<div id="topshadow"></div>-->
<div id="page-wrapper">
	<div id="page">
		<!-- HEADER -->
		<div id="header">
			<a href="index.php"><h2><?php echo $sitename;?></h2></a>
		</div>
		<!-- //HEADER -->
		
		<!-- menu starts here -->
		<div class="menu">
			<ul>
				<li><a href="index.php">Home
				<?php
					if(!isLoggedIn()){
						echo '/Login';
					}
				?>
				</a></li>
				<li><a href="client.php">Client</a>
					<ul>
						<li><a href="client.php?action=add">Add Client</a></li>
						<li><a href="client.php?action=remove">Remove Client</a></li>
						<li><a href="client.php?action=update">Update Client</a></li>
						<!-- added the search function not sure if i should remove the update and remove items above ^^^ -->
						<li><a href="client.php?action=search">Search for Client</a></li>
					</ul>
				</li>
				<li><a href="vehicle.php">Vehicles</a>
					<ul>
						<li><a href="vehicle.php?action=add">Add new vehicle</a></li>
						<li><a href="vehicle.php?action=remove">Remove vehicle</a></li>
						<li><a href="vehicle.php?action=update">Update vehicles</a></li>
					</ul>
				</li>
				<li><a href="premium.php"></a></li>
				<li><a href="claims.php">Manage Claims</a></li>
				<li><a href="manager.php">Managers</a></li>
				<?php
					if(isLoggedIn()){
						echo '<li><a href="logout.php">Logout</a></li>';
					}
				?>
			</ul>
		</div><!-- //MENU -->
		
		<div id="content"><!-- Anything below this line will be the content -->