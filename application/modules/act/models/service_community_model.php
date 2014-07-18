<?php
class service_community_model extends MY_Model{
	
	public $table = 'act_service_community';
	public $primary_key = 'SCOMMUNITY_ID';
	
    function __construct()
    {
        parent::__construct();
    }
}
?>