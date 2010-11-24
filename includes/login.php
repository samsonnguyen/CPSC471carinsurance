<?php
include 'config.php'; 
?>
<form name="form1" method="post" action="checklogin.php">
	<fieldset>
		<legend>Please login to access the database</legend>
		<label for="myusername">Username</label><br />
		<input name="myusername" type="text" id="myusername"><br />
		<label for="mypassword">Password</label><br />
		<input name="mypassword" type="password" id="mypassword"><br />
		<input type="submit" name="Submit" value="Login"> 
	</fieldset>
</form>

