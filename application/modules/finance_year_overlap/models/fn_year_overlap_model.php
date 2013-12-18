<?php
class Fn_year_overlap_model extends MY_Model{
	public $table = "fn_year_overlap";
	public $select = "fn_year_overlap.*, fn_cost_related.book_cost_id,book_cost_date, fn_budget_related.book_id budget_book_id,
	fn_cost_related.departmentid, fn_cost_related.divisionid, fn_cost_related.workgroupid, 
	(SELECT SUM(BUDGET_COMMIT) FROM fn_year_overlap_detail WHERE PID=fn_year_overlap.id AND EXPENSETYPE_ID=0 )summary";
	public $join = " left join fn_cost_related on fn_year_overlap.fn_cost_related_id = fn_cost_related.id
	left join fn_budget_related on fn_cost_related.book_id = fn_budget_related.id 
	";
	
	function __construct()
    {
        parent::__construct();
    }
}
?>