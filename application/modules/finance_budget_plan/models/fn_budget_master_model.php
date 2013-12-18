<?php
class Fn_budget_master_model extends MY_Model{
	
	public $table = 'FN_BUDGET_MASTER';	
	public $join =" left join CNF_WORKGROUP on FN_BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	left join CNF_DIVISION on CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID 
	";
	public $select = 'FN_BUDGET_MASTER.*,  CNF_WORKGROUP.TITLE WORKGROUP_NAME, CNF_DIVISION.TITLE DIVISION_NAME';
    function __construct()
    {
        parent::__construct();
    }	
}
?>