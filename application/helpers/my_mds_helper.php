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
						  		and ( metrics_keyer.keyer_users_id = '".login_data('id')."' or metrics_keyer.change_keyer_users_id = '".login_data('id')."' )
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
						  		and  ( metrics_keyer.keyer_users_id = '".login_data('id')."' or metrics_keyer.change_keyer_users_id = '".login_data('id')."' )
						  		and metrics_keyer.round_month = '".$round_month."' 
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
								$data['sum_result'] += @$result_chk_result['score_metrics']*$indicator_weight['metrics_weight_6'];
						}else{
							if($indicator_weight['metrics_cancel'] > '6'){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_6'];
								$data['sum_result'] += @$result_chk_result['score_metrics']*$indicator_weight['metrics_weight_6'];
							}
						}			
					}else if($round_month == '9' && $indicator_weight['metrics_weight_9'] != '' && $indicator_weight['metrics_start'] < '12' && count($result_chk_result) > '0' && $result_all == 'ok'){
						if($indicator_weight['metrics_cancel'] == ''){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_9'];
								$data['sum_result'] += @$result_chk_result['score_metrics']*$indicator_weight['metrics_weight_9'];
						}else{
							if($indicator_weight['metrics_cancel'] > '9'){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_9'];
								$data['sum_result'] += @$result_chk_result['score_metrics']*$indicator_weight['metrics_weight_9'];
							}
						}	
						
					}else if($round_month == '12' && $indicator_weight['metrics_weight_12'] != '' && count($result_chk_result) > '0' && $result_all == 'ok'){
						if($indicator_weight['metrics_cancel'] == ''){
							 	$data['weight_perc_tot'] += $indicator_weight['metrics_weight_12'];
								$data['sum_result'] += @$result_chk_result['score_metrics']*$indicator_weight['metrics_weight_12'];
						}else{
							if($indicator_weight['metrics_cancel'] > '12'){
								$data['weight_perc_tot'] += $indicator_weight['metrics_weight_12'];
								$data['sum_result'] += @$result_chk_result['score_metrics']*@$indicator_weight['metrics_weight_12'];
							}
						}
					}else{
						if($indicator_weight['metrics_start'] <= $round_month && count($result_chk_result) > '0' && $result_all == 'ok'){
							if($indicator_weight['metrics_cancel'] == ''){
								 	$data['weight_perc_tot'] += $indicator_weight['metrics_weight'];
									$data['sum_result'] += @$result_chk_result['score_metrics']*$data['weight_perc_tot'];
							}else{
								if($indicator_weight['metrics_cancel'] > $round_month){
									$data['weight_perc_tot'] += $indicator_weight['metrics_weight'];
									$data['sum_result'] += @$result_chk_result['score_metrics']*$data['weight_perc_tot'];
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
						
						// ตรวจสอบว่า มีการบันทึกข้อมูลครบทุกคนและผ่าน กพร. แล้ว
						$result_all = "ok";
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
						
						if($round_month == '6' && $indicator_weight['metrics_weight_6'] != '' && $indicator_weight['metrics_start'] == '6' && count($result_chk_result) > '0' && $result_all == "ok"){ 
							if($indicator_weight['metrics_cancel'] == ''){
								$weight_perc_tot += $indicator_weight['metrics_weight_6'];
							}else{
								if($indicator_weight['metrics_cancel'] > '6'){
									$weight_perc_tot += $indicator_weight['metrics_weight_6'];
								}
							}	
						}else if($round_month == '9' && $indicator_weight['metrics_weight_9'] != '' && $indicator_weight['metrics_start'] < '12' && count($result_chk_result) > '0' && $result_all == "ok"){ 
							
							if($indicator_weight['metrics_cancel'] == ''){
								$weight_perc_tot += $indicator_weight['metrics_weight_9'];
							}else{
								if($indicator_weight['metrics_cancel'] > '9'){
									$weight_perc_tot += $indicator_weight['metrics_weight_9'];
								}
							}	
							
						}else if($round_month == '12' && $indicator_weight['metrics_weight_12'] != '' && count($result_chk_result) > '0' && $result_all == "ok"){
							if($indicator_weight['metrics_cancel'] == ''){
								 	$weight_perc_tot += $indicator_weight['metrics_weight_12'];
							}else{
								if($indicator_weight['metrics_cancel'] > '12'){
									$weight_perc_tot += $indicator_weight['metrics_weight_12'];
								}
							}
						}else{
							if($indicator_weight['metrics_start'] <= $round_month && count($result_chk_result) > '0' && $result_all == "ok"){
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
					// หา น้ำหนักของทุกมิติ //
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
					}
					
					if($result_all == 'ok'){
						$data['score_metrics'] = @$result_chk_result[0]['score_metrics'];
						$data['result_metrics'] = @$result_chk_result[0]['result_metrics'];
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
							$url = "window.open('mds_indicator/form_show/".$metrics_id."/".@$result_chk_result['0']['id']."')";
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
					if($result['permit_type_id'] == '2' && $result['result_status_id'] == '2' && $status_id != '2'){
						$date = "-";
					}
				}else if($permit_type == 1){
					if($result['permit_type_id'] == '1' && $result['result_status_id'] == '2' && $status_id != '2'){
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
		 $sql_result = "select result.* ,mds_set_metrics_keyer.change_keyer_users_id
						from mds_metrics_result result
						left join mds_set_metrics_keyer on result.mds_set_metrics_id = mds_set_metrics_keyer.mds_set_metrics_id
											and result.round_month = mds_set_metrics_keyer.round_month 
											and mds_set_metrics_keyer.keyer_users_id = result.keyer_users_id 
						where result.mds_set_metrics_id = '".$metrics_id."'
									and  (mds_set_metrics_keyer.keyer_users_id = '".$users_keyer."' or mds_set_metrics_keyer.change_keyer_users_id = '".$users_keyer."' )
									order by result.id desc ";
		$result_chk = $CI->db->getarray($sql_result);
		dbConvert($result_chk);
		
		if(count($result_chk) == '0'){
				$sql_chk_users="SELECT MIN(KEYER.ROUND_MONTH) AS MIN_MONTH
								FROM MDS_SET_METRICS_KEYER KEYER 
								LEFT JOIN MDS_METRICS_RESULT RESULT ON KEYER.MDS_SET_METRICS_ID = RESULT.MDS_SET_METRICS_ID 
								AND KEYER.ROUND_MONTH = RESULT.ROUND_MONTH 
								AND KEYER.KEYER_USERS_ID = RESULT.KEYER_USERS_ID 
								WHERE ( KEYER.KEYER_USERS_ID = '943' OR KEYER.CHANGE_KEYER_USERS_ID = '947') AND KEYER.MDS_SET_METRICS_ID = '2' ";
				$result_chk_user = $CI->db->getarray($sql_chk_users);
				dbConvert($result_chk_user);
				$users_round_month = $result_chk_user['0']['min_month'];
				$chk_metrics_start = $metrics_start;
				for($i=1;$i<=3;$i++){
						if($chk_metrics_start <= '12'){
							// ตรวจสอบว่า มีการบันทึกข้อมูลครบทุกคนและผ่าน กพร. แล้ว
							$chk_keyer_result ="SELECT KEYER.KEYER_USERS_ID , RESULT.ID AS RESULT_ID ,RESULT.IS_SAVE ,RESULT.CONTROL_STATUS ,RESULT.KPR_STATUS,RESULT.RESULT_METRICS
												 FROM  MDS_SET_METRICS_KEYER KEYER
												 LEFT JOIN MDS_METRICS_RESULT RESULT  ON KEYER.MDS_SET_METRICS_ID = RESULT.MDS_SET_METRICS_ID 
															AND KEYER.ROUND_MONTH = RESULT.ROUND_MONTH AND KEYER.KEYER_USERS_ID = RESULT.KEYER_USERS_ID
											   	 WHERE KEYER.MDS_SET_METRICS_ID = '".$metrics_id."' AND KEYER.ROUND_MONTH = '".$chk_metrics_start."' ";
							
							$result_keyer_result = $CI->db->getarray($chk_keyer_result);
							dbConvert($result_keyer_result);
							
					
							$result_all = "ok";
							foreach ($result_keyer_result as $key => $keyer_result) {
								if($keyer_result['result_id'] == '' || $keyer_result['is_save'] != '2' || $keyer_result['control_status'] != '1' || $keyer_result['kpr_status'] != '1'){   
									$result_all = "no";
								}else{		
									$i = '5';
								}
								if($users_round_month > $metrics_start && $result_all == "no"){
									$data['error'] = "ไม่สามารถเพิ่มผลการปฎิบัติราชการได้ เนื่องจากผลการปฎิบัติราชการรอบเดือนก่อนหน้าที่ท่านรับผิดชอบยังไม่ผ่านการอนุมัติ";
								}
							}
							$chk_metrics_start = $chk_metrics_start+3;
						}
						
				}
			if($chk_metrics_start == '15'){
				$chk_metrics_start = $metrics_start;
			}
			$data['round_month'] = $chk_metrics_start;
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
function chk_user_dtl($users_id = null){
	$CI =& get_instance();
	$user_dtl = array();
	if($users_id != ''){
		$sql_chk = "select permission.users_id as permission_users_id,permission.id as permission_id
					,permission.mds_set_permit_type_id,permission.mds_set_position_id,users.*,mds_set_position.pos_name  
					from mds_set_permission permission
					left join users on permission.users_id = users.id
					left join mds_set_position on permission.mds_set_position_id = mds_set_position.id
					where permission.users_id = '".$users_id."' order by permission.id desc";
		$result_chk = $CI->db->getarray($sql_chk);
		dbConvert($result_chk);
		if(count($result_chk) > '0'){
			$user_dtl['name'] = $result_chk['0']['name'];
			$user_dtl['email'] = $result_chk['0']['email'];
			$user_dtl['tel'] = $result_chk['0']['tel'];
			$user_dtl['position_id'] = $result_chk['0']['mds_set_position_id'];
			$user_dtl['division_id'] = $result_chk['0']['divisionid'];
			$user_dtl['department_id'] = $result_chk['0']['departmentid'];
		}
	}
	return $user_dtl;
}
function chk_reslut_keyer_scroe($metrics_id=null,$round_month=null){
	$CI =& get_instance();
	$sql ="select mds_metrics_result.* 
			from mds_metrics_result 
			join mds_set_metrics_keyer on mds_metrics_result.mds_set_metrics_id = mds_set_metrics_keyer.mds_set_metrics_id 
								and mds_set_metrics_keyer.round_month = '".$round_month."' and mds_set_metrics_keyer.keyer_score = '1' 
								and mds_metrics_result.keyer_users_id = mds_set_metrics_keyer.keyer_users_id
			where mds_metrics_result.is_save = '2' and mds_metrics_result.control_status = '1' and mds_metrics_result.kpr_status = '1' 
			and mds_metrics_result.mds_set_metrics_id = '".$metrics_id."' and mds_metrics_result.round_month = '".$round_month."'";
	$result = $CI->db->getarray($sql);
	dbConvert($result);
		if(count($result) > '0'){
			$data = $result['0'];
		}else{
			$data ='';
		}

	return $data;
}

function set_metrics_dtl($indicator_id=null,$all_metrics_on=null,$metrics_on=null,$ref_id=null,$ref_parent=null,$key_sub=null,$sub_all=null,$urlpage=null,$sch_budget_year=null,$metrics_end=FALSE){
	$dtl = '';
	if($indicator_id != '' && $all_metrics_on != '' && $metrics_on != '' && $ref_id != '' && $ref_parent != '' && $sub_all != '' && $urlpage != '' && $sch_budget_year != ''){
			$dtl = '<ul><li><img src="images/tree/page.png" />'.$all_metrics_on;
			
				if(($key_sub+1) < $sub_all && $key_sub == 0){
					$dtl .= '<input type="button" class="btn_downico vtip" title="เลื่อนลง" ref_id = "'.$ref_id.'" ref_parent = "'.$ref_parent.'" indicator_id="'.$indicator_id.'" metrics_on="'.$metrics_on.'"  style="margin-left:20px" />';
			 	}else if(($key_sub+1) < $sub_all && $key_sub > 0){
					$dtl .= '<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น"  ref_id = "'.$ref_id.'" ref_parent = "'.$ref_parent.'" indicator_id="'.$indicator_id.'" metrics_on="'.$metrics_on.'" />';
					$dtl .= '<input type="button" class="btn_downico vtip" title="เลื่อนลง"  ref_id = "'.$ref_id.'" ref_parent = "'.$ref_parent.'" indicator_id="'.$indicator_id.'" metrics_on="'.$metrics_on.'"  />';
				}else if(($key_sub+1) == $sub_all && $key_sub > 0){
					$dtl .= '<input type="button" class="btn_upico vtip" title="เลื่อนขึ้น" ref_id = "'.$ref_id.'" indicator_id="'.$indicator_id.'" metrics_on="'.$metrics_on.'" ref_parent = "'.$ref_parent.'"/>';
				}
			if($metrics_end == FALSE){
				$dtl .= '<a href="'.$urlpage.'/form_2/'.$indicator_id.'/'.$ref_id.'/add"><input type="button" class="btn_addico vtip" title="เพิ่มตัวชี้วัดย่อย" /></a>';
			}
			$dtl .= '<a href="'.$urlpage.'/form_2/'.$indicator_id.'/'.$ref_id.'"><input type="button" class="btn_editico vtip" title="แก้ไขตัวชี้วัดนี้" /></a>';
			$dtl .= '<input type="button" class="btn_deleteico vtip"  title="ลบรายการนี้" link="'.$urlpage.'/delete_metrics/'.$sch_budget_year.'/'.$ref_id.'" />';
   }

	return $dtl;
}

function mds_sar_card_metrics_dtl($metrics_dtl=null,$metrics_on=null,$sch_budget_year=null,$indicator_all_weight_6='',$indicator_all_weight_9='',$indicator_all_weight_12='',$link=TRUE,$type=null){
	$dtl = '';
	if($metrics_dtl != '' && $sch_budget_year != '' && $indicator_all_weight_6 != '' && $indicator_all_weight_9 != '' && $indicator_all_weight_12 != ''){
		$dtl = array();
		$dtl['dtl']  = "<tr>";
  		$dtl['dtl'] .= "<td>";
  		$dtl['dtl'] .= empty($metrics_on)?'':$metrics_on;
  		$dtl['dtl'] .= @$metrics_dtl['metrics_on']."</td>";
  		$dtl['dtl'] .=	"<td>".@$metrics_dtl['metrics_name']."</td>";
  		$dtl['dtl'] .=	"<td>".@$metrics_dtl['result_budget_year_2']."</td>";
		$dtl['dtl'] .=	"<td>".@$metrics_dtl['result_budget_year_1']."</td>";
		$dtl['dtl'] .=	'<td style="text-align: right">'.htmlspecialchars_decode(@$metrics_dtl['metrics_target']).'</td>';

				$metrics_dtl_6 = metrics_weight(@$metrics_dtl['id'],6,$sch_budget_year,$link);
				if($indicator_all_weight_6 != '0'){
					$dtl['sum_score_6'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
				}
				if($metrics_dtl_6['result_metrics'] == ''){
					$metrics_dtl_6['result_metrics'] = 0;
				}
			if($type == 'export'){
				if($metrics_dtl_6['dtl_img'] == '1' || $metrics_dtl_6['dtl_img'] == '0'){
					@$metrics_dtl_6['img'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics']);
				}else{
					@$metrics_dtl_6['img'] = @$metrics_dtl_6['dtl_img'];
				}
			}
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_6['weight'],2).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.@$metrics_dtl_6['result_metrics'].'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_6['score_metrics'],4).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: center">'.@$metrics_dtl_6['img'].'</td>';

  				$metrics_dtl_9 = metrics_weight(@$metrics_dtl['id'],9,$sch_budget_year,$link);
				if($indicator_all_weight_9 != '0'){
					$dtl['sum_score_9'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
				}
				if($metrics_dtl_9['result_metrics'] == ''){
					$metrics_dtl_9['result_metrics'] = 0;
				}
			if($type == 'export'){
				if($metrics_dtl_9['dtl_img'] == '1' || $metrics_dtl_9['dtl_img'] == '0'){
					@$metrics_dtl_9['img'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics']);
				}else{
					@$metrics_dtl_9['img'] = @$metrics_dtl_9['dtl_img'];
				}
			}
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_9['weight'],2).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.@$metrics_dtl_9['result_metrics'].'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_9['score_metrics'],4).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: center">'.@$metrics_dtl_9['img'].'</td>';
 
  				$metrics_dtl_12 = metrics_weight(@$metrics_dtl['id'],12,$sch_budget_year,$link);
				if($indicator_all_weight_12 != '0'){
					$dtl['sum_score_12'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
				}
				if($metrics_dtl_12['result_metrics'] == ''){
					$metrics_dtl_12['result_metrics'] = 0;
				}
			if($type == 'export'){
				if($metrics_dtl_12['dtl_img'] == '1' || $metrics_dtl_12['dtl_img'] == '0'){
					@$metrics_dtl_12['img'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics']);
				}else{
					@$metrics_dtl_12['img'] = @$metrics_dtl_12['dtl_img'];
				}
			}

  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_12['weight'],2).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.@$metrics_dtl_12['result_metrics'].'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_12['score_metrics'],4).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: center">'.@$metrics_dtl_12['img'].'</td>';
  		$dtl['dtl'] .= '</tr>';
	}
	return $dtl;
}

function mds_report_sum_metrics_dtl($metrics_dtl = nul,$metrics_on = null,$sch_round_month = null ,$ass_id = null){
	$CI =& get_instance();
	$dtl = '';
	if($metrics_dtl != '' && $sch_round_month != ''){
					$dtl = array();
					$dtl['dtl'] = '';
					$dtl['ass_id'] = '';
					if(@$ass_id != @$metrics_dtl['mds_set_assessment_id']){
						$dtl['ass_id'] = @$metrics_dtl['mds_set_assessment_id'];
						$dtl['dtl'] .= '<tr>';
						$dtl['dtl'] .= '<td></td>';
						$dtl['dtl'] .=	'<td colspan="5"><b>'.@$metrics_dtl['ass_name'].'</b></td>';
						$dtl['dtl'] .= '</tr>';
					}else{
						$dtl['ass_id'] = $ass_id;
					}

		$dtl['dtl'] .= '<tr>';
  		$dtl['dtl'] .= '<td>';
  		$dtl['dtl'] .= empty($metrics_on)?'':$metrics_on;
  		$dtl['dtl'] .= @$metrics_dtl['metrics_on'].'</td>';
  		$dtl['dtl'] .=	'<td>'.@$metrics_dtl['metrics_name'].'</td>';
  	
  				if($metrics_dtl['metrics_weight_'.$sch_round_month] != ''){
  					$metrics_weight = $metrics_dtl['metrics_weight_'.$sch_round_month];
  				}else{
  					$metrics_weight = $metrics_dtl['metrics_weight'];
  				}
  			
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_weight,2).'</td>';
  			
  				$sql_control = "select mds_set_metrics_kpr.*,cnf_division.title as division_name ,cnf_department.title as department_name
  								from mds_set_metrics_kpr
  								left join cnf_division on mds_set_metrics_kpr.control_division_id = cnf_division.id 
								left join cnf_department on mds_set_metrics_kpr.control_department_id = cnf_department.id 
  								where mds_set_metrics_kpr.mds_set_metrics_id = '".@$metrics_dtl['id']."' and mds_set_metrics_kpr.round_month = '".@$sch_round_month."' ";
				$result_control = $CI->db->getarray($sql_control);
				dbConvert($result_control);
				$result_control = @$result_control['0'];
  		
  		$dtl['dtl'] .=	'<td>'.@$result_control['department_name'].' - '.@$result_control['division_name'].'</td>';
		$dtl['dtl'] .=	'<td>'.@$result_control['control_name'].'</td>';
			
  				$sql_keyer = "select mds_set_metrics_keyer.*
  								from mds_set_metrics_keyer
  								where mds_set_metrics_keyer.mds_set_metrics_id = '".@$metrics_dtl['id']."' and mds_set_metrics_keyer.round_month = '".@$sch_round_month."' ";
				$result_keyer =  $CI->db->getarray($sql_keyer);
				dbConvert($result_keyer);
		$dtl['dtl'] .=	'<td>';
					foreach ($result_keyer as $key => $keyer) {
						if($key != '0'){
							$dtl['dtl'] .= ",";
						}
						$dtl['dtl'] .= @$keyer['keyer_name'];
					} 
				
		$dtl['dtl'] .=	'</td>';
  		$dtl['dtl'] .= '</tr>';
	}
	return $dtl;
}

function mds_report_sum_perform_dtl($metrics_dtl=null,$metrics_on=null,$sch_round_month=null,$sch_budget_year=null,$indicator_all_weight=null,$ass_id=null){
	$dtl = '';
	if($metrics_dtl != '' && $sch_round_month != '' && $sch_budget_year != '' && $indicator_all_weight != ''){
			$dtl = array();
			$dtl['ass_id'] = '';
			$dtl['dtl'] = '';
			if($ass_id != @$metrics_dtl['mds_set_assessment_id']){
					$dtl['ass_id'] = @$metrics_dtl['mds_set_assessment_id'];
					$dtl['dtl'] .= "<tr>";
					$dtl['dtl'] .= '<td colspan="7"><b>'.@$metrics_dtl['ass_name'].'</b></td>';
					$dtl['dtl'] .= '</tr>';
			}else{
					$dtl['ass_id'] = $ass_id;
			}
	$dtl['dtl'] .= '<tr>';
  	$dtl['dtl'] .= '<td>ตัวชีวัดที่'; 
	$dtl['dtl'] .= empty($metrics_on)?'':$metrics_on;
  	$dtl['dtl'] .= @$metrics_dtl['metrics_on']." "; 
  	$dtl['dtl'] .= @$metrics_dtl['metrics_name'].'</td>';
  	$dtl['dtl']	.= '<td style="text-align: right">'.get_one('measure_name','mds_set_measure','id',@$metrics_dtl['mds_set_measure_id']).'</td>';
  	$dtl['dtl']	.= '<td style="text-align: right">'.htmlspecialchars_decode(@$metrics_dtl['metrics_target']).'</td>';
  		
				$metrics_score_dtl = metrics_weight(@$metrics_dtl['id'],$sch_round_month,$sch_budget_year);
				if($indicator_all_weight != '0'){
					//$sum_score += (@$metrics_score_dtl['weight']*@$metrics_score_dtl['score_metrics'])/@$indicator_all_weight;
					@$score = (@$metrics_score_dtl['weight']*@$metrics_score_dtl['score_metrics'])/@$indicator_all_weight;
				}
			
  	$dtl['dtl']	.= '<td style="text-align: right">'.number_format(@$metrics_score_dtl['weight'],2).'</td>';
	$dtl['dtl']	.= '<td style="text-align: right">'.@$metrics_score_dtl['result_metrics'].'</td>';
  	$dtl['dtl']	.= '<td style="text-align: right">'.number_format(@$metrics_score_dtl['score_metrics'],4).'</td>';
  	$dtl['dtl']	.= '<td style="text-align: right">'.number_format(@$score,4).'</td>';
  	$dtl['dtl']	.= '</tr>';
	}
	return $dtl;
}

function mds_report_compare_dtl($metrics_dtl=null,$metrics_on=null,$sch_budget_year=null,$indicator_all_weight_6='',$indicator_all_weight_9='',$indicator_all_weight_12='',$link=TRUE,$type=null){
	$dtl = '';
	if($metrics_dtl != '' && $sch_budget_year != '' && $indicator_all_weight_6 != '' && $indicator_all_weight_9 != '' && $indicator_all_weight_12 != ''){
		$dtl = array();
		$dtl['dtl']  = "<tr>";
  		$dtl['dtl'] .= "<td>";
  		$dtl['dtl'] .= empty($metrics_on)?'':$metrics_on;
  		$dtl['dtl'] .= @$metrics_dtl['metrics_on']."</td>";
  		$dtl['dtl'] .=	"<td>".@$metrics_dtl['metrics_name']."</td>";
  		$dtl['dtl'] .=	"<td></td>";
		$dtl['dtl'] .=	"<td></td>";
		$dtl['dtl'] .=	"<td></td>";
		$dtl['dtl'] .=	"<td></td>";
		$dtl['dtl'] .=	"<td></td>";
		$dtl['dtl'] .=	"<td></td>";
		$dtl['dtl'] .=	'<td style="text-align: right">'.htmlspecialchars_decode(@$metrics_dtl['metrics_target']).'</td>';

				$metrics_dtl_6 = metrics_weight(@$metrics_dtl['id'],6,$sch_budget_year,$link);
				if($indicator_all_weight_6 != '0'){
					$dtl['sum_score_6'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics'])/@$indicator_all_weight_6;
				}
				if($metrics_dtl_6['result_metrics'] == ''){
					$metrics_dtl_6['result_metrics'] = 0;
				}
			if($type == 'export'){
				if($metrics_dtl_6['dtl_img'] == '1' || $metrics_dtl_6['dtl_img'] == '0'){
					@$metrics_dtl_6['img'] = (@$metrics_dtl_6['weight']*@$metrics_dtl_6['score_metrics']);
				}else{
					@$metrics_dtl_6['img'] = @$metrics_dtl_6['dtl_img'];
				}
			}
		
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_6['weight'],2).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.@$metrics_dtl_6['result_metrics'].'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_6['score_metrics'],4).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: center">'.@$metrics_dtl_6['img'].'</td>';

  				$metrics_dtl_9 = metrics_weight(@$metrics_dtl['id'],9,$sch_budget_year,$link);
				if($indicator_all_weight_9 != '0'){
					$dtl['sum_score_9'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics'])/@$indicator_all_weight_9;
				}
				if($metrics_dtl_9['result_metrics'] == ''){
					$metrics_dtl_9['result_metrics'] = 0;
				}
			if($type == 'export'){
				if($metrics_dtl_9['dtl_img'] == '1' || $metrics_dtl_9['dtl_img'] == '0'){
					@$metrics_dtl_9['img'] = (@$metrics_dtl_9['weight']*@$metrics_dtl_9['score_metrics']);
				}else{
					@$metrics_dtl_9['img'] = @$metrics_dtl_9['dtl_img'];
				}
			}
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_9['weight'],2).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.@$metrics_dtl_9['result_metrics'].'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_9['score_metrics'],4).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: center">'.@$metrics_dtl_9['img'].'</td>';
 
  				$metrics_dtl_12 = metrics_weight(@$metrics_dtl['id'],12,$sch_budget_year,$link);
				if($indicator_all_weight_12 != '0'){
					$dtl['sum_score_12'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics'])/@$indicator_all_weight_12;
				}
				if($metrics_dtl_12['result_metrics'] == ''){
					$metrics_dtl_12['result_metrics'] = 0;
				}
			if($type == 'export'){
				if($metrics_dtl_12['dtl_img'] == '1' || $metrics_dtl_12['dtl_img'] == '0'){
					@$metrics_dtl_12['img'] = (@$metrics_dtl_12['weight']*@$metrics_dtl_12['score_metrics']);
				}else{
					@$metrics_dtl_12['img'] = @$metrics_dtl_12['dtl_img'];
				}
			}

  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_12['weight'],2).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.@$metrics_dtl_12['result_metrics'].'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: right">'.number_format(@$metrics_dtl_12['score_metrics'],4).'</td>';
  		$dtl['dtl'] .=	'<td style="text-align: center">'.@$metrics_dtl_12['img'].'</td>';
  		$dtl['dtl'] .= '</tr>';
	}
	return $dtl;
}

?>