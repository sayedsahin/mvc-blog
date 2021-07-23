<?php 
/**
 * Profile Class
 */
class profile extends PController
{
	
	function __construct()
	{
		parent::__construct();
		$data = array();
	}
	public function index()
	{
		$this->profile();
	}
	public function profile()
	{
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$id = Session::get("userId"); //Session Intit From header
		$user_data = array(
			'where'  => array('id' => $id),
			'type'   => 'single',
			'limit'  => '1'
		);
		$table = "user";
		$db = $this->load->model("Database"); //This Object
		$data['info'] = $db->select($table, $user_data); //This Object Method
		$this->load->view("user/info", $data);
		$this->load->view("admin/footer");
	}
	public function updateName($id = NULL)
	{

		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('name')->isEmpty()->length(3, 60); //Method Chaining
			if ($input->submit()) {
				$name = $input->values['name'];

				$table = "user";
				$data = array(
				'name' => $name,
				);
				$cond = array('id' => $id);

				$db = $this->load->model("Database"); //This Object

				$result = $db->update($table, $data, $cond); //This Object Method
				if ($result == 1) { // echo $query->execute() = 1
					$data = "Name Updated Successfully";
				}else{
					$data = "Name Not Updated";
				}
				$url = BASE_URL."/profile?msg=".urlencode(serialize($data));
				header("Location: ".$url);
			}else{
				$data['msg'] = $input->errors;
				$url = BASE_URL."/profile?error=".urlencode(serialize($data));
				header("Location: ".$url);
			} 
		}else{
			header("Location: ".BASE_URL."/profile/");
		}
	}
}
?>