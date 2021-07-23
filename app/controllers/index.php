<?php 
class index extends PController
{
	
	function __construct()
	{
		parent::__construct();
		$data = array();
	}
	public function index()
	{
		$this->home();
	}
	public function home($id = 1)
	{
		$id = ($id*10)-10;
		$ptable = "post";
		$ctable = "category";
		$post_data = array(
			'order'  => 'id ASC',
			'limit'  => "$id, 10"
		);
		$rowcount = array(
			'type'  => 'count'
		);

		$db = $this->load->model("Database"); //This Object
		$data['rowcount'] = $db->select($ptable, $rowcount);
		$data['scat'] = $db->select($ctable); //This Object Method
		$this->load->view("header", $data);

		$data['post'] = $db->select($ptable, $post_data); //This Object Method
		$this->load->view("content", $data);

		$this->catSidebar($db); //$this->load->view("sidebar")

		$this->load->view("footer");
	}
	
	public function post($id = NULL)
	{
		$this->parameterNull($id);

		$ptable = "post";
		$ctable = "category";
		$comtable = "comment";
		$join_data = array(
			"select" => "$ptable.*, $ctable.cname",
			"from" => "$ptable",
			"join" => "$ctable",
			"on" => "$ptable.cid = $ctable.cid",
			"where" => "$ptable.id = $id"
		);
		$rowcount = array(
			'where'  => array('uid' => $id),
			"type"  => "count"
		);
		if (isset($_GET['cid']) && !empty($_GET['cid'])) {
			$cid = $_GET['cid']*3-3;
		}else{
			$cid = '0';
		}

		$db = $this->load->model("Database"); //This Object
		$data['scat'] = $db->select($ctable); //This Object Method
		$this->load->view("header", $data);

		//post
		$data['postbyid'] = $db->selectJoin($join_data); //This Object Method
		//rowcount comment
		$data['rowcount'] = $db->select($comtable, $rowcount);
		//comment
		$data['getcomment'] = $db->select3Join($id, $cid); //This Object Method
		$this->load->view("details", $data);

		$this->catSidebar($db);
		$this->load->view("footer");
	}
	public function category($id = NULL)
	{
		$this->parameterNull($id);
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
		$this->load->view("footer");
	}
	public function search($id = 1)
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$input = $this->load->validation('Form');
			$input->post('keyword');
			$input->post('category');
			$keyword = $input->values['keyword'];
			$cat = $input->values['category'];
		}elseif (isset($_GET['submit'])) {
			$keyword = $_GET['keyword'];
			$cat = $_GET['category'];
		}else{
			echo "Search Form In This Here";
			exit();
		}
			
		if (!empty($keyword) || $cat != 0) {
			if (isset($_GET['page']) && !empty($_GET['page'])) {
			$id = $_GET['page']*2-2;
			}else{
				$id = '0';
			}
			$ptable = "post";
			$ctable = "category";
			$rowcount = array(
				'type'  => 'count'
			);
			$count = [
				//'select' => 'id, title',
				'where'  => ['title' => $keyword, 'content' => $keyword],
				'where_and'  => [/*'id' => $id, */'cid' => $cat],
				'type' => 'count'
			];
			$cond = [
				//'select' => 'id, title',
				'where'  => ['title' => $keyword, 'content' => $keyword],
				'where_and'  => [/*'id' => $id, */'cid' => $cat],
				'limit'  => $id.', 2'
			];

			$db = $this->load->model("Database"); //This Object
			$data['scat'] = $db->select($ctable); //This Object Method
			$this->load->view("header", $data);

			//$data['postbysearch'] = $db->search($ptable, $keyword, $cat); //This Object Method
			$data['rowcount'] = $db->search($ptable, $count);
			$data['postbysearch'] = $db->search($ptable, $cond); //This Object Method
			$this->load->view("search", $data);

			$this->catSidebar($db);
			$this->load->view("footer");
		}else{
			header("Location: ".BASE_URL."/index/search/");
		}
	}

	//Help Methods
	public function catSidebar($db)
	{
		$ctable = "category";
		$ptable = "post";
		$post_data = array(
			'order'  => 'id DESC',
			'limit'  => '4'
		);		

		$data['cat'] = $db->select($ctable); //This Object Method
		$data['lpost'] = $db->select($ptable, $post_data); //This Object Method
		$this->load->view("sidebar", $data);
	}
	public function parameterNull($id)
	{
		if ($id == NULL) {
			header("Location:".BASE_URL);
			exit();
		}
	}
}
?>