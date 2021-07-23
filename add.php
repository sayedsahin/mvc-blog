<?php include 'inc/header.php'; ?>
		<div class="card panel-default">
			<div class="alert alert-danger" id="alert" style="display: none;"><strong>Error ! </strong>Please Select All Students.</div>
			<div class="card-header">
				<h2>
					<p>Add Student <a href="index.php" class="btn btn-success float-right">Back</a></p>					
				</h2>
			</div>
			<div class="card-body">
					<form action="lib/process.php" method="post">
						<div class="form-group">
							<label for="name">Student Name</label>
							<input class="form-control" type="text" name="name" id="name">
						</div>
						<div class="form-group">
							<label for="email">Student Email</label>
							<input class="form-control" type="text" name="email" id="email">
						</div>
						<div class="form-group">
							<label for="phone">Student Phone</label>
							<input class="form-control" type="text" name="phone" id="phone">
						</div>
						<div class="form-group">
							<input type="hidden" name="action" value="add">
							<input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Submit">
						</div>
					</form>
			</div>
		</div>
		<?php include 'inc/footer.php'; ?>