<?php

class Fund_reg_child extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		#$this->load->model('fund_reg_child_model', 'fund_reg_child_mdl');
	}
	
	public function index()
	{
		/*
		if(!empty($_GET['keyword']))
		{
			$this->fund_reg_child_mdl->where("typep_name like '%".$_GET['keyword']."%'");
		}
		$data['items'] = $this->fund_reg_child_mdl->order_by('seq','asc')->get();
		$data['pagination']	= $this->fund_reg_child_mdl->pagination();
		
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
		*/
		$this->template->build('setting/fund_reg_child/index', @$data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_reg_child_mdl->get_row($id);
		$this->template->build('setting/fund_reg_child/form', $data);
	}
	
	public function save()
	{
		if($_POST)
		{
			$_POST['STAFF_ID'] = login_data('id');
			$this->fund_reg_child_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_reg_child');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_reg_child_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_reg_child');
	}
	
	public function chk_typep_name()
	{
		if($_GET['typep_name'])
		{
			$condition = '';
			if($_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_reg_child where typep_name = '".$_GET['typep_name']."'".$condition."";
			$result = $this->fund_reg_child_mdl->get($sql);
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