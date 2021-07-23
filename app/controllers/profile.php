<?php 
/**
 * Profile Class
*/
class profile extends PController
{
	
	function __construct()
	{
		parent::__construct();
		Session::checkSession(); //Session init in this function
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

		$id = Session::get("userId"); //Session init From header
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
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitname'])) {
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
					$msg = "&#x2714; Name updated successfully";
				}else{
					$msg = "Name not updated !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/profile");
			} 
		}else{
			header("Location: ".BASE_URL."/profile/");
		}
	}
	public function updateUsername($id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submituser'])) {
			$input = $this->load->validation('Form');
			$input->post('username')->isEmpty()->length(3, 60)->pregMatch(); //Method Chaining
			if ($input->submit()) {
				$username = $input->values['username'];

				$table = "user";
				$data = array(
				'username' => $username,
				);
				$cond = array('id' => $id);

				$db = $this->load->model("Database"); //This Object

				$check = $input->check($db, $table, "username", $username); //Check UserName
				if ($check == true) {
					$msg = "This user name already exist !";
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/profile");
					exit();
				}else{
					$result = $db->update($table, $data, $cond); //This Object Method
					if ($result == 1) { // echo $query->execute() = 1
						$msg = "&#x2714; Username updated successfully";
					}else{
						$msg = "Username not updated !";
					}
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/profile");
				}
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/profile");
			} 
		}else{
			header("Location: ".BASE_URL."/profile/");
		}
	}
	public function updateEmail($id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submitemail'])) {
			$input = $this->load->validation('Form');
			$input->post('email')->isEmpty()->validEmail(); //Method Chaining
			if ($input->submit()) {
				$email = $input->values['email'];

				$table = "user";
				$data = array(
				'email' => $email,
				);
				$cond = array('id' => $id);

				$db = $this->load->model("Database"); //This Object

				$check = $input->check($db, $table, "email", $email); //Check UserName
				if ($check == true) {
					$msg = "This email already exist !";
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/profile");
					exit();
				}

				$result = $db->update($table, $data, $cond); //This Object Method
				if ($result == 1) { // echo $query->execute() = 1
					$msg = "&#x2714; Email updated successfully";
				}else{
					$msg = "Email not updated !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/profile");
			} 
		}else{
			header("Location: ".BASE_URL."/profile/");
		}
	}
	public function updatePassword($id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
			$input = $this->load->validation('Form');
			$input->post('oldpassword')->isEmpty(); //Method Chaining
			$input->post('newpassword')->isEmpty()->length(6, 100);
			$input->post('renewpassword')->isEmpty();
			if ($input->submit()) {
				$oldpassword = $input->values['oldpassword'];
				$newpassword = $input->values['newpassword'];
				$renewpassword = $input->values['renewpassword'];

				$table = "user";
				$oldpassword = md5($oldpassword);
				$newpassword = md5($newpassword);
				$renewpassword = md5($renewpassword);
				$data = array(
				'password' => $newpassword,
				);
				$cond = array('id' => $id);

				$db = $this->load->model("Database"); //This Object

				$check = $input->check($db, $table, "password", $oldpassword); //Check UserName
				if ($check == false) {
					$msg = "Incorrect old password !";
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/profile");
					exit();
				}elseif (($oldpassword == $newpassword) || ($newpassword != $renewpassword)) {
					$msg = "Your old and new password same or new and re-new password not match !";
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/profile");
					exit();
				}else{
					$result = $db->update($table, $data, $cond); //This Object Method
					if ($result == 1) { // echo $query->execute() = 1
						$msg = "&#x2714; Password updated successfully";
					}else{
						$msg = "Password not updated !";
					}
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/profile");
				}
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/profile");
			} 
		}else{
			header("Location: ".BASE_URL."/profile/");
		}
	}
	public function updateImage($id = NULL)
	{
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$table = "user";
			$select_data = array(
				'select'=> 'username, image',
				'where' => array('id' => $id),
				'type'	=> 'single',
				'limit' => '1'
			);
			$db = $this->load->model("Database");
			$getimg = $db->select($table, $select_data);

			$permited = array('jpg', 'jpeg', 'png', 'svg' );
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_error = $_FILES['image']['error'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			//$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = 'img/profile/'.$getimg['username'].'.'.$file_ext;

			if (empty($file_name)) {
				$msg = "Please Select Any Image !";
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}elseif ($file_error !== 0) {
				$msg = "There was an error uploading your image !";
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}elseif ($file_size > 1048576) {
				$msg = "Image size should be less then 1MB !";
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}elseif (in_array($file_ext, $permited) === false) {
				$msg = "You can upload only: ".implode(', ', $permited)." !";
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}else{
				unlink($getimg['image']);
				$update_data = array(
				'image' => $uploaded_image,
				);
				$cond = array('id' => $id);
				move_uploaded_file($file_temp, $uploaded_image);
				$result = $db->update($table, $update_data, $cond); //This Object Method
				if ($result == 1) { // echo $query->execute() = 1
					$msg = "&#x2714; Image updated successfully";
				}else{
					$msg = "Image not updated !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/profile");
			}	
		}else{
			header("Location: ".BASE_URL."/profile/");
		}
	}
}
?>