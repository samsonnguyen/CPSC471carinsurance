<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<title>CPSC471 Car Insurance Management</title>
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
				<!-- Clients -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="client.php">Clients</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Clients</a>';
					}				 
				?>						
					<ul>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="client.php?action=add">Add Client</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Add Client</a>';
							}				 
						?>								
						</li>
						<!-- added the search function not sure if i should remove the update and remove items above ^^^ -->
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="client.php?action=search">Search Clients</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Search Clients</a>';
							}				 
						?>								
						</li>
					</ul>
				</li>
				<!-- Vehicles -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="vehicle.php">Vehicles</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Vehicles</a>';
					}				 
				?>						
					<ul>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="vehicle.php?action=add">Add Vehicle</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Add Vehicle</a>';
							}				 
						?>								
						</li>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="vehicle.php?action=search">Search Vehicles</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Search Vehicles</a>';
							}				 
						?>								
						</li>
					</ul>
				</li>
				<!-- Premiums -->
				<!-- INCOMPLETE -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="premium.php"></a>';
					}
					else {
						echo '<a href="index.php?action=invalid"></a>';
					}				 
				?>					
				</li>
				<!-- Claims -->	
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="claim.php">Claims</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Claims</a>';
					}				 
				?>						
					<ul>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="claim.php?action=add">Add Claim</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Add Claim</a>';
							}				 
						?>							
						</li>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="claim.php?action=search">Search Claims</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Search Claims</a>';
							}				 
						?>								
						</li>
					</ul>
				</li>
				<!-- Tickets -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="tickets.php">Tickets</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Tickets</a>';
					}				 
				?>				
					<ul>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="tickets.php?action=add">Add Ticket</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Add Ticket</a>';
							}				 
						?>
						</li>
						<li>
						<?php
							if(isLoggedIn()) {
								echo '<a href="tickets.php?action=search">Search Tickets</a>';
							}
							else {
								echo '<a href="index.php?action=invalid">Search Tickets</a>';
							}				 
						?>
						</li>
					</ul>
				</li>
				<!-- Policy -->
				<!-- INCOMPLETE -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="policy.php">Policies</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Policies</a>';
					}				 
				?>
				</li>
				<!-- Company -->
				<!-- INCOMPLETE -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="company.php">Companies</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Companies</a>';
					}				 
				?>
				</li>
				<!-- Managers -->
				<!-- INCOMPLETE -->
				<li>
				<?php
					if(isLoggedIn()) {
						echo '<a href="manager.php">Managers</a>';
					}
					else {
						echo '<a href="index.php?action=invalid">Managers</a>';
					}				 
				?>
				</li>
				<!-- Logout -->
				<?php
					if(isLoggedIn()){
						echo '<li><a href="logout.php">Logout</a></li>';
					}
				?>
			</ul>
		</div><!-- //MENU -->
		
		<div id="content"><!-- Anything below this line will be the content -->
