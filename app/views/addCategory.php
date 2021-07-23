
	<?php 
		if (isset($msg)) {
			echo '<div class="alert alert-success">'.$msg.'</div>';
		}
	 ?>

<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Add Category Name</h6>
        </div>
        <div style="min-height: 400px;" class="card-body">
            <form action="http://localhost/php/mvc/Category/catinsert" method="post">
				<div class="form-group">
					<label for="name">Student Name</label>
					<input class="form-control" type="text" name="cname" id="name" required="">
				</div>
				<div class="form-group">
					<label for="email">Student Email</label>
					<input class="form-control" type="text" name="ctitle" id="email" required="">
				</div>
				<div class="form-group">
					<input type="hidden" name="action" value="add">
					<input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Submit">
				</div>
			</form>
        </div>
    </div>
</div>
<!-- Side Content -->