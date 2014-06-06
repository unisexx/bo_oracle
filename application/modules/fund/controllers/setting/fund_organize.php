<?php

class Fund_organize extends Fund_Setting_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fund_organize_model', 'fund_organize_mdl');
	}
	
	public function index()
	{
		if(!empty($_GET['keyword'])) {
			$this->fund_organize_mdl->where("name like '%".$_GET['keyword']."%'");
		}
		
		$data['items'] = $this->fund_organize_mdl->get();
		$data['pagination']	= $this->fund_organize_mdl->pagination();
		$_GET['page'] = (empty($_GET['page']))?1:$_GET['page'];
		$data['no'] = (($_GET['page']-1)*20)+1;

		$this->template->build('setting/fund_organize/index', $data);
	}
	
	public function form($id = null)
	{
		$data['rs'] = $this->fund_organize_mdl->get_row($id);
		$this->template->build('setting/fund_organize/form', $data);
	}
	
		public function dd_chain_amphur() {
			$tmp = get_option('id', 'title', 'fund_amphur where province_id = '.$_GET['province_id']);
			
			$rs = '<option value="">-- เลือกอำเภอ/เขต --</option>';
			
			foreach($tmp as $key=>$item) {
				$rs .= '<option value="'.$key.'">'.$item.'</option>';
			}

			echo $rs;
		}

		public function dd_chain_district() {
			$tmp = get_option('id', 'title', 'fund_district where amphur_id = '.$_GET['amphur_id']);
			
			$rs = '<option value="">-- เลือกอำเภอ/เขต --</option>';
			
			foreach($tmp as $key=>$item) {
				$rs .= '<option value="'.$key.'">'.$item.'</option>';
			}

			echo $rs;
		}
	
	public function save()
	{
		if($_POST)
		{
			$this->fund_organize_mdl->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('fund/setting/fund_organize');
	}
	
	public function delete($id)
	{
		if($id)
		{
			$this->fund_organize_mdl->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('fund/setting/fund_organize');
	}
	public function chk_fund_name()
	{
		if(@$_GET['title'])
		{
			$condition = '';
			if(@$_GET['id']){
				$condition = " and id != '".$_GET['id']."' ";
			}
			
			$sql = "select * from fund_organize where title = '".$_GET['title']."'".$condition."";
			$result = $this->fund_organize_mdl->get($sql);
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