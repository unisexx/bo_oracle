<?php
/**
 * Reg_Fund
 * ทะเบียนบุคคล ขอรับเงินกองทุน
 */
class Reg_Fund extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->template->build("personal/reg_fund/index");
	}
	
	public function form() {
		$this->template->build("personal/reg_fund/form");
	}
	
}
