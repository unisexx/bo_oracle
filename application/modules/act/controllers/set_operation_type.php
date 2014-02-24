<?php
Class Set_operation_type extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("process_community_model","process_com");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " pcommunity_name like '%".$_GET['search']."%'" : "";
		$data['operation_types'] = $this->process_com->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->process_com->pagination();
		$this->template->build('set_operation_type/index',$data);
	}
	
	function form($id=false){
		$data['operation_type'] = $this->process_com->get_row($id);
		$this->template->build('set_operation_type/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->process_com->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_operation_type');
	}
	
	function delete($id){
		if($id){
			$this->process_com->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>