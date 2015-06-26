<?php 

include "template.php"; 

$query = "SELECT * FROM `task_response` WHERE `id` = '".$_GET['t_r_id']."'";
$task = db_select($query);	
if(validate_login($task["owner_id"],false)){
	$query = "DELETE FROM `task_response` WHERE `id`=".$task["id"].";";	
	$task_update = db_update($query);	
}
echo '<script>
window.setTimeout("window.close()", 1);
</script>';
?>