<!-- Side Content -->
<?php Session::set("link", $_SERVER['HTTP_REFERER']); ?>
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Edit Comment</h6>
        </div>
        <div style="min-height: 400px;" class="card-body">
	        <?php
				if ($commentbyid) {
				foreach ($commentbyid as $key => $value) {
			?>
            <form action="<?php echo BASE_URL; ?>/comment/editpro/<?php echo $value['comid']; ?>" method="post">
				<div class="form-group">
					<textarea class="form-control" rows="3" name="comment" id="comment"><?php echo $value['body']; ?></textarea>
				</div>
				<div class="form-group">
					<input type="hidden" name="uid" value="<?php echo $value['uid']; ?>">
					<input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Edit">
				</div>
			</form>
			<?php } }else{ header("Location: ".BASE_URL."/category/catlist"); } ?>
        </div>
    </div>
</div>
<!-- Side Content -->