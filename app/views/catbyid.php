<div class="card">
	<div class="card-header">
		<h2>
			<p>Category By Id <a href="add.php" class="btn btn-success float-right">Add</a></p>					
		</h2>
	</div>
	<div class="card-body">
		<div class="row">
			<div class="col-sm-10">
				<p>
					
				</p>
			</div>
			<div class="col-sm-2">
				<p>
					<ul class="list-group">
						<?php
							foreach ($catbyid as $key => $value) {
						?>
						<li class='list-group-item'><a href=""><?php echo $value['cname']; ?></a></li>
						<?php } ?>
					</ul>
				</p>
			</div>
		</div>
	</div>
</div>