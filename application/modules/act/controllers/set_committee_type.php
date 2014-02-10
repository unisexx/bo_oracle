<?php
Class Set_committee_type extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("committee_type_model","committee_type");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " committee_type_name like '%".$_GET['search']."%'" : "";
		$data['committee_types'] = $this->committee_type->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->committee_type->pagination();
		$this->template->build('set_committee_type/index',$data);
	}
	
	function form($id=false){
		$data['committee_type'] = $this->committee_type->get_row($id);
		$this->template->build('set_committee_type/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->committee_type->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_committee_type');
	}
	
	function delete($id){
		if($id){
			$this->committee_type->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>