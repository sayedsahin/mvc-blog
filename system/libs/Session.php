<?php
class Session{
	public static function init(){
		if (version_compare(phpversion(), '5.4.0', '<')) {
			if (session_id() == '') {
				session_start();
			}
		}else{
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}
		}
	}
	 
	public static function set($key, $val)
	{
		$_SESSION[$key] = $val;
	}

	public static function get($key){
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		} else {
			return false;
		}
	}
	public static function checkSession()
	{
		self::init();
		if (self::get("login") == false) {
			self::destroy();
			header("Location:".BASE_URL."/Login");
		}
	}
	public static function checkLogin()
	{
		self::init();
		if (self::get("login") == true) {
			header("Location:".BASE_URL."/Admin");
		}
	}
	public static function checkAdmin()
	{
		self::init();
		if (self::get("level") != 3) {
			header("Location:".BASE_URL."/Admin");
			exit();
		}
	}
	public static function checkAdminEditor()
	{
		self::init();
		if (self::get("level") != 3 && self::get("level") != 2) {
			header("Location:".BASE_URL."/Admin");
			exit();
		}
	}
	public function destroy()
	{
		session_destroy();
	}
}
?>