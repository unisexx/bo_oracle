<?php
/**
 * FUND_PERSONAL_PAYMENT_MODEL
 * รายละเอียดการจ่ายเงิน กองทุนเด็กรายบุคคล
 */
class Fund_Personal_Payment_Model extends MY_Model {
	
	public $table = "FUND_PERSONAL_PAYMENT_DETAIL";
	
	function __construct() {
		parent::__construct();
	}
}
