<?php
require 'db.php';
require 'config.php';
require $includesfolder.'functions.php';
include $includesfolder.'header.php';

$tbl_name = "Employees";

// username and password sent from form
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE Username='$myusername' and Password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count = mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register session and redirect to file "login_success.php"
$_SESSION['user']= $myusername;
$_SESSION['permission'] = $result['Permissions'];
?>

<!-- Login was successful -->
<p>Login successful!</p><a href="index.php">Back to index</a>

<?php
}
else {
?>

<!-- Error logging in -->
<p>Wrong Username or Password!</p>
<a href="index.php">Back to index</a>

<?php
}

include $includesfolder.'footer.php';
?>