<?php
/**
 * Result
 * ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายบุคคล
 */
class Result extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("fund_form_request_model","form_request");
		$this->load->model("fund_province","province");
	}
	
	public function index()
	{
		$where = " 1=1 ";
		
		$sql = "SELECT * FROM FUND_REQUEST_SUPPORT WHERE ".$where;
		
		$data["variable"] = $this->form_request->get($sql);
		$data["pagination"] = $this->form_request->pagination();
		$this->template->build("personal/result/index",$data);
	}
	
	public function form($id) {
		if($id) {
			$data["value"] = $this->form_request->get_row($id);
			$this->template->build("personal/result/form",$data);
		} else {
			redirect("fund/personal/result");
		}
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}