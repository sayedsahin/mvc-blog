<?php include 'inc/header.php'; ?>
<div class="card">
	<div class="alert alert-danger" id="alert" style="display: none;"><strong>Error ! </strong>Please Select All Students.</div>
	<div class="card-header">
		<h2>
			<p>Update Student <a href="index.php" class="btn btn-success float-right">Back</a></p>					
		</h2>
	</div>
	<div class="card-body">
		<form action="lib/process.php" method="post">
			<div class="form-group">
				<label for="name">Student Name</label>
				<input class="form-control" type="text" name="name" id="name" value="Sayed Ahmed">
			</div>
			<div class="form-group">
				<label for="email">Student Email</label>
				<input class="form-control" type="text" name="email" id="email" value="sayed@gmail.com">
			</div>
			<div class="form-group">
				<label for="phone">Student Phone</label>
				<input class="form-control" type="text" name="phone" id="phone" value="01832-816748">
			</div>
			<div class="form-group">
				<input type="hidden" name="id" value="">
				<input type="hidden" name="action" value="edit">
				<input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Update">
			</div>
		</form>
	</div>
</div>
<?php include 'inc/footer.php'; ?>