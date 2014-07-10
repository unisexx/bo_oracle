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
			
			$data["variable41"]		= $this->personal_payment->where("PAYMENT_TYPE=1 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable42_1"]	= $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_EDU_TYPE = 1 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable42_2"]	= $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_EDU_TYPE = 2 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable42_3"]	= $this->personal_payment->where("PAYMENT_TYPE=2 AND FUND_EDU_TYPE = 3 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable43"]		= $this->personal_payment->where("PAYMENT_TYPE=3 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			$data["variable44"]		= $this->personal_payment->where("PAYMENT_TYPE=4 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			$data["variable45"]		= $this->personal_payment->where("PAYMENT_TYPE=5 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable46"]		= $this->personal_payment->where("PAYMENT_TYPE=6 AND FUND_REQUEST_SUPPORT_ID= $id")->limit(50)->get();
			$data["variable47"]		= $this->personal_payment->where("PAYMENT_TYPE=7 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			$data["variable48"]		= $this->personal_payment->where("PAYMENT_TYPE=8 AND FUND_REQUEST_SUPPORT_ID= $id")->get_row();
			
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
				
				if($_POST["status"]==1) {
					
					$rq = $_POST["fund_request_support_id"];
					$type = $_POST["payment_type"];
					
					if(!file_exists("uploads/fund/personal/$rq")) {
						$old = umask(0);
						mkdir("uploads/fund/personal/$rq",0777);
						umask($old);
					}
					
					if(!file_exists("uploads/fund/personal/$rq/pay")) {
						$old = umask(0);
						mkdir("uploads/fund/personal/$rq/pay",0777);
						umask($old);
					}
					
					if(!file_exists("uploads/fund/personal/$rq/pay/section_$type")) {
						$old = umask(0);
						mkdir("uploads/fund/personal/$rq/pay/section_$type",0777);
						umask($old);
					}
					
					if(!file_exists("uploads/fund/personal/$rq/pay/section_$type/$id")) {
						$old = umask(0);
						mkdir("uploads/fund/personal/$rq/pay/section_$type/$id",0777);
						umask($old);
					}
					
					if(@$_FILES["file_payer"]["name"]) {
						$file_payer = uniqid().".".pathinfo($_FILES["file_payer"]["name"], PATHINFO_EXTENSION);
						is_uploaded_file($_FILES["file_payer"]["tmp_name"]);
						move_uploaded_file($_FILES["file_payer"]["tmp_name"], "uploads/fund/personal/$rq/pay/section_$type/$id/$file_payer");
					}
					
					if(@$_FILES["file_payee"]["name"]) {
						$file_payee = uniqid().".".pathinfo($_FILES["file_payee"]["name"], PATHINFO_EXTENSION);
						is_uploaded_file($_FILES["file_payee"]["tmp_name"]);
						move_uploaded_file($_FILES["file_payee"]["tmp_name"], "uploads/fund/personal/$rq/pay/section_$type/$id/$file_payee");
					}
					
					if(@$_FILES["file_proxy"]["name"]) {
						$file_proxy = uniqid().".".pathinfo($_FILES["file_proxy"]["name"], PATHINFO_EXTENSION);
						is_uploaded_file($_FILES["file_proxy"]["tmp_name"]);
						move_uploaded_file($_FILES["file_proxy"]["tmp_name"], "uploads/fund/personal/$rq/pay/section_$type/$id/$file_proxy");
					}
					
					if(@$_FILES["file_receipt"]["name"]) {
						$file_receipt = uniqid().".".pathinfo($_FILES["file_receipt"]["name"], PATHINFO_EXTENSION);
						is_uploaded_file($_FILES["file_receipt"]["tmp_name"]);
						move_uploaded_file($_FILES["file_receipt"]["tmp_name"], "uploads/fund/personal/$rq/pay/section_$type/$id/$file_receipt");
					}
					
					$pay = array(
						"id"							=> $id,
						"status"						=> 1,
						"date_payment"			=> ($_POST["date_payment"]) ? date_to_mysql($_POST["date_payment"],true) : null,
						"personal_accept"		=> $_POST["personal_accept"],
						"title"							=> $_POST["title"],
						"firstname"				=> $_POST["firstname"],
						"lastname"					=> $_POST["lastname"],
						"addr_number"			=> $_POST["addr_number"],
						"addr_moo"				=> $_POST["addr_moo"],
						"addr_trok"				=> $_POST["addr_trok"],
						"addr_soi"					=> $_POST["addr_soi"],
						"addr_road"				=> $_POST["addr_road"],
						"province_id"				=> $_POST["province_id"],
						"amphur_id"				=> $_POST["amphur_id"],
						"district_id"				=> $_POST["district_id"],
						
						"file_payer"				=> (@$_POST["file_payer"]) ? $file_payer : null,
						"file_payee"				=> (@$_POST["file_payee"]) ? $file_payee : null,
						"file_proxy"				=> (@$_POST["file_proxy"]) ? $file_proxy : null,
						"file_receipt"				=> (@$_POST["file_receipt"]) ? $file_receipt : null
					);
					
					$this->personal_payment->save($pay);
				}
				
				if($_POST["status"]==2) {
					
					$pay = array(
						"id"				=> $id,
						"status"			=> 2,
						"note"			=> $_POST["note"]
					);

					$last_id = $this->personal_payment->save($pay);
					
					//	เปลี่ยนสถานะที่ที่เหลือ ในกรณีที่ยุติการช่วยเหลือ
					$row = $this->personal_payment->get_row($last_id);
					
					$fund_request_support_id = $row["fund_request_support_id"];
					$payment_type = $row["payment_type"];
					
					$variable = $this->personal_payment->where("FUND_REQUEST_SUPPORT_ID=$fund_request_support_id AND PAYMENT_TYPE=$payment_type AND ID>$last_id")->get(false,true);
					foreach ($variable as $key => $value) {
						$chg = array(
							"id"				=> $value["id"],
							"status"			=> 2,
							"note"			=> $_POST["note"]
						);
						$this->personal_payment->save($chg);
					}
					
				}
				
			}
			
		}
		redirect("fund/personal/pay/form/".$_POST["fund_request_support_id"]);
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