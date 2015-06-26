<?php
	include "template.php";
	validate_login(-1,true);
if(isset($_POST['create']) && $_POST['create']=="true"){
	
	$title = sql_escape($_POST['t_title']);
	$tags = sql_escape($_POST['tags']);
	$task = sql_escape($_POST['t_task']);
	$story_id = sql_escape($_POST['owning_story']);
	$user_id = $_SESSION['user_id'];
	
	if(validate_login($user_id,false)){
	$query2 = "INSERT INTO `tasks`
	(`id`, `owner_id`, `story_id`, `tags`,`title`,  `task`) 
	VALUES (NULL, '$user_id', '$story_id', '$tags', '$title' , '$task');";	
	$task_id = db_insert($query2);	
		if($task_id > 0){
			//redirect to the edit file.
			header("Location: home.php"); /* Redirect browser */
			exit();
		}else{
			echo "query failed";
		}
	}else{
		echo "Couldn't validate user ID.";
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
			<h1>New Task</h1>
			<form action="" method="POST">
				<table>
				<tr><td>Task Title : </td><td><input type="text" name="t_title"></td></tr>
				<tr><td>Owning Story: </td><td>';
				//print a select box of each of the owners stories.
				$query = "SELECT * FROM `story_info` WHERE `owner_id` = '".$_SESSION['user_id']."'";
				$user_stories = db_select_multi($query);		
				echo "<select name='owning_story'>";
				foreach($user_stories as $story){
					echo "<option value='".$story["s_info_id"]."'>".$story["title"]."</option>";
				} 
				
				echo '</td></tr>
				<tr><td>Tags: (separated by a space) </td><td><input type="text" name="tags" placeholder="description item "></td></tr>
				<tr><td>Task Description/Requirements : </td><td><textarea class="ckeditor" id="editor1" name="t_task" rows="10" cols="50"></textarea></td></tr>
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