<?php 
class post extends PController
{
	//User Access Use in View Page
	function __construct()
	{
		parent::__construct();
		Session::checkSession();
		$data = array();
	}
	public function index()
	{
		$this->postlist();
	}
	public function postlist()
	{
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$ptable = "post";
		$ctable = "category";
		$post_data = array('order' => 'id DESC');
		$db = $this->load->model("Database"); //This Object
		$data['postlist'] = $db->select($ptable, $post_data); //This Object Method
		$data['catlist'] = $db->select($ctable); //This Object Method
		$this->load->view("admin/postlist", $data);

		$this->load->view("admin/footer");
	}
	public function postadd()
	{
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$ctable = "category";
		$db = $this->load->model("Database"); //This Object
		$data['catlist'] = $db->select($ctable); //This Object Method
		$this->load->view("admin/postadd", $data);
		$this->load->view("admin/footer");
	}
	public function postaddpro()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') { //Validation Way 1
			$input = $this->load->validation('Form');
			$input->post('title')->isEmpty()->length(5, 100); //Method Chaining
			$input->post('content')->isEmpty();
			$input->post('category')->isCatEmpty();

			if ($input->submit()) {
				$title = $input->values['title'];
				$content = $input->values['content'];
				$category = $input->values['category'];
				$ptable = "post";

				#Image Start
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_error = $_FILES['image']['error'];
				$file_temp = $_FILES['image']['tmp_name'];
				$permited = array('jpg', 'jpeg', 'png', 'gif' );

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_image = uniqid().'.'.$file_ext;

				$year = date("Y");
				$month = date("m");
				$uploaded_image = "img/".$year.'/'.$month.'/'.$unique_image;

				if (!empty($file_name)) {				
					if ($file_error !== 0) {
						$msg = "There was an error uploading your image !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/post/postadd");
						exit();
					}elseif ($file_size > 1048576) {
						$msg = "Image size should be less then 1MB !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/post/postadd");
						exit();
					}elseif (in_array($file_ext, $permited) === false) {
						$msg = "You can upload only: ".implode(', ', $permited)." !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/post/postadd");
						exit();
					}else{
						$data = array(
							'title' => $title,
							'content' => $content,
							'cid' => $category,
							'uid' => Session::get("userId"),
							'image' => $uploaded_image
						);
						!file_exists("img/".$year) ? mkdir("img/".$year) : false ; //Creat Folder
						!file_exists("img/".$year."/".$month) ? mkdir("img/".$year."/".$month) : false ;
						move_uploaded_file($file_temp, $uploaded_image);
					}
				}else{
					$data = array(
					'title' => $title,
					'content' => $content,
					'cid' => $category,
					'uid' => Session::get("userId")
					);
				}
				#Image End
				$db = $this->load->model("Database");
				$result = $db->insert($ptable, $data);
				if ($result == 1) {
					$msg = "&#x2714; Post Submited Successfully";
				}else{
					$msg = "Post Not Submited !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/post/postlist");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/post/postadd");
			}
		}else{
			header("Location: ".BASE_URL."/post/postadd");
		}
	}
	public function postedit($id = NULL)
	{
		$this->parameterNull($id);
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");

		$ptable = "post";
		$ctable = "category";
		$cond = array('where'  => array('id' => $id));

		$db = $this->load->model("Database"); //This Object
		$data['postbyid'] = $db->select($ptable, $cond); //This Object Method
		$data['category'] = $db->select($ctable); //This Object Method

		$this->load->view("admin/postedit", $data);

		$this->load->view("admin/footer");
	}	
	public function posteditpro($id = NULL)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('title')->isEmpty()->length(5, 300); //Method Chaining
			$input->post('content')->isEmpty();
			$input->post('category')->isCatEmpty();	

			if ($input->submit()) {
				$title = $input->values['title'];
				$content = $input->values['content'];
				$category = $input->values['category'];
				$ptable = "post";
				$db = $this->load->model("Database"); //Object

				#Image Start
				$file_name = $_FILES['image']['name'];
				$file_size = $_FILES['image']['size'];
				$file_error = $_FILES['image']['error'];
				$file_temp = $_FILES['image']['tmp_name'];
				$permited = array('jpg', 'jpeg', 'png', 'gif' );

				$div = explode('.', $file_name);
				$file_ext = strtolower(end($div));
				$unique_image = uniqid().'.'.$file_ext;

				$year = date("Y");
				$month = date("m");
				$uploaded_image = "img/".$year.'/'.$month.'/'.$unique_image;

				if (!empty($file_name)) {				
					if ($file_error !== 0) {
						$msg = "There was an error uploading your image !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/post/postadd");
						exit();
					}elseif ($file_size > 1048576) {
						$msg = "Image size should be less then 1MB !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/post/postadd");
						exit();
					}elseif (in_array($file_ext, $permited) === false) {
						$msg = "You can upload only: ".implode(', ', $permited)." !";
						Session::set("msg", $msg);
						header("Location: ".BASE_URL."/post/postadd");
						exit();
					}else{
						$data = array(
							'title' => $title,
							'content' => $content,
							'cid' => $category,
							'image' => $uploaded_image,
							'date_update' => date("Y-m-d H:i:s")
						);
						$getData = array(
							'select' => 'image',
							'where' => array('id' => $id),
							'type' => 'single',
							'limit' => '1'
						);
						$getimg = $db->select($ptable, $getData);
						unlink($getimg['image']); //Delete Old Image
						!file_exists("img/".$year) ? mkdir("img/".$year) : false ; //Creat Folder
						!file_exists("img/".$year."/".$month) ? mkdir("img/".$year."/".$month) : false ;
						move_uploaded_file($file_temp, $uploaded_image);
					}
				}else{
					$data = array(
						'title' => $title,
						'content' => $content,
						'cid' => $category,
						'date_update' => date("Y-m-d H:i:s")
					);
				}
				
				$cond = array('id' => $id);
				$result = $db->update($ptable, $data, $cond);
				if ($result == 1) {
					$msg = "Post Updated Successfully";
				}else{
					$msg = "Post Not Updated !";
				}
				Session::set("msg", $msg);
				header("Location: ".BASE_URL."/post/postlist");
			}else{
				$error = $input->errors;
				Session::set("msg", $error);
				header("Location: ".BASE_URL."/post/postedit/".$id);
			} 
		}else{
			header("Location: ".BASE_URL."/post/postlist");
		}
		#Image End
	}
	public function postdelete($id = NULL)
	{
		$ptable = "post";
		$cond = array(
			'select' => 'uid',
			'where' => array('id' => $id),
			'type'	=> 'single',
			'limit' => '1'
		);
		$db = $this->load->model("Database"); // This Object
		$postbyid = $db->select($ptable, $cond);
		$uid = $postbyid['uid'];

		if ((Session::get('level') == 3 || Session::get('userId') == $uid) && (Session::get('level') != 0)) {
			$this->parameterNull($id);
			$ptable = "post";
			$where = array( 'id' => $id );
			$result = $db->delete($ptable, $where); //This Object Method
			if ($result == 1) { // echo $query->execute() = 1
				$msg = "Post Deleted Successfully";
				//Delete Post Comment
				$comtable = "comment";
				$wherecom = array( 'pid' => $id );
				$deletecom = $db->delete($comtable, $wherecom);
			}else{
				$msg = "Post Not Deleted !";
			}
			Session::set("msg", $msg);
			header("Location: ".BASE_URL."/post/postlist");
		}else{
			header("Location: ".BASE_URL."/Admin");
		}
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