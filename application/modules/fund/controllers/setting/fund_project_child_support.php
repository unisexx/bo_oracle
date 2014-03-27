<?php

class Fund_project_child_support extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_project_child_support_model', 'fund_project_child_support_mdl');
	}
	
	public function index()
	{
		if(!empty($_GET['keyword']))
		{
			$this->fund_project_child_support_mdl->where("typeps_name like '%".$_GET['keyword']."%'");
		}
		$data['items'] = $this->fund_project_child_support_mdl->order_by('seq','asc')->get();
		$data['pagination']	= $this->fund_project_child_support_mdl->pagination();
		
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
		
		$this->template->build('setting/fund_project_child_support/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_project_child_support_mdl->get_row($id);
		$this->template->build('setting/fund_project_child_support/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$_POST['STAFF_ID'] = login_data('id');
			$this->fund_project_child_support_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_project_child_support');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_project_child_support_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_project_child_support');
	}
	
	public function chk_typeps_name()
	{
		if(@$_GET['typeps_name'])
		{
			$condition = '';
			if(@$_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_project_child_support where typeps_name = '".$_GET['typeps_name']."'".$condition."";
			$result = $this->fund_project_child_support_mdl->get($sql);
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