<?php
class budget_operation_area_model extends MY_Model{
	
	public $table = 'budget_operation_area';	
	public $join = 'left join cnf_province on budget_operation_area.provinceid = cnf_province.id ';
	public $select = 'budget_operation_area.* , cnf_province.title as province_title ';
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>