<?php
class budget extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		if(!is_login())redirect("home.php");
		$this->template->build('index');
	}
}
?>