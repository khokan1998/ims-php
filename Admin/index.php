<?php include "connectheader.php"; ?>
<body>
	
	<div class="container">
		<h2 align="center"><?php
		session_start();
		//print_r($_SESSION);

		echo "Wel-come"." to IMS ".$_SESSION['first_name'];

		?></h2>
	
	<?php include "connectfooter.php"?>
	