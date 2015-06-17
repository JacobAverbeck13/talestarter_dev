<?php
	include "template.php";
	validate_login(-1,true);
	echo '<script src="ckeditor/ckeditor.js"></script>';
	
if(isset($_GET['s_id']) && $_GET['s_id'] > 0){
	if(isset($_POST['save']) && $_POST['save']=="true"){
		$text = addslashes($_POST['s_text']);
		$story_info_id = $_SESSION['s_i']["s_info_id"];
		if(validate_login($_SESSION["s_i"]["owner_id"],false)){ //make sure that you own this story
			//add new story text in order to keep revisions
			$query1 = "INSERT INTO `story`
			(`story_id`, `text`, `created_on`)
			VALUES (NULL, '$text', CURRENT_TIMESTAMP);";
			$story_id = db_insert($query1);
			$story_id2 = $_SESSION['s_i']["story_id"];
			$story_id3 = $_SESSION['s_i']["second_version"];
			$story_remove = $_SESSION['s_i']["third_version"];
			unset($_SESSION['s_i']);
			//update the story info table with the new revision
			if($story_id > 0){
				$query2 = "UPDATE `story_info` SET
				`story_id` = '$story_id' , `second_version` = '$story_id2' , `third_version`='$story_id3'
				WHERE `s_info_id` = '$story_info_id';";	
				$story_info_id = db_insert($query2);
				
				$query2 = "DELETE FROM `story`
				WHERE `story_id` = '$story_remove';";	
				db_update($query2);
			}
		}
		
	}
	print_header();
	//pull current story id
	$story_info_id = $_GET['s_id'];
	$query = "SELECT * FROM `story_info` WHERE `s_info_id` = '$story_info_id'";
	$story_info = db_select($query);
	$_SESSION['s_i'] = $story_info;
	$story_id = $story_info["story_id"];
	//pull story text
	$query = "SELECT `text` FROM `story` WHERE `story_id` = '$story_id'";
	$story = db_select($query);
	echo '
	 <div class="container-fluid">
	 <div class="col-lg-12"><a href="home.php" class="btn btn-info" role="button">< Home</a></br></br></div>
		<div class="row">
			<div class="col-lg-12">
			<style>
			td{
				padding: 10px;
			}
			</style>
			<h1>Edit '. stripslashes($story_info['title']).'</h1>
			<div class="col-lg-8">
			<form action="" method="POST">
				<table>
				<tr><td><textarea class="ckeditor" cols="80" id="editor1" name="s_text" rows="10">'. stripslashes($story['text']).'</textarea></td></tr>
				<tr><td><button class="btn btn-info" role="button" name="save" value="true">Save</button></td></tr>
				</table>
				<hidden name="story_info_id" value="'.$story_info_id.'"></hidden>
			</form>
			</div>
			<a href="story_view.php?s_id='.$story_info_id.'" class="btn btn-info" role="button">View</a>
			<script>
				CKEDITOR.inline( "story-body" );
			</script>
			</div>
		</div>
	</div>';
}else{
	print_header();
	echo '
	 <div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			<style>
			td{
				padding: 10px;
			}
			</style>
			<h1>Edit Story</h1>
			Error: story identification missing.
			</div>
		</div>
	</div>';
}
?>

<?php
	print_footer();
?>