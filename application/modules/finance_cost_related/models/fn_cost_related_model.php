<?php
class fn_cost_related_model extends MY_Model{
	

	public $table="fn_cost_related";
	public $select = "fn_cost_related.*,cnf_department.title department_name, cnf_division.title division_name, cnf_workgroup.title workgroup_name";
	public $join = "left join cnf_department on fn_cost_related.departmentid = cnf_department.id
					left join cnf_division on fn_cost_related.divisionid = cnf_division.id
					left join cnf_workgroup on fn_cost_related.workgroupid = cnf_workgroup.id
	";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>