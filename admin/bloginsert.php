  <?php
include 'includes/connectserver.php';
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}
//echo $_SESSION['id'];
$id = '';
$title = '';
$description = '';
$updated_on = '';
$created_on = '';
$created_by = '';
$updated_by = '';
$category_id = '';

// Added comment for git.		

if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$sql = "SELECT * FROM blog WHERE id = " . $id;
	$result = mysqli_query($conn,$sql) or die("error");
	$data = mysqli_fetch_assoc($result);

		$id = $data['id']; 
	$title = $data['title'];
	$description = $data['description'];
	$created_on = $data['created_on'];
	$updated_on = $data['updated_on'];
	$created_by = $data['id'];
	$updated_by = $data['id'];
	$category_id = $data['id'];
}


if ($_POST) {
// print_r($_POST);
	$title = $_POST['title'];
	$description = $_POST['description'];
	$category_id = $_POST['category_id'];
	$userId = $_SESSION['id'];
	 if ($id) {
	 		$sql = "UPDATE blog SET title = '$title',description = '$description',updated_on = now(),updated_by = $userId, category_id = $category_id where id = $id";
			// print $sql;
	 			if (mysqli_query($conn,$sql)) {
	 				header('location: listblog.php');
	 				// echo "Data update successfully";
	 				}
	 			else
	 				{
	 				echo "Error:" . "</br>" . mysqli_error($conn);

	 				}
 			}
    else {
	$sql = "INSERT INTO blog(title,description,created_on,created_by,category_id) VALUES ('$title','$description',now(), $userId,$category_id)";
	//print $sql;
	// echo "</br>";
	if (mysqli_query($conn, $sql)) 
	{
		 header('location: listblog.php');
	    // echo "New record created successfully";
	} 
	else
	{ 
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
		mysqli_close($conn);
	}
}

include 'includes/connectheader.php';
?>
<div><h2>Blog Insert</h2></div>
<div class="container">
	<div class="row">

		<div class="col-sm-4 col-sm-offset-4">			
			<form action="" method="POST" name="insert">
				<div><label>Category:</label>
					<select name="category_id">
						<option value="">Please Select</option>
<?php
		$sql = "SELECT * FROM category WHERE is_active = 1";
		$value = mysqli_query($conn,$sql) OR die("error");
		while($row = mysqli_fetch_assoc($value)){
			?>
			<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
<?php } ?>
					</select>
				</div>		
			<div class="form-group">
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title" class="form-control" value="<?php echo $title; ?>">
			</div>
			<div class="form-group">
				<label>Description:</label>
				<textarea rows="3" name="description"placeholder="Description" class="form-control"value="<?php echo $description; ?>"></textarea>
			</div>
			<div class="btn">
				<a href="bloginsert.php">cancel</a>
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
  