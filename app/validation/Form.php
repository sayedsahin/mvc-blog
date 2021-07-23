<?php 
/**
 * Form Validation
 */
class Form
{
	public $currentValue;
	public $values = array();
	public $errors = array();
/*	public $file_temp;
	public $unique_image;*/

	function __construct()
	{
		# code...
	}
	public function post($key)
	{
		$this->values[$key] = trim(stripcslashes(htmlspecialchars($_POST[$key])));
		$this->currentValue = $key;
		return $this;
	}
	public function isEmpty()
	{
		if (empty($this->values[$this->currentValue])) {
			$this->errors[$this->currentValue]['empty'] = "Filled must not be empty !";
		}
		return $this;
	}
	public function isCatEmpty()
	{
		if ($this->values[$this->currentValue] == 0) {
			$this->errors[$this->currentValue]['empty'] = "Filled must not be empty !";
		}
		return $this;
	}
	public function length($min = 0, $max = 100)
	{
		if (strlen($this->values[$this->currentValue]) < $min OR strlen($this->values[$this->currentValue]) > $max) {
			$this->errors[$this->currentValue]['length'] = "Min ".$min." and max ".$max." characters !";
		}
		return $this;
	}
	public function validEmail()
	{
		if (!filter_var($this->values[$this->currentValue], FILTER_VALIDATE_EMAIL)) {
			$this->errors[$this->currentValue]['validemail'] = "This email is not valid !";
		}
		return $this;
	}
	public function pregMatch()
	{
		if (preg_match('/[^a-z0-9_-]+/i', $this->values[$this->currentValue])) {
			$this->errors[$this->currentValue]['validemail'] = "Only use A-Z a-z 0-9 _ - ";
		}
		return $this;
	}
	public function submit()
	{
		if (empty($this->errors)) {
			return true;
		}else{
			return false;
		}
	}
	//Extra Function
	public function check($db, $table, $key, $value)
	{
		$data = array(
			'where' => array($key => $value),
			'type'  => 'count'
		);
		$count = $db->select($table, $data);
		if ($count > 0) {
			return true;
		}else{
			return false;
		}
	}
	/*public function imageUpload($file, $size, $permited)
	{
		$file_name = $_FILES[$file]['name'];
		$file_size = $_FILES[$file]['size'];
		$file_error = $_FILES[$file]['error'];
		$this->file_temp = $_FILES[$file]['tmp_name'];

		$div = explode('.', $file_name);
		$file_ext = strtolower(end($div));
		$this->unique_image = uniqid().'.'.$file_ext;
		if (empty($file_name)) {
			$msg = "Please Select Any Image !";
			Session::set("msg", $msg);
			return false;
		}elseif ($file_error !== 0) {
			$msg = "There was an error uploading your image !";
			Session::set("msg", $msg);
			return false;
		}elseif ($file_size > $size) {
			$msg = "Image size should be less then 1MB !";
			Session::set("msg", $msg);
			return false;
		}elseif (in_array($file_ext, $permited) === false) {
			$msg = "You can upload only: ".implode(', ', $permited)." !";
			Session::set("msg", $msg);
			return false;
		}else{
			return true;
		}
	}*/
}
?>