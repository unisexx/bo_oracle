<?php
class Insp_project_main_activity_join_insp_process_model extends MY_Model{
	
	public $table = "insp_project_main_activity";
	public $select = "insp_project_main_activity.*,insp_progress.id as progress_id,insp_progress.projectid as project_id,insp_progress.*";
	public $join = "left join insp_progress ON insp_project_main_activity.id = insp_progress.mainacid";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>