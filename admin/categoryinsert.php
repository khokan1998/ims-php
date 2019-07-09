<?php 
include 'includes/connectserver.php';

// if(isset($_SESSION['first_name'])){
	// header('location:login.php');
// }
$id = '';
$name = '';
$is_active = '';

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$sql = "SELECT * FROM category WHERE id = " .$id;
	$value = mysqli_query($conn,$sql) or die("error");
	$data = mysqli_fetch_assoc($value);

	$name = $data['name'];
	$is_active = $data['is_active'];
}

if($_POST){
	// $id = $_POST['id'];
	$name = $_POST['name'];
	$is_active = $_POST['is_active'];

	if ($id) {
		$sql = "UPDATE category SET name = '$name',is_active = '$is_active'where id = $id";
		// print $sql;
		// die();
		if(mysqli_query($conn,$sql)){
			header('location:categorylist.php');
			// echo "update successfully";
		}
		else{
			echo "error:" ."</br>" .mysqli_error($conn);
		}
	}
	else{
		$sql = "INSERT INTO category(name,is_active) VALUES ('$name','$is_active')";
		// print $sql;
		// die();
		if(mysqli_query($conn,$sql)){
			header('location:categorylist.php');
			// echo "data insert successfully";
		}
		else{
			echo "error:" . $sql . "<br>".mysqli_erroe($conn);
		}
		mysqli_close($conn);
	}
}
include 'includes/connectheader.php';
?>
<div><h2>Category Insert</h2></div>
<div class="container">
	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<form action="" method="POST" name="insert">
			<div class="form-group">
				<label>Name:</label>
				<input type="textfield" name="name" placeholder="Name" class="form-control" value="<?php echo $name; ?>">
			</div>
			<div class="checkbox">
				<label>
					<input type="checkbox" name="is_active" value="1" <?php echo ($is_active) ? 'checked' : '';?>>
					is_active
				</label>
			</div>
			<div class="btn">
				<a href="categoryinsert.php">cancel</a>
			</div>
				<div>
					<button type="submit" name="submit" class="btn btn-primary">submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'includes/connectfooter.php';?>
