<?php
include 'includes/connectserver.php';

if(isset($_SESSION['id'])){
	header('location:index.php');
}

$PASSWORD = "";
$arer= [];
$error= false;
// print_r($_POST);

if(isset($_POST['email'])) {
	$email = trim($_POST['email']);
	$PASSWORD = trim($_POST['PASSWORD']);

	if(empty($email)){
		$error= true;
		$arer['email']='* Please fill up Email';
	}else {
		$email = trim($_POST['email']);
	}
	if(empty($PASSWORD)){
		$error= true;
		$arer['PASSWORD'] = '* Please fill up Password';
	}else {
		$PASSWORD = trim(md5($_POST['PASSWORD']));
	}
	// print $PASSWORD;
	if($error== false) {
		 // $sql = "SELECT * FROM users WHERE email = '$email' AND PASSWORD = '$PASSWORD' limit 1;";

		$sql = "SELECT * FROM users WHERE email = '$email' AND is_active = 1 AND user_role = 'admin' limit 1 ";
		//  	$pass = md5($PASSWORD);
		$result = mysqli_query($conn, $sql) or die("BAD QUERY");

		if(mysqli_num_rows($result) == 1) {

			$data = mysqli_fetch_assoc($result);
			
		// print '<pre>' . print_r($_SESSION, true) . '</pre>';

			// save data in $_SESSION.
			$_SESSION['first_name'] = $data['first_name'];
			$_SESSION['last_name'] = $data['last_name'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['mobile'] = $data['mobile'];
			$_SESSION['PASSWORD'] = $data['PASSWORD'];
			$_SESSION['user_role'] = $data['user_role'];
			
			$_SESSION['id'] = $data['id'];
		// print '<pre>' . print_r($_SESSION, true) . '</pre>';
			 header("location:index.php");
		}
		else {
				$arer['name'] = '* Invalid Credential';
				 //echo "Invalid Credential!";
			}
	}
}
	mysqli_close($conn);
	
include 'includes/connectheader.php';
?>
<div><h2>Login</h2></div>
<script type="text/javascript">
	function validateform(){
		var x = document.forms["login"]["email"].value;
		console.log(x);
		if (x == "") {
			alert("plz fill up email address");
			document.forms["login"]["email"].focus();
			return false;
		}
		var y = document.forms["login"]["password"].value;
		if (y == "") {
			alert("filled up password");
			document.forms["login"]["dob"].focus();
			return false;
		}
	}
</script>
	
<div class="row">
	<div class="col-sm-4 col-sm-offset-4">
		<form name="login" class="login-form" method="post">
			<div style="color: red;">
				<?php print (isset($arer['name'])) ? $arer['name'] :''; ?>
			</div>
			<div class="form-group">
				<label>Email</label>
					<div style="color: red;">
						<?php print (isset($arer['email'])) ? $arer['email'] :''; ?>
					</div>
				<input type="mail" name="email" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<label>Password</label>
					<div style="color: red;">
						<?php print (isset($arer['PASSWORD'])) ? $arer['PASSWORD'] :''; ?>
					</div>
				<input type="password" name="PASSWORD" autocomplete="off" class="form-control">
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-primary">Login</button>
			</div>
		</form>
	</div>
</div>
<?php
include 'includes/connectfooter.php';
?>