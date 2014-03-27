<?php
Class Mds_set_measure_target extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/Mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/Mds_set_metrics_model','metrics');
		$this->load->model('mds_indicator/Mds_metrics_result_model','metrics_result');
	}
	
	public $urlpage = "mds_set_measure_target";
	public $modules_name = "mds_set_measure_target";
	public $modules_title = " ตั้งค่า หน่วยวัดและเป้าหมาย";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		$condition = " 1=1 ";
		if(@$_GET['sch_budget_year'] != ''){
			$condition .= " and budget_year = '".@$_GET['sch_budget_year']."' ";
		}
		
		$sql = "select * from mds_set_indicator where ".$condition." order by indicator_on asc";
		
		$data['rs'] = $this->indicator->get($sql);
		$data['pagination']=$this->indicator->pagination();
		$this->template->build('index',@$data);

	}
	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($id != ''){
			$data['indicator'] = $this->indicator->get_row($id);
			
			$sql_assessment = "select distinct mds_set_metrics.mds_set_assessment_id , mds_set_assessment.ass_name ,mds_set_metrics.metrics_on
							from mds_set_metrics
							join mds_set_assessment on mds_set_metrics.mds_set_assessment_id = mds_set_assessment.id
							where mds_set_metrics.parent_id = '0' and mds_set_metrics.mds_set_indicator_id = '".$id."' 
							order by mds_set_metrics.metrics_on asc";
			$data['rs_ass'] = $this->metrics->get($sql_assessment);
			$data['mds_set_indicator_id'] = $id;
			
			new_save_logfile("VIEW",$this->modules_title,"mds_set_indicator","ID",$id,"indicator_name",$this->modules_name);
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ภูกต้อง');	
			redirect($data['urlpage'] );
		}
		$this->template->build('form',@$data);

	}
	function save(){
		$urlpage = $this->urlpage;
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($_POST){
			
			for($i=1;$i<=$_POST['num_i'];$i++){
				$update['id'] = @$_POST['id'][$i];
				$update['mds_set_measure_id'] = @$_POST['mds_set_measure_id'][$i];
				$update['metrics_target'] = htmlspecialchars(@$_POST['metrics_target'][$i], ENT_QUOTES ,'UTF-8');
				if(@$update['id'] != ''){
					$id = $this->metrics->save($update);
			   		new_save_logfile("EDIT",$this->modules_title,"mds_set_mitrics","ID",$id,"metrics_name",$this->modules_name);
			   }
			}
		   
		   set_notify('success', lang('save_data_complete'));	  
		}
		redirect($urlpage.'/index?sch_budget_year='.@$_POST['budget_year']);

	}
}
?>