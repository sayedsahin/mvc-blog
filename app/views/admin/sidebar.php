<!-- Side Menu -->
<div class="col-sm-2 mb-2">
    <div class="card  mb-2">
        <div class="card-header">
            Site Option
        </div>
        <ul class="list-group">
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/Admin">Home</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/profile">Profile</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/user/details/<?php echo Session::get('username'); ?>">About</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL."/account/logout"; ?>">Logout</a></li>
        </ul>
    </div>
    <?php if (Session::get("level") == 3 || Session::get("level") == 2) { ?>
    <div class="card  mb-2">
        <div class="card-header">
        	User Option
        </div>
        <ul class="list-group">
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/user/useradd">User Add</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL."/user/userlist"; ?>">User List</a></li>
        </ul>
    </div>
    <?php } ?>
    <?php if (Session::get("level") == 3 || Session::get("level") == 2) { ?>
    <div class="card mb-2">
        <div class="card-header">
            Category Option
        </div>
        <ul class="list-group">
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/category/catadd">Category Add</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/category/catlist">Category List</a></li>
        </ul>
    </div>
    <?php } ?>
    <div class="card">
        <div class="card-header">
            Post Option
        </div>
        <ul class="list-group">
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/post/postadd">Post Add</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/post/postlist">Post List</a></li>
            <li class='list-group-item list-group-item-action'><a class="text-dark" href="<?php echo BASE_URL; ?>/comment/list">Comment List</a></li>
        </ul>
    </div>
</div>
<!-- Side Menu -->