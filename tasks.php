<?php
	include "template.php";
	print_header();
	
		echo '<script>
	function update(val){
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open( "GET", "task_search.php?search="+val, false );
		xmlHttp.send( null );
		document.getElementById("task_table").innerHTML = xmlHttp.responseText;
		
	}
</script>';
	
	if(validate_login(-1,false)){ //validate that 'someone' is logged in
	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
			<h1>Tasks</h1>
			</br>
			<div class='col-lg-8'>
			<p style='font-size:16px;'> Search Title/Tags: <input type='search' class='search' placeholder='search...' oninput='update(this.value)'/>
			</p></br></br></br></div>";
			$query = "SELECT * FROM `tasks` LIMIT 25;";
			$user_tasks = db_select_multi($query);	
			echo "<div id='task_table' class='col-lg-12'>";	
			if($user_tasks != false){
			echo "<table class='col-lg-5'><th>Task: Title</th><th>Tags</th><th>Options</th>";
			foreach($user_tasks as $task){
				echo "<tr>
				<td>
				".$task["title"]."
				</td>
				<td>
				".$task["tags"]."
				</td>
				<td>
				<a href='task_view.php?t_id=".$task["id"]."' class='btn btn-info' role='button'>View</a>
				</td>
				</tr>";
			}
			echo "</table></div>";
			}

			echo "<a href='home.php' class='btn btn-info' role='button'>< Home</a>
			</div>
		</div>
	</div>";
	}else{
	
		echo "
		<div class='container-fluid'>
			<div class='row'>
			<div class='col-lg-7'></div><a href='home.php' class='btn btn-info' role='button'>< Home</a>
				<div class='col-lg-12'>
				<h1>Tasks</h1>
				</br>
				<p class='col-lg-5' style='font-size:18px;'>
				&nbsp;&nbsp;&nbsp;&nbsp;
						This system is not available to visitors, please <a href='login.php'>Log In</a> to gain
						access to this page.
				 </p>

				</div>
			</div>
		</div>";
	}
	print_footer();
?>