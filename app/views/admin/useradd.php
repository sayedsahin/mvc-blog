<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>User Add</h6>
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
            <form action="<?php echo BASE_URL; ?>/user/useraddpro" method="post">
				<div class="form-group">
                    <label for="name">User Name</label>
                    <input class="form-control" type="text" name="username" id="username">
                </div>
                <div class="form-group">
					<label for="name">Password</label>
					<input class="form-control" type="text" name="password" id="password">
				</div>
				<div class="form-group">
				    <label for="category">Select Level</label>
					<select class="form-control" name="level" id="level">
                        <option>Contributor</option>
                        <option value="1">Author</option>
                        <?php if (Session::get('level')  == 3) { ?>
                        <option value="2">Editor</option>
                        <option value="3">Admin</option>
                        <?php } ?>
					</select>
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