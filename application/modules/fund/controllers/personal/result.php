<?php
/**
 * Result
 * ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายบุคคล
 */
class Result extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("fund_form_request_model","form_request");
		$this->load->model("fund_personal_payment_model","personal_payment");
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
	
	public function save($id)
	{
		if($_POST) {
			$request = $this->form_request->get_row($id);
			
			$_POST["id"] = $id;
			
			//	วันเดือนปี ที่รับเรื่อง
			$_POST["date_request"] = date_to_mysql($_POST["date_request"],true);
			
			//	มติที่ประชุมลงวันที่
			$_POST["meeting_date"] = date_to_mysql($_POST["meeting_date"],true);
			
			//	เปลี่ยนค่าเดือนให้ถูก
			$_POST["4_1_start_month"] = sprintf("%02d",$_POST["4_1_start_month"]);
			$_POST["4_1_end_month"] = sprintf("%02d",$_POST["4_1_end_month"]);
			
			$_POST["4_5_start_month"] = sprintf("%02d",$_POST["4_5_start_month"]);
			$_POST["4_5_end_month"] = sprintf("%02d",$_POST["4_5_end_month"]);
			
			$_POST["4_6_start_month"] = sprintf("%02d",$_POST["4_6_start_month"]);
			$_POST["4_6_end_month"] = sprintf("%02d",$_POST["4_6_end_month"]);
			
			//	ข้อ 4(1) ค่าเลี้ยงดู/ค่าพาหนะ รวม
			$_POST["4_1_total"] = ($_POST["4_1_number"]*$_POST["4_1_permonth"]);
			
			//	ข้อ 4(5) ค่าเครื่องอุปโภคบริโภค รวม
			$_POST["4_5_total"] = ($_POST["4_5_number"]*$_POST["4_5_permonth"]);
			
			//	ข้อ 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์ รวม
			$_POST["4_6_total"] = ($_POST["4_6_number"]*$_POST["4_6_permonth"]);

			$this->form_request->save($_POST);
			
			//	-------------------------------------------------- 4(1) ค่าเลี้ยงดู/ค่าพาหนะ --------------------------------------------------
			$payment41 = $_POST["4_1_number"];
			$month41 = $_POST["4_1_start_month"];
			$year41 = $_POST["4_1_start_year"];
			
			for ($i=0; $i < $payment41; $i++) { 
				if($month41>12) {
					$month41 = 1;
					$year41++;
				}
				
				$payment = array(
					"fund_request_support_id"	=> $id,
					"payment_type"					=> 1,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_year"						=> $year41,
					"fund_month_number"		=> $i+1,
					"fund_month"						=> sprintf("%02d",$month41),
					"fund_cost"						=> $_POST["4_1_permonth"],
					"status"								=> 0
				);
				
				$this->personal_payment->save($payment);
				$month41++;
			}
			
			//	-------------------------------------------------- 4(2) ค่าใช้จ่ายทางการศึกษา --------------------------------------------------
			
			//	ประถมศึกษา
			$_POST["4_2_junior_total"] = ($_POST["4_2_junior_year"]*$_POST["4_2_junior_peryear"]);
			
			//	มัธยมศึกษา
			$_POST["4_2_senior_total"] = ($_POST["4_2_senior_year"]*$_POST["4_2_senior_peryear"]);
			
			//	อาชีวศึกษา
			$_POST["4_2_high_total"] = ($_POST["4_2_high_year"]*$_POST["4_2_high_peryear"]);
			
			//	รวมเป็นเงิน
			$_POST["4_2_total"] = $_POST["4_2_junior_total"]+$_POST["4_2_senior_total"]+$_POST["4_2_high_total"];
			
			//	ประถมศึกษา
			$junior_year = ($_POST["4_2_junior_year"]) ? $_POST["4_2_junior_year"] : 0;
			$junior_peryear = ($_POST["4_2_junior_peryear"]) ? ($_POST["4_2_junior_peryear"]) : 0;
			
			if($junior_year!=0) {
				for ($i=0; $i < $junior_year; $i++) { 
					
					$payment = array(
						"fund_request_support_id"	=> $id,
						"payment_type"					=> 2,
						"fund_support_personal_id"	=> $request["fund_child_id"],
						"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
						"fund_year_number"			=> $i+1,
						"fund_edu_type"					=> 1,
						"fund_cost"						=> $junior_peryear,
						"status"								=> 0
					);
					
					$this->personal_payment->save($payment);
				}
			}

			//	มัธยมศึกษา
			$senior_year = ($_POST["4_2_senior_year"]) ? $_POST["4_2_senior_year"] : 0;
			$senior_peryear = ($_POST["4_2_senior_peryear"]) ? ($_POST["4_2_senior_peryear"]) : 0;
			
			if($senior_year!=0) {
				for ($i=0; $i < $senior_year; $i++) { 
					
					$payment = array(
						"fund_request_support_id"	=> $id,
						"payment_type"					=> 2,
						"fund_support_personal_id"	=> $request["fund_child_id"],
						"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
						"fund_year_number"			=> $i+1,
						"fund_edu_type"					=> 2,
						"fund_cost"						=> $senior_peryear,
						"status"								=> 0
					);
					
					$this->personal_payment->save($payment);
				}
			}

			//	อาชีวศึกษา
			$high_year = ($_POST["4_2_high_year"]) ? $_POST["4_2_high_year"] : 0;
			$high_peryear = ($_POST["4_2_high_peryear"]) ? ($_POST["4_2_high_peryear"]) : 0;
			
			if($high_year!=0) {
				for ($i=0; $i < $high_year; $i++) { 
					
					$payment = array(
						"fund_request_support_id"	=> $id,
						"payment_type"					=> 2,
						"fund_support_personal_id"	=> $request["fund_child_id"],
						"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
						"fund_year_number"			=> $i+1,
						"fund_edu_type"					=> 3,
						"fund_cost"						=> $high_peryear,
						"status"								=> 0
					);
					
					$this->personal_payment->save($payment);
				}
			}
				
			//	-------------------------------------------------- 4(3) ทุนประกอบอาชีพ/ค่ารักษาพยาบาล --------------------------------------------------
			 $payment43 = $_POST["4_3"];
			 
			 	$payment = array(
					"fund_request_support_id"	=> $id,
			 		"payment_type"					=> 3,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_cost"						=> $payment43,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
			//	-------------------------------------------------- 4(4) ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์ --------------------------------------------------
			 $payment44 = $_POST["4_4"];
			 $payment44detail = $_POST["4_4_detail"];
			 
			 	$payment = array(
					"fund_request_support_id"	=> $id,
			 		"payment_type"					=> 4,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_cost"						=> $payment44,
					"fund_detail"						=> $payment44detail,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
			//	-------------------------------------------------- 4(5) ค่าเครื่องอุปโภคบริโภค --------------------------------------------------
			$payment45 = $_POST["4_5_number"];
			$month45 = $_POST["4_5_start_month"];
			$year45 = $_POST["4_5_start_year"];
			
			for ($i=0; $i < $payment45; $i++) { 
				if($month45>12) {
					$month45 = 1;
					$year45++;
				}
				
				$payment = array(
					"fund_request_support_id"	=> $id,
					"payment_type"					=> 5,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_year"						=> $year45,
					"fund_month_number"		=> $i+1,
					"fund_month"						=> sprintf("%02d",$month45),
					"fund_cost"						=> $_POST["4_5_permonth"],
					"status"								=> 0
				);				
				
				$this->personal_payment->save($payment);
				$month45++;
			}
			
			//	-------------------------------------------------- 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์ --------------------------------------------------
			$payment46 = $_POST["4_6_number"]; 
			$month46 = $_POST["4_6_start_month"];
			$year46 = $_POST["4_6_start_year"];
			
			for ($i=0; $i < $payment46; $i++) { 
				if($month46>12) {
					$month46 = 1;
					$year46++;
				}
				
				$payment = array(
					"fund_request_support_id"	=> $id,
					"payment_type"					=> 6,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_year"						=> $year46,
					"fund_month_number"		=> $i+1,
					"fund_month"						=> sprintf("%02d",$month46),
					"fund_cost"						=> $_POST["4_6_permonth"],
					"status"								=> 0
				);				
				
				$this->personal_payment->save($payment);
				$month46++;
			}
			
			//	-------------------------------------------------- 4(7) ค่าใช้จ่ายในการให้ความรู้/ฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก  --------------------------------------------------
			 $payment47 = $_POST["4_7"];
			 
			 	$payment = array(
					"fund_request_support_id"	=> $id,
			 		"payment_type"					=> 7,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_cost"						=> $payment47,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
			//	-------------------------------------------------- (พิเศษ) ค่าตรวจ DNA --------------------------------------------------
			$payment48 = $_POST["dna_charges"];
			
				$payment = array(
					"fund_request_support_id"	=> $id,
			 		"payment_type"					=> 8,
					"fund_support_personal_id"	=> $request["fund_child_id"],
					"fund_reg_personal_id"		=> $request["fund_reg_personal_id"],
					"fund_cost"						=> $payment48,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
		}
		redirect("fund/personal/result");
	}
	
	public function delete($id) {
		if($id) {
			$this->personal_payment->delete($id);
		}
	}
	
}