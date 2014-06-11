<?php
/**
 * Fund_Form_Request_Model
 * แบบฟอร์มขอรับเงินสนับสนุน รายบุคคล
 */
class Fund_Form_Request_Model extends MY_Model {
	
	public $table = "FUND_REQUEST_SUPPORT";
	
	function __construct()
	{
		parent::__construct();
	}
}
