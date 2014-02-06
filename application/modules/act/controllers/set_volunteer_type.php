<?php
Class Set_volunteer_type extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("volunteer_type_model","volunteer_type");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " volunteer_type_name like '%".$_GET['search']."%'" : "";
		$data['volunteer_types'] = $this->volunteer_type->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->volunteer_type->pagination();
		$this->template->build('set_volunteer_type/index',$data);
	}
	
	function form($id=false){
		$data['volunteer_type'] = $this->volunteer_type->get_row($id);
		$this->template->build('set_volunteer_type/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->volunteer_type->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_volunteer_type');
	}
	
	function delete($id){
		if($id){
			$this->volunteer_type->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>