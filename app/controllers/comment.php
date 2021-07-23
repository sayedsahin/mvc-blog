<?php 
class comment extends PController
{
	
	function __construct()
	{
		parent::__construct();
		$data = [];
	}
	public function index()
	{
		
	}
	public function getcomment($id)
	{
		$ptable = "post";
		$comtable = "comment";
		$post = [
			'select' => 'id',
			'where' => ['id' => $id],
			'type' => 'single',
			'limit' => '1'
		];
		$rowcount = array(
			'where'  => array('uid' => $id),
			"type"  => "count"
		);
		if (isset($_GET['cid']) && !empty($_GET['cid'])) {
			$cid = $_GET['cid']*3-3;
		}else{
			$cid = '0';
		}

		$db = $this->load->model("Database");
		$data['post'] = $db->select($ptable, $post);
		//rowcount comment
		$data['rowcount'] = $db->select($comtable, $rowcount);
		//comment
		$data['getcomment'] = $db->select3Join($id, $cid); //This Object Method
		$this->load->view("showcomment", $data);
	}
	public function comment($id)
	{
		Session::checkSession();
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Validation Way 1
			$input = $this->load->validation('Form');
			$input->post('comment')->isEmpty()->length(5, 500); //Method Chaining
			Session::init();

			if ($input->submit()) {
				$comment = $input->values['comment'];
				$table = "comment";
				$data = array(
					'body' => $comment,
					'pid' => $id,
					'uid' => Session::get("userId")
				);

				$db = $this->load->model("Database");
				$result = $db->insert($table, $data);
				if ($result == 1) {
					$msg = "&#x2714; Comment Submitted Successfully";
				}else{
					$msg = "Comment Not Submitted !";
				}
				//When Javascript Block
				if (empty($_POST['ajax'])) { 
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/index/post/$id#comment");
				}
			}else{
				$msg = $input->errors;
				//When Javascript Block
				if (empty($_POST['ajax'])){ 
					Session::set("msg", $msg);
					header("Location: ".BASE_URL."/index/post/$id#comment");
				}
			}
			//When Javascript Allow
			if (is_array($msg) && !empty($_POST['ajax'])) { 
				echo "<p class='alert alert-danger'>";
				foreach ($msg as $key => $value) {
                    foreach ($value as $val) {
                        echo "* ".$val." (".$key.")<br>";
                    }
                }
                echo "</p>";
			}else{
				echo '<p class="alert alert-success">'.$msg.'</p>';
			}
		}else{
			header("Location: ".BASE_URL."/index/post/$id#comment");
		}
	}
	public function list($id = 1)
	{
		Session::checkSession();
		$id = ($id*20)-20;
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$cond = [
			'where' => ['uid' => Session::get('userId')],
			'order' => 'comid DESC',
			'limit' => $id.',20'
		];
		$rowcount = [
			'where' => ['uid' => Session::get('userId')],
			'type' => 'count'
		];
		$table = "comment";
		$db = $this->load->model("Database"); //This Object
		$data['comment'] = $db->select($table, $cond); //This Object Method
		$data['rowcount'] = $db->select($table, $rowcount); //This Object Method
		$this->load->view("admin/commentlist", $data);

		$this->load->view("admin/footer");
	}
	public function edit($id = NULL)
	{
		Session::checkSession();
		$this->parameterNull($id);
		$db = $this->load->model("Database"); //This Object
		$this->commentAccess($id, $db); //Comment Access
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");
		$uid = '1';
		$table = "comment";
		$query_data = array('where'  => array('comid' => $id, 'uid' => $uid, 'status' => 0));
		$data['commentbyid'] = $db->select($table, $query_data); //This Object Method
		$this->load->view("admin/commentedit", $data);

		$this->load->view("admin/footer");
	}
	public function editpro($id = NULL)
	{
		Session::checkSession();
		$this->parameterNull($id);
		$db = $this->load->model("Database");
		$this->commentAccess($id, $db); //Comment Access

		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
			$input = $this->load->validation('Form');
			$input->post('comment')->isEmpty()->length(3, 600); //Method Chaining
			$input->post('uid')->isEmpty(); //Method Chaining
			if ($input->submit()) {
				$comment = $input->values['comment'];
				$table = "comment";
				$data = array(
				'body' => $comment,
				'date_update' => date("Y-m-d H:i:s")
				);
				$cond = array('comid' => $id);

				$result = $db->update($table, $data, $cond); //This Object Method
				if ($result == 1) { // echo $query->execute() = 1
					$msg = "&#x2714; Name updated successfully";
				}else{
					$msg = "Name not updated !";
				}
				Session::set("msg", $msg);
				header('Location: '.Session::get('link').'#comment');
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header('Location: '.Session::get('link').'#comment');
			} 
		}else{
			header('Location: '.Session::get('link').'#comment');
		}
		unset($_SESSION['link']);
	}
	public function delete($id = NULL)
	{
		Session::checkSession();
		Session::set("link", $_SERVER['HTTP_REFERER']);
		$this->parameterNull($id);
		$db = $this->load->model("Database");
		$this->commentAccess($id, $db); //Comment Access
		$table = "comment";
		$wcond = array('comid' => $id );
		$result = $db->delete($table, $wcond);;
		if ($result == 1) { // echo $query->execute() = 1
			$msg = "Comment Deleted Successfully";
		}else{
			$msg = "Comment Not Deleted !";
		}
		Session::set("msg", $msg);
		header("Location: ".Session::get('link')."#comment");
		unset($_SESSION['link']);
	}
	#................................Help Function................................#
	public function parameterNull($id)
	{
		if ($id == NULL) {
			header("Location:".BASE_URL);
			exit();
		}
	}
	public function commentAccess($id, $db)
	{
		$table = "comment";
		$cond = array(
			'select' => 'uid',
			'where' => array('comid' => $id),
			'type'	=> 'single',
			'limit' => '1'
		);
		$getuserid = $db->select($table, $cond);
		$uid = $getuserid['uid'];
		if (Session::get('userId') != $uid && Session::get('level') != 3) {
			header("Location:".BASE_URL);
			exit();
		}
	}
}
?>