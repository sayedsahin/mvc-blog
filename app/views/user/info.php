<!-- Side Content -->
<noscript>
	<style type="text/css">.collapse:not(.show) { display: table-row;}</style>
</noscript>
<style>

.upcontainer{}
.upcontainer:hover .upimage {
  opacity: 0.3;
}
</style>
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>Sahed Ahmed's Profile</h6>
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
        <?php if (isset($info)) { ?>
        <div class="media">
        	<div class="upcontainer">
	    	<img src="<?php echo !empty($info['image']) ? BASE_URL."/".$info['image'] : BASE_URL."/img/profile/avatar.png"; ?>" class="align-self-start upimage" style="width:60px; cursor: pointer;" data-toggle="collapse" data-target="#image">
	    	</div>
		    <div class="media-body">
	    		<table class="table table-bordered">
	    			<!-- Image -->	    			
	    			<tr id="image" class="collapse">
					   	<form action="<?php echo BASE_URL."/profile/updateImage/".$info['id']; ?>" method="post" class="form-inline" enctype="multipart/form-data">
					   		<td colspan="2">
						   		<div class="custom-file">
								    <input type="file" name="image" class="custom-file-input" id="customFile">
								    <label class="custom-file-label" for="customFile">Choose file</label>
								</div>
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" name="submitimage" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
	    			<!-- Name -->
	    			<tr>
	    				<th>Name</th>
	    				<td><?php echo $info['name']; ?></td>
	    				<td class="text-center" width="72px">
	    					<button type="button" name="" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#name">Edit</button>
	    				</td>
	    			</tr>
	    			<tr id="name" class="collapse">
					   	<form action="<?php echo BASE_URL."/profile/updateName/".$info['id']; ?>" method="post" class="form-inline"  enctype="multipart/form-data">
					   		<td colspan="2">
					   		<input class="form-control" type="text" name="name" id="" value="<?php echo $info['name']; ?>">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" name="submitname" class="btn btn-primary btn-sm">Save</button>
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
					   	<form action="<?php echo BASE_URL."/profile/updateUsername/".$info['id']; ?>" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control" type="text" name="username" id="" value="<?php echo $info['username']; ?>" ">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" name="submituser" class="btn btn-primary btn-sm">Save</button>
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
					   	<form action="<?php echo BASE_URL."/profile/updateEmail/".$info['id']; ?>" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control" type="text" name="email" id="" value="<?php echo $info['email']; ?>">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" name="submitemail" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
					<!-- Password -->
	    			<tr>
	    				<th>Password</th>
	    				<td>***********</td>
	    				<td class="text-center">
	    					<button type="button" name="" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#password">Edit</button>
	    				</td>
	    			</tr>
	    			<tr id="password" class="collapse">
					   	<form action="<?php echo BASE_URL."/profile/updatePassword/".$info['id']; ?>" method="post" class="form-inline">
					   		<td colspan="2">
					   		<input class="form-control mb-2" type="text" name="oldpassword" id="" placeholder="Enter Your Old Password.....">
					   		<input class="form-control mb-2" type="text" name="newpassword" id="" placeholder="Enter Your New Password....."><input class="form-control" type="text" name="renewpassword" id="" placeholder="Re-Enter Your New Password.....">
					   			</td>
					   			<td  class="text-center">
					   			<button type="submit" name="password" class="btn btn-primary btn-sm">Save</button>
					   		</td>
					   	</form>
					</tr>
	    		</table>
		    </div>
		</div>
		<?php } ?>
    </div>
</div>
<!-- Side Content -->

