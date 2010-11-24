<?php
include "config.php"
//link to client class for processing
?>

<form name="addclient" action="client.php" method="post">
Client ID<br />
<input type="text" name="clientid" /><br />
Address<br />
<input type="text" name="address" /><br />
Phone<br />	
<input type="text" name="phone" /><br />
Birthdate<br />
<input type="text" name="birthdate" /><br />
Licence Number<br />
<input type="text" name="licence_no" /><br />
Gender<br />
<input type="text" name="gender" /><br />
Age<br />	
<input type="text" name="age" /><br />
Company<br />
<input type="text" name="company" /><br />
Policy Number<br />
<input type="text" name="policy_no" /><br />
<input type="submit" name="submit" value="submit" />
</form>
