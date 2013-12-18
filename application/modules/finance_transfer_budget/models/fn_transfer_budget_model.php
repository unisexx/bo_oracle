<?php
class Fn_transfer_budget_model extends MY_Model{
	public $select = 'fn_transfer_budget.*, (select SUM(TRANSFER_COMMIT)from fn_transfer_budget_detail where pid=fn_transfer_budget.id)summary ';
	public $table = 'fn_transfer_budget';	
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>