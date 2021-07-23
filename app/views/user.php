<!-- Side Content -->
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>Category List</h6>
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
            <table class="table table-striped">
                <thead>
                    <tr class="">
                        <th width="10%" scope="col">SL</th>
                        <th width="37.5%" scope="col">Name</th>
                        <th width="37.5%" scope="col">Title</th>
                        <th width="15%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    if ($user) {
                        $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td>
                            <a class="btn btn-outline-dark btn-sm" href="<?php echo BASE_URL; ?>/category/catedit/<?php echo $user['id']; ?>">Edit</a>
                            <?php if (Session::get('level') == 3) { ?>
                            <a onclick="return confirm('Are You Sure To Deleted?')" class="btn btn-danger btn-sm" href="<?php echo BASE_URL; ?>/category/catdelete/<?php echo $user['image']; ?>">Delete</a>
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