<?php
class supporter_sub_model extends MY_Model{
	
	public $table = 'act_supporter_sub';
	public $primary_key = 'SUB_ID';
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>