<?php
class budget_report_10 extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_province/province_model','province');
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_plan/budget_plan_model','budget_plan');
		$this->load->model('budget_time/budget_time_model','budget_time');
		$this->load->model('budget_plan/budget_plan_detail_model','budget_plan_detail');
		$this->load->model('cnf_strategy_model','cnf_strategy');
	}
	public function index($export=FALSE)
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = @$_GET['budgetyear'];

		$data['divisionid'] = (!empty($_GET['division'])) ?  $_GET['division']:'';
		$data['division'] = $this->division->get_row($data['divisionid']);
		$data['userSection'] = (!empty($_GET['division'])) ?  $_GET['division']:'';
		$data['workgroupid'] = (!empty($_GET['workgroup'])) ? $_GET['workgroup']:'';
		$data['workgroup'] = $this->workgroup->get_row($data['workgroupid']);
		$data['step'] = (!empty($_GET['step'])) ? $_GET['step']:'';

		$data['productivity'] = (!empty($_GET['productivity'])) ? $_GET['productivity']:'';
		$data['mainactivity'] = (!empty($_GET['mainactivity'])) ? $_GET['mainactivity']:'';
		$data['subactivity']  = (!empty($_GET['subactivity']))  ? $_GET['subactivity'] :'';

		$data['userSection'] = (!empty($_GET['section'])) ? $_GET['section']:'';
		$data['userWorkgroup'] = (!empty($_GET['workgroup'])) ? $_GET['workgroup']:'' ;
		$data['pzone'] = (!empty($_GET['pzone'])) ? $_GET['pzone']:'';
		$data['pgroup'] = (!empty($_GET['pgroup'])) ? $_GET['pgroup']:'';
		$data['province'] = (!empty($_GET['province'])) ? $_GET['province']:'';

		$data['year'] = (!empty($_GET['year'])) ? $_GET['year'] : date('Y')-2;
		$data['thyear'] = $data['year'] + 543;
		$data['missionType'] = (!empty($_GET['missiontype'])) ? $_GET['missiontype']:'';
		//$data['user_divisionid'] = login_data("DIVISIONID");
		if($export){
			header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="รายงานการประมาณการรายจ่ายล่วงหน้าระยะปานกลาง ปีงบประมาณ'.($_GET['year']+543).'.xls"');
			$this->template->build('export',$data);
		}else{
			$this->template->build('index',$data);
		}

	}



}
?>