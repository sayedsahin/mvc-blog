<?php 
class Admin extends PController
{
	
	function __construct()
	{
		parent::__construct();
		Session::checkSession();
		$data = array();
	}
	public function index()
	{
		$this->home();
	}
	public function home()
	{
		$this->load->view("admin/header");
		$this->load->view("admin/sidebar");
		$this->load->view("admin/home");
		$this->load->view("admin/footer");
	}
}
?>