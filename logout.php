<?php
require 'config.php';
session_start();
session_destroy();

include $includesfolder.'header.php';
?>
<p>You are now logged out!</p>
Return to the <a href="index.php">homepage</a>
<?php
include $includesfolder.'footer.php';
?>