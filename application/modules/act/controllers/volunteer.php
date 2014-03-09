<?php
Class volunteer extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("volunteer_main_model","volunteer");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " and headline like '%".$_GET['search']."%'" : "";
		$condition .= @$_GET['rule_type']!='' ? " and rule_type = ".$_GET['rule_type'] : "" ;
		$data['volunteers'] = $this->volunteer->where("1 = 1 ".$condition)->order_by('id','desc')->get(false,false);
		$data['pagination'] = $this->volunteer->pagination();
		$this->template->build('volunteer/index',$data);
	}
	
	function form($id=false){
		$data['volunteer'] = $this->volunteer->get_row($id);
		$this->template->build('volunteer/form',$data);
	}
	
	function save(){
		if($_POST){
			// $this->db->debug = true;
			fix_file($_FILES["UploadFile"]);
			$_POST['picture_name'] = !empty($_FILES['UploadFile']['name']) ? $this->volunteer->upload($_FILES["UploadFile"],"uploads/act/volunteer") : @$_POST['hdfilename'];
			
			$this->volunteer->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/volunteer');
	}
	
	function delete($id){
		if($id){
			$this->volunteer->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>