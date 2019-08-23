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
			$sql = "SELECT * FROM blog ";
				$result = mysqli_query($conn,$sql);
			
			while ($row = mysqli_fetch_assoc($result)){
				// $date = $row['created_on'];
				// $newdate = date("M d,y",strtotime($date));
 			?>
				<div class="card mb-4">
					<img class="card-img-top" src="images/b1.jpg" alt="card-img cap">
					<div class="card-body">
						<h2 class="card-title"><?php echo $row['title']; ?></h2>
						<p class="card-text">
							<?php echo $row['teaser']; ?>
						</p>
						<a href="#" class="btn btn-primary">Read More -></a>					
					</div>
					<div class=" well card-footer text-muted"><?php echo date($row['created_on']); 
					 ?> by &nbsp;
					 <a href="#"><td><?php echo $row['created_by'];  ?></a></div>	
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
			<div class="col-md-4">
				<div class="card my-4">
					<h5 class="card-header">Search</h5>
					<div class="card-body">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search for...">
							<span class="input-group-btn">
								<button class="btn btn-secondary" type="button">Go</button>
							</span>	
						</div>
					</div>
				</div>
				<div class="card my-4">
					<h5 class="card-header">Categories</h5>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-6">
								<ul class="list-unstyled mb-0">
									<li><a href="#">Web Design</a></li>
									<li><a href="#">HTML</a></li>
									<li><a href="#">Freebies</a></li>	
								</ul>
							</div>
							<div class="col-lg-6">
								<ul class="list-unstyled mb-0">
									<li><a href="#">JavaScript</a></li>
									<li><a href="#">CSS</a></li>
									<li><a href="#">Tutorials</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="card my-4">
					<h5 class="card-header">Side Widget</h5>
					<div class="card-body">
						You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
include 'includes/footer.php';
?>