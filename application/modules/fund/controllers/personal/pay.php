<?php
/**
 * Result
 * ผลการจ่ายเงิน ขอรับเงินสนับสนุน
 */
class Pay extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("fund_project_child_support_model","child_support");
	}
	
	public function index() {
		$this->template->build("personal/pay/index");
	}
	
	public function form() {
		$this->template->build("personal/pay/form");
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}