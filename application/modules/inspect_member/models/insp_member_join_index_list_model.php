<?php
class Insp_member_join_index_list_model extends MY_Model{
	
	public $table = 'insp_project_risk_save risk';	
	public $select = "risk.createuser,risk.budgetyear,risk.projectid,risk.provinceareaid,risk.provinceid,user.name,usertype.title usertype,workgroup.title usergroup,workgroup.id workgroupid,province.title province";
	public $join = "left join users user on risk.createuser = user.id
left join user_type_title usertype on user.id = usertype.id
left join cnf_workgroup workgroup on user.workgroupid = workgroup.id
left join cnf_province province on risk.provinceid = province.id
group by risk.budgetyear,user.name,risk.createuser,risk.projectid,risk.provinceareaid,usertype.title,workgroup.title,risk.provinceid,workgroup.id,workgroup.id,province.title";
	
    function __construct()
    {
        parent::__construct();
    }	
}
?>