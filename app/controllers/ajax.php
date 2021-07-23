<?php 
class ajax extends PController
{
	
	function __construct()
	{
		parent::__construct();
		$data = [];
	}
	public function index()
	{
		
	}
	// No Need getcomment
	/*public function getcomment($id)
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
	}*/
	//no need comment
	/*public function comment($id)
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
			}else{
				$msg = $input->errors;
			}
			if (is_array($msg)) {
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
		}
	}*/

	public function search2()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('keyword');
			$input->post('category');
			$keyword = $input->values['keyword'];
			$cat = $input->values['category'];

			$ptable = "post";
			$ctable = "category";
			$db = $this->load->model("Database"); //This Object
			$data = $db->search($ptable, $keyword, $cat); //This Object Method
			if ($data) {
				echo "<div class='list-group dropdown-menu'>";
				foreach ($data as $key => $value) {
					echo "<a class='list-group-item list-group-item-action' href='".BASE_URL."/index/post/".$value['id']."'>".$value['title']."</a>";
				}
				echo "</div>";
			}else{
				echo "none";
			}
		}
	}
	public function search()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('keyword');
			$input->post('category');
			$keyword = $input->values['keyword'];
			$cid = $input->values['category'];

			$ptable = "post";
			$ctable = "category";
			$cond = [
				'select' => 'id, title',
				'where'  => ['title' => $keyword, 'content' => $keyword],
				'where_and'  => [/*'id' => $id, */'cid' => $cid],
				'limit' => '10'
			];
			$db = $this->load->model("Database"); //This Object
			$data = $db->search($ptable, $cond); //This Object Method
			if ($data) {
				echo "<div class='list-group dropdown-menu'>";
				foreach ($data as $key => $value) {
					echo "<a class='list-group-item list-group-item-action' href='".BASE_URL."/index/post/".$value['id']."'>".$value['title']."</a>";
				}
				echo '<span class="border p-1 text-primary text-center">more result click submit&rarr;</span>';
				echo "</div>";
			}else{
				echo "<div class='list-group dropdown-menu'><a class='list-group-item list-group-item-action'>Search Data Not Found</a></div>";
			}
		}
	}
}
?>