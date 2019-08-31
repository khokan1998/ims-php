<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<link rel="stylesheet" type="text/css" href="html/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="html/css/cust.css">
	<script type="text/javascript" src="../js/jquery-3.4.1.js"></script>
	<script type="text/javascript" src="../js/bootstrap.3.4.1.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../css/summernote.css">
	<script type="text/javascript" src="../js/summernote.js"></script>



	<!-- include summernote css/js -->
	<!-- <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script> -->
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
					<li><a href="listblog.php">Blogs</a></li>
					<li><a href="bloginsert.php">Blog Insert</a></li>
					<li><a href="list.php">User</a></li>
					<li><a href="insert.php">New User</a></li>
					<li><a href="categoryinsert.php">Category Insert</a></li>
					<li><a href="categorylist.php">Category List</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
				<?php
				}
				?>
			</div>
			<div class="col-sm-4" align="right">
				<?php
				if(isset($_SESSION['id'])){
					
					$fname = $_SESSION['first_name'];
					$lname = $_SESSION['last_name'];

					if(isset($_SESSION['first_name'])){
						echo $fname.' '.$lname;
					}
				}
				?>
			</div>

		</div>
	</div>
<div class="ims-contain-wrapeer container" >

	
