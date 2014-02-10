<?php
Class Set_strategic extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("strategic_model","strategic");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " strategic_name like '%".$_GET['search']."%'" : "";
		$data['strategics'] = $this->strategic->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->strategic->pagination();
		$this->template->build('set_strategic/index',$data);
	}
	
	function form($id=false){
		$data['strategic'] = $this->strategic->get_row($id);
		$this->template->build('set_strategic/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->strategic->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_strategic');
	}
	
	function delete($id){
		if($id){
			$this->strategic->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>