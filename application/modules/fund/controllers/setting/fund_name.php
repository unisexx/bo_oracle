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
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
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
	
	public function chk_fund_name()
	{
		if(@$_GET['fund_name'])
		{
			$condition = '';
			if(@$_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_mst_fund_name where fund_name = '".$_GET['fund_name']."'".$condition."";
			$result = $this->fund_name_mdl->get($sql);
			if(count($result) > 0){
				echo "false";
			}else{
				echo "true";
			}
		}else{
			echo "true";
		}
	}
}