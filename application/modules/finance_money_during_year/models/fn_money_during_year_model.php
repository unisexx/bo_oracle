<?php
class Fn_money_during_year_model extends MY_Model{
	
	public $table = "fn_money_during_year";
	//public $select = "fn_money_during_year.*,cnf_department.title as department_title,cnf_division.title as division_title,cnf_workgroup.title as workgroup_title";
	//public $join = "left join cnf_department on fn_money_during_year.department_id = cnf_department.id left join cnf_division on fn_money_during_year.division_id = cnf_division.id left join cnf_workgroup on fn_money_during_year.workgroup_id = cnf_workgroup.id";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>