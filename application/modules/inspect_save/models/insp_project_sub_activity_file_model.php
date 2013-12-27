<?php
class Insp_project_sub_activity_file_model extends MY_Model{
	
	public $table = 'INSP_PROJECT_SUB_ACTIVITY_FILE';
	public $select = "INSP_PROJECT_SUB_ACTIVITY_FILE.*, INSP_PROJECT_SUB_ACTIVITY_.TITLE";
	public $join = "LEFT JOIN INSP_PROJECT_SUB_ACTIVITY ON INSP_PROJECT_SUB_ACTIVITY_FILE.SUBACTID = INSP_PROJECT_SUB_ACTIVITY.ID";
	
    function __construct()
    {
        parent::__construct();
    }	
}
?>