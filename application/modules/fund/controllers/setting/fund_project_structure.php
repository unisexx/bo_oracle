<?php

class Fund_project_structure extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_project_structure_model', 'fund_project_structure_mdl');
	}
	
	public function index()
	{
		if(!empty($_GET['keyword']))
		{
			$this->fund_project_structure_mdl->where("ps_name like '%".$_GET['keyword']."%'");
		}
		$data['items'] = $this->fund_project_structure_mdl->order_by('seq','asc')->get();
		$data['pagination']	= $this->fund_project_structure_mdl->pagination();
		
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
		
		$this->template->build('setting/fund_project_structure/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_project_structure_mdl->get_row($id);
		$this->template->build('setting/fund_project_structure/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$_POST['STAFF_ID'] = login_data('id');
			$this->fund_project_structure_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_project_structure');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_project_structure_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_project_structure');
	}
	
	public function chk_ps_name()
	{
		if(@$_GET['ps_name'])
		{
			$condition = '';
			if(@$_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_project_structure where ps_name = '".$_GET['ps_name']."'".$condition."";
			$result = $this->fund_project_structure_mdl->get($sql);
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