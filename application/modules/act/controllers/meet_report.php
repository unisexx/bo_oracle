<?php
Class Meet_report extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("meeting_model","meeting");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " headline like '%".$_GET['search']."%'" : "";
		$data['meetings'] = $this->meeting->where($condition)->order_by('id','desc')->get(false,false);
		$data['pagination'] = $this->meeting->pagination();
		$this->template->build('meet_report/index',$data);
	}
	
	function form($id=false){
		// $this->db->debug = true;
		$data['meeting'] = $this->meeting->get_row($id);
		$this->template->build('meet_report/form',$data);
	}
	
	function save($id=false){
		// $this->db->debug = true;
		if($_POST){
			if(isset($_FILES["UploadFile"]))
			   {
				   fix_file($_FILES["UploadFile"]);		    
				   $_POST['file_data'] = isset($_FILES["UploadFile"])!='' ? $this->meeting->upload($_FILES["UploadFile"],"uploads/act_meet_report") : $_POST['file_data'];
			   }
			$this->meeting->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/meet_report/index');
	}
	
	function delete($id){
		if($id){
			$this->meeting->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>