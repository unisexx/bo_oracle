<?php
class fund_project_model extends MY_Model{
	
	public $table = 'act_fund_project';
	public $primary_key = 'PROJECT_ID';
	
    function __construct()
    {
        parent::__construct();
    }
}
?>