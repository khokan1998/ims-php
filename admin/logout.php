<?php
session_start();
	unset($_SESSION['first_name']);
	unset($_SESSION['last_name']);
	unset($_SESSION['email']);
	unset($_SESSION['mobile']);
	unset($_SESSION['PASSWORD']);
session_destroy();
header("location:login.php");
?>