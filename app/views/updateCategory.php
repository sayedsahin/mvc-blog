<?php 
	if (isset($msg)) {
		echo '<div class="alert alert-success">'.$msg.'</div>';
	}
?>
<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Edit Category</h6>
        </div>
        <div style="min-height: 400px;" class="card-body">
            <form action="<?php echo BASE_URL; ?>/Admin/catedit" method="post">
		<?php
			if (isset($catbyid)) {
			foreach ($catbyid as $key => $value) {
		?>
		<div class="form-group">
			<label for="name">Student Name</label>
			<input type="hidden" name="cid" value="<?php echo $value['cid']; ?>">
			<input class="form-control" type="text" name="cname" id="name" required="" value="<?php echo $value['cname']; ?>">
		</div>
		<div class="form-group">
			<label for="email">Student Email</label>
			<input class="form-control" type="text" name="ctitle" id="email" required="" value="<?php echo $value['ctitle']; ?>">
		</div>
		<div class="form-group">
			<input type="hidden" name="action" value="add">
			<input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Submit">
		</div>
		<?php } } ?>
	</form>
        </div>
    </div>
</div>
<!-- Side Content -->