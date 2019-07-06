<?php
include 'includes/connectserver.php';

if(isset($_SESSION['id'])){
	header('location:index.php');
}

$PASSWORD = "";

//print_r($_POST);

if(isset($_POST['email']))
{
	$email = $_POST['email'];
	$PASSWORD = $_POST['PASSWORD'];

	$sql = "SELECT * FROM users WHERE email = '$email' AND PASSWORD = '$PASSWORD' limit 1;";

	print $sql;
	$result = mysqli_query($conn, $sql) or die("BAD QUERY");

		if(mysqli_num_rows($result) == 1)
		{

			$data = mysqli_fetch_assoc($result);
			// print_r($data);
			// die;

			print '<pre>' . print_r($_SESSION, true) . '</pre>';

			// save data in $_SESSION.
			$_SESSION['first_name'] = $data['first_name'];
			$_SESSION['last_name'] = $data['last_name'];
			$_SESSION['email'] = $data['email'];
			$_SESSION['mobile'] = $data['mobile'];
			$_SESSION['PASSWORD'] = $data['PASSWORD'];
			
			$_SESSION['id'] = $data['id'];
		
			header("location:index.php");
			}
	else
		 	{
			echo "Invalid Credential!";
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
			<div class="form-group">
				<label>Email</label>
				<input type="mail" name="email" class="form-control">

			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" name="PASSWORD" class="form-control">
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