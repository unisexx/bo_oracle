<?php
class budget_report_1 extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();		
		$this->load->model('c_division/division_model','division');												
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
		$this->template->build('index',$data);
	}			
}
?>