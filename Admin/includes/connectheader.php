<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="html/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="html/css/cust.css">
</head>
<body>
	<div class="container-fluid header">
		<div class="row">
			<div class="col-sm-2">
			LOGO HERE
			</div>
			<div class="col-sm-6">
				<?php
				if(isset($_SESSION['id'])){	
				?>
				<ul class="list-inline">
					<li><a href="index.php">Home</a></li>
					<li><a href="listblog.php">Blog List</a></li>
					<li><a href="bloginsert.php">Bloginsert</a></li>
					<li><a href="list.php">User</a></li>
					<li><a href="insert.php">New User</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
				<?php
				}
				?>
			</div>
			<div class="col-sm-4" align="right">
				<?php
				$first_name= $_SESSION['first_name'];
				$last_name= $_SESSION['last_name']; 
				if(isset($_SESSION['first_name'])){
				echo $first_name.' '.$last_name;
				}
				?>
			</div>

		</div>
	</div>
<div class="ims-contain-wrapeer container" >

	
