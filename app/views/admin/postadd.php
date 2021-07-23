<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Add Post</h6>
        </div>
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
        <div style="min-height: 400px;" class="card-body">
            <form action="<?php echo BASE_URL; ?>/post/postaddpro" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Student Name</label>
					<input class="form-control" type="text" name="title" id="name">
				</div>
				<div class="form-group">
				    <label for="category">Select Category</label>
					<select class="form-control" name="category" id="category">
						<option>Choose...</option>
						<?php 
							foreach ($catlist as $key => $value) {
						?>
						<option value="<?php echo $value['cid']; ?>"><?php echo $value['cname']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="name">Feture Image</label>
					<input class="form-control" type="file" name="image" id="name">
				</div>
				<div class="form-group">
					<label>Your Post</label>
					<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
					<textarea class="form-control" name="content" id="editor"></textarea>
					<script>
					    ClassicEditor
				        .create( document.querySelector( '#editor' ) )
				        .catch( error => {
				        console.error( error );
				        } );
					</script>

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