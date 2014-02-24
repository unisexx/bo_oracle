<?php
Class Set_position_committee extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("subcommittee_position_model","pc");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " position_name like '%".$_GET['search']."%'" : "";
		$data['pcs'] = $this->pc->where($condition)->order_by('id','desc')->get(false,true);
		$data['pagination'] = $this->pc->pagination();
		$this->template->build('set_position_committee/index',$data);
	}
	
	function form($id=false){
		$data['pc'] = $this->pc->get_row($id);
		$this->template->build('set_position_committee/form',$data);
	}
	
	function save(){
		if($_POST){
			$_POST['staff_id'] = login_data("id");
			$_POST['created'] =  $_POST['created']=='' ? th_to_stamp(date("d-m-Y H:i:s"),TRUE) : $_POST['created'];
		    $_POST['updated'] = th_to_stamp(date("d-m-Y H:i:s"),TRUE);
			$this->pc->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_position_committee');
	}
	
	function delete($id){
		if($id){
			$this->pc->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>