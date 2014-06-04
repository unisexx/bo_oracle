<?php
/**
 * Result
 * ผลการพิจารณาขอรับเงินสนับสนุน กองทุนเด็กรายบุคคล
 */
class Result extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("fund_project_child_support_model","child_support");
	}
	
	public function index() {
		$this->template->build("support_personal/result/index");
	}
	
	public function form() {
		$this->template->build("support_personal/result/form");
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}