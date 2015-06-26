<?php
	include "database_connection.php";
	if(isset($_GET["search"])){

	$query = "select `id`,`title`,`tags` 
				FROM `tasks`  WHERE `title` LIKE '%".sql_escape($_GET["search"])."%' OR `tags` LIKE '%".sql_escape($_GET["search"])."%' LIMIT 20;";
	$user_tasks = db_select_multi($query);	
		
		
	}else{
	
	$query = "select `id`,`title`, `tags` 
				FROM `tasks` LIMIT 20;";
	$user_tasks = db_select_multi($query);	
	
	}
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>";

			echo "<div id='task_table' class='col-lg-12'>";	
			if($user_tasks != false){
			echo "<table class='col-lg-5'><th>Task: Title</th><th>Tags</th><th>Options</th>";
			foreach($user_tasks as $task){
				echo "<tr>
				<td>
				".$task["title"]."
				</td>
				<td>
				".$task["tags"]."
				</td>
				<td>
				<a href='task_view.php?t_id=".$task["id"]."' class='btn btn-info' role='button'>View</a>
				</td>
				</tr>";
			}
			echo "</table></div>";
			}
	echo"</div></div></div>";
?>