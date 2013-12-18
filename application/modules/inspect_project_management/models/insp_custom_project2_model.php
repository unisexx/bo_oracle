<?php
class Insp_custom_project2_model extends MY_Model{
	
	public $table = '(
		SELECT INSP_PROJECT.*,mt_project.title as projecttitle
		,  
		       CASE
		       WHEN INSP_PROJECT.WORKGROUPID>0 THEN cnf_workgroup.wprovinceid
		       WHEN INSP_PROJECT.DIVISIONID>0 THEN  cnf_division.provinceid
		       END AS provinceid
		,
		       CASE
		       WHEN INSP_PROJECT.WORKGROUPID>0 THEN cwg_province.title
		       WHEN INSP_PROJECT.DIVISIONID>0 THEN  cdv_province.title
		       END AS provincename
		FROM INSP_PROJECT
		left join cnf_division on INSP_PROJECT.divisionid = cnf_division.id
		left join cnf_workgroup on INSP_PROJECT.workgroupid = cnf_workgroup.id
		left join cnf_province cdv_province on cnf_division.provinceid = cdv_province.id
		left join cnf_province cwg_province on cnf_workgroup.wprovinceid = cwg_province.id
		left join mt_project on insp_project.mtprojectid = mt_project.id
		)';

    function __construct()
    {
        parent::__construct();
    }
	
}
?>