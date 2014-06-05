<?php
/**
 * Form
 * กองทุนรายบุคคล
 */
class Form extends Fund_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model("fund_project_child_support_model","child_support");
	}
	
	public function index() {
		$this->template->build("personal/form");
	}
	
	public function save() {
		
	}
	
	public function delete() {
		
	}
	
}