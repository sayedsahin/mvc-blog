	<div class="col-sm-10">
		<?php 
			if ($postbysearch) {
			foreach ($postbysearch as $key => $value) {
		?>
		<div class="card mb-2">	
			<div class="card-header">
			    <span><?php echo $value['title']; ?></span>
			</div>
			<div class="card-body">

					<?php
						$text =  htmlspecialchars_decode($value['content']);
						if (strlen($text) > 200) {
							$text = substr($text, 0, 200);
						}
						echo $text;
					?>
				</p> <!-- <p> start tag not use because it from database -->
				<a href="<?php echo BASE_URL; ?>/index/post/<?php echo $value['id']; ?>" class="btn btn-secondary float-right">Read</a>
			</div>	
		</div>
		<?php } } else{ echo "Data Not Found"; } ?>
		<!-- Pagination -->
		<ul class="pagination justify-content-center">	
			<?php 
				$total_page = ceil($rowcount/2);
				$uri = $_SERVER['REQUEST_URI'];
				$ex = explode('/', $uri);
				if (isset($_GET['page'])) {
					$ex = explode('&page', $ex['3']);
					$ex = $ex['0'];
				}else{
					$ex = $ex['3'];
				}
				//$end = (int) end($ex);
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
				}else{
					$page = 1;
				}
			?>
			<li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/index/search/'.$ex; ?>">First</a></li>
			<?php
				for ($i=$page-4; $i < $page; $i++) { //-4 mean left side 3 page
					$active = ($i+1 == $page) ? "active" : "" ;
					if ($i > -1) {
			?>
			<li class="page-item <?php echo $active; ?>"><a class="page-link" href="<?php echo BASE_URL.'/index/search/'.$ex.'&page='.($i+1); ?>"><?php echo ($i+1); ?></a></li>
			<?php } } ?>

			<?php 
				for ($i=$page; $i < $page+3; $i++) { //+3 mean right side 3 page
					if ($i < $total_page) {
			?>
			<li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/index/search/'.$ex.'&page='.($i+1); ?>"><?php echo ($i+1); ?></a></li>
			<?php } } ?>
			<li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/index/search/'.$ex.'&page='.$total_page; ?>">Last</a></li>
		</ul>
	</div>