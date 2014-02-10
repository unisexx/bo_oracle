<?php
class budget_report_9 extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_plan/budget_plan_model','budget_plan');
		$this->load->model('budget_time/budget_time_model','budget_time');
		$this->load->model('budget_plan/budget_plan_detail_model','budget_plan_detail');
	}
	public function index()
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = @$_GET['budgetyear'];

		$data['divisionid'] = (!empty($_GET['divisionid'])) ?  $_GET['divisionid']:'';
		$data['division'] = $this->division->get_row($data['divisionid']);
		$data['workgroupid'] = @$_GET['workgroupid'];
		$data['workgroup'] = $this->workgroup->get_row($data['workgroupid']);
		$data['step'] = (!empty($_GET['step'])) ? $_GET['step']:'';

		$data['productivity'] = (!empty($_GET['productivity'])) ? $_GET['productivity']:'';
		$data['mainactivity'] = (!empty($_GET['mainactivity'])) ? $_GET['mainactivity']:'';
		$data['subactivity']  = (!empty($_GET['subactivity']))  ? $_GET['subactivity'] :'';

		$data['year'] = (!empty($_GET['year'])) ? $_GET['year'] : date('Y')-1;
		$data['thyear'] = $data['year'] + 543;

        //$data['userWorkgroup'] = $_GET['workgroup']!='' ? $data['userWorkgroup'] = $_GET['workgroup'] : $data['userWorkgroup'];
        //$result = $this->db->GetArray("SELECT * FROM CNF_STRATEGY WHERE PRODUCTIVITYID = 0 AND SECTIONSTRATEGYID > 0 AND SYEAR=2013");
        //array_walk($result,'dbConvert');
		//var_dump($result);exit;

		$data['user_divisionid'] = login_data("DIVISIONID");
		$this->template->build('index',$data);
	}



	}
?>