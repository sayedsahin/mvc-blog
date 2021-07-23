<?php 
if (!empty($_GET['error'])) {
    $err = unserialize(urldecode($_GET['error']));
}
?>
<!-- Side Content -->
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>Sahed Ahmed's Profile</h6>
        </div>
        <?php 
        	if (isset($_GET['msg'])) {
        		echo "<div class='alert alert-success'>".unserialize(urldecode($_GET['msg']))."</div>";
        	}
        ?>
        <?php 
    	if (isset($err) && is_array($err)) {
    		echo '<div class="alert alert-danger">';
    		foreach ($err['msg'] as $key => $value) {
    			foreach ($value as $val) {
    				switch ($key) {
    				case 'name':
    						echo "* ".$key." ".$val."<br>";
    					break;
					case 'username':
    						echo "* ".$key." ".$val."<br>";
    					break;
					case 'email':
    						echo "* ".$key." ".$val."<br>";
    					break;
					case 'password':
    						echo "* ".$key." ".$val."<br>";
    					break;   				
    				default:
    					break;
    				}
    			}
    		}
    		echo "</div>";
    	}
        ?>
        <div class="media">
	    	<img src="<?php echo BASE_URL."/img/avatar.png" ?>" class="align-self-start mr-3" style="width:60px">
		    <div class="media-body">
	    		<table class="table table-bordered">
	    			<?php if (isset($info)) { ?>
	    			<!-- Name -->
	    			<tr>
	    				<th>Name</th>
	    				<td><?php echo $info['name']; ?></td>
	    				<td class="text-center" width="72px">
	    					<button type="button" name="" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#name">Edit</button>
	    				</td>
	    			</tr>
	    			<tr id="name" class="collapse">
					   	<form action="<?php echo BASE_URL."/profile/updateName/".$info['id']; ?>" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control form-control-sm" type="text" name="name" id="" value="<?php echo $info['name']; ?>">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
					<!-- User Name -->
	    			<tr>
	    				<th>User Name</th>
	    				<td><?php echo $info['username']; ?></td>
	    				<td class="text-center">
	    					<button type="button" name="" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#username">Edit</button>
	    				</td>
	    			</tr>
	    			<tr id="username" class="collapse">
					   	<form action="" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control form-control-sm" type="text" name="username" id="" value="<?php echo $info['username']; ?>" ">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
					<!-- Email -->
	    			<tr>
	    				<th>Email</th>
	    				<td><?php echo $info['email']; ?></td>
	    				<td class="text-center">
	    					<button type="button" name="" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#email">Edit</button>
	    				</td>
	    			</tr>
	    			<tr id="email" class="collapse">
					   	<form action="<?php echo BASE_URL."/profile/"; ?>" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control form-control-sm" type="text" name="email" id="" value="<?php echo $info['email']; ?>">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
					<!-- Password -->
	    			<tr>
	    				<th>Password</th>
	    				<td></td>
	    				<td class="text-center">
	    					<button type="button" name="" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#password">Edit</button>
	    				</td>
	    			</tr>
	    			<tr id="password" class="collapse">
					   	<form action="<?php echo BASE_URL."/profile/"; ?>" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control form-control-sm mb-2" type="text" name="opassword" id="" placeholder="Enter Your Old Password.....">
					   		<input class="form-control form-control-sm" type="text" name="npassword" id="" placeholder="Enter Your New Password.....">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
					<?php } ?>
	    		</table>
		    </div>
		</div>
    </div>
</div>
<!-- Side Content -->