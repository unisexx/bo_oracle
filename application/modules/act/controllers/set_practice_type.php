<?php
Class Set_practice_type extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("specific_model","practice_type");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " specific_name like '%".$_GET['search']."%'" : "";
		$data['practice_types'] = $this->practice_type->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->practice_type->pagination();
		$this->template->build('set_practice_type/index',$data);
	}
	
	function form($id=false){
		$data['practice_type'] = $this->practice_type->get_row($id);
		$this->template->build('set_practice_type/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->practice_type->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_practice_type');
	}
	
	function delete($id){
		if($id){
			$this->practice_type->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>