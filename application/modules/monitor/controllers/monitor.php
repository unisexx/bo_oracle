<?php
class Monitor extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->template->build('monitor_index');
	}
}
?>