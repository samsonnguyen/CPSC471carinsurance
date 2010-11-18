<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
	<title>CPSC471 Car insurance managment</title>
	<link rel="stylesheet" type="text/css" href="css/page.css" />
</head>
<body>
<div id="topshadow"></div>
<div id="page-wrapper">
	<div id="page">
		<!-- HEADER -->
		<div id="header">
			<a href="index.php"><h2><?php echo $sitename;?></h2></a>
		</div>
		<!-- HEADER -->
		<div class="menu">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="client.php">Client</a>
					<ul>
						<li><a href="addclient.php">Add Client</a></li>
						<li><a href="removeclient.php">Remove Client</a></li>
						<li><a href="updateclient.php">Update Client</a></li>
					</ul>
				</li>
				<li><a href="vehicles.php">Vehicles</a>
					<ul>
						<li><a href="addvehicle.php">Add new vehicle</a></li>
						<li><a href="removevehicle.php">Remove vehicle</a></li>
						<li><a href="updatevehicle.php">Update vehicles</a></li>
					</ul>
				</li>
				<li><a href="premium.php"></a></li>
				<li><a href="claims.php">Manage Claims</a></li>
				<li><a href="manager.php">Managers</a></li>
			</ul>
		</div><!-- //HEADER -->
		<div id="content"><!-- Anything below this line will be the content -->