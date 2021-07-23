<?php 
/**
 * Main Controller
 */
class Main
{
	public $url;
	public $ctlrName = "index";
	public $methodName = "index";
	public $ctlrPath = "app/controllers/";
	public $ctlr;
	function __construct()
	{
		$this->getUrl();
		$this->loadController();
		$this->loadMethod();
	}
	public function getUrl()
	{
		if (isset($_GET['url'])) {
			$this->url = $_GET['url'];
			$this->url = rtrim($this->url, '/');
			$this->url = explode('/', filter_var($this->url, FILTER_SANITIZE_URL));
		}else{
			unset($this->url);
		}
	}
	public function loadController()
	{
		if (!isset($this->url[0])) {
			include $this->ctlrPath.$this->ctlrName.'.php';
			$this->ctlr = new $this->ctlrName();
		}else{
			$this->ctlrName = $this->url[0];
			$fileName = $this->ctlrPath.$this->ctlrName.'.php';
			if (file_exists($fileName)) {
				include $fileName;
				if (class_exists($this->ctlrName)) {
					$this->ctlr = new $this->ctlrName();
				}else{
					header("Location: ".BASE_URL);
				}
			}else{
				header("Location: ".BASE_URL);
			}
		}
	}
	public function loadMethod()
	{
		if (isset($this->url[2])) {
			$this->methodName = $this->url[1]; //old $a
			if (method_exists($this->ctlr, $this->methodName)) {
				$this->ctlr->{$this->methodName}($this->url[2]);
			}else{
				header("Location: ".BASE_URL);
			}			
		}else{
			if (isset($this->url[1])) {
				$this->methodName = $this->url[1]; //old $a
				if (method_exists($this->ctlr, $this->methodName)) {
					$this->ctlr->{$this->methodName}();
				}else{
					header("Location: ".BASE_URL);
				}
			}else{
				if (method_exists($this->ctlr, $this->methodName)) {
					$this->ctlr->{$this->methodName}();
				}else{
					header("Location: ".BASE_URL);
				}
			}
		}
	}
}
?>