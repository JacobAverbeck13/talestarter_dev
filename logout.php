<?php 

include "template.php"; 
$_SESSION["user_id"] = -1;
header("Location: home.php"); /* Redirect browser */
exit();
?>
