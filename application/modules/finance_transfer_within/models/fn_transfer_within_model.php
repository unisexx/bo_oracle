<?php
class Fn_transfer_within_model extends MY_Model{
	
	public $table = 'fn_transfer_within';
	public $select = ' fn_transfer_within.*, fcr.workgroupid,fcr.divisionid,fcr.departmentid , 
	(SELECT SUM(transfer_commit) FROM fn_transfer_within_detail where pid=fn_transfer_within.id)summary';
	public $join = '
	LEFT JOIN fn_cost_related fcr ON fn_transfer_within.fn_cost_related_id = fcr.id 
	LEFT JOIN fn_budget_master fbm ON fcr.projectid = fbm.id 
	LEFT JOIN cnf_workgroup cw ON fbm.workgroup_id = cw.id
	LEFT JOIN cnf_division cdv ON cw.divisionid = cdv.id
	LEFT JOIN cnf_department cdp ON cdv.departmentid = cdp.id
	';
    function __construct()
    {
        parent::__construct();
    }
	
}
?>