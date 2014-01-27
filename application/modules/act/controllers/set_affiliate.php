<?php
Class Set_affiliate extends  Act_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->build('set_affiliate/index');
	}
	
	function form(){
		$this->template->build('set_affiliate/form');
	}
}
?>