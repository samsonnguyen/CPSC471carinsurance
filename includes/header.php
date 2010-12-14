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
			<a href="index.php"><h2><?php echo $sitename;?></h2></a><br />
			<span>By: Devin Chollak, Malik Yussuf, Samson Nguyen</span>
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
						<!-- added the search function not sure if i should remove the update and remove items above ^^^ -->
						<li><a href="client.php?action=search">Search for Client</a></li>
					</ul>
				</li>
				<li><a href="vehicle.php">Vehicles</a>
					<ul>
						<li><a href="vehicle.php?action=add">Add new vehicle</a></li>
						<li><a href="vehicle.php?action=search">Search for vehicle</a></li>
					</ul>
				</li>
				<li><a href="premium.php"></a></li>
				<li><a href="claim.php">Manage Claims</a>
					<ul>
						<li><a href="claim.php?action=add">Add new claim</a></li>
						<li><a href="claim.php?action=search">Search for Claims</a></li>
					</ul>
				</li>
				<li><a href="tickets.php">Tickets</a>
					<ul>
						<li><a href="tickets.php?action=add">Add Ticket</a></li>
						<li><a href="tickets.php?action=search">Search for Ticket</a></li>
					</ul>
				</li>
				<li><a href="policy.php">Policy</a>
					<ul>
						<li><a href="policy.php?action=add">Add Policy</a></li>
						<li><a href="policy.php?action=search">Search for Policy</a></li>
					</ul>
				</li>
				<li><a href="company.php">Company</a>
					<ul>
						<li><a href="company.php?action=add">Add Company</a></li>
						<li><a href="company.php?action=search">Search for Company</a></li>
					</ul>
				</li>
				<li><a href="manager.php">Managers</a>
					<ul>
						<li><a href="manager.php?action=add">Add Employee</a></li>
						<li><a href="manager.php?action=search">Search for Employee</a></li>
						<li><a href="manager.php?action=setbase">Set Base Price</a></li>
						<li><a href="manager.php?action=premium">Adjust premiums</a></li>
					</ul>
				</li>
				<?php
					if(isLoggedIn()){
						echo '<li><a href="logout.php">Logout</a></li>';
					}
				?>
			</ul>
		</div><!-- //MENU -->
		
		<div id="content"><!-- Anything below this line will be the content -->
