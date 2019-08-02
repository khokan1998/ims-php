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
$arer = [];

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

if (isset($_POST['first_name']))
{
	// print_r($_POST);
	$first_name = trim($_POST['first_name']);
	$last_name = trim($_POST['last_name']);
	$email = trim($_POST['email']);
	$mobile = trim($_POST['mobile']);
	$PASSWORD = trim($_POST['PASSWORD']);
	$is_active = (isset($_POST['is_active'])) ? 1 : 0;
	$user_role = $_POST['user_role'];

	// $error = false;
	if(empty($first_name)){
		$error = true;
		$arer['first_name'] = '* Please enter your First Name';
	}else {
		$first_name = trim($_POST['first_name']);
		if(!preg_match("/^[a-zA-Z]*$/", $first_name)){
			$arer['first_name'] = '* Only letters allowed';
		}
	}
	if(empty($last_name)){
		$error = true;
		$arer['last_name'] = '* Please enter your Last Name';  
	}else {
		$last_name = trim($_POST['last_name']);
		if(!preg_match("/^[a-zA-Z]*$/", $first_name)){
			$arer['first_name'] = '* Only letters allowed';
		}
	}
	if(empty($email)){
		$error = true;
		$arer['email'] = '* Please enter your Email';
	}else {
		$email = trim($_POST['email']);
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
			$arer['email'] = '* Invalid Email Address';
		}
	}
	if(empty($mobile)){
		$error = true;
		$arer['mobile'] = '* Please enter your Mobile No';
	}else {
		$mobile = trim($_POST['mobile']);
		if(!is_numeric($mobile)){
			$error = true;
			$arer['mobile'] = '* Only number input';
		}
		elseif(strlen($mobile)!=10){
			$error = true;
 			$arer['mobile'] = '* Only input 10 digits number';
 		}
	}
	if(empty($PASSWORD)){
		$error = true;
		$arer['PASSWORD'] = '* Please enter your Password';
	}else{
		$PASSWORD = trim(md5($_POST['PASSWORD']));
	}
	if(empty($user_role)){
		$error = true;
		$arer['user_role'] = '* Please select Role';
	}else{
		$user_role = trim($_POST['user_role']);
		if($user_role == "NULL"){
			$error= true;
			$arer['user_role'] = '* Please select Role';
		}
	}
// print_r($_POST);
	if ($id) {
		if ($error == false) {
			// case edit.. DO UPDATE.
			$sql = "UPDATE users SET first_name = '$first_name',last_name = '$last_name',email = '$email',mobile = '$mobile',PASSWORD='$PASSWORD',is_active='$is_active',user_role='$user_role' where id = $id";
			// print $sql;
			if (mysqli_query($conn,$sql)) {
				header('location:list.php');
				// echo "Data update successfully";	
			}
			else{
				echo "Error:" . "</br>" . mysqli_error($conn);
			}
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
		else{
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
			} 
			else { 
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			 }
		}

	}
}
include 'includes/connectheader.php';
?>

<div><h2>New User</h2></div>
<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<h4><?php echo ($id != '') ? 'Edit Form' : 'New form'  ?></h4>
				<form action="" method="POST" name="login">
					<div class="form-group">
						<label>First Name:</label>
						<div class="text-danger"><?php print(isset($arer['first_name'])) ? $arer['first_name'] :'';?></div>
 						<input type="text" name="first_name" autocomplete="off" value="<?php echo $first_name;  ?>" placeholder="First Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Last Name:</label>
						<div class="text-danger"><?php print(isset($arer['last_name'])) ? $arer['last_name'] :'';?></div>
						<input type="text" name="last_name" autocomplete="off" value="<?php echo $last_name; ?>" placeholder="Last Name" class="form-control">
					</div>
					<div class="form-group">
						<label>Email:</label>
							<div class="text-danger"><?php print(isset($arer['email'])) ? $arer['email'] :'';?>
					<?php if ($erroMsg != '') {?>
					<div style="color: red"><?php print $erroMsg; ?></div>
				<?php }?></div>
						<input type="email" name="email" autocomplete="off" value="<?php echo $email; ?>" placeholder="Email" class="form-control">
					</div>
					<div class="form-group"> 
						<label>Mobile No:</label>
						<div class="text-danger"><?php print(isset($arer['mobile'])) ? $arer['mobile'] :'';?></div>
						<input type="phone" name="mobile" autocomplete="off" value="<?php echo $mobile; ?>" class="form-control" placeholder="Mobile No"></div>
					
						<div class="form-group">
							<label>Password:</label>
								<div class="text-danger"><?php print(isset($arer['PASSWORD'])) ? $arer['PASSWORD'] :'';?></div>
							<input type="password" name="PASSWORD" autocomplete="off" value="<?php echo $PASSWORD; ?>" placeholder="Password" class="form-control">
						</div>
					<div class="checkbox">
						<label>
						<input type="checkbox" name="is_active" value="1" <?php echo ($is_active) ? 'checked' : '';?>>
						Is_active</label>
					</div>
					<div class="form-group">
						<label for="Role">Role:</label>
						<div class="text-danger"><?php if($user_role == "NULL"){
							print $arer['user_role'];
							}?></div>

						<select name="user_role" id="Role" class="form-control">
							<option value="NULL">Please Select</option>
							<option value="user"<?php print ($user_role == 'user') ? 'SELECTED':''; ?>>USER</option>
							<option value="admin"<?php print ($user_role == 'admin') ? 'SELECTED': ''; ?>>ADMIN</option>
						</select>
					</div>
					<div>
						<div class="form-group">
						<label for="img">Image:</label>
						<input type="file" name="img" id="img">
					</div>
					<div>
						<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						<a class="btn btn-default" href="list.php" role="button">Cancel</a>
					</div>
				</form>
			</div>
		</div>
	</div>
  	<?php include 'includes/connectfooter.php';
 ?>
