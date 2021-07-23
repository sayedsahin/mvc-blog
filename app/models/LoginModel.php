<?php 
/**
 * Login Model
 */
class LoginModel extends PModel
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function userLogin($table, $username, $password)
	{
		$sql = "SELECT * FROM $table WHERE username = :username AND password = :password";
		return $this->db->affectedRows($sql, $username, $password);
	}
	public function getUserData($table, $username, $password)
	{
		$sql = "SELECT * FROM $table WHERE username = :username AND password = :password";
		return $this->db->selectUser($sql, $username, $password);
	}
}
?>