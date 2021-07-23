<?php
	spl_autoload_register(function($class){
		include_once 'system/libs/'.$class.'.php';
	});
	include_once 'app/config/config.php';

	$main = new Main();

	/*if (isset($_GET['url'])) {
		$url = $_GET['url'];
		$url = rtrim($url, '/');
		$url = explode('/', filter_var($url, FILTER_SANITIZE_URL));		
		if ($_GET['url'] != "") {
			include 'app/controllers/'.$url[0].'.php';
			$ctlr = new $url[0]();
			if (isset($url[2])) {
				$a = $url[1]; //For PHP7
				$ctlr->$a($url[2]); // Or $ctlr->{$url[1]}($url[2]); //(If not $a and $b )
			}elseif (isset($url[1])) {
				$a = $url[1]; //For PHP7
				$ctlr->$a();
			}
		}
	}else{
		include 'app/controllers/Index.php';
		$ctlr = new Index();
		$ctlr->home();
	}*/
?>