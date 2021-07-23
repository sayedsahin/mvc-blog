<div class="col-sm-12">
	<div class="card mb-2">	
		<div class="card-header">
			Registration
		</div>
		<?php 
            if (isset($_GET['msg'])) {
                echo '<div class="alert alert-danger">'.unserialize(urldecode($_GET['msg'])).'</div>';
            }
        ?>
        <?php 
        	if (isset($error)) {
        		echo '<div class="alert alert-danger">';
        		foreach ($error as $key => $value) {
        			switch ($key) {
        				case 'name':
        					foreach ($value as $val) {
        						echo "* ".$key." ".$val."<br>";
        					}
        					break;
        				case 'username':
        					foreach ($value as $val) {
        						echo "* ".$key." ".$val."<br>";
        					}
        					break;
        				case 'email':
        					foreach ($value as $val) {
        						echo "* ".$key." ".$val."<br>";
        					}
        					break;
        				case 'password':
        					foreach ($value as $val) {
        						echo "* ".$key." ".$val."<br>";
        					}
        					break;
        				
        				default:
        					break;
        			}
        		}
        		echo "</div>";
        	}
        ?>
		<div class="card-body">
			<form action="<?php echo BASE_URL; ?>/account/signuppro" method="post">
				<div class="form-group">
					<label for="name">Name</label>
					<input class="form-control" type="text" name="name" id="name">
				</div>
				<div class="form-group">
					<label for="name">User Name</label>
					<input class="form-control" type="text" name="username" id="username">
				</div>
				<div class="form-group">
					<label for="email">E-Mail</label>
					<input class="form-control" type="text" name="email" id="email">
				</div>
				<div class="form-group">
					<label for="email">Password</label>
					<input class="form-control" type="text" name="password" id="password">
				</div>
				<div class="form-group">
					<input type="submit" name="registration" id="submit" class="btn btn-secondary" value="Sign Up">
				</div>
			</form>
		</div>	
	</div>
</div>