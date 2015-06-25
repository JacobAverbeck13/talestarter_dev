<script>

function update(val){
	var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", "story_search.php?search="+val, false );
    xmlHttp.send( null );
	document.getElementById("d_table").innerHTML = xmlHttp.responseText;
	
}

</script>

<?php
	include "template.php";
	print_header();
	
	//$query = "SELECT * FROM `story_info` LIMIT 10";
	$query = "select a.`s_info_id`, a.`owner_id`, a.`story_id`, a.`title`, a.`tags`, b.username 
				FROM story_info  a 
				LEFT JOIN users b ON a.`owner_id` = b.id LIMIT 10;";
	$user_stories = db_select_multi($query);		

	echo "
	 <div class='container-fluid'>
		<div class='row'>
			<div class='col-lg-12'>
			
			<h1>View New Stories</h1></br>
			<div class='col-lg-8'>
			<p style='font-size:16px;'> Search Title/Tags: <input type='search' class='search' placeholder='search...' oninput='update(this.value)'/>
			</p></br></br></br>
			</div><a href='home.php' class='btn btn-info' role='button'>< Home</a>
			</div>";
	echo "<div class='col-lg-12' id='d_table'><table class='col-lg-5'><th>Story Title</th><th>Author</th><th>Tags</th><th>Options</th>";
	foreach($user_stories as $story){
		echo "<tr>
		<td>
		".$story["title"]."</td> <td><a href='profile.php?user_id=".$story['owner_id']."' >".$story['username']."</a>
		</td>
		<td>
		".$story["tags"]."
		</td>
		<td>
		<a href='story_view.php?s_id=".$story["s_info_id"]."' class='btn btn-info' role='button'>View</a>
		</td>
		</tr>";
	}

	echo"</div></div></div>";
	print_footer();
?>
