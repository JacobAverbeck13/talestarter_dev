<?php
	include "database_connection.php";
	if(isset($_GET["search"])){
			//$query = "SELECT * FROM `story_info` LIMIT 10";
	$query = "select a.`s_info_id`, a.`owner_id`, a.`story_id`, a.`title`, a.`tags`, b.username 
				FROM story_info  a 
				LEFT JOIN users b ON a.`owner_id` = b.id WHERE a.`title` LIKE '%".sql_escape($_GET["search"])."%' OR a.`tags` LIKE '%".sql_escape($_GET["search"])."%' LIMIT 20;";
	$user_stories = db_select_multi($query);	
		
		
	}else{
	//$query = "SELECT * FROM `story_info` LIMIT 10";
	$query = "select a.`s_info_id`, a.`owner_id`, a.`story_id`, a.`title`, a.`tags`, b.username 
				FROM story_info  a 
				LEFT JOIN users b ON a.`owner_id` = b.id LIMIT 20;";
	$user_stories = db_select_multi($query);		
	}
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>";
	echo "<table class='col-lg-5'><th>Story Title</th><th>Author</th><th>Tags</th><th>Options</th>";
	if($user_stories != false){
		foreach($user_stories as $story){
			echo "<tr>
			<td>
			".$story["title"]."</td> <td><a href='profile.php?user_id=".$story['owner_id']."' >".$story['username']."</a>
			</td>
			<td>
			".$story["tags"]."
			</td>
			<td>
			<a href='story_view.php?s_id=".$story["s_info_id"]."' class='btn btn-info' role='button'>View</a>
			</td>
			</tr>";
		}
	}
	echo"</div></div></div>";
?>