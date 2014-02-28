<?php
Class Workinggroup extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("officer2_model","officer2");
	}
	
	function index(){
		$condition =" 1=1 ";		
		$condition .= @$_GET['search']!='' ? " and fname like '%".$_GET['search']."%' or lname like '%".$_GET['search']."%' or tel like '%".$_GET['search']."%' or email like '%".$_GET['search']."%' " : "";
		$condition .= @$_GET['province_code']!='' ? ' and province_code = '.$_GET['province_code'] : '';
		
		$data['officers'] = $this->officer2->where($condition)->get(false,FALSE);
		$data['pagination'] = $this->officer2->pagination();
		$this->template->build('workinggroup/index',$data);
	}
	
	function form($id=false){
		$data['officer'] = $this->officer2->get_row($id);
		$this->template->build('workinggroup/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->officer2->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/workinggroup');
	}
	
	function delete($id){
		if($id){
			$this->officer2->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>