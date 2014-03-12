<?php

class Fund_name extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_name_model', 'fund_name_mdl');
	}
	
	public function index()
	{
		if(!empty($_GET['keyword']))
		{
			$this->fund_name_mdl->where("fund_name like '%".$_GET['keyword']."%'");
		}
		$data['items'] = $this->fund_name_mdl->get();
		$data['pagination']	= $this->fund_name_mdl->pagination();
		$this->template->build('setting/fund_name/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_name_mdl->get_row($id);
		$this->template->build('setting/fund_name/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$this->fund_name_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_name');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_name_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_name');
	}
	
}