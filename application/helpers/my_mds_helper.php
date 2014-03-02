<?php
function is_permit($users_id = null,$permit = null){
	$data = '';	
	if($users_id != ''){
			$CI =& get_instance();
			$condition = '';
		if($permit != ''){
			$condition = "AND MDS_SET_PERMISSION_TYPE.MDS_SET_PERMIT_TYPE_ID = '".$permit."'";
		}
		
			$sql = "SELECT MDS_SET_PERMIT_TYPE.PERMIT_NAME 
					FROM  MDS_SET_PERMISSION
					JOIN MDS_SET_PERMISSION_TYPE ON MDS_SET_PERMISSION.ID =  MDS_SET_PERMISSION_TYPE.MDS_SET_PERMISSION_ID
					LEFT JOIN MDS_SET_PERMIT_TYPE ON MDS_SET_PERMISSION_TYPE.MDS_SET_PERMIT_TYPE_ID =  MDS_SET_PERMIT_TYPE.ID
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
function metrics_dtl_indicator($indicator_id = null,$parent_id = null,$round_month = null){ // หาตัวชี้วัดและประเด็ดประเมิน
	$result = array();
	if($indicator_id != '' && $parent_id != ''){
			$CI =& get_instance();
			$condition = '';
			if($round_month != ''){
				$condition = "and metrics.metrics_start <= '".$round_month."' ";
			}
			$sql = "select metrics.*,assessment.ass_name
						  from mds_set_metrics metrics
						  left join mds_set_assessment assessment on metrics.mds_set_assessment_id = assessment.id
						  where metrics.mds_set_indicator_id = '".@$indicator_id."' and metrics.parent_id = '".$parent_id."' 
						  $condition
						  order by metrics.metrics_on asc  ";
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
		$data['weight_perc_tot'] = '0';
		$data['sum_result'] = '0';
		$CI =& get_instance();
			if($id != '' && $round_month != ''){
				// หา น้ำหนักของทั้งมิติ //
				
				$sel_indicator_weight = "SELECT * FROM MDS_SET_METRICS 
										 WHERE MDS_SET_INDICATOR_ID = '".$id."'";
										 //AND METRICS_RESPONSIBLE = 'Y' ";
				$result_indicator_weight = $CI->db->getarray($sel_indicator_weight);
				dbConvert($result_indicator_weight);
				foreach ($result_indicator_weight as $key => $indicator_weight) {
					$chk_result = "SELECT RESULT.* 
									 FROM MDS_METRICS_RESULT RESULT
									 JOIN MDS_SET_METRICS_KEYER KEYER ON RESULT.MDS_SET_METRICS_ID = KEYER.MDS_SET_METRICS_ID 
												AND RESULT.ROUND_MONTH = KEYER.ROUND_MONTH AND RESULT.KEYER_USERS_ID = KEYER.KEYER_USERS_ID
								   WHERE RESULT.MDS_SET_METRICS_ID = '".$indicator_weight['id']."' 
								   AND RESULT.ROUND_MONTH = '".$round_month."' AND RESULT.IS_SAVE = '2' 
								   AND RESULT.CONTROL_STATUS = '1' AND RESULT.KPR_STATUS = '1' AND KEYER.KEYER_SCORE = '1'";
					$result_chk_result = $CI->db->getarray($chk_result);
					dbConvert($result_chk_result);
					$result_chk_result = @$result_chk_result['0'];
					
					$result_all = 'ok';
					// ตรวจสอบว่า มีการบันทึกข้อมูลครบทุกคนและผ่าน กพร. แล้ว
					$chk_keyer_result ="SELECT KEYER.KEYER_USERS_ID , RESULT.ID AS RESULT_ID ,RESULT.IS_SAVE ,RESULT.CONTROL_STATUS ,RESULT.KPR_STATUS
										 FROM  MDS_SET_METRICS_KEYER KEYER
										 LEFT JOIN MDS_METRICS_RESULT RESULT  ON KEYER.MDS_SET_METRICS_ID = RESULT.MDS_SET_METRICS_ID 
													AND KEYER.ROUND_MONTH = RESULT.ROUND_MONTH AND KEYER.KEYER_USERS_ID = RESULT.KEYER_USERS_ID
									   	 WHERE KEYER.MDS_SET_METRICS_ID = '".$indicator_weight['id']."' AND KEYER.ROUND_MONTH = '".$round_month."' ";
					$result_keyer_result = $CI->db->getarray($chk_keyer_result);
					dbConvert($result_keyer_result);
					
					foreach ($result_keyer_result as $key => $keyer_result) {
						if($keyer_result['result_id'] == '' || $keyer_result['is_save'] != '2' || $keyer_result['control_status'] != '1' || $keyer_result['kpr_status'] != '1'){   
							$result_all = "no";
						}
					}
					
					if($round_month == '6' && $indicator_weight['metrics_weight_6'] != '' && $indicator_weight['metrics_start'] == '6' && count($result_chk_result) > '0' && $result_all == 'ok'){
						if($indicator_weight['metrics_cancel'] == ''){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_6'];
								$data['sum_result'] += @$result_chk_result['score_metrics'];
						}else{
							if($indicator_weight['metrics_cancel'] > '6'){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_6'];
								$data['sum_result'] += @$result_chk_result['score_metrics'];
							}
						}			
					}else if($round_month == '9' && $indicator_weight['metrics_weight_9'] != '' && $indicator_weight['metrics_start'] < '12' && count($result_chk_result) > '0' && $result_all == 'ok'){
						if($indicator_weight['metrics_cancel'] == ''){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_9'];
								$data['sum_result'] += @$result_chk_result['score_metrics'];
						}else{
							if($indicator_weight['metrics_cancel'] > '9'){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_9'];
								$data['sum_result'] += @$result_chk_result['score_metrics'];
							}
						}	
						
					}else if($round_month == '12' && $indicator_weight['metrics_weight_12'] != '' && count($result_chk_result) > '0' && $result_all == 'ok'){
						if($indicator_weight['metrics_cancel'] == ''){
							 	$data['weight_perc_tot'] += $indicator_weight['metrics_weight_12'];
								$data['sum_result'] += @$result_chk_result['score_metrics'];
						}else{
							if($indicator_weight['metrics_cancel'] > '12'){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_12'];
								$data['sum_result'] += $indicator_weight['metrics_weight_12']*@$result_chk_result['0']['score_metrics'];
							}
						}
					}else{
						if($indicator_weight['metrics_start'] <= $round_month && count($result_chk_result) > '0' && $result_all == 'ok'){
							if($indicator_weight['metrics_cancel'] == ''){
								 	$data['weight_perc_tot'] += $indicator_weight['metrics_weight'];
									$data['sum_result'] += @$result_chk_result['score_metrics'];
							}else{
								if($indicator_weight['metrics_cancel'] > $round_month){
									$data['weight_perc_tot'] += $indicator_weight['metrics_weight'];
									$data['sum_result'] += @$result_chk_result['score_metrics'];
								}
							}
						}
					}
					  
				}
				// หา น้ำหนักของทั้งมิติ //
			}
	 return $data;
}
function indicator_all_weight($budget_year = null , $round_month = null , $result = FALSE){ // หาค่าคะแนนทั้งหมดของมิติ
		$weight_perc_tot='0';
		$CI =& get_instance();
			if($budget_year != '' && $round_month != ''){
				// หา น้ำหนักของทั้งมิติ //
				
				$sel_indicator_weight = "SELECT MDS_SET_METRICS.* 
										FROM MDS_SET_INDICATOR
										LEFT JOIN MDS_SET_METRICS ON MDS_SET_INDICATOR.ID = MDS_SET_METRICS.MDS_SET_INDICATOR_ID
										WHERE MDS_SET_INDICATOR.BUDGET_YEAR= '".$budget_year."' ";
											  //AND MDS_SET_METRICS.METRICS_RESPONSIBLE = 'Y'";
				$result_indicator_weight = $CI->db->getarray($sel_indicator_weight);
				dbConvert($result_indicator_weight);
				
				foreach ($result_indicator_weight as $key => $indicator_weight) {
				if($result == FALSE){		
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
						  
					}else if($result == true){
						$chk_result = "SELECT * FROM MDS_METRICS_RESULT
								   WHERE MDS_SET_METRICS_ID = '".$indicator_weight['id']."' 
								   AND ROUND_MONTH = '".$round_month."' AND IS_SAVE = '2' 
								   AND CONTROL_STATUS = '1' AND KPR_STATUS = '1' ";
						$result_chk_result = $CI->db->getarray($chk_result);
						dbConvert($result_chk_result);
						
						if($round_month == '6' && $indicator_weight['metrics_weight_6'] != '' && $indicator_weight['metrics_start'] == '6' && count($result_chk_result) > '0'){
							if($indicator_weight['metrics_cancel'] == ''){
								$weight_perc_tot += $indicator_weight['metrics_weight_6'];
							}else{
								if($indicator_weight['metrics_cancel'] > '6'){
									$weight_perc_tot += $indicator_weight['metrics_weight_6'];
								}
							}			
						}else if($round_month == '9' && $indicator_weight['metrics_weight_9'] != '' && $indicator_weight['metrics_start'] < '12' && count($result_chk_result) > '0'){
							
							if($indicator_weight['metrics_cancel'] == ''){
								$weight_perc_tot += $indicator_weight['metrics_weight_9'];
							}else{
								if($indicator_weight['metrics_cancel'] > '9'){
									$weight_perc_tot += $indicator_weight['metrics_weight_9'];
								}
							}	
							
						}else if($round_month == '12' && $indicator_weight['metrics_weight_12'] != '' && count($result_chk_result) > '0'){
							if($indicator_weight['metrics_cancel'] == ''){
								 	$weight_perc_tot += $indicator_weight['metrics_weight_12'];
							}else{
								if($indicator_weight['metrics_cancel'] > '12'){
									$weight_perc_tot += $indicator_weight['metrics_weight_12'];
								}
							}
						}else{
							if($indicator_weight['metrics_start'] <= $round_month && count($result_chk_result) > '0'){
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
			}
	 return $weight_perc_tot;
}
function metrics_weight($metrics_id = null , $round_month = null,$budget_year = null,$link = true){
	$CI =& get_instance();
	if($metrics_id != '' && $round_month != '' && $budget_year != ''){
					$chk_result = "SELECT RESULT.* 
									 FROM MDS_METRICS_RESULT RESULT
									 JOIN MDS_SET_METRICS_KEYER KEYER ON RESULT.MDS_SET_METRICS_ID = KEYER.MDS_SET_METRICS_ID 
												AND RESULT.ROUND_MONTH = KEYER.ROUND_MONTH AND RESULT.KEYER_USERS_ID = KEYER.KEYER_USERS_ID
								   WHERE RESULT.MDS_SET_METRICS_ID = '".$metrics_id."' 
								   AND RESULT.ROUND_MONTH = '".$round_month."' AND RESULT.IS_SAVE = '2' 
								   AND RESULT.CONTROL_STATUS = '1' AND RESULT.KPR_STATUS = '1' AND KEYER.KEYER_SCORE = '1'";
					$result_chk_result = $CI->db->getarray($chk_result);
					dbConvert($result_chk_result);
					
					$result_all = 'ok';
					$data['result_metrics'] = '0';
					// ตรวจสอบว่า มีการบันทึกข้อมูลครบทุกคนและผ่าน กพร. แล้ว
					$chk_keyer_result ="SELECT KEYER.KEYER_USERS_ID , RESULT.ID AS RESULT_ID ,RESULT.IS_SAVE ,RESULT.CONTROL_STATUS ,RESULT.KPR_STATUS,RESULT.RESULT_METRICS
										 FROM  MDS_SET_METRICS_KEYER KEYER
										 LEFT JOIN MDS_METRICS_RESULT RESULT  ON KEYER.MDS_SET_METRICS_ID = RESULT.MDS_SET_METRICS_ID 
													AND KEYER.ROUND_MONTH = RESULT.ROUND_MONTH AND KEYER.KEYER_USERS_ID = RESULT.KEYER_USERS_ID
									   	 WHERE KEYER.MDS_SET_METRICS_ID = '".$metrics_id."' AND KEYER.ROUND_MONTH = '".$round_month."' ";
					$result_keyer_result = $CI->db->getarray($chk_keyer_result);
					dbConvert($result_keyer_result);
					
					foreach ($result_keyer_result as $key => $keyer_result) {
						if($keyer_result['result_id'] == '' || $keyer_result['is_save'] != '2' || $keyer_result['control_status'] != '1' || $keyer_result['kpr_status'] != '1'){   
							$result_all = "no";
						}
						if(is_numeric(@$keyer_result['result_metrics'])){
							$data['result_metrics'] += @$keyer_result['result_metrics'];
						}else{
							$data['result_metrics'] += '0';
						}
					}
					
					if($result_all == 'ok'){
						$data['score_metrics'] = @$result_chk_result[0]['score_metrics'];
					}else{
						$data['score_metrics'] = '0';
						$data['result_metrics'] = '0';
					}
					
					// รูปเปรียบเทียบค่า คะแนน
					$sql_img = "select * from mds_set_score where budget_year = '".$budget_year."' and val_start <= '".@$data['score_metrics']."' and val_end >= '".$data['score_metrics']."' ";
				   	$result_imp = $CI->db->getarray($sql_img);
					dbConvert($result_imp);
					if(@$result_imp['0']['score_id'] != '' && $result_all == 'ok'){
						if($link == true){
							$url = "window.open('mds_indicator/form_2/".$metrics_id."/".@$result_chk_result['0']['id']."')";
							$data['img'] = '<a class="link_img" href="#" onclick="'.$url.'" ><img src="'.base_url().'themes/mdevsys/images/circle_'.@$result_imp['0']['score_id'].'.png" title="'.@$data['score_metrics'].'" width="16" height="16" ></a>';
							$data['dtl_img'] = "1";
						}else{
							$data['img'] = '<img src="'.base_url().'themes/mdevsys/images/circle_'.@$result_imp['0']['score_id'].'.png" title="'.@$data['score_metrics'].'" width="16" height="16" >';
							$data['dtl_img'] = "1";
						}
						
					}else{
						$data['img'] = '<img src="'.base_url().'themes/mdevsys/images/circle_0.png" width="16" height="16">';
						$data['dtl_img'] = "0";
					}
					
				   	//
						$chk_metrics = "SELECT * FROM MDS_SET_METRICS
								   WHERE ID = '".$metrics_id."' ";
						$result_chk_metrics = $CI->db->getarray($chk_metrics);
						dbConvert($result_chk_metrics);
						if(count($result_chk_metrics) > 0 && $result_all == 'ok'){
							if($round_month == 6 && @$result_chk_metrics['0']['metrics_weight_6'] != ''){
								$data['weight'] = @$result_chk_metrics['0']['metrics_weight_6'];
							}else if($round_month == 9 && @$result_chk_metrics['0']['metrics_weight_9'] != ''){
								$data['weight'] = @$result_chk_metrics['0']['metrics_weight_9'];
							}else if($round_month == 12 && @$result_chk_metrics['0']['metrics_weight_12'] != ''){
								$data['weight'] = @$result_chk_metrics['0']['metrics_weight_12'];
							}else{
								$data['weight'] = @$result_chk_metrics['0']['metrics_weight'];
							}
							
						}
					if(count($result_chk_result) == 0){
						$data['weight'] = '0';
					}
					if($round_month < @$result_chk_metrics[0]['metrics_start'] ){
							$data['img'] = '<img src="'.base_url().'themes/mdevsys/images/pass.gif" width="16" height="16">';
							$data['result_metrics'] = '0';	
							$data['score_metrics'] = '0';
							$data['dtl_img'] = 'เริ่มรอบถัดไป';
					}
					if(@$result_chk_metrics[0]['metrics_cancel'] != '' ){
						if($round_month >= @$result_chk_metrics[0]['metrics_cancel']){
							$data['img'] = '<img src="'.base_url().'themes/mdevsys/images/cancel.gif" width="16" height="16">';
							$data['result_metrics'] = '0';
							$data['score_metrics'] = '0';
							$data['dtl_img'] = 'ยกเลิกตัวชี้วัด';
						}
					}
					
	}
	return $data;
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
						order by result.id desc";
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
function chk_permission_id($users_id = null){
	$CI =& get_instance();
	$permission_id = '';
	if($users_id != ''){
		$sql_chk = "SELECT MDS_SET_PERMISSION.ID
					FROM MDS_SET_PERMISSION
					WHERE MDS_SET_PERMISSION.USERS_ID = '".$users_id."'";
		$result_chk = $CI->db->getarray($sql_chk);
		dbConvert($result_chk);
		if(count($result_chk) > '0'){
			$permission_id = $result_chk['0']['id'];
		}
	}
	return $permission_id;
}
		
?>