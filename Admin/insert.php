 <?php

include "connectserver.php";
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}


$erroMsg = '';

$id = '';
$first_name = '';
$last_name = '';
$mobile = '';
$email = '';
$PASSWORD = '';
$is_active = '';

//$created_on = '';
$error = false;

if (isset($_GET['id'])) {
	$id = $_GET['id'];

	// collect data from this given id
	$sql = "SELECT * FROM users WHERE id = " . $id;
	$result = mysqli_query($conn,$sql) or die("error");
	$data = mysqli_fetch_assoc($result);

	$first_name = $data['first_name'];
	$last_name = $data['last_name'];
	$email = $data['email'];
	$mobile = $data['mobile'];
	$PASSWORD = $data['PASSWORD'];
	$is_active = $data['is_active'];



}



if (isset($_POST['first_name'])) {
	# code...
			$first_name = $_POST['first_name'];
			$last_name = $_POST['last_name'];
			$email = $_POST['email'];
			$mobile = $_POST['mobile'];
			$PASSWORD = $_POST['PASSWORD'];

			$is_active = (isset($_POST['is_active'])) ? 1 : 0;


			$error = false;

	if (empty($first_name) OR empty($last_name) OR empty($email) OR empty($mobile) OR empty($PASSWORD)) 
{
	$error = true;
		$erroMsg .= "plz fill up  all the  value.";

}




	if ($id) {
		// case edit.. DO UPDATE.
		$sql = "UPDATE users SET first_name = '$first_name',last_name = '$last_name',email = '$email',mobile = '$mobile',PASSWORD='$PASSWORD',is_active='$is_active' where id = $id";
print $sql;
		if (mysqli_query($conn,$sql)) {
			echo "Data update successfully";
			
		}
		else
		{
			echo "Error:" . "</br>" . mysqli_error($conn);

			
 

		}
	}
	else {
		// case Insert DO INSERT.
 
		// Check if given email is already exists.

		$checkSql = "SELECT * FROM users WHERE email = '$email'";

		$res = mysqli_query($conn, $checkSql) or die("error");

		if (!$res) {
			$error = true;
			$erroMsg .= "Error in query : " . mysqli_error($conn); 
		}
		else
		{
			$checkData = mysqli_fetch_assoc($res);

		}

		

		//print_r($checkData);



		

		if (isset($checkData['email']) && $checkData['email'] == $email) {
			$error = true;
			$erroMsg .= "Given email is already exists."; 
		}


		if ($error == false) {
			$sql = "INSERT INTO users(first_name, last_name,email,mobile,PASSWORD,created_on,is_active)
			VALUES ('$first_name', '$last_name', '$email','$mobile','$PASSWORD',now(),'$is_active')";
			//print $sql;
			echo "</br>";
			if (mysqli_query($conn, $sql)) {
  			    echo "New record created successfully";
			} else { 
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

	}


}


?>


<?php


include "connectheader.php";

?>



<div class="container">
		
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<?php if ($erroMsg != '') {?>
				<div class="text-danger"><?php print $erroMsg; ?></div>
				<?php }?>
				<h4><?php echo ($id != '') ? 'Edit Form' : 'New form'  ?></h4>
				<form action="" method="POST" name="login">
					<div class="form-group">
						<label>first_name:</label>
 						<input type="text" name="first_name" value="<?php echo $first_name;  ?>" placeholder="first_name" class="form-control">
					</div>
					<div class="form-group">
						<label>last_name:</label>
						<input type="text" name="last_name" value="<?php echo $last_name; ?>" placeholder="last_name" class="form-control">
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="mail" name="email" value="<?php echo $email; ?>" placeholder="email" class="form-control">
					</div>
					<div class="form-group"> 
						<label>mobile</label>
						<input type="phone" name="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="phone"></div>
						<div class="form-group">
							<label>password</label>
							<input type="password" name="PASSWORD" value="<?php echo $PASSWORD; ?>" placeholder="password" class="form-control">
						</div>
					
					<div class="form-group">
						<label>Is-active:</label>
						<input type="checkbox" name="is_active" value="1" <?php echo ($is_active) ? 'checked' : '';?>>
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-danger">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
  	<?php include "connectfooter.php";
 ?>
