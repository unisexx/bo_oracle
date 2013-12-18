<?php
class budget_asset_model extends MY_Model{
	
	public $table = 'cnf_asset';
	public $join = ' 
	left join cnf_count_unit on cnf_asset.unittypeid = cnf_count_unit.id
	left join cnf_budget_type on cnf_asset.assettypeid = cnf_budget_type.id 
	';
	public $select = 'cnf_asset.*, cnf_count_unit.title unit_title, cnf_budget_type.title asset_type_title';
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>