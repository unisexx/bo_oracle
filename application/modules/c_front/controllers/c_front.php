<?php
class C_front extends Admin_Controller
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