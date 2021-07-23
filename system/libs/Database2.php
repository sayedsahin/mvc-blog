<?php 
class Database2 extends PDO
{
	function __construct($dsn, $user, $pass)
	{
		parent::__construct($dsn, $user, $pass);
	}
	public function select($sql, $data = array(), $fetch = PDO::FETCH_ASSOC)
	{
		$query = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$query->bindValue($key, $value);
		}
	
		$query->execute();
		return  $query->fetchAll($fetch);
	}
	public function insert($table, $data)
	{
		$key = implode(',', array_keys($data));
		$value = ':'.implode(', :', array_keys($data));
		$sql = "INSERT INTO $table ($key) VALUES ($value)";
		$query = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$query->bindValue(':'.$key, $value);
		}	
		return$query->execute();
	}
	public function update($table, $data, $cond)
	{
		$upkeys = "";
		foreach ($data as $key => $value) {
			$upkeys .= "$key=:$key,";
		}
		$upkeys = rtrim($upkeys, ",");
		$sql = "UPDATE $table SET $upkeys WHERE $cond";
		$query = $this->prepare($sql);
		foreach ($data as $key => $value) {
			$query->bindValue(":$key", $value);
		}
		return $query->execute();
	}
	public function delete($table, $cond)
	{
		$sql = "DELETE FROM $table WHERE $cond";
		return $this->exec($sql);
	}
	public function affectedRows($sql, $username, $password)
	{
		$password = md5($password);
		$query = $this->prepare($sql);
		$query->bindValue(":username", $username);
		$query->bindValue(":password", $password);
		$query->execute();
		return $query->rowCount(); //rowCount Not Working All Database

	}
	public function selectUser($sql, $username, $password)
	{
		$password = md5($password);
		$query = $this->prepare($sql);
		$query->bindValue(":username", $username);
		$query->bindValue(":password", $password);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	}
}
?>