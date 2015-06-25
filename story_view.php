<?php
include "template.php";
	
print_header();
//pull current story id
$story_info_id = $_GET['s_id'];
$query = "SELECT * FROM `story_info` WHERE `s_info_id` = '$story_info_id'";
$story_info = db_select($query);

$story_id = $story_info["story_id"];
//pull story text
$query = "SELECT `text` FROM `story` WHERE `story_id` = '$story_id'";
$story = db_select($query);
echo '
 <div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
		<style>
		td{
			padding: 10px;
		}
		</style>
		<h1>'. stripslashes($story_info['title']).'</h1>
			<div class="col-lg-8"">
			<p>
			'. stripslashes($story['text']).'
			</p>
			</div><br><a href="home.php" class="btn btn-info" role="button">< Home</a></br></br></br>';
if(validate_login($story_info["owner_id"],false)){	
	echo '<a href="story_edit.php?s_id='.$story_info_id.'" class="btn btn-info" role="button">Edit</a>';			
}
echo'<hidden name="story_info_id" value="'.$story_info_id.'"></hidden>
		</form>
		</div>
	</div>
</div>';
?>

<?php
	print_footer();
?>