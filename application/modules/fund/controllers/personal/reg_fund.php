<?php
/**
 * Reg_Fund
 * ทะเบียนบุคคล ขอรับเงินกองทุน
 */
class Reg_Fund extends Fund_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->model("fund_reg_personal_model","reg_personal");
		$this->load->model("fund_province","province");
		$this->load->model("fund_district","district");
		$this->load->model("fund_amphur","amphur");
	}
	
	public function index()
	{
		$data["variable"] = $this->reg_personal->get();
		$data["pagination"] = $this->reg_personal->pagination();
		$this->template->build("personal/reg_fund/index",$data);
	}
	
	public function form($id=null)
	{
		$data["value"] = $this->reg_personal->get_row($id);
		$this->template->build("personal/reg_fund/form",$data);
	}
	
	public function save($id=null)
	{
		if($_POST) {
			
			if($id) {
				$_POST["id"] = $id;
				$_POST["birthday"] = date_to_mysql($_POST["birthday"],TRUE);
				$this->reg_personal->save($_POST);
			} else {
				$_POST["birthday"] = date_to_mysql($_POST["birthday"],TRUE);				
				$this->reg_personal->save($_POST);
			}
			
		}
		redirect("fund/personal/reg_fund");
	}
	
	public function delete($id)
	{
		if($id) {
			$this->reg_personal->delete($id);
		}
	}
	
}
