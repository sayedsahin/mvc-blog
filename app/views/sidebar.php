<div class="col-lg-2 mb-2">
<div class="card  mb-2">
	<div class="card-header">
	    Category
	</div>
	<ul class="list-group">
		<?php
			foreach ($cat as $key => $value) {
		?>
		<li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/index/category/<?php echo $value['cid']; ?>"><?php echo $value['cname']; ?></a></li>
		<?php } ?>
	</ul>
</div>

<div class="card">
	<div class="card-header">
	    Latest Post
	</div>
	<ul class="list-group">
		<?php
			foreach ($lpost as $key => $value) {
		?>
		<li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/index/post/<?php echo $value['id']; ?>"><?php echo $value['title']; ?></a></li>
		<?php } ?>
	</ul>
</div>
</div>
