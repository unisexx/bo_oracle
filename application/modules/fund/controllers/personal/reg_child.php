<?php
/**
 * Reg Child
 * ทะเบียนข้อมูลเด็ก
 */
class Reg_Child extends Fund_Controller {
	
	function __construct() 
	{
		parent::__construct();
		$this->load->model('fund_child_model');
	}
	
	public function index() 
	{
		$data['items'] = $this->fund_child_model->get();
		$data['pagination'] = $this->fund_child_model->pagination();
		$this->template->build("personal/reg_child/index", $data);
	}
	
	public function form($id = null)
	{
		$this->template->build('personal/reg_child/form');
	}
	
	public function save()
	{
		
	}
	
	public function delete($id)
	{
		
	}
	
}