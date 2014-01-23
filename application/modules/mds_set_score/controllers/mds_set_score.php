<?php
Class Mds_set_score extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_score/Mds_set_score_model','score');
		
	}
	
	public $urlpage = "mds_set_score";
	public $modules_name = "mds_set_score";
	public $modules_title = " คะแนนผลประเมิน";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		$sql = "select distinct budget_year from mds_set_score order by budget_year";
		$data['rs'] = $this->score->get($sql);
		$data['pagination']=$this->score->pagination();
		$this->template->build('index',@$data);

	}
	function form($year=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		if($year != ''){
			$data['budget_year'] = $year;
		}
		$this->template->build('form',@$data);

	}
	function save(){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		if($_POST){
			
		   for ($i=1; $i <= 5 ; $i++) {
		   		$data_score['budget_year'] = $_POST['budget_year']; 
				$data_score['id'] = @$_POST['id_'.$i];
				$data_score['score_id'] = @$i;
				$data_score['val_start'] = @$_POST['val_start_'.$i];
				$data_score['val_end'] = @$_POST['val_end_'.$i];
				//print_r($data_score);
				$this->score->save($data_score);
		   } 
		   //return FALSE;
		   set_notify('success', lang('save_data_complete'));		   
		   if($_POST['id_1'] != ''){
		    	$action_type = "ADD";
				$action =" เพิ่มคะแนนผลประเมิน ปีงบประมาณ :".$_POST['budget_year'];
				save_logfile($action_type,$action,$this->modules_name);
		   }else{
		   		$action_type = "EDIT";
				$action =" แก้ไขคะแนนผลประเมิน ปีงบประมาณ :".$_POST['budget_year'];
				save_logfile($action_type,$action,$this->modules_name);
		   }		   
		}
		redirect($urlpage);

	}
	function delete($year=FALSE){
		$urlpage = $this->urlpage;		
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่

		$action_type = "DELETE";
		$action =" ลบคะแนนผลประเมิน ปีงบประมาณ :".$year;
		save_logfile($action_type,$action,$this->modules_name);					
		$this->score->where("budget_year = '".$year."' ")->delete();		
		redirect($urlpage);
	}
	function chk_budget_year(){	
			$data['budget_year'] = $_GET['budget_year'];
		
		$this->load->view('score_dtl',@$data);
	}
}
?>