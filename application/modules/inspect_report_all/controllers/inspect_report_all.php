<?php
class Inspect_report_all extends Inspect_Controller
{
	public $modules_name = "inspect_report_all";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('inspect_save/insp_project_risk_save_model','risk');
		$this->load->model('inspect_risk_subject/insp_risk_subject_model','risk_subject');
		$this->load->model('c_province/province_model','province');
		$this->load->model('inspect_level/inspect_level_model','level');
		$this->load->model('inspect_inspector_recomm/insp_inspector_recomm_model','recomm');
		$this->load->model('inspect_round/insp_round_detail_model','detail');
		$this->load->model('inspect_project_management/insp_project_model','insp_project');
		$this->load->model('c_division/division_model','division');
	}
	
	function index()
	{
		if($_GET){
			$data['type_id'] = array('1'=>'K','2'=>'P','3'=>'N','4'=>'O');
			$data['risktype'] = $this->risk_subject->where("budgetyear = ".$_GET['mt_year'])->get(FALSE,TRUE);
			$data['province'] = $this->province->get(FALSE,TRUE);
			$data['level'] = $this->level->where("budgetyear = ".$_GET['mt_year'])->get(FALSE,TRUE);
			
			$projectname = $this->insp_project->get_one('title',$_GET['project_id']);
			$round_detail = $this->detail->get_one('round_name',$_GET['insp_round_detail_id']);
			$action_type = "VIEW";
			$action =" ดูรายงานค่าความเสี่ยง ปี:".($_GET['mt_year']+543)." โครงการ ".$projectname." ".$round_detail;
			save_logfile($action_type,$action,$this->modules_name);
		}
		if(@$_GET['action']=="export"){
			header('Content-type:application/xls');
			$filename= "inspect_report_all_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);	
			$data['show_title'] = "รายงานค่าความเสี่ยง ปี:".($_GET['mt_year']+543)." โครงการ ".$projectname." ".$round_detail;
			@$this->load->view('export',$data);	
		}else{	
			@$this->template->build('inspect_report_all_index',$data);
		}
	}
	
	function select_project_round_ajax(){
		echo form_dropdown('project_id',get_option("id","title","insp_project where budgetyear = ".$_POST['mt_year']),'','','-- เลือกโครงการ --','0');
		echo " ";
		echo form_dropdown('insp_round_detail_id',get_option("id","round_name","insp_round_detail where round_id = ".$_POST['round_id']),'','','-- เลือกรอบการบันทึก --','0');
		echo "<span class='loading-icon2'></span>";
	}

	function recomm(){
		$data['province'] = $this->province->get(FALSE,TRUE);
		
		if($_GET){
			$division_name= $this->division->get_one('title',$_GET['divisionid']);
			$action_type = "VIEW";
			$action =" ดูรายงานข้อเสนอแนะผู้ตรวจ ปี :".($_GET['budgetyear']+543)." ".$division_name;
			save_logfile($action_type,$action,$this->modules_name);
		}
		
		if(@$_GET['action']=="export"){
			header('Content-type:application/xls');
			$filename= "inspect_report_all_recomm_".date("Y-m-d_H_i_s").".xls";
			header("Content-Disposition: attachment; filename=".$filename);	
			$data['show_title'] = "รายงานข้อเสนอแนะผู้ตรวจ ปี :".($_GET['budgetyear']+543)." ".$division_name;
			$this->load->view('export_recomm',$data);	
		}else{	
			$this->template->build('inspect_report_all_recomm',$data);
		}
	}
}
?>