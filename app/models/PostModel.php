<?php 
/**
 * Post Model
 */
class PostModel extends PModel
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function postList($table)
	{
		$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 4";
		return  $this->db->select($sql);
	}
	public function postListTable($table)
	{
		$sql = "SELECT * FROM $table ORDER BY id DESC";
		return  $this->db->select($sql);
	}
	public function postById($posttable, $id)
	{
		$sql = "SELECT * FROM $posttable WHERE id=:id";
		$data = array( ":id" => $id);
		return  $this->db->select($sql, $data);
	}
	public function postDetails($posttable, $cattable, $id)
	{
		$sql = "SELECT $posttable.*, $cattable.cname FROM $posttable
				INNER JOIN $cattable
				ON $posttable.cid = $cattable.cid
				WHERE $posttable.id = $id";
		return  $this->db->select($sql);
	}
	public function catPost($posttable, $cattable, $id)
	{
		$sql = "SELECT $posttable.*, $cattable.cname FROM $posttable
				INNER JOIN $cattable
				ON $posttable.cid = $cattable.cid
				WHERE $cattable.cid = $id";
		return  $this->db->select($sql);
	}
	public function letestPost($lptable)
	{
		$sql = "SELECT * FROM $lptable ORDER BY id DESC LIMIT 4";
		return  $this->db->select($sql);
	}
	public function searchPost($posttable, $keyword, $cat)
	{
		if (empty($keyword) && $cat == 0) {
			header("Location:".BASE_URL);
		}
		if (isset($keyword) && !empty($keyword) && $cat == 0) {
			$sql = "SELECT * FROM $posttable WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'";
			return $this->db->select($sql);
		}elseif (isset($cat) && !empty($cat) && $cat > 0) {
			$sql = "SELECT * FROM $posttable WHERE (title LIKE '%$keyword%' OR content LIKE '%$keyword%') AND (cid = $cat)";
			return $this->db->select($sql);
		}
	}
	public function addPost($table, $data)
	{
		return  $this->db->insert($table, $data);
	}
	public function updatePost($table, $data, $cond)
	{
		return  $this->db->update($table, $data, $cond);
	}
	public function postDelete($table, $cond)
	{
		return  $this->db->delete($table, $cond);
	}
}
?>