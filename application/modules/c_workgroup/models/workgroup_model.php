<?php
class Workgroup_model extends MY_Model{
	
	public $table = 'CNF_WORKGROUP';
	public $select = "cnf_workgroup.*,cnf_division.title divisiontitle,cnf_division.departmentid, cnf_department.title departmenttitle";
	public $join = "left join cnf_division on cnf_workgroup.divisionid = cnf_division.id left join cnf_department on cnf_division.departmentid = cnf_department.id";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>