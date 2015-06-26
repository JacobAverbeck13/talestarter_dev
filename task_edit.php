<?php
	include "template.php";
	validate_login(-1,true);
if(isset($_POST['save']) && $_POST['save']=="true"){
	
	$title = sql_escape($_POST['t_title']);
	$tags = sql_escape($_POST['tags']);
	$task = sql_escape($_POST['t_task']);
	$story_id = sql_escape($_POST['owning_story']);
	$user_id = $_SESSION["t_info"]["owner_id"];
	
	if(validate_login($user_id,false)){
	$query2 = "UPDATE `tasks` SET
	 `owner_id` = '$user_id', `story_id` = '$story_id', `tags` = '$tags', `title` ='$title',  `task` ='$task'
	  WHERE `id`=".$_SESSION["t_info"]["id"].";";	
	$task_update = db_update($query2);	
	unset($_SESSION["t_info"]);
		if($task_update){
			//redirect to the edit file.
			header("Location: home.php"); /* Redirect browser */
			exit();
		}else{
			echo "Update failed";
		}
	}else{
		echo "Couldn't validate user ID.";
	}
	
}else{
	print_header();
	if(isset($_GET["t_id"]) && $_GET["t_id"] > 0){
		$query = "SELECT * FROM `tasks` WHERE `id` = '".$_GET['t_id']."'";
		$task = db_select($query);	
		$_SESSION["t_info"] = $task;
		if(validate_login($task['owner_id'],false)){
			echo '
			 <div class="container-fluid">
				<div class="row">
					<div class="col-lg-8">
					<style>
					td{
						padding: 10px;
					}
					</style>
					<h1>Edit Task</h1>
					<form action="" method="POST">
						<table>
						<tr><td>Task Title : </td><td><input type="text" value = "'.$task["title"].'" name="t_title"></td></tr>
						<tr><td>Owning Story: </td><td>';
						//print a select box of each of the owners stories.
						$query = "SELECT * FROM `story_info` WHERE `owner_id` = '".$_SESSION['user_id']."'";
						$user_stories = db_select_multi($query);		
						echo "<select name='owning_story'>";
						foreach($user_stories as $story){
							if($task["story_id"] == $story["s_info_id"]){
							echo "<option selected value='".$story["s_info_id"]."'>".$story["title"]."</option>";	
							}else{
							echo "<option value='".$story["s_info_id"]."'>".$story["title"]."</option>";
							}
						} 
						
						echo '</td></tr>
						<tr><td>Tags: (separated by a space) </td><td><input type="text" value = "'.$task["tags"].'" name="tags" placeholder="description item "></td></tr>
						<tr><td>Task Description/Requirements : </td><td><textarea class="ckeditor" id="editor1" name="t_task" rows="10" cols="50">'.$task["task"].'</textarea></td></tr>
						<tr><td><button class="btn btn-info" role="button" name="save" value="true">Save</button></td></tr>
						</table>
					</form>
					</div></br></br></br><a href="home.php" class="btn btn-info" role="button">< Home</a>
				</div>
			</div>';
		}else{
			echo "Failed to validate user";
		}
	}
}
?>

<?php
	print_footer();
?>