<?php
function is_permit($users_id = null,$permit = null){
	$data = '';	
	if($users_id != ''){
			$CI =& get_instance();
			$condition = '';
		if($permit != ''){
			$condition = "AND MDS_SET_PERMISSION.MDS_SET_PERMIT_TYPE_ID = '".$permit."'";
		}
		
			$sql = "SELECT MDS_SET_PERMIT_TYPE.PERMIT_NAME 
					FROM  MDS_SET_PERMISSION
					LEFT JOIN MDS_SET_PERMIT_TYPE ON MDS_SET_PERMISSION.MDS_SET_PERMIT_TYPE_ID =  MDS_SET_PERMIT_TYPE.ID
					WHERE MDS_SET_PERMISSION.USERS_ID = '".$users_id."' 
					$condition ";
			$result = $CI->db->getarray($sql); 
			dbConvert($result);
			$result=@$result['0'];
			//print_r($result);
			return @$result['permit_name'];
			
	}else{
		return $data;
	}
}
function metrics_dtl_indicator($indicator_id = null,$parent_id = null){
	$result = array();
	if($indicator_id != '' && $parent_id != ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*,assessment.ass_name
						  from mds_set_metrics metrics
						  left join mds_set_assessment assessment on metrics.mds_set_assessment_id = assessment.id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.parent_id = '".$parent_id."' order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			dbConvert($result_1);
			$result=$result_1;
	
	}
	return @$result;
}

function chk_keyer_indicator($indicator_id = null,$id = null){
	$result = 'N';
	if($indicator_id != '' && $id != ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  left join mds_set_metrics_keyer metrics_keyer on metrics.id = metrics_keyer.mds_set_metrics_id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and  metrics_keyer.keyer_users_id = '".login_data('id')."'
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
	}
	return @$result;
}

function metrics_set_indicator($mds_set_indicator_id = null,$mds_set_assessment_id = null,$parent_id = null){
	$result = array();
	$condition = '';
	if($mds_set_indicator_id != '' && $parent_id !=''){
		if($parent_id == '0' && $mds_set_assessment_id != ''){
			$condition = "and mds_set_assessment_id = '".$mds_set_assessment_id."' ";
		}
			$CI =& get_instance();
			$sql = "select *
							from mds_set_metrics
							where mds_set_metrics.parent_id = '".$parent_id."' 
							and mds_set_metrics.mds_set_indicator_id = '".$mds_set_indicator_id."' 
							$condition ";
			$result_1 = $CI->db->getarray($sql); 
			dbConvert($result_1);
			$result=$result_1;
	
	}
	return @$result;
}
function indicator_weight($id = null , $round_month = null){
		$weight_perc_tot='0';
		$CI =& get_instance();
			if($id != '' && $round_month != ''){
				// หา น้ำหนักของทั้งมิติ //
				
				$sel_indicator_weight = "SELECT * FROM MDS_SET_METRICS WHERE MDS_SET_INDICATOR_ID = '".$id."' ";
				$result_indicator_weight = $CI->db->getarray($sel_indicator_weight);
				dbConvert($result_indicator_weight);
				foreach ($result_indicator_weight as $key => $indicator_weight) {
					if($round_month == '6' && $indicator_weight['metrics_weight_6'] != ''){
						$weight_perc_tot += $indicator_weight['metrics_weight_6'];
					}else if($round_month == '9' && $indicator_weight['metrics_weight_9'] != ''){
						$weight_perc_tot += $indicator_weight['metrics_weight_9'];
					}else if($round_month == '12' && $indicator_weight['metrics_weight_12'] != ''){
						$weight_perc_tot += $indicator_weight['metrics_weight_12'];
					}else{
						$weight_perc_tot += $indicator_weight['metrics_weight'];
					}
					  
				}
				// หา น้ำหนักของทั้งมิติ //
			}
	 return $weight_perc_tot;
}
?>