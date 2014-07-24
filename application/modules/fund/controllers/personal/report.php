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
		
		$this->load->model('fund_province', 'province');
	}
	
	function report_01() {
		$data['month_ary'] = array(
			1=>'มกราคม',
			2=>'กุมภาพันธ์',
			3=>'มีนาคม',
			4=>'เมษายน',
			5=>'พฤษภาคม',
			6=>'มิถุนายน',
			7=>'กรกฏาคม',
			8=>'สิงหาคม',
			9=>'กันยายน',
			10=>'ตุลาคม',
			11=>'พฤศจิกายน',
			12=>'ธันวาคม'
		);
		
		
		$select = 'fund_request_support.*,
					fund_reg_personal.idcard as per_idcard,
					fund_reg_personal.birthday as per_birth,
					fund_childs.idcard as child_idcard,
					fund_childs.birthday as child_birth';
					
		$join = "left join fund_reg_personal on fund_request_support.fund_reg_personal_id = fund_reg_personal.id
				left join fund_childs on fund_request_support.fund_child_id = fund_childs.id";
		
		$where = '1=1';
			$where .= (empty($_GET['sch_province']))?'':" and fund_request_support.province_id = '".$_GET['sch_province']."'";
			$where .= (empty($_GET['sch_year']))?'':" and fund_request_support.year_budget = '".$_GET['sch_year']."'";
			$where .= (empty($_GET['sch_times']))?'':" and fund_request_support.meeting_number = '".$_GET['sch_times']."'";
			
			
			if(!empty($_GET['sch_date_meeting'])) {
				$tmp = explode('-', $_GET['sch_date_meeting']);
				$tmp = ($tmp[2]-543).'-'.$tmp[1].'-'.$tmp[0];
			}
			
			$where .= (empty($tmp))?'':" and fund_request_support.meeting_date = '".$tmp."'";
		
		//Get head data
		if(!empty($_GET['sch_province'])) {
			$tmp = $this->province->get_row($_GET['sch_province']);
			$data['province_title'] = $tmp['title'];
		}
		
		$data['items'] = $this->form_request->select($select)->join($join)->where($where)->order_by('fund_request_support.id','asc')->get();

		$this->template->build('personal/report/report_01', @$data);
	}
	
	function report_02() {
		$_GET['year_budget'] = (empty($_GET['year_budget']))?(date('Y')+543):$_GET['year_budget'];
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
		$data['month_ary'] = array(
			1=>'มกราคม',
			2=>'กุมภาพันธ์',
			3=>'มีนาคม',
			4=>'เมษายน',
			5=>'พฤษภาคม',
			6=>'มิถุนายน',
			7=>'กรกฏาคม',
			8=>'สิงหาคม',
			9=>'กันยายน',
			10=>'ตุลาคม',
			11=>'พฤศจิกายน',
			12=>'ธันวาคม'
		);
		
		//Get head data
		if(!empty($_GET['sch_province'])) {
			$tmp = $this->province->get_row($_GET['sch_province']);
			$data['province_title'] = $tmp['title'];
		}
		
		$where = '1=1';
			$where .= (empty($_GET['sch_province']))?'':" and fund_request_support.province_id = '".$_GET['sch_province']."'";
			$where .= (empty($_GET['sch_year']))?'':" and fund_request_support.year_budget = '".$_GET['sch_year']."'";
			$where .= (empty($_GET['sch_times']))?'':" and fund_request_support.meeting_number = '".$_GET['sch_times']."'";
			
			if(!empty($_GET['sch_date_meeting'])) {
				$tmp = explode('-', $_GET['sch_date_meeting']);
				$tmp = ($tmp[2]-543).'-'.$tmp[1].'-'.$tmp[0];
			}
			$where .= (empty($tmp))?'':" and fund_request_support.meeting_date = '".$tmp."'";
		
		$data["variable"] = $this->form_request->where($where)->get();
		$this->template->build("personal/report/report_03",$data);
	}
	
	function report_04() {
		$data['month_ary'] = array(
			1=>'มกราคม',
			2=>'กุมภาพันธ์',
			3=>'มีนาคม',
			4=>'เมษายน',
			5=>'พฤษภาคม',
			6=>'มิถุนายน',
			7=>'กรกฏาคม',
			8=>'สิงหาคม',
			9=>'กันยายน',
			10=>'ตุลาคม',
			11=>'พฤศจิกายน',
			12=>'ธันวาคม'
		);
		
		//Get head data
		if(!empty($_GET['sch_province'])) {
			$tmp = $this->province->get_row($_GET['sch_province']);
			$data['province_title'] = $tmp['title'];
		}
		
		$fund_year = $_GET['sch_year']-543;
		if (@$_GET['sch_month'] > '9' ){
			 $fund_year =  $fund_year-1;
		}
		/*
		select 
			fund_request_support.date_request,
			fund_request_support.updated,
			fund_request_support.fund_child_name,
			fund_request_support.fund_reg_personal_name,
				fund_personal_payment_detail.addr_number,
				fund_personal_payment_detail.addr_moo,
				fund_personal_payment_detail.addr_trok,
				fund_personal_payment_detail.addr_soi,
				fund_personal_payment_detail.addr_road,
					fund_province.title as province_title,
					fund_amphur.title as amphur_title,
					fund_district.title as district_title,
				fund_personal_payment_detail.fund_cost,
				fund_personal_payment_detail.date_payment
		from fund_request_support 
			left join fund_personal_payment_detail on fund_request_support.id = fund_personal_payment_detail.fund_request_support_id
				left join fund_province on fund_personal_payment_detail.province_id = fund_province.id
				left join fund_amphur on fund_personal_payment_detail.amphur_id = fund_amphur.id
				left join fund_district on fund_personal_payment_detail.district_id = fund_district.id
		where
			fund_request_support.status = '1'
			and fund_personal_payment_detail.status = '1'
			and fund_request_support.province_id = '1'
			and fund_personal_payment_detail.fund_month = '01' 
			and fund_personal_payment_detail.fund_year = '2014'
		*/
		
		$select = "fund_request_support.date_request,
					fund_request_support.updated,
					fund_request_support.fund_child_name,
					fund_request_support.fund_reg_personal_name,
						fund_personal_payment_detail.addr_number,
						fund_personal_payment_detail.addr_moo,
						fund_personal_payment_detail.addr_trok,
						fund_personal_payment_detail.addr_soi,
						fund_personal_payment_detail.addr_road,
							fund_province.title as province_title,
							fund_amphur.title as amphur_title,
							fund_district.title as district_title,
						fund_personal_payment_detail.fund_cost,
						fund_personal_payment_detail.date_payment";
		$join = "left join fund_personal_payment_detail on fund_request_support.id = fund_personal_payment_detail.fund_request_support_id
					left join fund_province on fund_personal_payment_detail.province_id = fund_province.id
					left join fund_amphur on fund_personal_payment_detail.amphur_id = fund_amphur.id
					left join fund_district on fund_personal_payment_detail.district_id = fund_district.id";
		$where = "fund_request_support.status = '1'
					and fund_personal_payment_detail.status = '1'";
		//Fund_request_support.status = 1 : คือคำขอที่ได้รับอนุมัติแล้ว
		//Fund_personal_payment_detail.statsu = '1' : คือรายการเบิกจ่ายที่ได้รับการอนุมัติ (จ่ายเงินไปแล้ว)
		
		$where .= (empty($_GET['sch_province']))?'':"and fund_request_support.province_id = '".$_GET['sch_province']."'";
		$where .= (empty($_GET['sch_month']))?'':"and fund_personal_payment_detail.fund_month = '".substr('0'.$_GET['sch_month'], -2, 2)."'"; 
		$where .= (empty($_GET['sch_year']))?'':"and fund_personal_payment_detail.fund_year = '".($_GET['sch_year']-543)."'";
		
		$data['rs'] = $this->form_request->select($select)->join($join)->where($where)->order_by('fund_request_support.id', '')->get(false, true);
		
		
		$this->template->build('personal/report/report_04',@$data);
	}
	
	function report_05() {
		
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
					frs.year_budget = '".@$_GET['year_budget']."'
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
}