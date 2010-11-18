<?php
session_start();
session_destroy();

include 'header.php';
?>
<p>You are now logged out!</p>
Return to the <a href="index.php">homepage</a>
<?php
include 'footer.php';
?>