 <?php

include 'includes/connectserver.php';
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}

// Do we need to get this done like this?
$erroMsg = '';

$id = '';
$first_name = '';
$last_name = '';
$mobile = '';
$email = '';
$PASSWORD = '';
$is_active = '';
$user_role = '';

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
	$user_role = $data['user_role'];
}


if (isset($_POST['first_name'])) {

	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$PASSWORD = $_POST['PASSWORD'];
	$is_active = (isset($_POST['is_active'])) ? 1 : 0;
	$user_role = $_POST['user_role'];

	$error = false;

	if (empty($first_name) OR empty($last_name) OR empty($email) OR empty($mobile) OR empty($PASSWORD) OR empty($user_role)) 
{
	$error = true;
		$erroMsg .= "plz fill up  all the  value.";

}




	if ($id) {
		// case edit.. DO UPDATE.
		$sql = "UPDATE users SET first_name = '$first_name',last_name = '$last_name',email = '$email',mobile = '$mobile',PASSWORD='$PASSWORD',is_active='$is_active',user_role='$user_role' where id = $id";
print $sql;
		if (mysqli_query($conn,$sql)) {
			header('location:list.php');
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
			// print_r($_POST);
			$sql = "INSERT INTO users(first_name, last_name,email,mobile,PASSWORD,created_on,is_active,user_role)
			VALUES ('$first_name', '$last_name', '$email','$mobile','$PASSWORD',now(),'$is_active','$user_role')";
			// print $sql;
		
			if (mysqli_query($conn, $sql)) {
				header('location: list.php');
  			    // echo "New record created successfully";
			} else { 
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			}
		}

	}


}


?>


<?php


include 'includes/connectheader.php';

?>


<div><h2>New User</h2></div>
<div class="container">
		
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<?php if ($erroMsg != '') {?>
				<div class="text-danger"><?php print $erroMsg; ?></div>
				<?php }?>
				<h4><?php echo ($id != '') ? 'Edit Form' : 'New form'  ?></h4>
				<form action="" method="POST" name="login">
					<div class="form-group">
						<label>First Name:</label>
 						<input type="text" name="first_name" value="<?php echo $first_name;  ?>" placeholder="First Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Last Name:</label>
						<input type="text" name="last_name" value="<?php echo $last_name; ?>" placeholder="Last Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Email:</label>
						<input type="mail" name="email" value="<?php echo $email; ?>" placeholder="Email" class="form-control">
					</div>
					<div class="form-group"> 
						<label>Mobile No:</label>
						<input type="phone" name="mobile" value="<?php echo $mobile; ?>" class="form-control" placeholder="Mobile No"></div>
						<div class="form-group">
							<label>Password:</label>
							<input type="password" name="PASSWORD" value="<?php echo $PASSWORD; ?>" placeholder="Password" class="form-control">
						</div>
					
					<div class="checkbox">
						<label>
						<input type="checkbox" name="is_active" value="1" <?php echo ($is_active) ? 'checked' : '';?>>
						Is_active</label>
					</div>
					<div><label>Role:</label>
						<select name="user_role">
							<option value="user">user</option>
							<option value="admin" selected="">admin</option>
						</select>
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
  	<?php include 'includes/connectfooter.php';
 ?>
