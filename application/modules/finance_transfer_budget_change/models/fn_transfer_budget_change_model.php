<?php
class Fn_transfer_budget_change_model extends MY_Model{
	
	public $table = 'fn_transfer_budget_change';
	public $select = " fn_transfer_budget_change.*, (SELECT SUM(transfer_commit) FROM fn_transfer_budget_change_detail WHERE pid=fn_transfer_budget_change.ID)summary";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>