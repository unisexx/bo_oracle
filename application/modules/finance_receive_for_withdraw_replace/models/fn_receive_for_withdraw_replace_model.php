<?php
class Fn_receive_for_withdraw_replace_model extends MY_Model{
	
	public $table = 'fn_receive_for_withdraw_replace';
	//public $select = 'fn_budget_source.*,fn_strategy.title as statment_title,budget.title as budget_title,charge.title as charge_title';
	//public $join = 'left join fn_strategy on fn_budget_source.statment_id = fn_strategy.id left join fn_budget_type budget on fn_budget_source.budget_id = budget.id left join fn_budget_type charge on fn_budget_source.charge_id = charge.id';
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>