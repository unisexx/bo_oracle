<?php
/**
 * Form
 * กองทุนรายบุคคล
 */
class Form extends Fund_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("fund_project_child_support_model","child_support");
		$this->load->model("fund_child_model","fund_child");
		$this->load->model("fund_reg_personal_model","reg_personal");
		$this->load->model("fund_province","province");
		$this->load->model("fund_district","district");
		$this->load->model("fund_amphur","amphur");
	}
	
	public function index()
	{
		$this->template->build("personal/form");
	}
	
	public function save()
	{
		
	}
	
	public function delete()
	{
		
	}
	
	public function modal_child()
	{
		$data["variable"] = $this->fund_child->get();
		$data["pagination"] = $this->fund_child->pagination();
		$this->load->view("personal/modal_child",$data);
	}
	
	public function modal_request()
	{
		$data["variable"] = $this->fund_child->get_page();
		$this->load->view("modal_request",$data);
	}
	
}