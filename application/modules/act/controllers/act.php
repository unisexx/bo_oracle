<?php
Class Act extends  Act_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->build('act_index');
	}
}
?>