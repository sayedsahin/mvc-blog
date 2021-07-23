<?php 
class account extends PController
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->login();
	}
	#_____________________________Login_____________________________#
	public function login()
	{
		Session::checkLogin();
		//Header
		$data = array();
		$ctable = "category";
		$db = $this->load->model("Database"); //Object
		$data['scat'] = $db->select($ctable); //Object Method
		$this->load->view("header", $data);
		//Login
		$this->load->view("login/login");
		//Footer
		$this->load->view("footer");
	}
	public function loginpro() //pro mean process
	{
		if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {
			$username = $_POST['username'];
			$password = $_POST['password'];
			if (empty($username) || empty($password)) {
				header("Location:".BASE_URL."/account?empty");
				exit();
			}
			$table = "user";
			$datacount = array(
				'select'  => 'email, password',
				'where' => array('username' => $username, 'password' => md5($password)),
				'type'  => 'count',
				'limit' => '1'
			);
			$datafetch = array(
				'where' => array('username' => $username, 'password' => md5($password)),
				'type'  => 'single',
				'limit' => '1'
			);
			$db = $this->load->model("Database"); //Object
			$count = $db->select($table, $datacount); //Object Method
			if ($count > 0) {
				$result = $db->select($table, $datafetch);
				Session::init();
				Session::set("login", true);
				Session::set("username", $result['username']);
				Session::set("userId", $result['id']);
				Session::set("level", $result['level']);
				//header("Location:".BASE_URL."/Admin");
				header("Location:".Session::get("link"));
				unset($_SESSION['link']);
			}else{
				header("Location:".BASE_URL."/account?err");
			}
		}else{
			header("Location:".BASE_URL."/account");
		}
	}
	#_______________________________Ragistration_______________________________#
	public function signup()
	{
		Session::checkLogin();
		$data = array();
		$ctable = "category";
		$db = $this->load->model("Database"); //Object
		$data['scat'] = $db->select($ctable); //Object Method
		$this->load->view("header", $data);
		$this->load->view("regi/registration");
		$this->load->view("footer");
	}
	public function signuppro()
	{
		Session::checkLogin();
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['registration'])) {
			$input = $this->load->validation('Form');
			$input->post('name')->isEmpty()->length(1, 30); //Method Chaining
			$input->post('username')->isEmpty()->length(3, 30)->pregMatch();
			$input->post('email')->isEmpty()->length(1, 30)->validEmail();
			$input->post('password')->isEmpty()->length(4, 20);

			if ($input->submit()) {
				$name = $input->values['name'];
				$username = $input->values['username'];
				$email = $input->values['email'];
				$password = $input->values['password'];

				$table = "user";
				$data = array(
				'name' => $name,
				'username' => $username,
				'email' => $email,
				'password' => md5($password),
				'level' => '0'
				);			

				$db = $this->load->model("Database"); //Object

				$checkuser = $input->check($db, $table, "username", $username); //Check UserName
				if ($checkuser == true) {
					$msg = "User Name &quot;".$username."&quot; Already Exist !";
					header("Location: ".BASE_URL."/account/signup?msg=".urlencode(serialize($msg)));
					exit();
				}

				$checkemail = $input->check($db, $table, "email", $email); //Check Email
				if ($checkemail == true) {
					$msg = "User Name &quot;".$username."&quot; Already Exist !";
					header("Location: ".BASE_URL."/account/signup?msg=".urlencode(serialize($msg)));
					exit();
				}

				$result = $db->insert($table, $data); //Object Method			
				if ($result == 1) { // echo $query->execute() = 1
					$mdata = "Registration Successfully, Sign in Now.";
					$url = BASE_URL."/account/login?msg=".urlencode(serialize($mdata));
					header("Location: ".$url);
				}else{
					$mdata = "Registration Unsuccessful, Try Again";
					$url = BASE_URL."/account/signup?msg=".urlencode(serialize($mdata));
					header("Location: ".$url);
				}			
			}else{
				$dataerr['error'] = $input->errors;
				$data = array();
				$ctable = "category";
				$db = $this->load->model("Database"); //Object
				$data['scat'] = $db->select($ctable); //Object Method
				$this->load->view("header", $data);
				$this->load->view("regi/registration", $dataerr);
				$this->load->view("footer");
			} 
		}else{
			header("Location: ".BASE_URL."/account/signup");
		}
	}
	#________________________________Logout________________________________#
	public function logout()
	{
		Session::init();
		Session::destroy();
		header("Location:".BASE_URL."/account");
	}
}
?>