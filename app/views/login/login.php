<?php Session::set("link", $_SERVER['HTTP_REFERER']); ?>
<div class="col-sm-12">
	<div class="card mb-2">	
		<div class="card-header">
			Login
		</div>
		<div class="card-body">
			<?php 
				if (isset($_GET['err'])) {
					echo "<div class='alert alert-danger'>Incorrect User Name or Password !</div>";
				}elseif (isset($_GET['empty'])) {
					echo "<div class='alert alert-danger'>Filed Must Not Be Empty !</div>";
				}elseif (isset($_GET['msg'])) {
					echo "<div class='alert alert-success'>".unserialize(urldecode($_GET['msg']))."</div>";
				}
			?>
			<form action="<?php echo BASE_URL; ?>/account/loginpro" method="post">
				<div class="form-group">
					<label for="name">User Name</label>
					<input class="form-control" type="text" name="username" id="username">
				</div>
				<div class="form-group">
					<label for="email">Password</label>
					<input class="form-control" type="text" name="password" id="password">
				</div>
				<div class="form-group">
					<input type="submit" name="login" id="submit" class="btn btn-secondary" value="Login">
				</div>
			</form>
		</div>	
	</div>
</div>