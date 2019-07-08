<?php
include 'includes/connectserver.php';
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}
$title= "";

if(isset($_REQUEST['title'])){
	$title=$_GET['title'];

	$sql = "SELECT * FROM blog";
	$result = mysqli_query($conn,$sql);

	if(!empty($title))
	{
		$sql .= " WHERE title like '%".$title."%'";
	}
	$result = mysqli_query($conn,$sql);
}
else
{
	$sql = "SELECT * FROM blog";
	$result = mysqli_query($conn,$sql) or die("error");
	
}

include 'includes/connectheader.php';
?>
<div><h2>Blog</h2></div>
<form class="form-inline">
	<div class="form-group">
		<input type="text"class="form-control"placeholder="search"name="title"value="<?php echo $title;?>">
	<button type="submit" class="btn btn-primary">search</button>

	<!-- <input type="submit" name="submit" class="btn btn-primary" value="search"> -->
	</div>
</form>
	<table class="table table-bordered">
 	<thead><tr>
		<th>Id</th>	
		<th>Title</th>
		<th>Description</th>
		<th>Created On</th>
		<th>Updated On</th>
		<th>Created By</th>
		<th>Updated By</th>
		<th>Edit</th>
	</tr></thead>
	<tbody>
		<?php while ($row = mysqli_fetch_assoc($result)) {
			
		 ?>
	<tr>
	    <td><?php echo $row['id']; ?></td>
		<td><?php echo $row['title']; ?></td>
		<td><?php echo $row['description']; ?></td>
		<td><?php echo $row['created_on']; ?></td>
		<td><?php echo $row['updated_on']; ?></td>
		<td><?php echo $row['created_by']; ?></td>
		<td><?php echo $row['updated_by']; ?></td>
		<td><a href="bloginsert.php?id=<?php echo $row['id']?>">edit</a></td>
	</tr>
		<?php
		}
		?>
	</tbody>	
	</table>
<?php include 'includes/connectfooter.php';
 ?>