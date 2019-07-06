<?php
include "connectserver.php";
$email = "";	

if (isset($_REQUEST['email'])) {
	//$email = $_POST['email'];
	
	$sql = "SELECT * FROM users  WHERE email = '$email'";
	echo "$sql".'</br>';
	$count = 0;
	$result = mysqli_query($conn,$sql);
	print_r($result);
	$count = mysqli_num_rows($result);
	print_r($count);
}
?>


