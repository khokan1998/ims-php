<?php

include 'admin/includes/connectserver.php';
include 'includes/header.php';
?>

<?php
			$id = "";
			if (isset($_GET['id'])) {
				$id = $_GET['id'];

				// print_r($_GET['id']);
				$sql = "SELECT * FROM blog WHERE id = " . $id;
				$result = mysqli_query($conn,$sql);
			
				$row = mysqli_fetch_assoc($result);
			}
		?>

<div class="container">
	<div class="row">
		<div class="col-md-8">
		 	<div class="row">
				<h1 class="my-4 mn-4">
					 <?php echo $row['title']; ?><small></small>
				</h1>
			</div>
		
		<div class="card mb-4">
			<img class="card-img-top" src="images/b1.jpg" alt="card-img cap">
				<div class="card-body">
					<!-- <h2 class="card-title"></h2> -->
					<p class="card-text">
						<h4><?php echo $row['teaser']; ?></h4>
					</p>
					<p>
						<?php echo $row['description']; ?>
					</p>				
				</div>
		</div>

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