<?php
session_start();
include "database_connection.php";
if(isset($_SESSION["user_id"]) == false){
	$_SESSION["user_id"] = -1;
}

$url_base = $_SERVER['SERVER_NAME'];

function validate_login($userid, $redirect){
	if(isset( $_SESSION["user_id"]) && $_SESSION["user_id"] != -1){ //if session user is set
		if($userid == -1 || $userid ==  $_SESSION["user_id"]){ //if user matches
			return true;
		}else{ //user doesn't match
			if(isset($redirect) && $redirect == true){
				$_SESSION["user_id"] = -1;
				header("Location: login.php"); /* Redirect browser */
				exit();
			}
			return false;
		}
		return true;
	}else{ //user is not set
		if(isset($redirect) && $redirect == true){
			$_SESSION["user_id"] = -1;
			header("Location: login.php"); /* Redirect browser */
			exit();
		}
		return false;
	}
}

function print_header (){
	if(isset($_SESSION["user_id"]) == false){
	$_SESSION["user_id"] = -1;
	}
	$user_id = $_SESSION["user_id"];
	echo '<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TaleStarter</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="home.php">
                        TaleStarter
                    </a>
                </li>
                <li>
                    <a href="discover.php">View Stories</a>
                </li>
                <li>
                    <a href="tasks.php">Contribute</a>
                </li>
                <li>
                    <a href="more_info.php">More Info</a>
                </li>
                <li>';
				
				if($_SESSION["user_id"] > 0){
				echo '<a href="logout.php">Logout</a>';
				}
				else{
				echo '<a href="login.php">LogIn</a>';
				}
                echo '</li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
           ';
}

function print_footer (){
	if(isset($_SESSION["user_id"]) == false){
	$_SESSION["user_id"] = -1;
	}
	$user_id = $_SESSION["user_id"];
	echo '

        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>';
}



?>