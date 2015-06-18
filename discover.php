<?php
	include "template.php";
	print_header();
	
	//$query = "SELECT * FROM `story_info` LIMIT 10";
	$query = "select a.`s_info_id`, a.`owner_id`, a.`story_id`, a.`title`, b.username 
				FROM story_info  a 
				LEFT JOIN users b ON a.`owner_id` = b.id LIMIT 10;";
	$user_stories = db_select_multi($query);		

	echo "
	 <div class='container-fluid'>
	 <div class='col-lg-7'></div><a href='home.php' class='btn btn-info' role='button'>< Home</a>
		<div class='row'>
			<div class='col-lg-12'>
			
			<h1>View New Stories</h1></br>";
	echo "<table class='col-lg-5'><th>Story Title</th><th>Author</th><th>Options</th>";
	foreach($user_stories as $story){
		echo "<tr>
		<td>
		".$story["title"]."</td> <td>".$story['username']."
		</td>
		<td>
		<a href='story_view.php?s_id=".$story["s_info_id"]."' class='btn btn-info' role='button'>View</a>
		</td>
		</tr>";
	}

	echo"</div></div></div>";
	print_footer();
?>