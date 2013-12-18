<?php
Class Fund extends  Fund_Controller{
	public function __construct(){
		parent::__construct();
	}
	
	function index(){
		$this->template->build('fund_index');
	}
}
?>