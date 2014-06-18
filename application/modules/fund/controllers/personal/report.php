<?php
/**
 * Result
 * ผลการจ่ายเงิน ขอรับเงินสนับสนุน
 */
class Report extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		/*$this->load->model("fund_form_request_model","form_request");
		$this->load->model("fund_personal_reportment_model","personal_reportment");
		$this->load->model("fund_province","province");*/
	}
	
	function report_01() {
		$this->template->build('personal/report/report_01');
	}
	
	public function index()
	{
		$where = " STATUS=1 ";
		
		$sql = "SELECT * FROM FUND_REQUEST_SUPPORT WHERE ".$where;
		
		$data["variable"] = $this->form_request->get($sql);
		$data["pagination"] = $this->form_request->pagination();
		$this->template->build("personal/report/index",$data);
	}
	
	public function form($id)
	{
		if($id) {
			$data["value"] = $this->form_request->get_row($id);
			
			$data["variable41"] = $this->personal_reportment->where("reportMENT_TYPE=1 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable42"] = $this->personal_reportment->where("reportMENT_TYPE=2 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable43"] = $this->personal_reportment->where("reportMENT_TYPE=3 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable44"] = $this->personal_reportment->where("reportMENT_TYPE=4 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable45"] = $this->personal_reportment->where("reportMENT_TYPE=5 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable46"] = $this->personal_reportment->where("reportMENT_TYPE=6 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			$data["variable47"] = $this->personal_reportment->where("reportMENT_TYPE=7 AND FUND_SUPPORT_PERSONAL_ID=$id")->limit(50)->get();
			
			$this->template->build("personal/report/form",$data);
		} else {
			redirect("fund/personal/report",$data);
		}
	}

	public function subform($id)
	{
		if($id) {
			$data["value"] = $this->personal_reportment->get_row($id);
			$this->load->view("personal/report/subform",$data);
		} else {
			echo "- ไม่มีข้อมูล -";
		}
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}