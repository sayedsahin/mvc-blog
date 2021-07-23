<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Edit Category</h6>
        </div>
        <div style="min-height: 400px;" class="card-body">
        	<?php 
	            if (!empty($_SESSION['msg'])) {
	                $msg = Session::get("msg");
	                if (is_array($msg)) {
	                    echo "<div class='alert alert-danger'>";
	                    foreach ($msg as $key => $value) {
	                        foreach ($value as $val) {
	                            echo "* ".$val." (".$key.")<br>";
	                        }
	                    }
	                    echo "</div>";
	                }else{
	                    $color = (strpos($msg, '!') != false) ? 'danger' : 'success' ;
	                    echo "<div class='alert alert-".$color."'>".$msg."</div>";
	                }               
	                unset($_SESSION['msg']);
	            }
	        ?>
	        <?php
				if ($catbyid) {
				foreach ($catbyid as $key => $value) {
			?>
            <form action="<?php echo BASE_URL; ?>/category/cateditpro/<?php echo $value['cid']; ?>" method="post">
		<div class="form-group">
			<label for="name">Category Name</label>
			<input class="form-control" type="text" name="cname" id="name" value="<?php echo $value['cname']; ?>">
		</div>
		<div class="form-group">
			<label for="email">Category Email</label>
			<input class="form-control" type="text" name="ctitle" id="email" value="<?php echo $value['ctitle']; ?>">
		</div>
		<div class="form-group">
			<input type="hidden" name="action" value="add">
			<input type="submit" name="submit" id="submit" class="btn btn-secondary" value="Submit">
		</div>
	</form>
	<?php } }else{ header("Location: ".BASE_URL."/category/catlist"); } ?>
        </div>
    </div>
</div>
<!-- Side Content -->