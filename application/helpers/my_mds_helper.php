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
function metrics_dtl_indicator($indicator_id = null,$parent_id = null){ // หาตัวชี้วัดและประเด็ดประเมิน
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

function chk_keyer_indicator($indicator_id = null,$id = null,$round_month=null){ //check ว่าเป็นผู้บันทึกตัวชี้วัดหรือไม่
	$result = 'N';
	if($indicator_id != '' && $id != '' && $round_month == ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  join mds_set_metrics_keyer metrics_keyer on metrics.id = metrics_keyer.mds_set_metrics_id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and  metrics_keyer.keyer_users_id = '".login_data('id')."'
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
	}else if($indicator_id != '' && $id != '' && $round_month != ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  join mds_set_metrics_keyer metrics_keyer on metrics.id = metrics_keyer.mds_set_metrics_id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and  metrics_keyer.keyer_users_id = '".login_data('id')."' and metrics_keyer.round_month = '".$round_month."' 
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
		
	}
	return @$result;
}

function chk_control_indicator($indicator_id = null,$id = null,$result_id = null){ //check ว่าเป็น ผู็กำกับ ตัวชี้วัดหรือไม่
	$result = 'N';
	if($indicator_id != '' && $id != '' && $result_id == ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  join mds_set_metrics_kpr metrics_kpr on metrics.id = metrics_kpr.mds_set_metrics_id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and  metrics_kpr.control_users_id = '".login_data('id')."'
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
	}else if($indicator_id != '' && $id != '' && $result_id != ''){
			$CI =& get_instance();
			$condition = '';
			
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  join mds_metrics_result on metrics.id = mds_metrics_result.mds_set_metrics_id
						  join mds_set_metrics_kpr metrics_kpr on metrics.id = metrics_kpr.mds_set_metrics_id and mds_metrics_result.round_month = metrics_kpr.round_month
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and mds_metrics_result.id = '".$result_id."' 
						  		and  metrics_kpr.control_users_id = '".login_data('id')."'
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
		
	}
	return @$result;
}

function chk_kpr_indicator($indicator_id = null,$id = null,$result_id = null){ //check ว่าเป็น ผู็กำกับ ตัวชี้วัดหรือไม่
	$result = 'N';
	if($indicator_id != '' && $id != '' && $result_id == ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  join mds_set_metrics_kpr metrics_kpr on metrics.id = metrics_kpr.mds_set_metrics_id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and  metrics_kpr.kpr_users_id = '".login_data('id')."'
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
	}else if($indicator_id != '' && $id != '' && $result_id != ''){
			$CI =& get_instance();
			$condition = '';
			$sql = "select metrics.*
						  from mds_set_metrics metrics
						  join mds_metrics_result on metrics.id = mds_metrics_result.mds_set_metrics_id
						  join mds_set_metrics_kpr metrics_kpr on metrics.id = metrics_kpr.mds_set_metrics_id and mds_metrics_result.round_month = metrics_kpr.round_month
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.id = '".$id."' 
						  		and mds_metrics_result.id = '".$result_id."' 
						  		and  metrics_kpr.kpr_users_id = '".login_data('id')."'
						  order by metrics.metrics_on asc  ";
			$result_1 = $CI->db->getarray($sql); 
			$num_result = count($result_1);
			if($num_result > 0){
				$result = 'Y';
			}
		
	}
	return @$result;
}

function metrics_set_indicator($mds_set_indicator_id = null,$mds_set_assessment_id = null,$parent_id = null){ // หาตั้วชี้วัดในแต่ล่ะ เลเวล
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
function indicator_weight($id = null , $round_month = null){ // หาค่าคะแนนทั้งหมดของมิติ
		$weight_perc_tot='0';
		$CI =& get_instance();
			if($id != '' && $round_month != ''){
				// หา น้ำหนักของทั้งมิติ //
				
				$sel_indicator_weight = "SELECT * FROM MDS_SET_METRICS WHERE MDS_SET_INDICATOR_ID = '".$id."' AND METRICS_RESPONSIBLE = 'Y' ";
				$result_indicator_weight = $CI->db->getarray($sel_indicator_weight);
				dbConvert($result_indicator_weight);
				foreach ($result_indicator_weight as $key => $indicator_weight) {
					if($round_month == '6' && $indicator_weight['metrics_weight_6'] != '' && $indicator_weight['metrics_start'] == '6'){
						if($indicator_weight['metrics_cancel'] == ''){
							$weight_perc_tot += $indicator_weight['metrics_weight_6'];
						}else{
							if($indicator_weight['metrics_cancel'] > '6'){
								$weight_perc_tot += $indicator_weight['metrics_weight_6'];
							}
						}			
					}else if($round_month == '9' && $indicator_weight['metrics_weight_9'] != '' && $indicator_weight['metrics_start'] < '12'){
						if($indicator_weight['metrics_cancel'] == ''){
							$weight_perc_tot += $indicator_weight['metrics_weight_9'];
						}else{
							if($indicator_weight['metrics_cancel'] > '9'){
								$weight_perc_tot += $indicator_weight['metrics_weight_9'];
							}
						}	
						
					}else if($round_month == '12' && $indicator_weight['metrics_weight_12'] != ''){
						if($indicator_weight['metrics_cancel'] == ''){
							 	$weight_perc_tot += $indicator_weight['metrics_weight_12'];
						}else{
							if($indicator_weight['metrics_cancel'] > '12'){
								$weight_perc_tot += $indicator_weight['metrics_weight_12'];
							}
						}
					}else{
						if($indicator_weight['metrics_start'] <= $round_month){
							if($indicator_weight['metrics_cancel'] == ''){
								 	$weight_perc_tot += $indicator_weight['metrics_weight'];
							}else{
								if($indicator_weight['metrics_cancel'] > $round_month){
									$weight_perc_tot += $indicator_weight['metrics_weight'];
								}
							}
						}
					}
					  
				}
				// หา น้ำหนักของทั้งมิติ //
			}
	 return $weight_perc_tot;
}
function chk_date_approve($result_id = null , $permit_type = null,$status_id = null){ // หาวันที่ในการอนุมัติสถานะ ต่างๆ
		$CI =& get_instance();
		if($result_id != '' && $permit_type != '' && $status_id != ''){
		
			$sql_chk_status = "SELECT RESULT_STATUS.*,MDS_METRICS_RESULT.IS_SAVE
							FROM MDS_METRICS_RESULT_STATUS RESULT_STATUS
							JOIN MDS_METRICS_RESULT ON RESULT_STATUS.MDS_METRICS_RESULT_ID = MDS_METRICS_RESULT.ID
							WHERE RESULT_STATUS.MDS_METRICS_RESULT_ID = '".$result_id."' AND PERMIT_TYPE_ID = '".$permit_type."' AND RESULT_STATUS_ID = '".$status_id."'
							ORDER BY RESULT_STATUS.ID DESC";
			$result_chk_status = $CI->db->getarray($sql_chk_status);
			dbConvert($result_chk_status);
			$result = @$result_chk_status['0'];
			if($result['create_date'] != ''){
				$update = explode('-', @$result['create_date']);
				$update_year =  substr(@$update['0'],2)+43;
				$date = @$update['2'].'/'.@$update['1'].'/'.@$update_year;
				
			
				if($permit_type == 3){
					if($result['is_save'] == '1' ){
						$date = "-";
					}
				}else if($permit_type == 2){
					if($result['permit_type_id'] == '2' && $result['result_status_id'] == '2'){
						$date = "-";
					}
				}else if($permit_type == 1){
					if($result['permit_type_id'] == '1' && $result['result_status_id'] == '2'){
						$date = "-";
					}
				}
			}else{
				$date = "-";
			}
		}else{
			$date = "-";
		}
	return $date;	
}

function chk_result_round_month($users_keyer = null,$metrics_id = null,$metrics_start = null){
	$CI =& get_instance();
	$data['round_month'] = '';
	if($users_keyer != ''&& $metrics_id != '' && $metrics_start != ''){
		$sql_result = "select result.*
						from mds_metrics_result result 
						where result.keyer_users_id = '".$users_keyer."' and RESULT.MDS_SET_METRICS_ID = '".$metrics_id."' 
						order by result.id asc";
		$result_chk = $CI->db->getarray($sql_result);
		dbConvert($result_chk);
		if(count($result_chk) == '0'){
			$data['round_month'] = $metrics_start;
		}else{
			foreach ($result_chk as $key => $chk) {
				if($chk['control_status'] == '' && $chk['kpr_status'] == ''){
					$data['round_month'] = $result_chk['0']['round_month'];
					$data['error'] = "ไม่สามารถเพิ่มผลการปฎิบัติราชการได้ เนื่องจากผลการปฎิบัติราชการรอบ ".$result_chk['0']['round_month']." เดือน ยังไม่มีการตรวจรับรอง";
				}else if($chk['control_status'] == '1' && $chk['kpr_status'] == ''){
						
					$data['round_month'] = $result_chk['0']['round_month'];
					$data['error'] = "ไม่สามารถเพิ่มผลการปฎิบัติราชการได้ เนื่องจากผลการปฎิบัติราชการรอบ ".$result_chk['0']['round_month']."ไม่ผ่านการอนุมัติ";
					
				}else if($chk['control_status'] == '1' && $chk['kpr_status'] == '1'){
					if($result_chk['0']['round_month'] < '12'){
						$data['round_month'] = $result_chk['0']['round_month']+3;
					}else{
						$data['error'] = "ท่านทำการกรอกข้อมูลถึงรอบ 12 เดือนแล้ว ไม่สามารถเพิ่มผลการปฎิบัติราชการได้";
					}	
				}
			}
		}
		
	}
	return $data;
}
		
?>