<?php
    //set headers to NOT cache a page
    header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
    header("Pragma: no-cache"); //HTTP 1.0
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
    // Date in the past
    //or, if you DO want a file to cache, use:
    header("Cache-Control: max-age=2592000"); 
    //30days (60sec * 60min * 24hours * 30days)
?>
<?php 
    Session::init();
    $checkSess = Session::get('login');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Create Own MVC Framework</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>/favicon.ico">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/inc/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/inc/styles.css">
    <script src="<?php echo BASE_URL; ?>/inc/jquery.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="<?php echo BASE_URL; ?>/inc/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/inc/main.js"></script>
    <style>
        @media (min-width: 576px){.col-sm-2 {padding-right: 0; padding-left: 0;}}
    </style>
</head>
<body>
	<div class="container" style="padding-left: 0;padding-right: 0;">
		<div class="card card-header text-center mb-2">
		<h2>
            <div class="btn-group btn-group-sm float-right mt-2">
                <?php if($checkSess == true){ ?>
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/Admin" ?>'">Panel</button>
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/account/logout" ?>'">Logout</button>
                <?php }else{ ?>
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/account" ?>'">Sign in</button>
                <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/account/signup/" ?>'">Sign up</button>
                <?php } ?>
            </div>
            <div class="float-left">
                <img src="<?php echo BASE_URL.'/img/almodina.png' ?>" alt="" class="img-fluid">
            </div>       
        </h2>
	</div>

<div class="mb-2 card">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo BASE_URL; ?>">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
    <script>
    //$(document).ready(function(){
        /*$('#keyword').keyup(function(){
            var keyword = $(this).val();
            var category = $("#category").val();
            if (keyword != '') {
                $.ajax({
                    url:"<?php echo BASE_URL.'/ajax/search' ?>",
                    method:"POST",
                    data:{keyword:keyword, category:category},// //ei "livesearch" ti php $_POST['livesearch'] e boshbe"
                    dataType:"text",
                    success:function(data){
                        $('#msglive').html(data);
                    }
                });
            }else{
                $('#msglive').html("");
            }
        });*/
        function searchFilter(){
            var keyword = $("#keyword").val();
            var category = $("#category").val();
            if (keyword != '') {
                $.ajax({
                    url:"<?php echo BASE_URL.'/ajax/search' ?>",
                    method:"POST",
                    data:{keyword:keyword, category:category},
                    dataType:"text",
                    success:function(data){
                        $('#msglive').html(data);
                    }
                });
            }else{
                $('#msglive').html("");
            }
        }
    //});
    </script>
    <form class="form-inline my-2 my-lg-0" action="<?php echo BASE_URL.'/index/search/'; ?>" method="get">
       
        <input class="form-control" type="text" name="keyword" id="keyword" placeholder="Search" aria-label="Search" onkeyup="searchFilter();">
         <!--  -->
        <div class="mr-1 ml-1">
            <select name="category" id="category" class="custom-select" id="inlineFormCustomSelect" onchange="searchFilter();">
                <option value="">Choose...</option>
                <?php 
                    foreach ($scat as $key => $value) {
                ?>
                <option value="<?php echo $value['cid'] ?>"><?php echo $value['cname']; ?></option>
                <?php } ?>
            </select>
        </div>
        <!--  -->
        <input class="btn btn-outline-dark my-2 my-sm-0" type="submit" name="submit"><!-- Search</button> -->
    </form>
  </div>
</nav>
</div>

<div class="card">
    <div class="col-lg-3 absolute" id="msglive"></div><!--   -->
  <div class="card-header">
    <h4>
        <p>Home Page<span href="add.php" class="btn btn-outline-info btn-sm float-right"><?php date_default_timezone_set('Asia/Dhaka'); echo date('h:i:s a'); ?></span></p>         
    </h4>
  </div>
    <div class="card-body">
        <div class="row">