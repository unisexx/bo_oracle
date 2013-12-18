<?php
class Logout extends Inspect_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function index(){
		//$this->db->debug = true;
		logout();		
		redirect('home');
	}
}		