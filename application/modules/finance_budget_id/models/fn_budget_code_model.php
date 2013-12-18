<?php
class Fn_budget_code_model extends MY_Model{
	
	public $table = 'fn_budget_code';
	public $select = "fn_budget_code.*,fn_strategy.title";
	public $join = "join fn_strategy on fn_budget_code.productivity_id = fn_strategy.id";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>