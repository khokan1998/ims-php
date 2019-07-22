<?php 
include 'includes/connectserver.php';

if(!isset($_SESSION['first_name'])){
	header('location:login.php');
 }

$id = '';
$name = '';
$is_active = '';
$error = false;
$arer = [];

if(isset($_GET['id'])){
	$id = $_GET['id'];

	$sql = "SELECT * FROM category WHERE id = " .$id;
	$value = mysqli_query($conn,$sql) or die("error");
	$data = mysqli_fetch_assoc($value);
 
	$name = $data['name'];
	$is_active = $data['is_active'];
}

if(isset($_POST['name'])){
	// print_r($_POST);
	// $id = $_POST['id'];
	$name = trim($_POST['name']);
	$is_active = isset($_POST['is_active']) ? 1 : 0 ;

	if(empty($name)){
		$error = true;
		$arer['name'] = 'Please fill up Name';	
	}
	else{
		$name = trim($_POST['name']);
	}

	if ($id) {
		if($error == false){
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
	}
	else{
		if($error == false){
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
						<div style="color:red;"><?php print(isset($arer['name'])) ? $arer['name'] :'';?></div>
						<input type="textfield" name="name" placeholder="Name" class="form-control"
							value="<?php echo $name; ?>">
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="is_active" value="1" 
							<?php echo ($is_active) ? 'checked' : '';?>>
							Is_active:
					</label>
				</div>
				<div>
					<button type="submit" name="submit" class="btn btn-primary">submit</button>
					<a class="btn btn-default" href="categorylist.php" role="button">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
<?php include 'includes/connectfooter.php';?>
