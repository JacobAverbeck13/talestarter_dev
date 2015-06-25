<?php
	include "template.php";
	validate_login(-1,true);
if(isset($_POST['create']) && $_POST['create']=="true"){
	
	$title = sql_escape($_POST['s_title']);
	$tags = sql_escape($_POST['tags']);
	$when = sql_escape($_POST['s_when']);
	$where = sql_escape($_POST['s_where']);
	$user_id = $_SESSION['user_id'];
	$query1 = "INSERT INTO `story`
	(`story_id`, `text`, `created_on`)
	VALUES (NULL, 'Empty Story', CURRENT_TIMESTAMP);";
	$story_id = db_insert($query1);
	if($story_id > 0){
	$query2 = "INSERT INTO `story_info`
	(`s_info_id`, `owner_id`, `story_id`, `title`,`tags`,  `when`, `where`) 
	VALUES (NULL, '$user_id', '$story_id', '$title', '$tags' , '$when', '$where');";	
	$story_info_id = db_insert($query2);	
		if($story_info_id > 0){
			//redirect to the edit file.
			header("Location: story_edit.php?s_id=".$story_info_id); /* Redirect browser */
			exit();
		}else{
			echo "query 2 failed";
		}
	}else{
		echo "query 1 failed";
	}
	
}else{
	print_header();
	echo '
	 <div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
			<style>
			td{
				padding: 10px;
			}
			</style>
			<h1>New Story</h1>
			<form action="" method="POST">
				<table>
				<tr><td>Story Title : </td><td><input type="text" name="s_title"></td></tr>
				<tr><td>Tags: (separated by a space) </td><td><input type="text" name="tags" placeholder="action adventure romance"></td></tr>
				<tr><td>Setting <b>When</b> : </td><td><textarea name="s_when" rows="10" cols="50"></textarea></td></tr>
				<tr><td>Setting <b>Where</b> : </td><td><textarea name="s_where" rows="10" cols="50"></textarea></td></tr>
				<tr><td><button class="btn btn-info" role="button" name="create" value="true">Create</button></td></tr>
				</table>
			</form>
			</div></br></br></br><a href="home.php" class="btn btn-info" role="button">< Home</a>
		</div>
	</div>';
}
?>

<?php
	print_footer();
?>