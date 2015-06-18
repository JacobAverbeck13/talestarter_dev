<?php
	include "template.php";
	print_header();
	if(validate_login(-1,false)){ //validate that 'someone' is logged in
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
			<h1>".$_SESSION['username']."'s Home</h1></br>";
	$query = "SELECT * FROM `story_info` WHERE `owner_id` = '".$_SESSION['user_id']."'";
	$user_stories = db_select_multi($query);		
	echo "<table class='col-lg-5'><th>Your Stories: Title</th><th>Options</th>";
	foreach($user_stories as $story){
		echo "<tr>
		<td>
		".$story["title"]."
		</td>
		<td>
		<a href='story_view.php?s_id=".$story["s_info_id"]."' class='btn btn-info' role='button'>View</a>
		<a href='story_edit.php?s_id=".$story["s_info_id"]."' class='btn btn-info' role='button'>Edit</a>
		</td>
		</tr>";
	}
	echo "</table>";
	echo "<div class='col-lg-12'></br></br><a href='story_new.php' class='btn btn-info' role='button'>New Story</a></div>";
	echo"</div></div></div>";
	
	}else{
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
			<h1>Welcome To TaleStarter</h1>
			</br>
			<p class='col-lg-5' style='font-size:18px;'>
			&nbsp;&nbsp;&nbsp;&nbsp;
					This website is designed to help writers quickly compose quality stories based
			 on a collaborative task force comprised of new, casual and professional writers. 
			 As new stories are created using this site, visitors will be allowed to read and vote on them. 
			 This will allow for free publicity for authors as well as quick feedback on their stories
			 prior to hiring an editor or publisher.
			  </br></br>
			 <a href='more_info.php' class='btn btn-info' role='button'>More Info</a>
			 <a href='discover.php' class='btn btn-info' role='button'>View Stories</a>
			 </p>

			</div>
		</div>
	</div>";
	}
	print_footer();
?>