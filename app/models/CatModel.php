<?php 
/**
 * Category Model
 */
class CatModel extends PModel
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function catList($table)
	{
		$sql = "SELECT * FROM $table ORDER BY cid DESC";
		return  $this->db->select($sql);
	}
	public function catById($table, $id)
	{
		$sql = "SELECT * FROM $table WHERE cid=:cid";
		$data = array(':cid' => $id );
		return  $this->db->select($sql, $data);
	}
	public function insertCat($table, $data)
	{
		return  $this->db->insert($table, $data);
	}
	public function updateCat($table, $data, $cond)
	{
		return  $this->db->update($table, $data, $cond);
	}
	public function deleteCat($table, $cond)
	{
		return  $this->db->delete($table, $cond);
	}
}
?>