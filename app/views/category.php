<!-- Side Content -->
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>Category List</h6>
        </div>
        <div style="">
        	<ul class="list-group">
				<?php
					foreach ($cat as $key => $value) {
				?>
				<li class='list-group-item'><a href=""><?php echo $value['cname']; ?></a></li>
				<?php } ?>
			</ul>
        </div>
    </div>
</div>
<!-- Side Content -->