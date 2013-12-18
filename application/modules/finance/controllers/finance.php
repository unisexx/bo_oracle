<?php
class Finance extends Finance_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->template->build('finance_index');
	}
}
?>