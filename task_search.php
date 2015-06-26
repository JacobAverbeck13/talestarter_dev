<?php
	include "database_connection.php";
	if(isset($_GET["search"])){

	$query = "select a.`id`, a.`story_id` , a.`title`, a.`tags`, b.`title`  as `s_title`
				FROM `tasks` a LEFT JOIN `story_info` b ON a.`story_id` = b.`s_info_id` WHERE a.`title` LIKE '%".sql_escape($_GET["search"])."%' OR a.`tags` LIKE '%".sql_escape($_GET["search"])."%' LIMIT 20;";
	$user_tasks = db_select_multi($query);	
		
		
	}else{
	
	$query = "select a.`id`, a.`story_id`, a.`title`, a.`tags`, b.`title` as `s_title`
				FROM `tasks` a LEFT JOIN `story_info` b ON a.`story_id` = b.`s_info_id` LIMIT 20;";
	$user_tasks = db_select_multi($query);	
	
	}

echo "<table class='col-lg-5'><th>Task: Title</th><th>Story</th><th>Tags</th><th>Options</th>";
if($user_tasks != false){
			
	foreach($user_tasks as $task){
		echo "<tr>
		<td>
		".$task["title"]."
		</td>
		<td>
		<a href='story_view.php?s_id='".$task["story_id"]."'>".$task["s_title"]."</a>
		</td>
		<td>
		".$task["tags"]."
		</td>
		<td>
		<a href='task_view.php?t_id=".$task["id"]."' class='btn btn-info' role='button'>View</a>
		</td>
		</tr>";
	}
			
}
echo "</table>";
?>