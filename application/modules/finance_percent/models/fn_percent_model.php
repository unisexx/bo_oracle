<?php
class fn_percent_model extends MY_Model{
	
    public $select = " fn_percent.*, cnf_division.title division_name, bg_type.title budget_type_title, ep_type.title expense_type_title ";
	public $table="fn_percent";	
	public $join = " 
	left join cnf_division on fn_percent.division_id = cnf_division.id
	left join fn_budget_type bg_type on fn_percent.budget_type_id = bg_type.id
	left join fn_budget_type ep_type on fn_percent.expense_type_id = ep_type.id 
	";
	
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>