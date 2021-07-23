<!-- Side Content -->
<script src="/inc/dataTables.min.js"></script>
<link rel="stylesheet" href="/inc/dataTables.css">
<script>
    $(document).ready( function () {
    $('#table_id').DataTable();
} );
</script>
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>Post List</h6>
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
        <div style="">
            <table id="table_id" class="table table-striped" data-page-length="5"> <!-- Default 10 -->
                <thead>
                    <tr>
                        <th width="5%" scope="col">SL</th>
                        <th width="30%" scope="col">Name</th>
                        <th width="30%" scope="col">Post</th>
                        <th width="10%" scope="col">Category</th>
                        <th width="20%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($postlist as $key => $value) {
                        $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td>
                        <?php
                            $title = $value['title'];
                            if (strlen($title) > 30) {
                                $title = substr($title, 0, 30);
                            }
                            echo $title."...";
                        ?>
                        </td>
                        <td>
                        <?php
                            $content = htmlspecialchars_decode($value['content']);
                            if (strlen($content) > 100) {
                                $content = substr($content, 0, 100);
                            }
                            echo $content."...";
                        ?>
                        </td>
                        <?php 
                            foreach ($catlist as $key => $cat) {
                                if ($cat['cid'] == $value['cid']) {
                        ?>
                        <td><?php echo $cat['cname']; ?></td>
                        <?php } } ?>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="<?php echo BASE_URL."/index/post/".$value['id']; ?>">View</a>
                            
                            <?php if ($value['uid'] == Session::get('userId') || Session::get('level') == 3 || Session::get('level') == 2) { ?> 
                            <a class="btn btn-outline-dark btn-sm" href="<?php echo BASE_URL; ?>/post/postedit/<?php echo $value['id']; ?>">Edit</a>
                            <?php } ?>

                            <?php 
                                if (($value['uid'] == Session::get('userId') || Session::get('level') == 3) && (Session::get('level') != 0)) {
                            ?>    
                            <a onclick="return confirm('Are You Sure To Deleted?')" class="btn btn-danger btn-sm" href="<?php echo BASE_URL; ?>/post/postdelete/<?php echo $value['id']; ?>">Delete</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Side Content -->