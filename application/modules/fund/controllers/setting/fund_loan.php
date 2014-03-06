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
		$data['rs'] = $this->fund_loan_mdl->get_row($id);
		$this->template->build('setting/fund_loan/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$this->fund_loan_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_loan');
	}
	
	public function delete($id)
	{
		if($id)
		{
			//$this->fund_loan->mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_loan');
	}
	
}