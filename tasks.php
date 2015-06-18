<?php
	include "template.php";
	print_header();
	if(validate_login(-1,false)){ //validate that 'someone' is logged in
	echo "
	 <div class='container-fluid'>
		<div class='row'>
		<div class='col-lg-7'></div><a href='home.php' class='btn btn-info' role='button'>< Home</a>
			<div class='col-lg-12'>
			<h1>Tasks</h1>
			</br>
			<p class='col-lg-5' style='font-size:18px;'>
			&nbsp;&nbsp;&nbsp;&nbsp;
					This system is still under development. Soon this page will be the hub of finding tasks which
					need to be completed. 
			 </p>

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