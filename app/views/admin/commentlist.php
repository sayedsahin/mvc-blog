<!-- Side Content -->
<div class="col-sm-10">
    <div class="card">
        <div class="card-header">
            <h6>My Comment List</h6>
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
            <?php if ($comment) { ?>
            <table class="table table-striped">
                <thead>
                    <tr class="">
                        <th width="10%" scope="col">SL</th>
                        <th width="75%" scope="col">Title</th>
                        <th width="15%" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($comment as $key => $value) {
                        $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $value['body']; ?></td>
                        <td>
                            <a class="btn btn-outline-dark btn-sm" href="<?php echo BASE_URL; ?>/comment/edit/<?php echo $value['comid']; ?>">Edit</a>
                            <a onclick="return confirm('Are You Sure To Deleted?')" class="btn btn-danger btn-sm" href="<?php echo BASE_URL; ?>/comment/delete/<?php echo $value['comid']; ?>">Delete</a>
                        </td>
                    </tr>
                    <?php } //End Foreach ?>
                </tbody>
            </table>
            <!-- Pagination -->
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/comment/list'; ?>">First</a></li>

                <?php 
                    $per_page = ceil($rowcount/20);
                    $uri = $_SERVER['REQUEST_URI'];
                    $ex = explode('/', $uri);
                    $end = (int) end($ex);
                    for ($i=$end-4; $i < $end; $i++) { //-4 mean left side 3 page
                        $active = ($i+1 == $end) ? "active" : "" ;
                        if ($i > -1) {
                ?>
                <li class="page-item <?php echo $active; ?>"><a class="page-link" href="<?php echo BASE_URL.'/comment/list/'.($i+1); ?>"><?php echo ($i+1); ?></a></li>
                <?php } } ?>

                <?php 
                    for ($i=$end; $i < $end+3; $i++) { //+3 mean right side 3 page
                        if ($i < $per_page) {
                ?>
                <li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/comment/list/'.($i+1); ?>"><?php echo ($i+1); ?></a></li>
                <?php } } ?>
                <li class="page-item"><a class="page-link" href="<?php echo BASE_URL.'/comment/list/'.$per_page; ?>">Last</a></li>
            </ul>
            <?php } else{ echo "Comment Not Found"; } ?>
        </div>
    </div>
</div>
<!-- Side Content -->