<?php

class Fund_loan extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_loan_model', 'fund_loan_mdl');
	}
	
	public function index()
	{
		$data['items'] = $this->fund_loan_mdl->get();
		$data['pagination']	= $this->fund_loan_mdl->pagination();
		$this->template->build('setting/fund_loan/index', $data);
	}
	
	public function form($id = null)
	{
		
	}
	
	public function save()
	{
		
	}
	
	public function delete()
	{
		
	}
	
}