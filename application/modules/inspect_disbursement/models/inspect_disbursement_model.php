<?php
class Inspect_disbursement_model extends MY_Model{
	
	public $table = 'insp_disbursement';
	public $select = 'INSP_DISBURSEMENT.*,cnf_division.title division_title,cnf_province.title province_title,insp_round_detail.round_name';
	public $join = 'left join cnf_division on INSP_DISBURSEMENT.division_id = cnf_division.id
left join cnf_province on INSP_DISBURSEMENT.province_id = cnf_province.id
left join cnf_province_area on cnf_province.area = cnf_province_area.id
left join insp_round_detail on INSP_DISBURSEMENT.insp_round_detail_id = insp_round_detail.id';
	
    function __construct()
    {
        parent::__construct();
    }
	
}
?>