<?php
Class requirement extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("rule_model","rule");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " and headline like '%".$_GET['search']."%'" : "";
		$condition .= @$_GET['rule_type']!='' ? " and rule_type = ".$_GET['rule_type'] : "" ;
		$data['rules'] = $this->rule->where("1 = 1 ".$condition)->order_by('id','desc')->get(false,false);
		$data['pagination'] = $this->rule->pagination();
		$this->template->build('requirement/index',$data);
	}
	
	function form($id=false){
		$data['rule'] = $this->rule->get_row($id);
		$this->template->build('requirement/form',$data);
	}
	
	function save(){
		if($_POST){
			fix_file($_FILES["UploadFile"]);		    
			$_POST['file_data'] = !empty($_FILES['UploadFile']['name']) ? $this->rule->upload($_FILES["UploadFile"],"uploads/act/rule") : @$_POST['hdfilename'];
			
			fix_file($_FILES["UploadFile2"]);		    
			$_POST['file_data2'] = !empty($_FILES['UploadFile2']['name']) ? $this->rule->upload($_FILES["UploadFile2"],"uploads/act/rule") : @$_POST['hdfilename2'];
			
			fix_file($_FILES["UploadFile3"]);		    
			$_POST['file_data3'] = !empty($_FILES['UploadFile3']['name']) ? $this->rule->upload($_FILES["UploadFile3"],"uploads/act/rule") : @$_POST['hdfilename3'];
			
			$_POST['staff_id'] = login_data("id");
			$this->rule->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/requirement');
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