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
		$where = " STATUS=1 ";
		
		$sql = "SELECT * FROM FUND_REQUEST_SUPPORT WHERE ".$where;
		
		$data["variable"] = $this->form_request->get($sql);
		$data["pagination"] = $this->form_request->pagination();
		$this->template->build("personal/pay/index",$data);
	}
	
	public function form($id)
	{
		if($id) {
			$data["value"] = $this->form_request->get_row($id);
			
			$data["variable41"] = $this->personal_payment->where("PAYMENT_TYPE=1 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable42"] = $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable43"] = $this->personal_payment->where("PAYMENT_TYPE=3 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable44"] = $this->personal_payment->where("PAYMENT_TYPE=4 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable45"] = $this->personal_payment->where("PAYMENT_TYPE=5 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable46"] = $this->personal_payment->where("PAYMENT_TYPE=6 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable47"] = $this->personal_payment->where("PAYMENT_TYPE=7 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			
			$this->template->build("personal/pay/form",$data);
		} else {
			redirect("fund/personal/pay",$data);
		}
	}

	public function subform($id)
	{
		if($id) {
			$data["value"] = $this->personal_payment->get_row($id);
			$this->load->view("personal/pay/subform",$data);
		} else {
			echo "- ไม่มีข้อมูล -";
		}
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}