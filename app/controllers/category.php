<?php 
/**
 * Category Class
 */
class category extends PController
{
		
	function __construct()
	{
		parent::__construct();
		Session::init();
		Session::checkSession();
		$data = array();
	}
	public function index()
	{
		$this->catlist();
	}

	public function catlist()
	{
		Session::checkAdminEditor();
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$cat_data = array('order' => 'cid DESC');
		$ctable = "category";
		$db = $this->load->model("Database"); //This Object
		$data['cat'] = $db->select($ctable, $cat_data); //This Object Method
		$this->load->view("admin/catlist", $data);

		$this->load->view("admin/footer");
	}
	public function catadd(){
		Session::checkAdminEditor();
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");
		$this->load->view("admin/catadd");
		$this->load->view("admin/footer");
	}
	public function cataddpro()
	{
		Session::checkAdminEditor();
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
			$input = $this->load->validation('Form');
			$input->post('cname')->isEmpty()->length(3, 20); //Method Chaining
			$input->post('ctitle')->isEmpty(3, 40);

			if ($input->submit()) {
				$name = $input->values['cname'];
				$title = $input->values['ctitle'];

				$table = "category";
				$data = array(
				'cname' => $name,
				'ctitle' => $title,
				);

				$db = $this->load->model("Database"); //This Object
				$check = $input->check($db, $table, "cname", $name); //Check UserName
				if ($check == true) {
					$msg = "This category name already exist !";
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/category/catadd");
					exit();
				}else{
					$result = $db->insert($table, $data); //This Object Method
					if ($result == 1) { // echo $query->execute() = 1
						$msg = "&#x2714; Category Inserted Successfully";
					}else{
						$msg = "Category Not Inserted !";
					}
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/category/catlist");
				}
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/category/catadd");
			}
		}else{
			header("Location:".BASE_URL."/Admin");
		}
	}
	public function catedit($id = NULL)
	{
		Session::checkAdminEditor();
		$this->parameterNull($id);
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$query_data = array('where'  => array('cid' => $id));
		$ctable = "category";
		$db = $this->load->model("Database"); //This Object
		$data['catbyid'] = $db->select($ctable, $query_data); //This Object Method
		$this->load->view("admin/catedit", $data);

		$this->load->view("admin/footer");
	}
	public function cateditpro($id = NULL)
	{
		Session::checkAdminEditor();
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
			$input = $this->load->validation('Form');
			$input->post('cname')->isEmpty()->length(3, 20); //Method Chaining
			$input->post('ctitle')->isEmpty(3, 40);

			if ($input->submit()) {
				$name = $input->values['cname'];
				$title = $input->values['ctitle'];

				$table = "category";
				$data = array(
				'cname' => $name,
				'ctitle' => $title,
				);
				$match_data = array(
					'select' => 'cname',
					'where'  => array('cid' => $id),
					'type'   => 'single',
					'limit'  => '1'
				);
				$cond = array('cid' => $id );

				$db = $this->load->model("Database"); //This Object
				$match_cname = $db->select($table, $match_data);
				if ($name != $match_cname['cname']) {
					$check = $input->check($db, $table, "cname", $name); //Check UserName
					if ($check == true) {
						$msg = "This category name already exist !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/category/catedit/".$id);
						exit();
					}
				}
				$result = $db->update($table, $data, $cond); //This Object Method
				if ($result == 1) { // echo $query->execute() = 1
					$msg = "&#x2714; Category Edited Successfully";
				}else{
					$msg = "Category Not Edited !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/category/catlist");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/category/catedit/".$id);
			}
		}else{
			header("Location:".BASE_URL."/Admin");
		}
	}
	public function catdelete($id = NULL)
	{
		Session::checkAdmin();
		$this->parameterNull($id);
		$table = "category";
		$cond = array('cid' => $id );
		$db = $this->load->model("Database"); 
		$result = $db->delete($table, $cond);
		$mdata = array();
			if ($result == 1) { // echo $query->execute() = 1
				$msg = "Category Deleted Successfully";
			}else{
				$msg = "Category Not Deleted !";
			}
			Session::set("msg", $msg);
			header("Location: ".BASE_URL."/category/catlist");
	}	
	#................................Help Function................................#
	public function parameterNull($id)
	{
		if ($id == NULL) {
			header("Location:".BASE_URL."/Admin");
			exit();
		}
	}
}
?>