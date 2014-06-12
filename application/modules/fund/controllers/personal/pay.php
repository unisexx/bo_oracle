<?php
/**
 * Result
 * ผลการจ่ายเงิน ขอรับเงินสนับสนุน
 */
class Pay extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("fund_form_request_model","form_request");
		$this->load->model("fund_personal_payment_model","personal_payment");
		$this->load->model("fund_province","province");
	}
	
	public function index()
	{
		$where = " STATUS=2 ";
		
		$sql = "SELECT * FROM FUND_REQUEST_SUPPORT WHERE ".$where;
		
		$data["variable"] = $this->form_request->get($sql);
		$data["pagination"] = $this->form_request->pagination();
		$this->template->build("personal/pay/index",$data);
	}
	
	public function form($id)
	{
		if($id) {
			$data["value"] = $this->form_request->get_row($id);
			$this->template->build("personal/pay/form");
		} else {
			redirect("fund/personal/pay",$data);
		}
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}