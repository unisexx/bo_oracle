<?php
class c_log_model extends MY_Model{
	
	public $table = 'user_logfile';
	public $join = ' 
	LEFT JOIN users ON user_logfile.userid=users.id
	LEFT JOIN cnf_department ON users.departmentid = cnf_department.id
	LEFT JOIN cnf_division ON users.divisionid = cnf_division.id
	LEFT JOIN cnf_workgroup ON users.workgroupid = cnf_workgroup.id 
	LEFT JOIN cnf_province cpw ON cnf_workgroup.wprovinceid = cpw.id
	LEFT JOIN cnf_province cpd ON cnf_division.provinceid = cpd.id
	';
	public $select = ' user_logfile.*, users.name, cnf_workgroup.title as workgroup_title, cnf_division.title as division_title, cnf_department.title as department_title,cpw.title wprovince_name, cpd.title dprovince_name ';
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>