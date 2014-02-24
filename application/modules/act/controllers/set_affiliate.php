<?php
Class Set_affiliate extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("under_model","under");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " under_name like '%".$_GET['search']."%'" : "";
		$data['affiliates'] = $this->under->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->under->pagination();
		$this->template->build('set_affiliate/index',$data);
	}
	
	function form($id=false){
		$data['affiliate'] = $this->under->get_row($id);
		$this->template->build('set_affiliate/form',$data);
	}
	
	function save(){
		if($_POST){
			$_POST['staff_id'] = login_data("id");
			$_POST['created'] =  $_POST['created']=='' ? th_to_stamp(date("d-m-Y H:i:s"),TRUE) : $_POST['created'];
		    $_POST['updated'] = th_to_stamp(date("d-m-Y H:i:s"),TRUE);
			$this->under->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_affiliate');
	}
	
	function delete($id){
		if($id){
			$this->under->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>