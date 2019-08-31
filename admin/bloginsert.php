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
$teaser = '';
$is_featured = '';
$is_active = '';
$error = false;
$arer = [];		

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
	$category_id = $data['category_id'];
	$teaser = $data['teaser'];
	$is_featured = $data['is_featured'];
	$is_active = $data['is_active'];
	// print_r($data);
}

if ($_POST) {
	  // print_r($_POST);
	$title = trim($_POST['title']);
	$teaser = trim($_POST['teaser']);
	$description = trim($_POST['description']);
	$category_id = $_POST['category_id'];
	$is_featured = (isset($_POST['is_featured'])) ? 1 : 0;
	$is_active = (isset($_POST['is_active'])) ? 1 : 0;
	$userId = $_SESSION['id'];

	if(empty($title)){
		$error = true;
		$arer['title'] = '* Please fill up Title';
	}else {
		$title = trim($_POST['title']);
	}
	if(empty($teaser)){
		$error = true;
		$arer['teaser'] = '* Please fill up Teaser';
	}else {
		$teaser = trim($_POST['teaser']);
	}
	if(empty($description)){
		$error = true;
		$arer['description'] = '* Please fill up Description';
	} else {
		$description = trim($_POST['description']);
	}
	if (empty($category_id)) {
		$error = true;
		$arer['category_id'] = '* Please Select Category';
	}
	else{
		$category_id = $_POST['category_id'];
		if($category_id == 'NULL'){
			$error = true;
	 		$arer['category_id'] = '* Please Select Category';
 		}	
	}
		
	if ($id) {
	 	if($error == false){
	 		$sql = "UPDATE blog SET title = '$title',description = '$description',updated_on = now(),updated_by = $userId, category_id = $category_id,teaser = '$teaser',is_featured = '$is_featured',is_active = '$is_active' where id = $id";
 			if (mysqli_query($conn,$sql)) {
 				header('location: listblog.php');
 				// echo "Data update successfully";
				}else{
 				echo "Error:" . "</br>" . mysqli_error($conn);
 			}
 		}
 	}
    else {
    	if($error == false){
			$sql = "INSERT INTO blog(title,description,created_on,created_by,category_id,teaser,is_featured,is_active) VALUES ('$title','$description',now(), $userId,$category_id,'$teaser','$is_featured','$is_active')";
			//print $sql;
			if (mysqli_query($conn, $sql)) {
				 header('location: listblog.php');
			    // echo "New record created successfully";
			} 
			else{ 
			    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				mysqli_close($conn);
			}
		}
	}
}
include 'includes/connectheader.php';
?>

<div><h2>Blog Insert</h2></div>
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<form action="" method="POST" name="insert">
				<div class="form-group">			
					<label for="Category">Category:</label>
					<div class="text-danger"><?php if($category_id == "NULL"){
							print $arer['category_id'];}?>		
					</div> 
					<select name="category_id" id="Category" class="form-control">
						<option value="NULL">Please Select</option>
						<?php
							$sql = "SELECT * FROM category WHERE is_active = 1";
							$value = mysqli_query($conn,$sql) OR die("error");
							while($row = mysqli_fetch_assoc($value)){ ?>
						<option value="<?php echo $row['id']; ?>"
							<?php print ($row['id'] == $category_id) ? 'SELECTED' : '' ?>>
							<?php echo $row['name']; ?>
						</option>
							<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label>Title:</label>
					<div class="text-danger"><?php print(isset($arer['title'])) ? $arer['title'] :'';?></div>
					<input type="text" name="title" autocomplete="off" placeholder="Title" class="form-control" value="<?php echo $title; ?>">
				</div>
				<div class="form-group">
					<label>Teaser:</label>
					<div class="text-danger"><?php print(isset($arer['teaser'])) ? $arer['teaser'] :'';?></div>	
					<input type="text" name="teaser" autocomplete="off" placeholder="Teaser" class="form-control" value="<?php echo $teaser; ?>">				
				</div>
				<div class="form-group">
					<label>Description:</label>
						<div class="text-danger"><?php print(isset($arer['description'])) ? $arer['description'] :'';?></div>
					<textarea id="summernote" rows="2" name="description" autocomplete="off" placeholder="Description" class="form-control"><?php echo $description; ?></textarea>
				</div>
				<div class="checkbox">
						<label>
						<input type="checkbox" name="is_featured" value="1" <?php echo ($is_featured) ? 'checked' : '';?>>
						Is_featured</label>
					</div>
				<div class="checkbox">
						<label>
						<input type="checkbox" name="is_active" value="1" <?php echo ($is_active) ? 'checked' : '';?>>
						Is_active</label>
					</div>
				<div>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
					<a class="btn btn-default" href="listblog.php" role="button">Cancel</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
  		$('#summernote').summernote();
	});
</script>
<?php include 'includes/connectfooter.php';
 ?>
  