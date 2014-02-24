<?php
Class Competent extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("officer_model","officer");
	}
	
	function index(){
		$condition =" 1=1 ";		
		$condition .= @$_GET['search']!='' ? " and fname like '%".$_GET['search']."%' or lname like '%".$_GET['search']."%' or tel like '%".$_GET['search']."%' or email like '%".$_GET['search']."%' " : "";
		$condition .= @$_GET['province_code']!='' ? ' and province_code = '.$_GET['province_code'] : '';
		
		$data['officers'] = $this->officer->where($condition)->get(FALSE,FALSE);
		$data['pagination'] = $this->officer->pagination();
		$this->template->build('competent/index',$data);
	}
	
	function form($id=false){
		$data['officer'] = $this->officer->get_row($id);
		$this->template->build('competent/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->officer->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/competent');
	}
	
	function delete($id){
		if($id){
			$this->officer->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>