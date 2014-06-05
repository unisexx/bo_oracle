<?php
/**
 * Reg Child
 * ทะเบียนข้อมูลเด็ก
 */
class Reg_Child extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->template->build("personal/reg_child/index");
	}
	
}
