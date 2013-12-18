<?php
class Insp_project_risk_save_model extends MY_Model{
	
	public $table = 'insp_project_risk_save';
	public $select = "insp_project_risk_save.*,insp_risk_subject.*";
	public $join = "left join insp_risk_subject on insp_project_risk_save.subjectid = insp_risk_subject.id";
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>