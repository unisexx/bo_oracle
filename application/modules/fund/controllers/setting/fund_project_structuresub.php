<?php

class fund_project_structuresub extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_project_structuresub_model', 'fund_project_structuresub_mdl');
	}
	
	public function index()
	{
		$condition = "1=1";
		if(!empty($_GET['keyword']))
		{
			$condition .= " and structuresub.pssub_name like '%".$_GET['keyword']."%'";
		}
		
		$sql = "select structuresub.*,structure.ps_name
				from fund_project_structuresub structuresub
				left join fund_project_structure structure on structuresub.fund_project_structure_id = structure.id 
				where ".$condition;
		
		$data['items'] = $this->fund_project_structuresub_mdl->get($sql);
		$data['pagination']	= $this->fund_project_structuresub_mdl->pagination();
		
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
		
		$this->template->build('setting/fund_project_structuresub/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_project_structuresub_mdl->get_row($id);
		$this->template->build('setting/fund_project_structuresub/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$_POST['STAFF_ID'] = login_data('id');
			$this->fund_project_structuresub_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_project_structuresub');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_project_structuresub_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_project_structuresub');
	}
	
	public function chk_pssub_name()
	{
		if(@$_GET['pssub_name'] != '' && @$_GET['fund_project_structure_id'] != '')
		{
			$condition = '';
			if(@$_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_project_structuresub where pssub_name = '".$_GET['pssub_name']."' 
					and fund_project_structure_id = '".$_GET['fund_project_structure_id']."' ".$condition."";
			$result = $this->fund_project_structuresub_mdl->get($sql);
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