<?php 
/**
 * User Class
 */
class user extends PController
{
	function __construct()
	{
		parent::__construct();
		Session::checkSession();
		//Session::checkAdminEditor();
		$data = [];

	}
	public function details($username = NULL)
	{
		if ($username == NULL) {
			$username = Session::get('username');
		}
		
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$table = "user";
		$post_data = [
			'where' => ['username' => $username],
			'type' => 'single'
		];
		$db = $this->load->model("Database"); //This Object
		$data['user'] = $db->select($table, $post_data); //This Object Method
		$this->load->view("user", $data);
		$this->load->view("admin/footer");
////////////////////////////////////////////////////////
		/*$this->parameterNull($id);
		$ptable = "post";
		$ctable = "category";
		$join_data = array(
			"select" => "$ptable.*, $ctable.cname",
			"from" => "$ptable",
			"join" => "$ctable",
			"on" => "$ptable.cid = $ctable.cid",
			"where" => "$ctable.cid = $id"
		);

		$db = $this->load->model("Database"); //This Object
		$data['scat'] = $db->select($ctable); //This Object Method
		$this->load->view("header", $data);

		$data['postbycat'] = $db->selectJoin($join_data); //This Object Method
		$this->load->view("catpost", $data);

		$this->catSidebar($db);
		$this->load->view("footer");*/
	}
	public function userlist()
	{
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$user_data = array('order'  => 'id DESC');
		$table = "user";
		$db = $this->load->model("Database"); //This Object
		$data['user'] = $db->select($table, $user_data); //This Object Method
		$this->load->view("admin/userlist", $data);

		$this->load->view("admin/footer");
	}
	public function useradd()
	{
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");
		$this->load->view("admin/useradd");
		$this->load->view("admin/footer");
	}
	public function useraddpro()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('username')->isEmpty()->length(3, 30); //Method Chaining
			$input->post('password')->isEmpty();
			$input->post('level');

			if ($input->submit()) {
				$username = $input->values['username'];
				$password = $input->values['password'];
				$level = $input->values['level'];

				$table = "user";
				$data = array(
				'username' => $username,
				'password' => md5($password),
				'level' => $level
				);			

				$db = $this->load->model("Database");

				$checkuser = $input->check($db, $table, "username", $username); //Check UserName
				if ($checkuser == true) {
					$msg = "This Username Already Exist !";
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/user/useradd");
					exit();
				}

				$result = $db->insert($table, $data);
				if ($result == 1) { // echo $query->execute() = 1
					$msg = "User added successfully";
				}else{
					$msg = "User Not Added !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/user/userlist");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/user/useradd");
			} 
		}else{
			header("Location: ".BASE_URL."/user/useradd");
		}
	}
	public function useredit($id = NULL)
	{
		$this->parameterNull($id);
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$table = "user";
		$user_data = array('where'  => array('id' => $id));
		$db = $this->load->model("Database"); //This Object
		$data['user'] = $db->select($table, $user_data); //This Object Method

		$this->load->view("admin/useredit", $data);
		$this->load->view("admin/footer");
	}
	public function usereditpro($id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('username')->isEmpty()->length(3, 30); //Method Chaining
			$input->post('level');

			if ($input->submit()) {
				$username = $input->values['username'];
				$level = $input->values['level'];
				$table = "user";
				$data = array(
				'username' => $username,
				'level' => $level
				);
				$check_data = array(
					'select' => 'username',
					'where'  => array('id' => $id),
					'type'   => 'single',
					'limit'  => '1'
				);
				$cond = array('id' => $id);

				$db = $this->load->model("Database");
				$uresult = $db->select($table, $check_data);
				if ($username != $uresult['username']) {
					$checkuser = $input->check($db, $table, "username", $username); //Check UserName
					if ($checkuser == true) {
						$msg = "Username already exist !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/user/useredit/".$id);
						exit();
					}
				}
				$result = $db->update($table, $data, $cond);
				if ($result == 1) { // echo $query->execute() = 1
					$msg = "User updated successfully";
				}else{
					$msg = "User not updated !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/user/userlist");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/user/useredit/".$id);
			} 
		}else{
			header("Location: ".BASE_URL."/Admin");
		}
	}
	public function userdelete($id = NULL)
	{
		Session::checkAdmin();
		$this->parameterNull($id);
		$table = "user";
		$cond = array('id' => $id);
		$db = $this->load->model("Database"); //This Object
		$result = $db->delete($table, $cond); //This Object Method
		if ($result == 1) { // echo $query->execute() = 1
			$msg = "User deleted successfully";
		}else{
			$msg = "User not deleted !";
		}
		Session::set("msg", $msg);
		header("Location: ".BASE_URL."/user/userlist");
	}
	public function parameterNull($id)
	{
		if ($id == NULL) {
			header("Location:".BASE_URL."/Admin");
			exit();
		}
	}
}
?>