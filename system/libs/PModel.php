<?php 
	class PModel
	{
		protected $db = array();
		function __construct()
		{
			$dsn = "mysql:dbname=db_mvc; host=localhost";
			$user = "root";
			$pass = "";
			$this->db = new Database2($dsn, $user, $pass);
		}
	}
?>