<?php 
/**
 * Database For PDO
 */
class Database
{
	private $dbhost = "localhost";
	private $dbuser = "root";
	private $dbpass = "root";
	private $dbname = "db_mvc";
	private $pdo;
	function __construct()
	{
		if (!isset($this->pdo)) {
			try {
				$link = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
				$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$link->exec("SET CHARACTER SET utf8");
				$this->pdo = $link;
			} catch (PDOException $e) {
				die("Failed to connect with Database".$e->getMessage());
			}
		}
	}

	#Select Data - 1 (Sayed Sahin)
	/*------------------------------------------------------
		$data
			'select' => 'email',
			'where'  => ['id' => '2', 'email' => 'gmail'],
			'type'   => 'single',
			'type'   => 'count',
			'order'  => 'id DESC',
			'limit'  => '2,
		];
	-------------------------------------------------------*/
	public function select($table, $data = [])
	{
		$select = "";
		$where = "";
		$order = "";
		$limit = "";

		//select
		$select .= array_key_exists("select", $data)?$data['select']:"*"; #[Ternary Operator]

		//where
		if (array_key_exists("where", $data)) {
			$where .= " WHERE ";
			$wcond = "";
			$i = 0;
			foreach ($data['where'] as $key => $value) {
				$add = ($i > 0)?" AND ":""; #[Ternary Operator]
				$wcond .= $add.$key."=:".$key;
				$i++;
			}
			$where .= $wcond; //see pdo project for orginal
		}

		//order
		if (array_key_exists("order", $data)) {
			$order .= " ORDER BY ".$data['order'];
		}

		//limit
		if (array_key_exists("limit", $data)) {
			$limit .= " LIMIT ".$data['limit'];
		}

		//query
		$sql = "SELECT ".$select." FROM ".$table.$where.$order.$limit;
		//prepare
		$query = $this->pdo->prepare($sql);
		//bindValu
		if (array_key_exists("where", $data)) {
			foreach ($data['where'] as $key => $value) {
				$query->bindValue(":$key", $value);
			}
		}
		//execute
		$query->execute();
		//fetch or rowCount
		if (array_key_exists("type", $data)) {
			switch ($data['type']) {
				case 'single':
					$row = $query->fetch(PDO::FETCH_ASSOC);
					break;
				case 'count':
					$row = $query->rowCount(); //rowCount Not Working All Database
					break;				
				default:
					$row = "";
					break;
			}
		}else{
			if ($query->rowCount() > 0) {
				$row = $query->fetchAll();
			}
		}
		//return
		return !empty($row)?$row:false;
	}

	#Insert Data
	/*------------------------------
		$data[
			'title' => $title,		
			'content' => $content,	
			'cid' => $category,		
			'uid' => $id,			
			'image' => $image		
		];
	--------------------------------*/
	public function insert($table, $data = [])
	{
		if (!empty($data) && is_array($data)) {
			$keys = "";
			$values = "";

			$keys .= implode(",", array_keys($data));
			$values .= ":".implode(", :", array_keys($data));
			$sql = "INSERT INTO ".$table." (".$keys.") VALUES (".$values.")";
			$query = $this->pdo->prepare($sql);
			foreach ($data as $key => $value) {
				$query->bindValue(":$key", $value);
			}
			$result = $query->execute();
			return $result;
			/*if ($result) {
				$lastid = $this->pdo->lastInsertId(); //maybe possible only return $result;
				return $lastid;
			}else{
				return false;
			}*/
		}
	}

	#Update Data
	/*----------------------------------
		$data[
			'title' => $title,
			'content' => $content,
			'cid' => $category,	
			'date' =>date("Y-m-d H:i:s")
		];
		$cond = ['id' => $id];
	-----------------------------------*/
	public function update($table, $data = [], $where)
	{
		if (!empty($data) && is_array($data)) {
			$keyvalue = "";
			$wherecon = ""; //Where Condition
			$i=0;
			foreach ($data as $key => $value) {
				$add = ($i > 0)?", ":""; #[Ternary Operator]
				$keyvalue .= $add.$key."=:".$key; //[.=]Concatenation assignment
				$i++;
			}
			if (!empty($where) && is_array($where)) {
				$i=0;
				foreach ($where as $key => $value) {
					$add = ($i > 0)?" AND ":""; #[Ternary Operator]
					$wherecon .= $add.$key."=:".$key; //[.=]Concatenation assignment
					$i++;
				}
			}
			$sql = "UPDATE ".$table." SET ".$keyvalue." WHERE ".$wherecon;
			$query = $this->pdo->prepare($sql);
			foreach ($data as $key => $value) {
				$query->bindValue(":$key", $value);
			}
			foreach ($where as $key => $value) {
				$query->bindValue(":$key", $value);
			}
			$update = $query->execute();
			return $update;
			//return $update?$query->rowCount():false; //পূর্বের কন্টেন্ট বহাল থাকলে না করলে Not Updated দেখাবে
		}else{
			return false;
		}
	}

