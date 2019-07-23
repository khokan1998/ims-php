<?php include 'includes/connectserver.php';
 	include 'includes/connectheader.php';

	if(!isset($_SESSION['first_name'])){
		$fname = $_SESSION['fname'];
		$lname = $_SESSION['lname'];
		header('location:login.php');
	}
	?>
	<div class="container">
		<h1 align="center">
			<?php
				//session_start();
				// print_r($_SESSION);
			echo "Welcome"." To Inventory Management System ".''.'</br>';
			echo $fname.' '.$lname;
				?>	
		</h2>
	</div>

<?php include 'includes/connectfooter.php'?>
	