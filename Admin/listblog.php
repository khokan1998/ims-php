<?php
include 'connectserver.php';
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}

$sql = "SELECT * FROM blog";
$result = mysqli_query($conn,$sql) or die("error");

include 'connectheader.php';
?>
	<table border="1" align="center">
		<tr>
		<th>title</th>
		<th>Description</th>
		<th>created_on</th>
		<th>updated_on</th>
		<th>created_by</th>

		</tr>
		<?php while ($row = mysqli_fetch_assoc($result)) {
			
		 ?>
		<tr>
			
				<td><?php echo $row['title']; ?></td>
				<td><?php echo $row['description']; ?></td>
				<td><?php echo $row['created_on']; ?></td>
				<td><?php echo $row['updated_on']; ?></td>
				<td><?php echo $row['created_by']; ?></td>
				<td><a href="bloginsert.php?id=<?php echo $row['id']?>">edit</a></td>

		
		</tr>
		<?php
		}
		?>
	</table>
<?php include "connectfooter.php";
 ?>