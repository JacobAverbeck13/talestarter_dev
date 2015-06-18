<?php include "template.php";?>


<?php
if(isset($_POST['logIn'])){
	//find user by name or email
	if (filter_var($_POST['username_email'], FILTER_VALIDATE_EMAIL)) {
		$email = $_POST['username_email'];
		$query = "SELECT * FROM `users` WHERE `email` LIKE '$email'";		
		//check for similar user name or password
		$select = db_select($query);
		if($select != false){
			$_pass = $select['password'];
		}
	}else{
		$username = $_POST['username_email'];
		$query = "SELECT * FROM `users` WHERE `username` LIKE '$username'";		
		//check for similar user name or password
		$select = db_select($query);
		if($select != false){
			$_pass = $select['password'];
		}
	}
	
	//check password
	if(password_verify($_POST['pass'], $_pass) == true){
		$_SESSION['user_id'] = $select['id'];
		$_SESSION["username"] = $select['username'];
		header("Location: home.php"); /* Redirect browser */
		exit();
	}else{
		login_form();
		echo "</br></br>Logged failed.";
	} 
}else{
	login_form();
}

function login_form(){
		print_header(); 

	echo '
	<div class="col-lg-7"></div><a href="home.php" class="btn btn-info" role="button">< Home</a></br></br>
	<h1>LogIn</h1>
	<form action="" method="POST">
	<table><tr>
	<td style="padding: 10px;">Username or Email:</td> <td style="padding: 10px;"><input type="text" name="username_email"></td>
	</tr>
	<tr>
	<td style="padding: 10px;">Password:</td> <td style="padding: 10px;"><input type="password" name="pass"></td>
	</tr>
	<tr><td>
	<button type="submit" class="btn btn-info" name="logIn" value="true">LogIn</button>
	</td></tr></table>
	</form>
	</br></br></br></br><a href="signup.php" class="btn btn-info" role="button">Create Account</a>';
	
}	
?>

<?php print_footer();?>