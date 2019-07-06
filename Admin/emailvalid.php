<?php
include 'includes/connectserver.php';


$email = '';
$erroMsg = '';	



if (isset($_POST['email'])) {

$email = $_POST['email'];


}

	$checkSql = "SELECT * FROM users WHERE email = '$email';";

		$res = mysqli_query($conn, $checkSql) or die("error");
		$count = mysqli_num_rows($res);

		$checkData = mysqli_fetch_assoc($res);

		print_r($checkData);
		$error = false;

		if (isset($checkData['email']) && $checkData['email'] == $email) {
			$error = true;
			$erroMsg .= "Given email is already exists.";
		}


		if ($count > 0) {
			echo "valid email";
		}
		else
		{
			echo "is not avalable";
		}




	mysqli_close($conn);
	

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form method="post">
		<label>Email:</label>
		<input type="mail" name="email" value="">
		<input type="submit" name="submit" value="submit">
	</form>

</body>
</html>