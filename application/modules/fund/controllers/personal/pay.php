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
		$this->load->model("fund_reg_personal_model","reg_personal");
		$this->load->model("fund_province","province");
		$this->load->model("fund_district","district");
		$this->load->model("fund_amphur","amphur");
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
			
			$data["variable41"] = $this->personal_payment->where("PAYMENT_TYPE=1 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable42_1"] = $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_EDU_TYPE = 1 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable42_2"] = $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_EDU_TYPE = 2 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable42_3"] = $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_EDU_TYPE = 3 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable43"] = $this->personal_payment->where("PAYMENT_TYPE=3 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			$data["variable44"] = $this->personal_payment->where("PAYMENT_TYPE=4 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			$data["variable45"] = $this->personal_payment->where("PAYMENT_TYPE=5 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable46"] = $this->personal_payment->where("PAYMENT_TYPE=6 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable47"] = $this->personal_payment->where("PAYMENT_TYPE=7 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			$data["variable48"] = $this->personal_payment->where("PAYMENT_TYPE=8 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			
			$this->template->build("personal/pay/form",$data);
		} else {
			redirect("fund/personal/pay",$data);
		}
	}

	public function subform($id)
	{
		if($id) {
			$data["value"] = $this->personal_payment->get_row($id);
			$data["person"] = $this->reg_personal->get_row($data["value"]["fund_reg_personal_id"]);
			$this->load->view("personal/pay/subform",$data);
		} else {
			echo "- ไม่มีข้อมูล -";
		}
	}
	
	public function save($id) {
		if($id) {
			
			if($_POST) {
				
				if($_POST["status"]) {
					$_POST["id"] = $id;
					$_POST["date_payment"] = ($_POST["date_payment"]) ? date_to_mysql($_POST["date_payment"],true) : null;
					$this->personal_payment->save($_POST);
				}
			}
			
		}
		redirect("fund/personal/pay/form/".$_POST["fund_support_personal_id"]);
	}
	
	public function delete() {
		
	}
	
	public function getpersonal($id)
	{
		if($id) {
			$data["value"] = $this->reg_personal->get_row($id);
			$this->load->view("personal/pay/getpersonal",$data);
		}
	}
	
	public function getblank()
	{
		$this->load->view("personal/pay/getblank");
	}
	
}