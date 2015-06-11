<?php include "template.php"; print_header(); ?>
<h1>SignUp</h1>

<?php
if(isset($_POST['SignUp'])){
	signup_form();
	$continue = true;
	$username = $_POST['username'];
	$email = $_POST['email'];
	$encypt_password = "";
	if (!preg_match("/^[0-9a-zA-Z ]*$/",$_POST['username'])) {
		echo "invalid username, Only letters and white space allowed.</br>"; 
		$continue = false;
	}else{
		$query = "SELECT * FROM `users` WHERE `username` LIKE '$username'";		
		//check for similar user name or password
		$select = db_select($query);
		if($select != false){
			echo "username taken.</br>";
			$continue = false;
		}
	}
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		echo "invalid email format.</br>";
		$continue = false;
	}else{
		$query = "SELECT * FROM `users` WHERE `email` LIKE '$email'";
		//check for similar user name or password
		$select = db_select($query);
		if($select != false){
			echo "email taken.</br>";
			$continue = false;
		}
	}
	if($_POST['pass'] == $_POST['v_pass']){
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,15}$/', $_POST['pass'])) {
			echo 'the password does not meet the requirements.</br>';
			$continue = false;
		}else{
		$encypt_password = password_hash($_POST['pass'], PASSWORD_DEFAULT);	
		}
	}else{
		echo "Passwords do not match.</br>";
		$continue = false;
	}
	
	if($continue == true){
		$query = "INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `updated`) 
		VALUES (NULL, '$username', '$encypt_password', '$email', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);";
		$insert = db_insert($query);
		if($insert){
			echo "User Created";
			$_SESSION['user_id'] = $insert;
		}else{
			echo "Creation Failed";
		}
	}
	
}else{
	signup_form();
}	
	function signup_form(){
		echo '<form action="" method="POST">
	<table><tr>
	<td style="padding: 10px;">Username</td> <td style="padding: 10px;"><input type="text" name="username"></td>
	</tr>
	<tr>
	<td style="padding: 10px;">Email</td> <td style="padding: 10px;"><input type="text" name="email"></td>
	</tr>
	<tr>
	<td style="padding: 10px;">Password:</td> <td style="padding: 10px;"><input type="password" name="pass"></td>
	</tr>
	<tr>
	<td style="padding: 10px;">Verify Password:</td> <td style="padding: 10px;"><input type="password" name="v_pass"></td>
	</tr>
	<tr><td>
	<button type="submit" class="btn btn-info" name="SignUp" value="true">Sign Up</button>
	</td></tr></table>
	</form>';
	}
?>

<?php print_footer();?>