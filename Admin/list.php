<?php
include "connectserver.php";


if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}

$first_name = "";

if(isset($_REQUEST['submit'])){
    $first_name=$_GET['first_name'];
    
    $sql=" SELECT * FROM users";

    if (!empty($first_name)) {
        $sql .= " WHERE first_name like '%".$first_name."%' OR last_name LIKE '%".$first_name."%' OR email LIKE '%".$first_name."%' OR mobile LIKE '%".$first_name."%'";
    }
    


    //$sql .= " LIMIT 2 ";


    $result=mysqli_query($conn,$sql);
}
else{
    $sql="SELECT * FROM users";
    $result=mysqli_query($conn,$sql);
}

include "connectheader.php";
?>





	<div class="container">
	
			<h2 align="center"><div>
			<form method="get">
    			<table border="1">
  						<tr>
    
    			<td>
    				<input type="text" name="first_name" value="<?php echo $first_name;?>" /></td>
    
        <td><input type="submit" name="submit" value="search" /></td>
  </tr>
</table>
</form></div>
</h2>
<form>
	<table class="table">
		<thead>
		<tr>
			<th>id</th>
			<th>firstname</th>
			<th>lastname</th>
			<th>email</th>
			<th>mobile</th>
			<th>PASSWORD</th>
			<th>created_on</th>
			<th>is_active</th>
			</tr>
		
			</thead>
		
			<tbody>
				<?php while ($row = mysqli_fetch_array($result)) {
			?>
		
		<tr>
			<td><?php echo $row['id']?></td>
			<td><?php echo $row['first_name']?></td>
			<td><?php echo $row['last_name']?></td>
			<td><?php echo $row['email']?></td>
			<td><?php echo $row['mobile']?></td>
			<td><?php echo $row['PASSWORD']?></td>
			<td><?php echo $row['created_on']?></td>
			<td><?php echo $row['is_active']?></td>
			<td><a href="insert.php?id=<?php echo $row['id']?>">edit</a></td>
		</tr>
		<?php
	}
	?>
		</tbody>
	</table>
	</form>
	<?php include"connectfooter.php" ?>