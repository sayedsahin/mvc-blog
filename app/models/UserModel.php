<?php 
/**
 * User Model
 */
class UserModel extends PModel
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function getUserList($table) //use
	{
		$sql = "SELECT * FROM $table ORDER BY id DESC";
		return  $this->db->select($sql);
	}
	public function userById($table, $id) //use
	{
		$sql = "SELECT * FROM $table WHERE id=:id";
		$data = array(':id' => $id );
		return  $this->db->select($sql, $data);
	}
	public function insertPost($table, $data) //use
	{
		return  $this->db->insert($table, $data);
	}
	public function updateUser($table, $data, $cond) //use
	{
		return  $this->db->update($table, $data, $cond);
	}
	public function delUser($table, $cond) //use
	{
		return  $this->db->delete($table, $cond);
	}
}
?>