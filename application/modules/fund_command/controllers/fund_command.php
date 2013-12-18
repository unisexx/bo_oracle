<?php
Class Fund_command extends Fund_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	function index(){
		
	}
	
	function form(){
		$this->template->build('command_form');
	}
	
	function save(){
		
	}
}
?>