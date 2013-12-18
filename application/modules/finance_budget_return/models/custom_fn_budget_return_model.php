<?php
class Custom_fn_budget_return_model extends MY_Model{
	public $table="(
	select fn_budget_return.*,
	fn_budget_related.book_id book_related_id,
	fn_cost_related.book_cost_id book_cost_id,
	CASE 
	WHEN fn_budget_return.cost_related_id >0 THEN fn_cost_related.budgetyear
	WHEN fn_budget_return.budget_related_id >0 THEN fn_budget_related.budgetyear 
	END AS budgetyear,
	CASE 
	WHEN fn_budget_return.cost_related_id >0 THEN fn_cost_related.budgetplantype
	WHEN fn_budget_return.budget_related_id >0 THEN fn_budget_related.budgetplantype 
	END AS budgetplantype,
	CASE 
	WHEN fn_budget_return.cost_related_id >0 THEN fn_cost_related.budgetyeartype
	WHEN fn_budget_return.budget_related_id >0 THEN fn_budget_related.budgetyeartype 
	END AS budgetyeartype,
	CASE 
	WHEN fn_cost_related.departmentid >0 THEN fc_dp.id 
	WHEN fn_budget_related.departmentid >0 THEN fb_dp.id 
	END AS departmentid,
	CASE 
	WHEN fn_cost_related.departmentid >0 THEN fc_dp.title 
	WHEN fn_budget_related.departmentid >0 THEN fb_dp.title 
	END AS departmentname,
	CASE 
	WHEN fn_cost_related.divisionid >0 THEN fc_dv.id 
	WHEN fn_budget_related.divisionid >0 THEN fb_dv.id 
	END AS divisionid,
	CASE 
	WHEN fn_cost_related.divisionid >0 THEN fc_dv.title 
	WHEN fn_budget_related.divisionid >0 THEN fb_dv.title 
	END AS divisionname,
	CASE 
	WHEN fn_cost_related.workgroupid >0 THEN fc_wg.id 
	WHEN fn_budget_related.workgroupid >0 THEN fb_wg.id 
	END AS workgroupid,
	CASE 
	WHEN fn_cost_related.workgroupid >0 THEN fc_wg.title 
	WHEN fn_budget_related.workgroupid >0 THEN fb_wg.title 
	END AS workgroupname	
	from fn_budget_return	
	left join fn_budget_related on fn_budget_return.budget_related_id = fn_budget_related.id
	left join fn_cost_related on fn_budget_return.cost_related_id = fn_cost_related.id
	
	left join cnf_department fb_dp on fn_budget_related.departmentid = fb_dp.id
	left join cnf_division fb_dv on fn_budget_related.divisionid = fb_dv.id
	left join cnf_workgroup fb_wg on fn_budget_related.workgroupid = fb_wg.id
	
	left join cnf_department fc_dp on fn_cost_related.departmentid = fc_dp.id
	left join cnf_division fc_dv on fn_cost_related.divisionid = fc_dv.id
	left join cnf_workgroup fc_wg on fn_cost_related.workgroupid = fc_wg.id
	)cust_budget_return  
	";
    function __construct()
    {
        parent::__construct();
    }
	
}
?>