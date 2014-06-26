<?php
/**
 * Result
 * ผลการจ่ายเงิน ขอรับเงินสนับสนุน
 */
class Report extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('fund_project_support_model', 'project_support');
	}
	
	
	function report_01() {
		$sql_project = "select fund_project_support.province_id , fund_province.title as province_name
						from fund_project_support
						left join fund_province on fund_project_support.province_id = fund_province.id 
						where fund_project_support.budget_year = '".@$_GET['budget_year']."' 
						group by fund_project_support.province_id , fund_province.title
						order by fund_project_support.province_id asc ";
		$data["data_province"] = $this->project_support->get($sql_project,true);
		foreach ($data["data_province"] as $key => $data_province) {
			$sql_project = "select count(id) as total_project_1
							from fund_project_support
							where fund_project_support.province_id = '".$data_province['province_id']."' ";
			$data["project_01"] = $this->db->getrow($sql_project);
		}
		
		$this->template->build('project/report/report_01', @$data);
	}
	
	function report_02() {
		$this->template->build('project/report/report_02');
	}
	
	function report_03() {
		$this->template->build('project/report/report_03');
	}
	
	function report_04() {
		$this->template->build('project/report/report_04');
	}
	
	function report_05() {
		$this->template->build('project/report/report_05');
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