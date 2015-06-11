<?php 

include "template.php"; 
$_SESSION["user_id"] = -1;
header("Location: login.php"); /* Redirect browser */
exit();
?>
