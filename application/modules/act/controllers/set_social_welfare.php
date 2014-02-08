<?php
Class Set_social_welfare extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("social_welfare_model","social_welfare");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " social_welfare_name like '%".$_GET['search']."%'" : "";
		$data['social_welfares'] = $this->social_welfare->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->social_welfare->pagination();
		$this->template->build('set_social_welfare/index',$data);
	}
	
	function form($id=false){
		$data['social_welfare'] = $this->social_welfare->get_row($id);
		$this->template->build('set_social_welfare/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->social_welfare->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_social_welfare');
	}
	
	function delete($id){
		if($id){
			$this->social_welfare->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>