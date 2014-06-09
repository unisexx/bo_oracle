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
		$this->template->build('main');
	}
	
	public function get_amphur($id)
	{
		echo form_dropdown("amphur_id",get_option("ID","TITLE","FUND_AMPHUR","PROVINCE_ID = $id","TITLE"),@$value->amphur_id,"id=\"amphur_id\"","-- เลือกอำเภอ --");
	}
	
	public function get_district($id)
	{
		echo form_dropdown("district_id",get_option("ID","TITLE","FUND_DISTRICT","AMPHUR_ID = $id","TITLE"),@$value->amphur_id,"id=\"district_id\"","-- เลือกตำบล --");
	}
	
}