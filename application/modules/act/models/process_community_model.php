<?php
class process_community_model extends MY_Model{
	
	public $table = 'act_process_community';
	public $primary_key = 'PCOMMUNITY_ID';
	
    function __construct()
    {
        parent::__construct();
    }
}
?>