<?php
	include "template.php";
	print_header();
	if(isset($_GET["user_id"]) && $_GET["user_id"] > 0){
		$query = "SELECT * FROM `users` WHERE `id` = '".$_GET["user_id"]."'";		
		//check for similar user name or password
		$profile = db_select($query);
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
			<h1>".$profile['username']."'s Profile</h1></br>";
	$query = "SELECT * FROM `story_info` WHERE `owner_id` = '".$profile['id']."'";
	$user_stories = db_select_multi($query);		
	echo "<table class='col-lg-5'><th>Your Stories: Title</th><th>Options</th>";
	foreach($user_stories as $story){
		echo "<tr>
		<td>
		".$story["title"]."
		</td>
		<td>
		<a href='story_view.php?s_id=".$story["s_info_id"]."' class='btn btn-info' role='button'>View</a>
		</td>
		</tr>";
	}
	echo "</table>";
	echo "<div class='col-lg-12'></br></br>";
	echo"</div></div></div>";
	}else{
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
			<h1>".$_SESSION['username']."'s Home</h1></br>";
	echo "<p>Profile ID is missing. Please ensure a valid id was used. </p>";
	echo "<div class='col-lg-12'></br></br><a href='story_new.php' class='btn btn-info' role='button'>New Story</a></div>";
	echo"</div></div></div>";	
	}
	
	print_footer();
?>