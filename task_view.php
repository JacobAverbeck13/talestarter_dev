<?php
	include "template.php";
	validate_login(-1,true);

print_header();


echo '<script>

function t_delete(val){
	if(confirm("Are you sure you would like to permanently delete this reponse?")){
	var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", val, false );
    xmlHttp.send( null );
	location.reload();	
	}	
}

</script>';


if(isset($_GET["t_id"]) && $_GET["t_id"] > 0){
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
					.underline{
						font-size: 18px;
						border-bottom: solid black 1px;
					}
					</style>
					<h1>'.$task["title"].'</h1></br>
					<p class="col-lg-12 underline" ><b class="col-lg-4">Story Title:</b> <a href="story_view.php?s_id='.$story_info["s_info_id"].'">'.$story_info["title"].'</a></p>
					<p class="col-lg-12 underline" ><b class="col-lg-4">Story Tags:</b> '.$story_info["tags"].'</p>
					<p class="col-lg-12 underline" ><b class="col-lg-4">Story Setting (When):</b> '.$story_info["when"].'</p>
					<p class="col-lg-12 underline" ><b class="col-lg-4">Story Setting (Where):</b> '.$story_info["where"].'</p>
					<div class="col-lg-12"> </br></br></br></div>
					<p class="col-lg-12 underline" ><b class="col-lg-4">Task Tags:</b> '.$task["tags"].'</p>
					<div class="col-lg-12"> </br></br></div>
					<p class="col-lg-12" style="font-size:20px;" ><b class="col-lg-4">Task:</b> '.$task["task"].'</p>
				</div>
				</br></br></br><a href="home.php" class="btn btn-info" role="button">< Home</a>
				</br></br></br></br><a href="task_response.php?t_id='.$task["id"].'" class="btn btn-info" role="button">Respond</a>';
		
		//add display each response.
		$query = "select a.`id`, a.`owner_id`, a.`response`, b.`username`
			FROM task_response  a 
			LEFT JOIN users b ON a.`owner_id` = b.id WHERE a.`task_id` =".$task["id"].";";
		$task_responses = db_select_multi($query);
		
		echo '<div class="col-lg-8" style="padding-top: 160px;">
			<h1>Responses</h1>';
		if($task_responses != false){
		//show responses and edit button...
					
			foreach($task_responses as $response){
				echo '<div class="col-lg-12" style="border-left: solid rgb(91, 192, 222) 5px;
  border-right: solid rgb(91, 192, 222) 5px; border-bottom: solid rgb(91, 192, 222) 5px;" >';
				echo '<p class="col-lg-12" style="padding-top:50px"><b class="col-lg-4">Author:</b> '.$response["username"].'</p>';
				echo '<p class="col-lg-12"><b class="col-lg-4">Response:</b> '.$response["response"].'</p>';
				
				if(validate_login($response['owner_id'],false)){
				echo '<div class="col-lg-12"><a onclick="t_delete(\'task_delete.php?t_r_id='.$response["id"].'\')" class="btn btn-info" role="button">Delete</a></br></br></div>';
				}
				echo '</div>';
			} 
			
		}
		echo'</div>
			</div>
		</div>';
}
?>

<?php
	print_footer();
?>