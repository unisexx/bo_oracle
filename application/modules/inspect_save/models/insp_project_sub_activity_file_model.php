<?php
class Insp_project_sub_activity_file_model extends MY_Model{
	
	public $table = 'insp_project_sub_activity_file';
	public $select = "insp_project_sub_activity_file.*, insp_project_sub_activity.title";
	public $join = "left join insp_project_sub_activity on insp_project_sub_activity_file.subactid = insp_project_sub_activity.id";
	
    function __construct()
    {
        parent::__construct();
    }	
}
?>