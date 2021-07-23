	<div class="col-sm-10">
		<?php
			if ($postbycat) {
			foreach ($postbycat as $key => $value) {
		?>
		<div class="card mb-2">	
			<div class="card-header">
			    <span><?php echo $value['title']; ?></span><span class="float-right"><a href="<?php echo BASE_URL; ?>/Index/category/<?php echo $value['cid']; ?>"><?php echo $value['cname']; ?></a></span>
			</div>
			<div class="card-body">
				<p>
					<?php
						$text =  htmlspecialchars_decode($value['content']);
						if (strlen($text) > 200) {
							$text = substr($text, 0, 200);
						}
						echo $text;
					?>
				</p>
				<a href="<?php echo BASE_URL; ?>/index/post/<?php echo $value['id']; ?>" class="btn btn-secondary float-right">Read</a>
			</div>	
		</div>
		<?php } }else{ echo "Post Not Found"; } ?>
</div>