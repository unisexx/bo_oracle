<?php
Class Set_project extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("project_model","project");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " project_name like '%".$_GET['search']."%'" : "";
		$data['projects'] = $this->project->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->project->pagination();
		$this->template->build('set_project/index',$data);
	}
	
	function form($id=false){
		$data['project'] = $this->project->get_row($id);
		$this->template->build('set_project/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->project->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_project');
	}
	
	function delete($id){
		if($id){
			$this->project->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>