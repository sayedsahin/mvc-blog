<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Edit Post</h6>
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
            <?php 
                if ($postbyid) {
                foreach ($postbyid as $key => $value) {
                    if (Session::get('level') == 3 || Session::get('level') == 2 || Session::get('userId') == $value['uid']) {
            ?>
            <form action="<?php echo BASE_URL."/post/posteditpro/".$value['id']; ?>" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="name">Post Title</label>
					<input class="form-control" type="text" name="title" id="name" value="<?php echo $value['title']; ?>">
				</div>
				<div class="form-group">
				    <label for="category">Select Category</label>
					<select class="form-control" name="category" id="category">
						<?php
                            if ($category) {
							foreach ($category as $key => $cat) {
                                $selected = ($value['cid'] == $cat['cid']) ?"selected": "";
						?>
						<option <?php echo $selected; ?> value="<?php echo $cat['cid']; ?>"><?php echo $cat['cname']; ?></option>
						<?php } } ?>
					</select>
				</div>
                <div class="form-group">
                    <label for="name">Feature Image</label>
                    <input class="form-control" type="file" name="image" id="image">
                    <img src="<?php echo BASE_URL."/".$value['image']; ?>" class="img-fluid img-thumbnail" width="144px">
                </div>
				<div class="form-group">
					<label>Your Post</label>
					<script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
					<textarea class="form-control" name="content" id="editor"><?php echo htmlspecialchars_decode($value['content']); ?></textarea>
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
            <?php }else{ header("Location: ".BASE_URL."/Admin"); } } }else{ header("Location: ".BASE_URL."/post/postlist"); }?>
        </div>
    </div>
</div>
<!-- Side Content -->