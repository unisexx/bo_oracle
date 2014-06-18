<?php
/**
 * Form
 * กองทุนรายบุคคล
 */
class Form extends Fund_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("fund_form_request_model","form_request");
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
		if($_POST) {
			
			$_POST["date_request"] = date_to_mysql($_POST["date_request"],true);
			$_POST["fund_child_id"] = $_POST["child_id"];
			$_POST["fund_child_name"] = $_POST["child_name"];
			
			$_POST["fund_reg_personal_id"] = $_POST["personal_id"];
			$_POST["fund_reg_personal_name"] = $_POST["personal_name"];
			
			$this->form_request->save($_POST);
		}
		redirect("fund");
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
		$data["variable"] = $this->reg_personal->get();
		$data["pagination"] = $this->reg_personal->pagination();
		$this->load->view("personal/modal_request",$data);
	}
	
}