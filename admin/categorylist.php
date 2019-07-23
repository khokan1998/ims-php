<?php
include 'includes/connectserver.php';
if(!isset($_SESSION['first_name'])){
	header('location:login.php');
}
$name = '';
 if(isset($_REQUEST['name'])){
 	$name = trim($_GET['name']);

 	$sql = " SELECT * FROM category ";

 	if(!empty($name)){
 		$sql .= " WHERE name like '%".$name."%'"; 
 	}
 	$value = mysqli_query($conn,$sql);
 }
 else{ 	
 	$sql = " SELECT * FROM category ";
 	$value = mysqli_query($conn,$sql) OR die ("error");
}
include 'includes/connectheader.php';
?>
<div><h2>Category List</h2></div>
		<form class="form-inline">
			<div class="form-group">
				<input type="text"class="form-control"autocomplite="off"placeholder="search"name="name"value="<?php echo $name;?>">
				<button type="submit" class="btn btn-primary">search</button>
			</div>
		</form>
<form>
	<div class="col-sm-8 col-sm-offset-2">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Active</th>
					<th>Edit</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($value)) {
					?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['name']; ?></td>
						<td><?php echo $row['is_active']; ?></td>
						<td><a class="btn btn-primary" href="categoryinsert.php?id=<?php echo $row['id']?>" role="button">Edit</a></td>
					</tr>
					<?php
						} ?>
			</tbody>
		</table>
	</div>
</form>
<?php include 'includes/connectfooter.php';
?>