	#Delete Data
	/*-------------------------------
		$cond = ['id' => $id];
	--------------------------------*/
	public function delete($table, $where)
	{
		if (!empty($where) && is_array($where)) {
			$wherecon = ""; //Where Condition
			$i=0;
			foreach ($where as $key => $value) {
				$add = ($i > 0)?" AND ":""; #[Ternary Operator]
				$wherecon .= $add.$key."=:".$key; //[.=]Concatenation assignment
				$i++;
			}
			$sql = "DELETE FROM ".$table." WHERE ".$wherecon;
			$query = $this->pdo->prepare($sql);
			foreach ($where as $key => $value) {
				$query->bindValue(":$key", $value);
			}
			$result = $query->execute();
			return $result?true:false;
		}
	}

	#Search Data
	/*-----------------------------------------------
		$data[
			'select' => 'email',
			'where'  => ['title' => '$title', 'cid' => '$cid'],
			'type'   => 'single',
			'type'   => 'count',
			'order'  => 'id DESC',
			'limit'  => '2,3'
		]
	-------------------------------------------------*/
	public function search($table, $data = [])
	{
		$select = "";
		$where = "";
		$order = "";
		$limit = "";

		//select
		$select .= array_key_exists("select", $data)?$data['select']:"*"; #[Ternary]

		//Where
		if (array_key_exists("where", $data)) {
			$where .= " WHERE ("; 
			$operator = "";
			$i = 0;
			foreach ($data['where'] as $key => $value) {
				$add = ($i > 0)?" OR ":""; #[Ternary Operator]
				$operator .= $add.$key." LIKE :".$key; //$add.$key." LIKE %".$value."%"
				$i++;
			}
			$where .= $operator.")";
			if (array_key_exists("where_and", $data) && $data['where_and']['cid'] > 0) {
				$c = 0;
				$operator_and = " AND (";
				foreach ($data['where_and'] as $skey => $svalue) {
					$add2 = ($c > 0)?" AND ":""; #[Ternary Operator]
					$operator_and .= $add2.$skey." LIKE :".$skey;
					$c++;
				}
				$where .= $operator_and.")";
			}
		}

		//order
		if (array_key_exists("order", $data)) {
			$order .= " ORDER BY ".$data['order'];
		}

		//limit
		if (array_key_exists("limit", $data)) {
			$limit .= " LIMIT ".$data['limit'];
		}

		//query
		$sql = "SELECT ".$select." FROM ".$table.$where.$order.$limit;

		//prepare
		$query = $this->pdo->prepare($sql);
		//bindValu 2
		if (array_key_exists("where", $data)) {
			foreach ($data['where'] as $key => $value) {
				$query->bindValue(":$key", '%'.$value.'%');
			}
			if (array_key_exists("where_and", $data) && $data['where_and']['cid'] > 0) {
				foreach ($data['where_and'] as $key => $value) {
					$query->bindValue(":$key", '%'.$value.'%');
				}
			}
		}
		//execute
		$query->execute();
		//fetch or rowCount
		if (array_key_exists("type", $data)) {
			switch ($data['type']) {
				case 'single':
					$row = $query->fetch(PDO::FETCH_ASSOC);
					break;
				case 'count':
					$row = $query->rowCount(); //rowCount Not Working All Database
					break;				
				default:
					$row = "";
					break;
			}
		}else{
			if ($query->rowCount() > 0) {
				$row = $query->fetchAll();
			}
		}
		//return
		return !empty($row)?$row:false;
	}

	//Search Query
	public function search2($table, $keyword, $cat)
	{
		if (isset($keyword) && !empty($keyword) && $cat == 0) {
			$sql = "SELECT * FROM $table WHERE title LIKE '%$keyword%' OR content LIKE '%$keyword%'";
		}elseif (isset($cat) && !empty($cat) && $cat > 0) {
			$sql = "SELECT * FROM $table WHERE (title LIKE '%$keyword%' OR content LIKE '%$keyword%') AND (cid = $cat)";
		}
		$query = $this->pdo->prepare($sql);
		$query->execute();
		return  $query->fetchAll(PDO::FETCH_ASSOC);
	}

	//Select Joind Query
	public function selectJoin($data = [])
	{
		$sql = "SELECT ".$data['select']." FROM ".$data['from']."
				INNER JOIN ".$data['join']."
				ON ".$data['on']."
				WHERE ".$data['where'];
		$query = $this->pdo->prepare($sql);
		$query->execute();
		return  $query->fetchAll(PDO::FETCH_ASSOC);
	}
	//Select Joind Query 3 Table
	public function select3Join($id, $cid)
	{
		$sql = "SELECT comment.*, user.id, user.name, user.username, user.image, post.id FROM comment
				INNER JOIN user
				ON comment.uid = user.id
				INNER JOIN post
				ON comment.pid = post.id
				WHERE post.id = $id
				ORDER BY date DESC
				LIMIT $cid, 3";
		$query = $this->pdo->prepare($sql);
		$query->execute();
		return  $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>