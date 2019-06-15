  <?php
include 'connectserver.php';
if (!isset($_SESSION['first_name'])) {
	header("Location:login.php");
}
		$id = '';
		$title = '';
		$Description = '';
		$updated_on = '';
		$created_on = '';
		$created_by = '';


// Added comment for git.		

if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$sql = "SELECT * FROM blog  id = " . $id;
		$result = mysqli_query($conn,$sql) or die("error");
		$data = mysqli_fetch_assoc($result);

		$title = $data['title'];
		$Description = $data['Description'];
		$updated_on = $data['updated_on'];
		$created_on = $data['created_on'];
		$id = $data['id'];
		$created_by = $data['created_by'];
		
}




	if ($id) {
		
			$sql = "UPDATE blog SET title = '$title',Description = '$Description',updated_on = '$updated_on',created_on = '$created_on',created_by = '$created_by' where id = $id";
			//print $sql;
				if (mysqli_query($conn,$sql)) {
					echo "Data update successfully";
					}
				else
					{
					echo "Error:" . "</br>" . mysqli_error($conn);

					}
			}
	else {
		
 			$sql = "INSERT INTO blog(title,Description,created_on,updated_on,created_by,id)
			VALUES ('$title','$Description',now(),now(),'$created_by')";
			//print $sql;
			echo "</br>";
				if (mysqli_query($conn, $sql)) {
	  			    echo "New record created successfully";
				} else { 
				    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				}
			}

			
			mysqli_close($conn);




include "connectheader.php";
?>




<div class="container">
		
		<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				
				<h4><?php echo ($id != '') ? 'Edit Page' : 'New Page'  ?></h4>
				
								<form action="" method="POST" name="insert">
					<div class="form-group">
						<label>title:</label>
						
						<input type="textarea" name="title" value="<?php echo $title;  ?>">
					</div>
					<div class="form-group">
						<label>Description:</label>
						<textarea name="Description" rows="4" cols="30" value="<?php echo $Description;  ?>" ></textarea>
					</div>
				
					<div><label>Role:</label>
						<select name="code">
							<option value="USER">USER</option>
							<option value="ADMIN" selected="">ADMIN</option>
						</select>
					</div>

						
					<div>
						<button type="submit" name="submit" class="btn btn-danger">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
  	
<?php include "connectfooter.php";
 ?>
  