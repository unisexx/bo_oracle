<?php
Class Set_branch_service extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("branch_service_model","branch_service");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " branch_service_name like '%".$_GET['search']."%'" : "";
		$data['branch_services'] = $this->branch_service->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->branch_service->pagination();
		$this->template->build('set_branch_service/index',$data);
	}
	
	function form($id=false){
		$data['branch_service'] = $this->branch_service->get_row($id);
		$this->template->build('set_branch_service/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->branch_service->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_branch_service');
	}
	
	function delete($id){
		if($id){
			$this->branch_service->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>