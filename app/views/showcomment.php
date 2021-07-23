<?php Session::init(); ?>
<script>
//Ajax
$(document).ready(function(){
	$('a.page-link').bind('click', function(e) {           
		var url = $(this).attr('data-page');
		$('#get').load("<?php echo BASE_URL.'/comment/getcomment/'.$post['id'].'?cid=' ?>"+url); 
		e.preventDefault();
	});
});
</script>
<?php if (!empty($getcomment)) { ?>
<div id="get">
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


<!-- Pagination -->
<ul class="pagination justify-content-center">
	<li class="page-item"><a data-page="1" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id']; ?>">First</a></li>

	<?php 
		$per_page = ceil($rowcount/3);
		if (isset($_GET['cid'])) {
			$cid = $_GET['cid'];
		}else{
			$cid = 1;
		}

		for ($i=$cid-4; $i < $cid; $i++) { //-4 mean left side 3 page
			$active = ($cid == $i+1) ? "active" : "" ;
			if ($i > -1) {
	?>
	<li class="page-item <?php echo $active; ?>"><a data-page="<?php echo $i+1; ?>" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id'].'?cid='.($i+1); ?>"><?php echo ($i+1); ?></a></li>
	<?php } } ?>

	<?php 
		for ($i=$cid; $i < $cid+3; $i++) { //+3 mean right side 3 page
			if ($i < $per_page) {
	?>
	<li class="page-item"><a data-page="<?php echo $i+1; ?>" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id'].'?cid='.($i+1); ?>"><?php echo ($i+1); ?></a></li>
	<?php } } ?>
	<li class="page-item"><a data-page="<?php echo $per_page; ?>" class="page-link" href="<?php echo BASE_URL.'/index/post/'.$post['id'].'?cid='.$per_page; ?>">Last</a></li>
</ul>
</div>
<?php  }else{ echo "<li class='media mb-2'>Comment Not Found</li>"; } ?>

