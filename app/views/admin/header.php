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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Own MVC Framework</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/inc/bootstrap.min.css">
    <script src="<?php echo BASE_URL; ?>/inc/jquery.min.js"></script>
    <script src="<?php echo BASE_URL; ?>/inc/bootstrap.min.js"></script>
    <!-- <script src="/php/mvc/inc/main.js"></script> -->
    <style>
        @media (min-width: 576px) {
            .col-sm-2 {
                padding-right: 0;
                padding-left: 0;
            }
        }
    </style>
</head>

<body>
    <div class="container" style="padding-left: 0;padding-right: 0;">
        <div class="card card-header text-center mb-2">
            <h2>
                <div class="btn-group btn-group-sm float-right mt-2">
                    <?php if($checkSess == true){ ?>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL ?>'">Home</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/account/logout" ?>'">Logout</button>
                    <?php }else{ ?>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/account" ?>'">Sign in</button>
                    <button type="button" class="btn btn-outline-secondary" onclick="window.location.href ='<?php echo BASE_URL."/Registration/" ?>'">Sign up</button>
                    <?php } ?>
                </div>
                <div class="float-left">
                    <img src="<?php echo BASE_URL.'/img/almodina.png' ?>" alt="" class="img-fluid">
                </div>       
            </h2>
    </div>
        <div class="card">
            <div class="card-header">
                <h4>
              <p>Admin Panel<span href="add.php" class="btn btn-outline-info btn-sm float-right"><?php date_default_timezone_set('Asia/Dhaka'); echo date('h:i:s a'); ?></span></p>         
          </h4>
            </div>
            <div class="card-body">
                <div class="row">