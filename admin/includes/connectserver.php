<?php
include __dir__ . '/conflict.php';
session_start();
// print '<pre>' . print_r($_SESSION,true) . '</pre>';
$servername = "localhost";
// define("username","root");
// define("password","admin");
// $username = "root";
// $password = "admin";
$dbname = "ims";
$conn =mysqli_connect($servername,username,password,$dbname);
if (!$conn) {
	echo die('connection failed:' . mysqli_connect_error());
}

?>
