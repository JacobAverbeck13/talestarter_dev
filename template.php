<?php
session_start();
include "database_connection.php";
if(isset($_SESSION["user_id"]) == false){
	$_SESSION["user_id"] = -1;
}
$user_id = $_SESSION["user_id"];

$url_base = $_SERVER['SERVER_NAME'];

function validate_login(){
	if(isset($_SESSION["user_id"]) == false || $_SESSION["user_id"] == -1){
	$_SESSION["user_id"] = -1;
	header("Location: login.php"); /* Redirect browser */
	exit();
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
                    <a href="#">Discover</a>
                </li>
                <li>
                    <a href="#">Write</a>
                </li>
                <li>
                    <a href="#">Contribute</a>
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