<?php
include 'includes/connectserver.php';
if(!isset($_SESSION['first_name'])){
	header('location:login.php');
}
$name = '';
if(isset($_REQUEST['name'])){
	$name = $_GET['name'];

	$sql = "SELECT * FROM category";
	$value = mysqli_query($conn,$sql);

	if(!empty($name))
	{
		$sql .= "WHERE name like '%".$name."%'"; 
	}
	$value = mysqli_query($conn,$sql);
}
else{
	$sql = "SELECT * FROM category";
	$value = mysqli_query($conn,$sql) OR die ("error");
}
include 'includes/connectheader.php';
?>
<div><h2>category list</h2></div>
<table class="table table-bordered">
	<thead><tr>
		<th>Id</th>
		<th>Name</th>
		<th>Active</th>
		<th>Edit</th>
	</tr></thead>
	<tbody>
		<?php while ($row = mysqli_fetch_assoc($value)) {
			?>
			<tr>
				<td><?php echo $row['id']; ?></td>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['is_active']; ?></td>
				<td><a href="categoryinsert.php?id=<?php echo $row['id']?>">edit</a></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>
<?php include 'includes/connectfooter.php';
?>
