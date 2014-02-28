<?php
Class Set_committee_expert extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("committee_ability_model","com_ex");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " ability_name like '%".$_GET['search']."%'" : "";
		$data['committee_experts'] = $this->com_ex->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->com_ex->pagination();
		$this->template->build('set_committee_expert/index',$data);
	}
	
	function form($id=false){
		$data['committee_expert'] = $this->com_ex->get_row($id);
		$this->template->build('set_committee_expert/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->com_ex->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_committee_expert');
	}
	
	function delete($id){
		if($id){
			$this->com_ex->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>