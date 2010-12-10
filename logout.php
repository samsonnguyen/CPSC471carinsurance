<?php
require 'config.php';
require $includesfolder.'functions.php';

/*
 * Destroy session data, which will logout the user
 */
session_start();
session_destroy();

//Display header
include $includesfolder.'header.php';
?>
<p>You are now logged out!</p>
Return to the <a href="index.php">homepage</a>
<?php
//Display footer
include $includesfolder.'footer.php';
?>