<?php

include 'admin/includes/connectserver.php';
include 'includes/header.php';
?>

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="row">
					<h1 class="my-4 mn-4">
						Page Heading <small>Secondary Text</small>
					</h1>
				</div>
			<?php 
			//select b.created_by, u.first_name, u.last_name, count(b.id), group_concat(b.title) from blog b join users u on b.created_by = u.id group by b.created_by;
			
			// $sql = "SELECT * FROM blog ";
				// $sql = "select b.id,b.title,b.teaser,b.created_on,u.first_name,u.last_name from blog b join users u on b.created_by = u.id ";
				$sql = "select b.id,b.title,b.teaser,b.created_on,b.is_featured,b.is_active,u.first_name,u.last_name from blog b join users u on b.created_by = u.id where b.is_featured like 1 and b.is_active like 1";
				$result = mysqli_query($conn,$sql);
			
			while ($row = mysqli_fetch_assoc($result)){
				$date = $row['created_on'];
				$newdate = date("M d,y",strtotime($date));
 			?>
				<div class="card mb-4">
					<img class="card-img-top" src="images/b1.jpg" alt="card-img cap">
					<div class="card-body">
						<h2 class="card-title"><?php echo $row['title']; ?></h2>
						<p class="card-text">
							<?php echo $row['teaser']; ?>
						</p>
						<a href="blog.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Read More -></a>					
					</div>
					<div class=" well card-footer text-muted"><?php echo $newdate; ?><?php // echo date($row['created_on']); 
					 ?> by &nbsp;
					 <a href="#"><td><?php echo $row['first_name'].' '.$row['last_name'] ;  ?></a></div>	
				</div>
				<?php
			 		}
					?>
				
				<ul class="pagination a justify-content-center mb-4">
					<li class="page-item">
						<a class="page-link" href="#"><- Older</a>
					</li>
					<li class="page-item disabled">
						<a class="page-link" href="#">Newer -></a>
					</li>
				</ul>
			</div>
			<?php include 'includes/right_panel.php'; ?> 
		</div>
	</div>

<?php
include 'includes/footer.php';
?>