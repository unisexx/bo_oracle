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
			$_POST["id"] = $id;
			
			//	วันเดือนปี ที่รับเรื่อง
			$_POST["date_request"] = date_to_mysql($_POST["date_request"]);
			
			//	มติที่ประชุมลงวันที่
			$_POST["metting_date"] = date_to_mysql($_POST["metting_date"]);
			
			//	เปลี่ยนค่าเดือนให้ถูก
			$_POST["4_1_start_month"] = sprintf("%02d",$_POST["4_1_start_month"]);
			$_POST["4_5_start_month"] = sprintf("%02d",$_POST["4_5_start_month"]);
			$_POST["4_6_start_month"] = sprintf("%02d",$_POST["4_5_start_month"]);
			
			//	ข้อ 4(1) ค่าเลี้ยงดู/ค่าพาหนะ รวม
			$_POST["4_1_total"] = ($_POST["4_1_number"]*$_POST["4_1_permonth"]);
			
			//	ข้อ 4(5) ค่าเครื่องอุปโภคบริโภค รวม
			$_POST["4_5_total"] = ($_POST["4_5_number"]*$_POST["4_5_permonth"]);
			
			//	ข้อ 4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์ รวม
			$_POST["4_6_total"] = ($_POST["4_6_number"]*$_POST["4_6_permonth"]);
			
			//	ข้อ 4(2) ค่าใช้จ่ายทางการศึกษา
			
				//	ประถมศึกษา
				$_POST["4_2_junior_total"] = ($_POST["4_2_junior_year"]*$_POST["4_2_junior_peryear"]);
				
				//	มัธยมศึกษา
				$_POST["4_2_junior_total"] = ($_POST["4_2_junior_year"]*$_POST["4_2_junior_peryear"]);
				
				//	อาชีวศึกษา
				$_POST["4_2_junior_total"] = ($_POST["4_2_junior_year"]*$_POST["4_2_junior_peryear"]);
				
				//	รวมเป็นเงิน
				$_POST["4_2_total"] = $_POST["4_2_junior_total"]+$_POST["4_2_junior_total"]+$_POST["4_2_junior_total"];

			$this->form_request->save($_POST);
			
			//	4(1) ค่าเลี้ยงดู/ค่าพาหนะ
			$payment41 = $_POST["4_1_number"];
			$month41 = $_POST["4_1_start_month"];
			$year41 = $_POST["4_1_start_year"];
			
			for ($i=0; $i < $payment41; $i++) { 
				if($month41>12) {
					$month41 = 1;
					$year41++;
				}
				
				$payment = array(
					"payment_type"					=> 1,
					"fund_support_personal_id"	=> 0,
					"fund_year"						=> $year41,
					"fund_month_number"		=> $i+1,
					"fund_month"						=> sprintf("%02d",$month41),
					"fund_cost"						=> $_POST["4_1_permonth"],
					"status"								=> 0
				);				
				
				$this->personal_payment->save($payment);
				$month41++;
			}
			
			//	4(2) ค่าใช้จ่ายทางการศึกษา
			$payment42 = $_POST["4_2_junior_year"];
			$year42 = $_POST["junior_peryear"];
			
			for ($i=0; $i < $payment41; $i++) { 
				
				$payment = array(
					"payment_type"					=> 1,
					"fund_support_personal_id"	=> 0,
					"fund_year"						=> null,
					"fund_month"						=> null,
					"fund_year_number"			=> $i+1,
					"fund_cost"						=> $_POST["junior_peryear"],
					"status"								=> 0
				);				
				
				$this->personal_payment->save($payment);
				$month41++;
			}
			
			 //	4(3) ทุนประกอบอาชีพ/ค่ารักษาพยาบาล
			 $payment43 = $_POST["4_3"];
			 
			 	$payment = array(
			 		"payment_type"					=> 3,
					"fund_support_personal_id"	=> 0,
					"fund_cost"						=> $payment43,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
			 //	4(4) ค่าใช้จ่ายเกี่ยวกับกายอุปกรณ์
			 $payment44 = $_POST["4_4"];
			 $payment44detail = $_POST["4_4_detail"];
			 
			 	$payment = array(
			 		"payment_type"					=> 3,
					"fund_support_personal_id"	=> 0,
					"fund_cost"						=> $payment44,
					"fund_detail"						=> $payment44detail,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
			//	4(5) ค่าเครื่องอุปโภคบริโภค
			$payment45 = $_POST["4_5_number"];
			$month45 = $_POST["4_5_start_month"];
			$year45 = $_POST["4_5_start_year"];
			
			for ($i=0; $i < $payment41; $i++) { 
				if($month45>12) {
					$month45 = 1;
					$year45++;
				}
				
				$payment = array(
					"payment_type"					=> 5,
					"fund_support_personal_id"	=> 0,
					"fund_year"						=> $year45,
					"fund_month_number"		=> $i+1,
					"fund_month"						=> sprintf("%02d",$month45),
					"fund_cost"						=> $_POST["4_5_permonth"],
					"status"								=> 0
				);				
				
				$this->personal_payment->save($payment);
				$month45++;
			}
			
			//	4(6) ค่าสงเคราะห์ครอบครัวอุปถัมภ์
			$payment46 = $_POST["4_6_number"]; 
			$month46 = $_POST["4_6_start_month"];
			$year46 = $_POST["4_6_start_year"];
			
			for ($i=0; $i < $payment41; $i++) { 
				if($month45>12) {
					$month46 = 1;
					$year46++;
				}
				
				$payment = array(
					"payment_type"					=> 5,
					"fund_support_personal_id"	=> 0,
					"fund_year"						=> $year46,
					"fund_month_number"		=> $i+1,
					"fund_month"						=> sprintf("%02d",$month46),
					"fund_cost"						=> $_POST["4_6_permonth"],
					"status"								=> 0
				);				
				
				$this->personal_payment->save($payment);
				$month46++;
			}
			
			 //	4(7) ค่าใช้จ่ายในการให้ความรู้/ฝึกอบรมเกี่ยวกับวิธีการอุปการะเลี้ยงดูเด็ก
			 $payment47 = $_POST["4_7"];
			 
			 	$payment = array(
			 		"payment_type"					=> 7,
					"fund_support_personal_id"	=> 0,
					"fund_cost"						=> $payment47,
					"status"								=> 0
				);
			 
			$this->personal_payment->save($payment);
			
		}
	}
	
	public function delete() {
		
	}
	
}