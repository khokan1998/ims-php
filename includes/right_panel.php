
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
					<?php 
					$sql = 'select * from category where is_active = 1';
					$result = mysqli_query($conn,$sql);

					while ($row = mysqli_fetch_assoc($result)) {
					?>
					<ul class="list-unstyled mb-0">
						<li><a href=""><?php echo $row['name']; ?></a></li>	
					</ul>
					<?php
						}
						?>
				</div>
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