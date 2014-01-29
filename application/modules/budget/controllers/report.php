<?php

class Report extends Admin_Controller {
	
	public function __construct()
	{
		parent::__construct();	
	}
	
	public function report_1()
	{
		$this->load->model('c_division/division_model','division');												
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_plan/budget_plan_model','budget_plan');
		$this->load->model('budget_time/budget_time_model','budget_time');
		$this->load->model('budget_plan/budget_plan_detail_model','budget_plan_detail');	
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		$data['url_parameter'] = GetCurrentUrlGetParameter();			
		$data['budgetyear'] = @$_GET['budgetyear'];																
		$this->template->build('report_1',$data);
	}	
	
	public function report_2()
	{
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');															
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_plan/budget_plan_model','budget_plan');
		$this->load->model('budget_time/budget_time_model','budget_time');
		$this->load->model('budget_plan/budget_plan_detail_model','budget_plan_detail');
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		$data['url_parameter'] = GetCurrentUrlGetParameter();			
		$data['budgetyear'] = @$_GET['budgetyear'];					
		$data['divisionid'] = @$_GET['divisionid'];
		$data['division'] = $this->division->get_row($data['divisionid']);
		$data['workgroupid'] = @$_GET['workgroupid'];
		$data['workgroup'] = $this->workgroup->get_row($data['workgroupid']);
		$data['step'] = @$_GET['step'];											
		$this->template->build('report_2',$data);
	}
	
}
