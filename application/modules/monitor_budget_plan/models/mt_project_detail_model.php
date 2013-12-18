<?php
class Mt_project_detail_model extends MY_Model{
	
	public $table = 'mt_project_detail';	
	public $join = ' LEFT JOIN fn_budget_type ON mt_project_detail.BUDGETTYPEID=fn_budget_type.ID ';
	public $select = ' mt_project_detail.*, fn_budget_type.title BudgetTypeTitle';
    function __construct()
    {
        parent::__construct();
    }	
}
?>