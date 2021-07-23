<!-- Side Content -->
<div class="col-sm-10">
    <div class="card mb-2">
        <div class="card-header">
            <h6>Admin Control Panel</h6>
        </div>
        <div style="min-height: 400px" class="card-body">
            <div class="p-3 mb-2 bg-info text-white rounded">
            <?php 
                echo "Your Id: ".Session::get("userId")."<br>";
                echo "Your User Name: ".Session::get("username")."<br>";
                echo "Your Level: ".Session::get("level")."<br>";
                echo "Your Link: ".Session::get("link")."<br>";
                if (isset($_SESSION['msg'])) {
                echo "Your Msg: ".Session::get("msg")."<br>";
                }
            ?>
        	</div>
        </div>
    </div>
</div>
<!-- Side Content -->