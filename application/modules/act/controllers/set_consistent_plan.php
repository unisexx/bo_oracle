<?php
Class Set_consistent_plan extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("policy_model","consistent");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " policy_name like '%".$_GET['search']."%'" : "";
		$data['consistents'] = $this->consistent->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->consistent->pagination();
		$this->template->build('set_consistent_plan/index',$data);
	}
	
	function form($id=false){
		$data['consistent'] = $this->consistent->get_row($id);
		$this->template->build('set_consistent_plan/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->consistent->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_consistent_plan');
	}
	
	function delete($id){
		if($id){
			$this->consistent->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>