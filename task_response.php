<?php
	include "template.php";
	validate_login(-1,true);
if(isset($_POST['submit']) && $_POST['submit']=="true"){
	
	$task_id = $_SESSION["t_info"]["id"];
	$task = sql_escape($_POST['t_task']);
	$user_id = $_SESSION['user_id'];
	
	if(validate_login($user_id,false)){
	$query2 = "INSERT INTO `task_response`
	(`id`, `task_id`, `owner_id`, `response`) 
	VALUES (NULL, $task_id , '$user_id', '$task');";	
	$task_r_id = db_insert($query2);	
		if($task_r_id > 0){
			//redirect to the edit file.
			header("Location: task_view.php?t_id=$task_id"); /* Redirect browser */
			exit();
		}else{
			echo "query failed";
		}
	}else{
		echo "Couldn't validate user ID.";
	}
	
}else{
	print_header();
	$query = "SELECT * FROM `tasks` WHERE `id` = '".$_GET['t_id']."'";
	$task = db_select($query);	
	
	$query = "SELECT * FROM `story_info` WHERE `s_info_id` = '".$task['story_id']."'";
	$story_info = db_select($query);	
	$_SESSION["t_info"] = $task;
	
	echo '
		 <div class="container-fluid">
			<div class="row">
				<div class="col-lg-8" >
					<style>
					p{
						font-size: 18px;
						border-bottom: solid black 1px;
					}
					</style>
					<h1>'.$task["title"].'</h1></br>
					<p class="col-lg-12"><b class="col-lg-4">Story Title:</b> '.$story_info["title"].'</p>
					<p class="col-lg-12"><b class="col-lg-4">Story Tags:</b> '.$story_info["tags"].'</p>
					<p class="col-lg-12"><b class="col-lg-4">Story Setting (When):</b> '.$story_info["when"].'</p>
					<p class="col-lg-12"><b class="col-lg-4">Story Setting (Where):</b> '.$story_info["where"].'</p>
					<div class="col-lg-12"> </br></br></br></div>
					<p class="col-lg-12"><b class="col-lg-4">Task Tags:</b> '.$task["tags"].'</p>
					<p class="col-lg-12"><b class="col-lg-4">Task:</b> '.$task["task"].'</p>
				</div>
				</br></br></br><a href="home.php" class="btn btn-info" role="button">< Home</a>';
		
	
	echo '
			<div class="col-lg-8">
			<style>
			td{
				padding: 10px;
			}
			</style>
			</br></br></br><h1>Response</h1>
			<form action="" method="POST">
				<table>
				<tr><td><textarea class="ckeditor" id="editor1" name="t_task" rows="10" cols="50"></textarea></td></tr>
				<tr><td><button class="btn btn-info" role="button" name="submit" value="true">Submit</button></td></tr>
				</table>
			</form>
		</div>
	</div>';
}
?>

<?php
	print_footer();
?>