<?php 
	
	class PController
	{
		protected $load = array();
		function __construct()
		{
			$this->load = new Load();
		}
	}
?>