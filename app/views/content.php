	<div class="col-lg-10" style="padding-left: 0; padding-right: 4px;">
		<?php
			if ($post) {
			foreach ($post as $key => $value) {
		?>
		<div class="card mb-2">	
			<div class="card-header">
			    <?php echo $value['title']; ?>
			</div>
			<div class="card-body">
				
				<?php
					$text =  htmlspecialchars_decode($value['content']);
					if (strlen($text) > 200) {
						$text = substr($text, 0, 200);
					}
					echo $text;
				?>
				</p> <!-- <p> Start Tag Not Use Because This From Database -->
				<a href="<?php echo BASE_URL; ?>/index/post/<?php echo $value['id']; ?>" class="btn btn-secondary float-right">Read</a>
			</div>	
		</div>
		<?php } }else{ header("Location: ".BASE_URL); }?>

		<!-- Pagination -->
		<ul class="pagination justify-content-center">
			<li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/index/'; ?>">First</a></li>

			<?php 
				$total_page = ceil($rowcount/10);
				$uri = $_SERVER['REQUEST_URI'];
				$ex = explode('/', $uri);
				$end = (int) end($ex);
				for ($i=$end-4; $i < $end; $i++) { //-4 mean left side 3 page
					$active = ($i+1 == $end) ? "active" : "" ;
					if ($i > -1) {
			?>
			<li class="page-item <?php echo $active; ?>"><a class="page-link" href="<?php echo BASE_URL.'/index/home/'.($i+1); ?>"><?php echo ($i+1); ?></a></li>
			<?php } } ?>

			<?php 
				for ($i=$end; $i < $end+3; $i++) { //+3 mean right side 3 page
					if ($i < $total_page) {
			?>
			<li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/index/home/'.($i+1); ?>"><?php echo ($i+1); ?></a></li>
			<?php } } ?>
			<li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/index/home/'.$total_page; ?>">Last</a></li>
		</ul>
	</div>
		