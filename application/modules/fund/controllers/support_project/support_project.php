<?php
/**
 * Support Project
 * กองทุนเด็กรายโครงการ
 */
class Support_Project extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
	}
	
	public function list_request() {
		$this->template->build("support_project/list_request");
	}
	
	public function list_result() {
		$this->template->build("support_project/list_result");
	}
	
}
