<?php
session_start();
//print '<pre>' . print_r($_SESSION,true) . '</pre>';
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "ims";
$conn =mysqli_connect($servername,$username,$password,$dbname);
if (!$conn) {
	echo die('connection failed:' . mysqli_connect_error());
}

?>
