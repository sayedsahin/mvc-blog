<?php $a = 'header("Location: ".BASE_URL."/index/")'; ?>
<style>
.media img {
    width:64px;
    height:64px;
    border:2px solid #e5e7e8;
}

.media {
    border-bottom:1px dashed #efefef;
    margin-bottom:25px;
}
.ed{padding: 0px 3px;
    font-size: 14px;}
</style>
	<div class="col-sm-10" style="padding-left: 0; padding-right: 4px;">
		<?php
			if ($postbyid) {
			foreach ($postbyid as $key => $post) {
		 ?>
		<div class="card mb-2">	
			<div class="card-header">
				<span><?php echo $post['title']; ?></span><span class="float-right"><a href="<?php echo BASE_URL; ?>/index/category/<?php echo $post['cid']; ?>"><?php echo $post['cname']; ?></a></span>
			</div>
			<div class="card-body text-justify">
				<img src="<?php echo BASE_URL."/".$post['image']; ?>" class="img-fluid img-thumbnail float-left mr-2 mb-2" width="144px" alt="">
				<?php echo htmlspecialchars_decode($post['content']); ?>
			</div>	
		</div>
	    <div class="comment-wrapper">
	        <div class="card border border-secondar">
	            <div class="card-header">
	                Comment panel
	            </div>
	            <a name="comment" class="invisible"></a>
	            <?php
	            	// Error and Success Message
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
	            <div class="card-body">
	            	<script>
	            	//Ajax
					$(document).ready(function(){
						$("#submit").click(function(){
							var comment = $("#comment").val();
							var ajax = 1;
							//if ($.trim(comment) != '') {
								$.ajax({
									url:"<?php echo BASE_URL.'/comment/comment/'.$post['id']; ?>",
									method:"POST",
									data:{comment:comment, ajax:ajax}, //body means $_POST['body'] - content means variable
									dataType:"text",
									success:function(data){
										$("#comment").val(''); //Empty after submit
										$('#msg').fadeIn();
										$('#msg').html(data);
										$('#msg').fadeOut(5000);
										$("#afterclick").load("<?php echo BASE_URL.'/comment/getcomment/'.$post['id']; ?>").fadeIn("slow");
									}
								});
								return false;
							//}
						});


						/*$('a.page-link').bind('click', function(e) {           
							var url = $(this).attr('href');
							$('#get').load(url); // load the html response into a DOM element
							e.preventDefault(); // stop the browser from following the link
						});*/
						$('a.page-link').bind('click', function(e) {           
							var url = $(this).attr('data-page');
							$('#get').load("<?php echo BASE_URL.'/comment/getcomment/'.$post['id'].'?cid=' ?>"+url); // load the html response into a DOM element
							e.preventDefault(); // stop the browser from following the link
						});
					});
					</script>
	            	<?php 
	            		//Comment Permission
	            		if (Session::get("login") == true) {
	            	?>
	            	<!-- AJAX --> <div class="container fixed-bottom" id="msg"></div> 
	            	<form action="<?php echo BASE_URL.'/comment/comment/'.$post['id']; ?>" method="post">
		                <textarea class="form-control" placeholder="write a comment..." rows="3" name="comment" id="comment"></textarea>
		                <br>
		                <button type="submit" class="btn btn-info float-right" name="submit" id="submit">Post</button>
	                </form>
	            	<?php }else{ echo "You want to comment, please login."; } ?>
	                <div class="clearfix"></div>
	                <hr>
	                <!-- AJAX --> <!-- <div id="afterclick"></div>  -->
	                <!-- AJAX <noscript>  -->
	                <div id="afterclick">
	                <div id="get">
	                <?php if (!empty($getcomment)) { ?>
	                <ul class="media-list pl-0">
	                	<?php foreach ($getcomment as $key => $value) { ?>
	                    <li class="media mb-2">
	                        <a href="#" class="float-left">
	                            <img src="<?php echo !empty($value['image']) ? BASE_URL."/".$value['image'] : BASE_URL."/img/profile/avatar.png"; ?>" alt="" class="rounded-circle">
	                        </a>
	                        <div class="media-body">
	                            <span class="text-muted float-right">
	                                <small class="text-muted"><?php echo date('j F, Y, g:i a', strtotime($value['date'])) ?></small>
	                            </span>
	                            <strong class="text-success">@<a class="text-success" href="<?php echo BASE_URL?>"><?php echo $value['name']; ?> </a></strong>
	                    		<!-- Edit Delete Permission -->
	                            <?php if (Session::get("userId") == $value['uid']) { ?>
	                            <a class="btn btn-outline-secondary ed" href="<?php echo BASE_URL.'/comment/edit/'.$value['comid']; ?>">Edit</a>
	                            <a class="btn btn-outline-secondary ed" href="<?php echo BASE_URL.'/comment/delete/'.$value['comid']; ?>" onclick="return confirm('Are You Sure To Deleted?')">Delete</a>
	                        	<?php } ?>
	                            <p>
	                                <?php echo $value['body']; ?>
	                            </p>
	                        </div>
	                    </li>
	                    <?php } // End foreach ?>
	                </ul>

	                <!--Pagination -->
					<ul class="pagination justify-content-center">
						<li class="page-item"><a data-page="1" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id']; ?>">First</a></li>

						<?php 
							$per_page = ceil($rowcount/10);
							if (isset($_GET['cid'])) {
								$cid = $_GET['cid'];
							}else{
								$cid = 1;
							}

							for ($i=$cid-4; $i < $cid; $i++) { //-4 mean left side 3 page
								$active = ($cid == $i+1) ? "active" : "" ;
								if ($i > -1) {
						?>
						<li class="page-item <?php echo $active; ?>"><a data-page="<?php echo $i+1; ?>" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id'].'?cid='.($i+1); ?>" id="next"><?php echo ($i+1); ?></a></li>
						<?php } } ?>

						<?php 
							for ($i=$cid; $i < $cid+3; $i++) { //+3 mean right side 3 page
								if ($i < $per_page) {
						?>
						<li class="page-item"><a data-page="<?php echo $i+1; ?>" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id'].'?cid='.($i+1); ?>" id="next"><?php echo ($i+1); ?></a></li>
						<?php } } ?>
						<li class="page-item"><a data-page="<?php echo $per_page; ?>" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id'].'?cid='.$per_page; ?>">Last</a></li>
					</ul>
					<!-- AJAX </noscript>  -->
					<?php  }else{ echo "<li class='media mb-2'>Comment Not Found</li>"; } ?>
					</div>
					</div>
	            </div>
	        </div>
		</div>
		<?php } } else{ header("Location: ".BASE_URL); } ?>
	</div>