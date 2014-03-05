<?php

Class Fund extends Fund_Controller {
		
	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->template->build('index');
	}
	
	public function main($fund_id)
	{
		$this->template->build('fund_index');
	}
}