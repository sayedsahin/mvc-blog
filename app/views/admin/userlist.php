<!-- Side Content -->
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>User List</h6>
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
                        <th width="37.5%" scope="col">User</th>
                        <th width="37.5%" scope="col">Level</th>
                        <th width="15%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($user as $key => $value) {
                        $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $value['username']; ?></td>
                        <td>
                        <?php 
                            if ($value['level'] == 3) {
                                echo "Admin";
                            }elseif ($value['level'] == 2) {
                                echo "Editor";
                            }elseif ($value['level'] == 1) {
                                echo "Author";
                            }elseif ($value['level'] == 0) {
                                echo "Contributor";
                            }
                            
                        ?>    
                        </td>
                        <td>
                            <?php if ($value['level'] != 3 || Session::get('level') == 3) {?>
                            <a class="btn btn-outline-dark btn-sm" href="<?php echo BASE_URL; ?>/user/useredit/<?php echo $value['id']; ?>">Edit</a>
                            <?php }else{ echo '<button type="button" class="btn btn-outline-dark btn-sm" disabled>N/A</button>'; } ?>

                            <?php if (Session::get("level") == 3) { ?>
                            <a onclick="return confirm('Are You Sure To Deleted?')" class="btn btn-danger btn-sm" href="<?php echo BASE_URL; ?>/user/userdelete/<?php echo $value['id']; ?>">Delete</a>
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