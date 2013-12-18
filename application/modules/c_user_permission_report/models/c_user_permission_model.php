<?php
class c_user_permission_model extends MY_Model{
	
	public $table = 'USERS';
	public $join = '
	LEFT JOIN CNF_DIVISION ON USERS.DIVISIONID = CNF_DIVISION.ID 
	LEFT JOIN CNF_WORKGROUP ON USERS.WORKGROUPID = CNF_WORKGROUP.ID 
	';
	public $select = ' USERS.*, CNF_DIVISION.TITLE AS DIVISION_TITLE, CNF_WORKGROUP.TITLE AS WORKGROUP_TITLE ';
	
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>