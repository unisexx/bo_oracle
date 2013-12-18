<?php
class Inspect extends Inspect_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$this->template->build('inspect_index');
	}
}
?>