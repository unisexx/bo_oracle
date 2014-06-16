<?php

class Fund_attorney extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_attorney_model', 'fund_attorney_mdl');
	}
	
	public function index()
	{
		if(!empty($_GET['keyword'])) {
			$this->fund_attorney_mdl->where("names like '%".$_GET['keyword']."%'");
		}
		
		$data['items'] = $this->fund_attorney_mdl->get();
		$data['pagination']	= $this->fund_attorney_mdl->pagination();
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
		$data['no'] = (($_GET['page']-1)*20)+1;

		$this->template->build('setting/fund_attorney/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_attorney_mdl->get_row($id);
		$this->template->build('setting/fund_attorney/form', $data);
	}
	
	
	public function save()
	{
		if($_POST)
		{
			$this->fund_attorney_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_attorney');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_attorney_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_attorney');
	}
	public function chk_fund_name()
	{
		if(@$_GET['names'])
		{
			$condition = '';
			if(@$_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_attorney where names = '".$_GET['names']."'".$condition."";
			$result = $this->fund_attorney_mdl->get($sql);
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