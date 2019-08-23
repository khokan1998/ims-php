<?php
include 'includes/connectserver.php';
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}
$title= "";

if(isset($_REQUEST['title'])){
	$title=trim($_GET['title']);

	$sql ="SELECT * FROM blog";
	$result = mysqli_query($conn,$sql);

	if(!empty($title)){
		$sql .= " WHERE title like '%".$title."%'";
	}
	$result = mysqli_query($conn,$sql);
}
else {
	$sql ="SELECT * FROM blog";
	$result = mysqli_query($conn,$sql) or die("error");
}
include 'includes/connectheader.php';
?>
<div><h2>Blog</h2></div>

		<form class="form-inline">
			<div class="form-group">
				<input type="text"class="form-control"autocomplite="off"placeholder="search"name="title"value="<?php echo $title;?>">
				<button type="submit" class="btn btn-primary">search</button>
			</div>
		</form>

<table class="table table-sesponsive">
 	<thead>
 		<tr>
			<th>Id</th>	
			<th>Title</th>
			<th>Teaser</th>
			<th>Description</th>
			<th>Created On</th>
			<th>Updated On</th>
			<th>Created By</th>
			<th>Updated By</th>
			<th>Category</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>
		<?php while ($row = mysqli_fetch_assoc($result)) {	
		 ?>
		<tr>
		    <td><?php echo $row['id']; ?></td>
			<td><?php echo $row['title']; ?></td>
			<td><?php echo $row['teaser']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['created_on']; ?></td>
			<td><?php echo $row['updated_on']; ?></td>
			<td><?php echo $row['created_by']; ?></td>
			<td><?php echo $row['updated_by']; ?></td>
			<td><?php echo $row['category_id']; ?></td>
			<td><a class="btn btn-primary" href="bloginsert.php?id=<?php echo $row['id']?>" role="button">Edit</a></td>
		</tr>
		<?php
			} ?>
	</tbody>	
</table>
<?php include 'includes/connectfooter.php';
 ?>