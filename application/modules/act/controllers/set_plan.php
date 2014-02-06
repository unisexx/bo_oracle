<?php
Class Set_plan extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("plan_model","plan");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " plan_name like '%".$_GET['search']."%'" : "";
		$data['plans'] = $this->plan->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->plan->pagination();
		$this->template->build('set_plan/index',$data);
	}
	
	function form($id=false){
		$data['plan'] = $this->plan->get_row($id);
		$this->template->build('set_plan/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->plan->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_plan');
	}
	
	function delete($id){
		if($id){
			$this->plan->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>