<?php
Class Set_position_director extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("committee_position_model","pd");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " position_name like '%".$_GET['search']."%'" : "";
		$data['pds'] = $this->pd->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->pd->pagination();
		$this->template->build('set_position_director/index',$data);
	}
	
	function form($id=false){
		$data['pd'] = $this->pd->get_row($id);
		$this->template->build('set_position_director/form',$data);
	}
	
	function save(){
		if($_POST){
			$_POST['staff_id'] = login_data("id");
			$_POST['created'] =  $_POST['created']=='' ? th_to_stamp(date("d-m-Y H:i:s"),TRUE) : $_POST['created'];
		    $_POST['updated'] = th_to_stamp(date("d-m-Y H:i:s"),TRUE);
			$this->pd->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_position_director');
	}
	
	function delete($id){
		if($id){
			$this->pd->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>