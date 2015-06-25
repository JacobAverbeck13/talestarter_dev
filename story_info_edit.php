<?php
	include "template.php";
	validate_login(-1,true);
if(isset($_POST['save']) && $_POST['save']=="true"){
	
	$title = sql_escape($_POST['s_title']);
	$tags = sql_escape($_POST['tags']);
	$when = sql_escape($_POST['s_when']);
	$where = sql_escape($_POST['s_where']);
	$story_info_id = $_SESSION['s_i']["s_info_id"];
	//validate user? again
	if(validate_login($_SESSION['s_i']["owner_id"],false)){
		//update not insert
	$query = "UPDATE `story_info` SET
	  `title` = '$title', `tags` = '$tags',  `when` = '$when', `where` = '$where' WHERE `s_info_id` = $story_info_id;";	
	$story_update = db_update($query);	
	unset($_SESSION['s_i']);
		if($story_update == true){
			//redirect to the edit file.
			header("Location: story_edit.php?s_id=".$story_info_id); /* Redirect browser */
			exit();
		}else{
			echo "update failed";
		}
	}else{
		echo "User id's don't match";
	}
	
}else{
	if(isset($_GET['s_id']) && $_GET['s_id']>0){
		//pull in info to prepoulate the fields.
		$story_info_id = $_GET['s_id'];
		$query = "SELECT * FROM `story_info` WHERE `s_info_id` = '$story_info_id'";
		$story_info = db_select($query);
		$_SESSION['s_i'] = $story_info;
		print_header();
		if(validate_login($story_info["owner_id"],false)){
			echo '
			 <div class="container-fluid">
				<div class="row">
					<div class="col-lg-8">
					<style>
					td{
						padding: 10px;
					}
					</style>
					<h1>Edit Story Info</h1>
					<form action="" method="POST">
						<table>
						<tr><td>Story Title : </td><td><input type="text" name="s_title" value="'.$story_info["title"].'"></td></tr>
						<tr><td>Tags: (separated by a space) </td><td><input type="text" name="tags" value="'.$story_info["tags"].'" placeholder="action adventure romance"></td></tr>
						<tr><td>Setting <b>When</b> : </td><td><textarea name="s_when" rows="10" cols="50" >'.$story_info["when"].'</textarea></td></tr>
						<tr><td>Setting <b>Where</b> : </td><td><textarea name="s_where" rows="10" cols="50" >'.$story_info["where"].'</textarea></td></tr>
						<tr><td><button class="btn btn-info" role="button" name="save" value="true">Save</button></td></tr>
						</table>
					</form>
					</div>
					</br></br></br></br>
					</br></br><a href="story_edit.php?s_id='.$story_info_id.'" class="btn btn-info" role="button">< Back To Story</a></br></br>
				</div>
			</div>';
		}else{
			echo '<div class="container-fluid">
			 <div class="col-lg-7"></div><a href="home.php" class="btn btn-info" role="button">< Home</a></br></br>
				<div class="row">
					<div class="col-lg-12">
					<h1>Edit Story Info</h1>
					Sorry it appears you are not the rightful owner of this story.
					</div>
				</div>
			</div>';
		}
	}
}
	print_footer();
?>