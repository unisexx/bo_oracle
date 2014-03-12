<?php

class Fund_transfer_province extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_transfer_province_model', 'fund_transfer_province_mdl');
	}
	
	public function index()
	{
		if(!empty($_GET['keyword']))
		{
			//$this->fund_name_mdl->where("fund_name like '%".$_GET['keyword']."%'");
		}
		$sql = "SELECT T.*, P.TITLE, F.FUND_NAME
		FROM FUND_TRANSFER_PROVINCE T
		JOIN CNF_PROVINCE P ON P.ID = T.PROVINCE_ID
		LEFT JOIN FUND_MST_FUND_NAME F ON F.ID = T.FUND_ID";
		$data['items'] = $this->fund_transfer_province_mdl->get($sql);
		$data['pagination']	= $this->fund_transfer_province_mdl->pagination();
		$this->template->build('setting/fund_transfer_province/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_transfer_province_mdl->get_row($id);
		$this->template->build('setting/fund_transfer_province/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$this->fund_transfer_province_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_transfer_province');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_transfer_province_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_transfer_province');
	}
	
}