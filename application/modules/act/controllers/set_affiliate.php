<?php
Class Set_affiliate extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("affiliate_model","affiliate");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " affiliate_name like '%".$_GET['search']."%'" : "";
		$data['affiliates'] = $this->affiliate->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->affiliate->pagination();
		$this->template->build('set_affiliate/index',$data);
	}
	
	function form($id=false){
		$data['affiliate'] = $this->affiliate->get_row($id);
		$this->template->build('set_affiliate/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->affiliate->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_affiliate');
	}
	
	function delete($id){
		if($id){
			$this->affiliate->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>