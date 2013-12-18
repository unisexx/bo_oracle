<?php
class Mt_strategy_key_model extends MY_Model{
	
	public $table = 'mt_strategy_key';	
	public $select = 'mt_strategy_key.*, cnf_count_unit.title unittypename ';
	public $join = 'LEFT JOIN cnf_count_unit ON mt_strategy_key.unittypeid = cnf_count_unit.id ';
	
    function __construct()
    {
        parent::__construct();
    }	
}
?>