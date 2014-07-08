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
			if(!empty($_POST["date_request"])) {
				$_POST["date_request"] = date_to_mysql($_POST["date_request"],true);
			} else {
				$_POST["date_request"] = date('Y-m-d');
			}
			
			$_POST["fund_child_id"] = $_POST["child_id"];
			$_POST["fund_child_name"] = $_POST["child_name"];

			$_POST["fund_reg_personal_id"] = $_POST["personal_id"];
			$_POST["fund_reg_personal_name"] = $_POST["personal_name"];

			$this->form_request->save($_POST);
		}
		redirect("fund");
	}
	
	//	ข้อมูลเด็ก 
	public function modal_child()
	{
		$where = " 1=1 ";
		
		if(@$_GET["keyword"]) {
			$where .= " AND (FIRSTNAME LIKE '%".$_GET["keyword"]."%' OR LASTNAME LIKE '%".$_GET["keyword"]."%')";
		}
		
		$sql = "SELECT * FROM FUND_CHILDS WHERE ".$where;
		 
		$data["variable"] = $this->fund_child->get($sql);
		
		// $data["variable"] = $this->fund_child->limit(15)->get();
		$data["pagination"] = $this->fund_child->pagination();
		$this->load->view("personal/modal_child",$data);
	}
	
	public function modal_child_form()
	{
		$this->load->view("personal/modal_child_form");
	}
	
	public function modal_child_save()
	{
		if($_POST) {
			
			$_POST["birthday"] = date_to_mysql($_POST["birthday"],TRUE);
			$id = $this->fund_child->save($_POST);

			$data["value"] = $this->fund_child->get_row($id);
			$this->load->view("personal/modal_child_save",$data);
		}
	}
	
	public function modal_request()
	{
		//	ข้อมูลทะเบียนผู้ขอรับการช่วยเหลือ (แทน)
		$where = " 1=1 ";

		if(@$_GET["keyword"]) {
			$where .= " AND (FIRSTNAME LIKE '%".$_GET["keyword"]."%' OR LASTNAME LIKE '%".$_GET["keyword"]."%')";
		}
		
		$sql = "SELECT * FROM FUND_REG_PERSONAL WHERE ".$where;

		$data["variable"] = $this->reg_personal->get($sql);
		
		// $data["variable"] = $this->reg_personal->limit(15)->get();
		$data["pagination"] = $this->reg_personal->pagination();
		$this->load->view("personal/modal_request",$data);
	}
	
	public function modal_request_form()
	{
		//	เพิ่มทะเบียนผู้ขอรับการช่วยเหลือ (แทน)
		$this->load->view("personal/modal_request_form");
	}
	
	public function modal_request_save()
	{
		//	บันทึกทะเบียนผู้ขอรับการช่วยเหลือ (แทน)
		if($_POST) {
			
			$_POST["birthday"] = date_to_mysql($_POST["birthday"],TRUE);				
			$id = $this->reg_personal->save($_POST);

			$data["value"] = $this->reg_personal->get_row($id);
			$this->load->view("personal/modal_request_save",$data);
		}
	}
	
}