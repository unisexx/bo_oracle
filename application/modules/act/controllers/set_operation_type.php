<?php
Class Set_operation_type extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("operation_type_model","operation_type");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " operation_type like '%".$_GET['search']."%'" : "";
		$data['operation_types'] = $this->operation_type->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->operation_type->pagination();
		$this->template->build('set_operation_type/index',$data);
	}
	
	function form($id=false){
		$data['operation_type'] = $this->operation_type->get_row($id);
		$this->template->build('set_operation_type/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->operation_type->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_operation_type');
	}
	
	function delete($id){
		if($id){
			$this->operation_type->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>