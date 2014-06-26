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
		
		//(f) report_01
		$this->load->model("fund_form_request_model","form_request");
		
		//(f) report_02
		$this->load->model("fund_personal_payment_model","personal_payment");
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
		echo $_GET['year_budget'] = (empty($_GET['year_budget']))?(date('Y')+543):$_GET['year_budget'];
		$qry = "SELECT
					FUND_REQUEST_SUPPORT.YEAR_BUDGET,
					FUND_PROVINCE.TITLE AS PROVINCE_TITLE,
					SUM(FUND_PERSONAL_PAYMENT_DETAIL.FUND_COST) as cost_2
					
				FROM 
					FUND_REQUEST_SUPPORT
					LEFT JOIN FUND_PERSONAL_PAYMENT_DETAIL ON FUND_REQUEST_SUPPORT.ID = FUND_PERSONAL_PAYMENT_DETAIL.FUND_REQUEST_SUPPORT_ID
					LEFT JOIN FUND_PROVINCE ON FUND_REQUEST_SUPPORT.PROVINCE_ID = FUND_PROVINCE.ID
				WHERE
					FUND_REQUEST_SUPPORT.YEAR_BUDGET = '".$_GET['year_budget']."'
				GROUP BY 
					FUND_REQUEST_SUPPORT.YEAR_BUDGET,
					FUND_PROVINCE.TITLE
				ORDER BY 
					FUND_PROVINCE.TITLE ASC";
					
					
		$data['rs'] = $this->personal_payment->get($qry);
		
		$this->template->build('personal/report/report_02', @$data);
	}
	
	function report_03()
	{
		$data["variable"] = $this->form_request->get();
		$this->template->build("personal/report/report_03",$data);
	}
	
	function report_04() {
		if(@$_GET['fund_year'] != '' && @$_GET['fund_month'] != '' && @$_GET['province_id'] != '') {
			$fund_year = $_GET['fund_year']-543;
			if (@$_GET['fund_month'] > '9' ){
				 $fund_year =  $fund_year-1;
			}
			$sql_result = "select support.date_request, support.meeting_date, support.fund_child_name, 
								  payment.fund_month, payment.fund_cost , payment.title || payment.firstname ||' '|| payment.lastname as presonal_name, 
								  payment.date_payment, payment.addr_number, payment.addr_moo, payment.addr_trok, payment.addr_soi, payment.addr_road, 
								  fund_province.title as province_name, fund_amphur.title as amphur_name, fund_district.title as district_name
						  from fund_request_support support
						  left join fund_personal_payment_detail payment on support.id = payment.fund_request_support_id
						  left join fund_province on payment.province_id = fund_province.id
						  left join fund_amphur on payment.amphur_id = fund_amphur.id
						  left join fund_district on payment.district_id = fund_district.id
						  where support.status = '1' and support.province_id = '".$_GET['province_id']."' and payment.status = '1'  
								and payment.fund_month = '".@$_GET['fund_month']."' and payment.fund_year = '".$fund_year."'
						  order by payment.fund_year asc, payment.fund_month asc";
			$data['rs'] = $this->form_request->get($sql_result,true);
			
			$data['provine_name'] = get_one('title','fund_province','id',$_GET['province_id']);
		}
		
		$this->template->build('personal/report/report_04',@$data);
	}
	
	function report_05() {
			
		$_GET['year_budget'] = (empty($_GET['year_budget']))?(date('Y')+543):$_GET['year_budget'];
		
		$qry = "select 
				fund_province.id province_id,
				FUND_PROVINCE.title as province_title,
				sum(fppd.fund_cost) subvention_present,
				sum(fppd_1.fund_Cost) actual_cost 
				from 
					FUND_REQUEST_SUPPORT frs
					left join fund_province on frs.province_id = fund_province.id
					left join FUND_PERSONAL_PAYMENT_DETAIL fppd on  frs.id = fppd.FUND_REQUEST_SUPPORT_ID
					left join FUND_PERSONAL_PAYMENT_DETAIL fppd_1 on fppd.id = fppd_1.id and fppd_1.status = 1
				where 
					frs.year_budget = '".$_GET['year_budget']."'
				group by fund_province.id, fund_province.title
				order by fund_province.title asc";
		$data['rs'] = $this->form_request->get($qry);
		foreach($data['rs'] as $key=>$item) {
			$qry = 'select
						sum(case when (FUND_REQUEST_SUPPORT ."4_1_TOTAL" is null) then \'0\' else FUND_REQUEST_SUPPORT ."4_1_TOTAL" end
						+ case when (FUND_REQUEST_SUPPORT ."4_2_TOTAL" is null) then \'0\' else FUND_REQUEST_SUPPORT ."4_2_TOTAL" end
						+ case when (FUND_REQUEST_SUPPORT ."4_3" is null) then \'0\' else FUND_REQUEST_SUPPORT ."4_3" end
						+ case when (FUND_REQUEST_SUPPORT ."4_4" is null) then \'0\' else FUND_REQUEST_SUPPORT ."4_4" end
						+ case when (FUND_REQUEST_SUPPORT ."4_5_TOTAL" is null) then \'0\' else FUND_REQUEST_SUPPORT ."4_5_TOTAL" end
						+ case when (FUND_REQUEST_SUPPORT ."4_6_TOTAL" is null) then \'0\' else FUND_REQUEST_SUPPORT ."4_6_TOTAL" end) approve_amount
						, count(id) approve_count
						
					from FUND_REQUEST_SUPPORT 
					where
						FUND_REQUEST_SUPPORT .province_id = '.$item['province_id'].'
						and 
						FUND_REQUEST_SUPPORT .status = 1
					group by province_id';
			$tmp = $this->form_request->get($qry);
			$tmp = @$tmp[0];
			
			if(empty($tmp)) {
				$tmp = array('approve_amount'=>0, 'approve_count'=>0);
			}

			$data['rs'][$key] = array_merge($data['rs'][$key], $tmp);
		}

		$this->template->build('personal/report/report_05', @$data);
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