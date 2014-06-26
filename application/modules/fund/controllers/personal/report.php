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
		
		$this->load->model("fund_form_request_model","form_request");
		
	}
	
	function report_01() {
		
		$select = 'fund_request_support.*,
					fund_reg_personal.idcard as per_idcard,
					fund_reg_personal.birthday as per_birth,
					fund_childs.idcard as child_idcard,
					fund_childs.birthday as child_birth';
					
		$join = "left join fund_reg_personal on fund_request_support.fund_reg_personal_id = fund_reg_personal.id
				left join fund_childs on fund_request_support.fund_child_id = fund_childs.id";
		
		$where = '1=1';
			$where .= (empty($_GET['province_id']))?'':" and fund_request_support.province_id = '".$_GET['province_id']."'";
			$where .= (empty($_GET['year_budget']))?'':" and fund_request_support.year_budget = '".$_GET['year_budget']."'";
			$where .= (empty($_GET['times']))?'':" and fund_request_support.meeting_number = '".$_GET['times']."'";
			
			if(!empty($_GET['meeting_date'])) {
				$tmp = explode('-', $_GET['meeting_date']);
				$tmp = ($tmp[2]-543).'-'.$tmp[1].'-'.$tmp[0];
			}
			$where .= (empty($tmp))?'':" and fund_request_support.meeting_date = '".$tmp."'";
		
		$data['items'] = $this->form_request->select($select)->join($join)->where($where)->order_by('fund_request_support.id','asc')->get();
		
		$this->template->build('personal/report/report_01', @$data);
	}
	
	function report_02() {
		$this->template->build('personal/report/report_02');
	}
	
	function report_03() {
		$this->template->build('personal/report/report_03');
	}
	
	function report_04() {
		$this->template->build('personal/report/report_04');
	}
	
	function report_05() {
		$this->template->build('personal/report/report_05');
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