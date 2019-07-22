<?php include 'includes/connectserver.php';
 	include 'includes/connectheader.php';

	if(!isset($_SESSION['first_name'])){
		header('location:login.php');
	}
	?>
	<div class="container">
		<h1 align="center">
			<?php
				//session_start();
				//print_r($_SESSION);
		echo "Welcome"." To Inventory Management System ".''.'</br>';
		echo $_SESSION['first_name'].' '.$_SESSION['last_name'];
		?>
			
		</h2>
	</div>

<?php include 'includes/connectfooter.php'?>
	