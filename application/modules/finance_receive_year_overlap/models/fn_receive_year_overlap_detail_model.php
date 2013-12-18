<?php
class Fn_receive_year_overlap_detail_model extends MY_Model{
	
	public $table = 'fn_receive_year_overlap_detail';
	public $select = 'fn_receive_year_overlap_detail.*, fn_strategy.title as budgetyeartypetitle, fbt.title as budgettypetitle, fbe.title as expensetitle';
	public $join = 'LEFT JOIN fn_strategy ON fn_receive_year_overlap_detail.budgetyeartype = fn_strategy.id 
	LEFT JOIN fn_budget_type fbt ON fn_receive_year_overlap_detail.budgettypeid = fbt.id 
	LEFT JOIN fn_budget_type fbe ON fn_receive_year_overlap_detail.expensetypeid = fbe.id '; 
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>