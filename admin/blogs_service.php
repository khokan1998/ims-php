<?php
include 'includes/connectserver.php';
// $id = '';
// $name = '';

// if (isset($_REQUEST['name'])) {
// 	$name = $_GET['name'];

// 	$sql = "SELECT * FROM  ";
// 	$result = mysqli_query($conn,$sql);

// 	if (!empty($name)) {
// 		$sql .= " WHERE name LIKE '%".$name."%'"; 
// 	}
// 	$result = mysqli_query($conn,$sql);
// }
// else {
// 	$sql = "SELECT id,title FROM blog ";
// 	$result = mysqli_query($conn,$sql);
// }
sleep(2);

$sql = "SELECT * FROM blog ";
	$result = mysqli_query($conn,$sql);

// $data = [];

while ($row = mysqli_fetch_assoc($result)){

	$data[] = $row;
}
  print json_encode($data);

 // print json_decode($data);


?>