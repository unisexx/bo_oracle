<?php
Class Mds_set_indicator extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/Mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/Mds_set_metrics_model','metrics');
		$this->load->model('mds_set_indicator/Mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/Mds_set_metrics_keyer_model','keyer');
		$this->load->model('mds_indicator/Mds_metrics_result_model','metrics_result');
		
	}
	
	public $urlpage = "mds_set_indicator";
	public $modules_name = "mds_set_indicator";
	public $modules_title = " ตั้งค่า มิติ";

	public $modules_title_2 = " ตั้งค่า ตัวชี้วัด";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		$condition = " 1=1 ";
		if(@$_GET['sch_budget_year'] != ''){
			$condition .= " and budget_year = '".@$_GET['sch_budget_year']."' ";
		}
		if(@$_GET['sch_indicatorn'] != ''){
			$condition .=" and id = '".@$_GET['sch_indicatorn']."' ";
		}
		$data['rs'] = $this->indicator->where($condition)->get('',true);
		
		$this->template->build('index',@$data);

	}
	function form($budget_year=null, $id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($id != ''){
			$data['rs'] = $this->indicator->get_row($id);
			new_save_logfile("VIEW",$this->modules_title,$this->indicator->table,"ID",$id,"indicator_name",$this->modules_name);
		}else{
			$data['rs']['budget_year'] = $budget_year;
		}
		$this->template->build('form',@$data);

	}

	function form_2($indicator_id=null, $id=null,$action = null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		if($id == '' && $indicator_id != ''){
			
			$data['rs']['mds_set_indicator_id'] = $indicator_id;
			$data['rs_indicator'] = $this->indicator->get_row($indicator_id);
			if($data['rs_indicator']['id'] == ''){
				set_notify('error', 'การเข้าถึงข้อมูลผิดพลาด');	
				redirect($data['urlpage']);
			}
			
			$sql_max_metrics_on = "select max(mds_set_metrics.metrics_on) as max_metrics_on 
									from mds_set_metrics
									join mds_set_indicator on mds_set_metrics.mds_set_indicator_id = mds_set_indicator.id
								   where mds_set_indicator.budget_year = '".@$data['rs_indicator']['budget_year']."' 
								   		 and mds_set_metrics.parent_id = '0' "; 
			$result_max = $this->metrics->get($sql_max_metrics_on);
			$data['max_mrtrics_on'] = @$result_max['0']['max_metrics_on']+1;
			
			$data['rs']['parent_id'] = '0';
			
		}else if($id != '' && $indicator_id != '' && $action == ''){
			
			$data['rs_indicator'] = $this->indicator->get_row($indicator_id);
			if($data['rs_indicator']['id'] == ''){
				set_notify('error', 'การเข้าถึงข้อมูลผิดพลาด');	
				redirect($data['urlpage']);
			}
			
			$data['rs'] = $this->metrics->get_row($id);
			// log
			new_save_logfile("VIEW",$this->modules_title_2,$this->metrics->table,"ID",$id,"metrics_name",$this->modules_name);
			
			if($data['rs']['parent_id'] ==  0){
				$sql_max_metrics_on = "select max(mds_set_metrics.metrics_on) as max_metrics_on 
									from mds_set_metrics
									join mds_set_indicator on mds_set_metrics.mds_set_indicator_id = mds_set_indicator.id
								   where mds_set_indicator.budget_year = '".@$data['rs_indicator']['budget_year']."' 
								   		 and mds_set_metrics.parent_id = '0' "; 
				$result_max = $this->metrics->get($sql_max_metrics_on);
				$data['max_mrtrics_on'] = @$result_max['0']['max_metrics_on']+1;
			}else{
				$sql_max_metrics_on = "select max(metrics_on) as max_metrics_on from mds_set_metrics 
								   where mds_set_indicator_id = '".@$indicator_id."' and parent_id = '".$id."' "; 
				$result_max = $this->metrics->get($sql_max_metrics_on);
				$data['max_mrtrics_on'] = @$result_max['0']['max_metrics_on']+1;
			
			}
			
			
			$data['parent_on'] = '';
			$parent_on_id = $data['rs']['parent_id'];
			
			if($data['rs']['parent_id'] != '0'){
				for ($i=1; $i <= 4 ; $i++) {				
					$parent_on = '';
					$parent_on = $this->metrics->get_row($parent_on_id);
					$parent_on_id = $parent_on['parent_id'];
					
					if($parent_on['parent_id'] == '0'){
						$data['mds_set_assessment_id'] = $parent_on['mds_set_assessment_id'];
						$i = '6';
					}
					
					if($data['parent_on'] != ''){
						$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
					}else{
						$data['parent_on'] = @$parent_on['metrics_on'];
					}	
					
				}
			}
			
		}else if($id != '' && $indicator_id != '' && $action == 'add'){
			$data['rs']['mds_set_indicator_id'] = $indicator_id;
			$data['rs_indicator'] = $this->indicator->get_row($indicator_id);
			if($data['rs_indicator']['id'] == ''){
				set_notify('error', 'การเข้าถึงข้อมูลผิดพลาด');	
				redirect($data['urlpage']);
			}
			
			$sql_max_metrics_on = "select max(metrics_on) as max_metrics_on from mds_set_metrics 
								   where mds_set_indicator_id = '".@$indicator_id."' and parent_id = '".$id."' "; 
			$result_max = $this->metrics->get($sql_max_metrics_on);
			$data['max_mrtrics_on'] = @$result_max['0']['max_metrics_on']+1;
			
			$data['parent_on'] = '';
			$parent_on = $this->metrics->get_row($id);
			$parent_on_id = $parent_on['id'];
			
			if(@$parent_on['parent_id'] != '0'){
				for ($i=1; $i <= 4 ; $i++) {
					if($i == 4){
						set_notify('error', 'การเข้าถึงข้อมูลผิดพลาด');
						redirect($data['urlpage'].'/index?sch_budget_year='.@$data['rs_indicator']['budget_year']);
					}
					$parent_on = '';
					$parent_on = $this->metrics->get_row($parent_on_id);
					$parent_on_id = $parent_on['parent_id'];
					if($parent_on['parent_id'] == '0'){
						$data['mds_set_assessment_id'] = $parent_on['mds_set_assessment_id'];
						$i = 5;
					}
					
					if($data['parent_on'] != ''){
						$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
					}else{
						$data['parent_on'] = @$parent_on['metrics_on'];
					}
					
				}
			}else{
				$data['parent_on'] = @$parent_on['metrics_on'];
				$data['mds_set_assessment_id'] = $parent_on['mds_set_assessment_id'];
			}
			$data['rs']['parent_id'] = $id;
		}
		
		
		$this->template->build('form_2',@$data);

	}
	
	function save(){
		$urlpage = $this->urlpage;
		$this->db->debug = true;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($_POST){
			
			if($_POST['id']>0){
		   		$_POST['UPDATE_DATE'] = date("Y-m-d");
				$_POST['UPDATE_BY'] = login_data('id');
			}else{
				$_POST['CREATE_DATE'] = date("Y-m-d");
				$_POST['CREATE_BY'] = login_data('id');
			}
			$id = $this->indicator->save($_POST);
						
		   if($_POST['id']>0){
		   	new_save_logfile("EDIT",$this->modules_title,$this->indicator->table,"ID",$id,"indicator_name",$this->modules_name);
		   }else{
		   	new_save_logfile("ADD",$this->modules_title,$this->indicator->table,"ID",$id,"indicator_name",$this->modules_name);
		   }
		   
		   
		   set_notify('success', lang('save_data_complete'));	  
		}
		redirect($urlpage.'/index?sch_budget_year='.@$_POST['budget_year']);

	}
	function save_2(){
		$urlpage = $this->urlpage;
		/*
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		 * 
		 */
		//return false;
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($_POST){
			
			$metrics_cancel = @$_POST['metrics_cancel'];
			if($metrics_cancel == ''){
				@$_POST['metrics_cancel'] = '';
			}
			
			if($_POST['id']>0){
				$_POST['UPDATE_DATE'] = date("Y-m-d");
				$_POST['UPDATE_BY'] = login_data('id');
			}else{
				$_POST['CREATE_DATE'] = date("Y-m-d");
				$_POST['CREATE_BY'] = login_data('id');
			}
			
			if(@$_POST['id'] != ''){ // ตรวจสอบว่ามีเลขลำดับซ้ำกันหรือไม่
				$chk_metrics_on = "SELECT METRICS.ID,METRICS.METRICS_ON
							  FROM MDS_SET_METRICS METRICS
							  LEFT JOIN MDS_SET_INDICATOR INDICATOR ON METRICS.MDS_SET_INDICATOR_ID = INDICATOR.ID
							  WHERE INDICATOR.BUDGET_YEAR = '".@$_POST['budget_year']."' AND METRICS.PARENT_ID = '".@$_POST['parent_id']."' 
							  AND METRICS.METRICS_ON = '".@$_POST['metrics_on']."' AND METRICS.ID != '".@$_POST['id']."' ORDER BY METRICS.METRICS_ON ASC ";
				$result_chk_on = $this->metrics->get($chk_metrics_on);
				$num_chk_on = count($result_chk_on);
			}else{
				$chk_metrics_on = "SELECT METRICS.ID,METRICS.METRICS_ON
							  FROM MDS_SET_METRICS METRICS
							  LEFT JOIN MDS_SET_INDICATOR INDICATOR ON METRICS.MDS_SET_INDICATOR_ID = INDICATOR.ID
							  WHERE INDICATOR.BUDGET_YEAR = '".@$_POST['budget_year']."' AND METRICS.PARENT_ID = '".@$_POST['parent_id']."' 
							  AND METRICS.METRICS_ON = '".@$_POST['metrics_on']."' ORDER BY METRICS.METRICS_ON ASC ";
				$result_chk_on = $this->metrics->get($chk_metrics_on);
				$num_chk_on = count($result_chk_on);
			}
			
			if($num_chk_on > 0){ // ถ้ามีเลขลำดับซ้ำกัน
				$sql_update_on = "SELECT METRICS.ID,METRICS.METRICS_ON
								  FROM MDS_SET_METRICS METRICS
								  LEFT JOIN MDS_SET_INDICATOR INDICATOR ON METRICS.MDS_SET_INDICATOR_ID = INDICATOR.ID
								  WHERE INDICATOR.BUDGET_YEAR = '".@$_POST['budget_year']."' AND METRICS.PARENT_ID = '".@$_POST['parent_id']."' 
								  AND METRICS.METRICS_ON >= '".@$_POST['metrics_on']."' ORDER BY METRICS.METRICS_ON ASC ";
				$result_on = $this->metrics->get($sql_update_on);
				foreach ($result_on as $key => $result) {
					$update_on['id'] = $result['id'];
					$update_on['metrics_on'] = $result['metrics_on']+1;
					$this->metrics->save($update_on);
				}
			}
			
			$id = $this->metrics->save($_POST);
			
			if($_POST['metrics_responsible'] == 'Y'){
				$kpr_6['id'] = @$_POST['kpr_id_6'];
				$kpr_9['id'] = @$_POST['kpr_id_9'];
				$kpr_12['id'] = @$_POST['kpr_id_12'];
				
				if(@$_POST['metrics_start'] == 6){ // เรื่มที่รอบ 6 เดือน
					
					$kpr_6['kpr_users_id'] = $_POST['kpr_6'];
					if(@$_POST['kpr_permission_id_6'] == ''){
						$kpr_6['kpr_permission_id'] = chk_permission_id($_POST['kpr_6']);
					}else{
						$kpr_6['kpr_permission_id'] = @$_POST['kpr_permission_id_6'];
					}
					
					$kpr_6['control_users_id'] = $_POST['control_6'];
					if(@$_POST['control_permission_id_6'] == ''){
						$kpr_6['control_permission_id'] = chk_permission_id($_POST['control_6']);
					}else{
						$kpr_6['control_permission_id'] = @$_POST['control_permission_id_6'];
					}
					$kpr_6['round_month'] = '6';
					$kpr_6['mds_set_metrics_id'] = $id;
					$kpr_6_id = $this->kpr->save($kpr_6);
				
					$this->keyer->where("round_month = '6' and mds_set_metrics_id = '".$id."'")->delete();
					for($i=1; $i <= @$_POST['keyer_num_6'] ; $i++) { 
						$keyer_6['keyer_users_id'] = @$_POST['keyer_6'][$i];
						if(@$_POST['keyer_permission_id_6'][$i] == ''){
						    $keyer_6['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_6'][$i]);
						}else{
							$keyer_6['keyer_permission_id'] = @$_POST['keyer_permission_id_6'][$i];
						}
						// ผู้บันทึกคะแนน
						if(@$_POST['keyer_score_6']['0'] == $i){
							$keyer_6['keyer_score'] = '1';
						}else{
							$keyer_6['keyer_score'] = '0';
						}
						
						$keyer_6['activity'] = @$_POST['activity_6'][$i];
						$keyer_6['round_month'] = '6';
						$keyer_6['mds_set_metrics_id'] = $id;
						if(@$keyer_6['keyer_users_id'] != ''){
							$this->keyer->save($keyer_6);
						}
						
					}
				
					if(@$_POST['sem_9'] == 6){ // เรื่มที่รอบ 6 เดือนกรณี ผู้รับผิดชอบรอบ 9 เดือนเหมือนรอบ 6 เดือน
						$kpr_9['kpr_users_id'] = $_POST['kpr_6'];
						if(@$_POST['kpr_permission_id_6'] == ''){
							$kpr_9['kpr_permission_id'] = chk_permission_id($_POST['kpr_6']);
						}else{
							$kpr_9['kpr_permission_id'] = @$_POST['kpr_permission_id_6'];
						}
						
						$kpr_9['control_users_id'] = $_POST['control_6'];
						if(@$_POST['control_permission_id_6'] == ''){
							$kpr_9['control_permission_id'] = chk_permission_id($_POST['control_6']);
						}else{
							$kpr_9['control_permission_id'] = @$_POST['control_permission_id_6'];
						}

						$kpr_9['round_month'] = '9';
						$kpr_9['mds_set_metrics_id'] = $id;
						$kpr_9_id = $this->kpr->save($kpr_9);
						
						$this->keyer->where("round_month = '9' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_6'] ; $i++) { 
							$keyer_9['keyer_users_id'] = @$_POST['keyer_6'][$i];
							if(@$_POST['keyer_permission_id_6'][$i] == ''){
								$keyer_9['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_6'][$i]);
							}else{
								$keyer_9['keyer_permission_id'] = @$_POST['keyer_permission_id_6'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_6']['0'] == $i){
								$keyer_9['keyer_score'] = '1';
							}else{
								$keyer_9['keyer_score'] = '0';
							}
							
							$keyer_9['activity'] = @$_POST['activity_6'][$i];
							$keyer_9['round_month'] = '9';
							$keyer_9['mds_set_metrics_id'] = $id;
							if(@$keyer_9['keyer_users_id'] != ''){
								$this->keyer->save($keyer_9);
							}	
						}
						
					}else{ // เรื่มที่รอบ 6 เดือนกรณี ผู้รับผิดชอบรอบ 9 เดือน เปลี่ยนผู้ดูแลตัวชี้วัด
						$kpr_9['kpr_users_id'] = $_POST['kpr_9'];
						if(@$_POST['kpr_permission_id_9'] == ''){
							$kpr_9['kpr_permission_id'] = chk_permission_id($_POST['kpr_9']);
						}else{
							$kpr_9['kpr_permission_id'] = @$_POST['kpr_permission_id_9'];
						}
						
						$kpr_9['control_users_id'] = $_POST['control_9'];
						if(@$_POST['control_permission_id_9'] == ''){
							$kpr_9['control_permission_id'] = chk_permission_id($_POST['control_9']);
						}else{
							$kpr_9['control_permission_id'] = @$_POST['control_permission_id_9'];
						}

						$kpr_9['round_month'] = '9';
						$kpr_9['mds_set_metrics_id'] = $id;
						$kpr_9_id = $this->kpr->save($kpr_9);
						
						$this->keyer->where("round_month = '9' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_9'] ; $i++) { 
							$keyer_9['keyer_users_id'] = @$_POST['keyer_9'][$i];
							if(@$_POST['keyer_permission_id_9'][$i] == ''){
								$keyer_9['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_9'][$i]);
							}else{
								$keyer_9['keyer_permission_id'] = @$_POST['keyer_permission_id_9'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_9']['0'] == $i){
								$keyer_9['keyer_score'] = '1';
							}else{
								$keyer_9['keyer_score'] = '0';
							}
							
							$keyer_9['activity'] = @$_POST['activity_9'][$i];
							$keyer_9['round_month'] = '9';
							$keyer_9['mds_set_metrics_id'] = $id;
							if(@$keyer_9['keyer_users_id'] != ''){
								$this->keyer->save($keyer_9);
							}	
						}
					}
					
					if(@$_POST['sem_12'] == 6 || (@$_POST['sem_12'] == 9 && @$_POST['sem_9'] == 6)){
						 // เรื่มที่รอบ 6 เดือน กรณี ผู้รับผิดชอบรอบ 12 เดือน เหมือนรอบ 9 เดือน และ รอบ 9 เดือน เหมือนรอบ 6 เดือน
						 
						$kpr_12['kpr_users_id'] = $_POST['kpr_6'];
						if(@$_POST['kpr_permission_id_6'] == ''){
							$kpr_12['kpr_permission_id'] = chk_permission_id($_POST['kpr_6']);
						}else{
							$kpr_12['kpr_permission_id'] = @$_POST['kpr_permission_id_6'];
						}

						$kpr_12['control_users_id'] = $_POST['control_6'];
						if(@$_POST['control_permission_id_6'] == ''){
							$kpr_12['control_permission_id'] = chk_permission_id($_POST['control_6']);
						}else{
							$kpr_12['control_permission_id'] = @$_POST['control_permission_id_6'];
						}
						
						$kpr_12['round_month'] = '12';
						$kpr_12['mds_set_metrics_id'] = $id;
						$kpr_12_id = $this->kpr->save($kpr_12);
						
						$this->keyer->where("round_month = '12' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_6'] ; $i++) { 
							$keyer_12['keyer_users_id'] = @$_POST['keyer_6'][$i];
							if(@$_POST['keyer_permission_id_6'][$i] == ''){
								$keyer_12['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_6'][$i]);
							}else{
								$keyer_12['keyer_permission_id'] = @$_POST['keyer_permission_id_6'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_6']['0'] == $i){
								$keyer_12['keyer_score'] = '1';
							}else{
								$keyer_12['keyer_score'] = '0';
							}

							$keyer_12['activity'] = @$_POST['activity_6'][$i];
							$keyer_12['round_month'] = '12';
							$keyer_12['mds_set_metrics_id'] = $id;
							if(@$keyer_12['keyer_users_id'] != ''){
								$this->keyer->save($keyer_12);
							}	
						}
						
					}else if(@$_POST['sem_12'] == 9 && @$_POST['sem_9'] == 9){
						 // เรื่มที่รอบ 6 เดือน กรณี ผู้รับผิดชอบรอบ 12 เดือน เหมือนรอบ 9 เดือน และ รอบ 9 เดือน เปลี่ยนผู้รับผิดชอบ
						 
						$kpr_12['kpr_users_id'] = $_POST['kpr_9'];
						if(@$_POST['kpr_permission_id_9'] == ''){
							$kpr_12['kpr_permission_id'] = chk_permission_id($_POST['kpr_9']);
						}else{
							$kpr_12['kpr_permission_id'] = @$_POST['kpr_permission_id_9'];
						}
						
						$kpr_12['control_users_id'] = $_POST['control_9'];
						if(@$_POST['control_permission_id_9'] == ''){
							$kpr_12['control_permission_id'] = chk_permission_id($_POST['control_9']);
						}else{
							$kpr_12['control_permission_id'] = @$_POST['control_permission_id_9'];
						}
						
						$kpr_12['round_month'] = '12';
						$kpr_12['mds_set_metrics_id'] = $id;
						$kpr_12_id = $this->kpr->save($kpr_12);
						
						$this->keyer->where("round_month = '12' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_9'] ; $i++) { 
							$keyer_12['keyer_users_id'] = @$_POST['keyer_9'][$i];
							if(@$_POST['keyer_permission_id_9'][$i] == ''){
								$keyer_12['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_9'][$i]);
							}else{
								$keyer_12['keyer_permission_id'] = @$_POST['keyer_permission_id_9'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_9']['0'] == $i){
								$keyer_12['keyer_score'] = '1';
							}else{
								$keyer_12['keyer_score'] = '0';
							}

							$keyer_12['activity'] = @$_POST['activity_9'][$i];
							$keyer_12['round_month'] = '12';
							$keyer_12['mds_set_metrics_id'] = $id;
							if(@$keyer_12['keyer_users_id'] != ''){
								$this->keyer->save($keyer_12);
							}	
						}
						
					}else{
						// เรื่มที่รอบ 6 เดือน กรณี ผู้รับผิดชอบรอบ 12 เดือน มีผู้รับผิดชอบ ไม่เหมือนรอบ 9 เดือน และ 6 เดือน
						
						$kpr_12['kpr_users_id'] = $_POST['kpr_12'];
						if(@$_POST['kpr_permission_id_12'] == ''){
							$kpr_12['kpr_permission_id'] = chk_permission_id($_POST['kpr_12']);
						}else{
							$kpr_12['kpr_permission_id'] = @$_POST['kpr_permission_id_12'];
						}
						
						$kpr_12['control_users_id'] = $_POST['control_12'];
						if(@$_POST['control_permission_id_12'] == ''){
							$kpr_12['control_permission_id'] = chk_permission_id($_POST['control_12']);
						}else{
							$kpr_12['control_permission_id'] = @$_POST['control_permission_id_12'];
						}
						
						$kpr_12['round_month'] = '12';
						$kpr_12['mds_set_metrics_id'] = $id;
						$kpr_12_id = $this->kpr->save($kpr_12);
						
						$this->keyer->where("round_month = '12' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_12'] ; $i++) { 
							$keyer_12['keyer_users_id'] = @$_POST['keyer_12'][$i];
							if(@$_POST['keyer_permission_id_12'][$i] == ''){
								$keyer_12['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_12'][$i]);
							}else{
								$keyer_12['keyer_permission_id'] = @$_POST['keyer_permission_id_12'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_12']['0'] == $i){
								$keyer_12['keyer_score'] = '1';
							}else{
								$keyer_12['keyer_score'] = '0';
							}
							
							$keyer_12['activity'] = @$_POST['activity_12'][$i];
							$keyer_12['round_month'] = '12';
							$keyer_12['mds_set_metrics_id'] = $id;
							if(@$keyer_12['keyer_users_id'] != ''){
								$this->keyer->save($keyer_12);
							}	
						}
					}
				}else if(@$_POST['metrics_start'] == 9){
					// เริ่มรอบ 9 เดือน
					
					if(@$_POST['sem_9'] == 9){
						$kpr_9['kpr_users_id'] = $_POST['kpr_9'];
						if(@$_POST['kpr_permission_id_9'] == ''){
							$kpr_9['kpr_permission_id'] = chk_permission_id($_POST['kpr_9']);
						}else{
							$kpr_9['kpr_permission_id'] = @$_POST['kpr_permission_id_9'];
						}
						
						$kpr_9['control_users_id'] = $_POST['control_9'];
						if(@$_POST['control_permission_id_9'] == ''){
							$kpr_9['control_permission_id'] = chk_permission_id($_POST['control_9']);
						}else{
							$kpr_9['control_permission_id'] = @$_POST['control_permission_id_9'];
						}

						$kpr_9['round_month'] = '9';
						$kpr_9['mds_set_metrics_id'] = $id;
						$kpr_9_id = $this->kpr->save($kpr_9);
						
						$this->keyer->where("round_month = '9' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_9'] ; $i++) { 
							$keyer_9['keyer_users_id'] = @$_POST['keyer_9'][$i];
							if(@$_POST['keyer_permission_id_9'][$i] == ''){
								$keyer_9['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_9'][$i]);
							}else{
								$keyer_9['keyer_permission_id'] = @$_POST['keyer_permission_id_9'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_9']['0'] == $i){
								$keyer_9['keyer_score'] = '1';
							}else{
								$keyer_9['keyer_score'] = '0';
							}

							$keyer_9['activity'] = @$_POST['activity_9'][$i];
							$keyer_9['round_month'] = '9';
							$keyer_9['mds_set_metrics_id'] = $id;
							if(@$keyer_9['keyer_users_id'] != ''){
								$this->keyer->save($keyer_9);
							}	
						}
					}
					
					if(@$_POST['sem_12'] == 9 && @$_POST['sem_9'] == 9){
						// เริ่มที่รอบ 9  เดือน กรณีผู้รับผิดสอบรอบ 12 เดือน เหมือน 9 เดือน
						
						$kpr_12['kpr_users_id'] = $_POST['kpr_9'];
						if(@$_POST['kpr_permission_id_9'] == ''){
							$kpr_12['kpr_permission_id'] = chk_permission_id($_POST['kpr_9']);
						}else{
							$kpr_12['kpr_permission_id'] = @$_POST['kpr_permission_id_9'];
						}
						
						$kpr_12['control_users_id'] = $_POST['control_9'];
						if(@$_POST['control_permission_id_9'] == ''){
							$kpr_12['control_permission_id'] = chk_permission_id($_POST['control_9']);
						}else{
							$kpr_12['control_permission_id'] = @$_POST['control_permission_id_9'];
						}
						
						$kpr_12['round_month'] = '12';
						$kpr_12['mds_set_metrics_id'] = $id;
						$kpr_12_id = $this->kpr->save($kpr_12);
						
						$this->keyer->where("round_month = '12' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_9'] ; $i++) { 
							$keyer_12['keyer_users_id'] = @$_POST['keyer_9'][$i];
							if(@$_POST['keyer_permission_id_9'][$i] == ''){
								$keyer_12['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_9'][$i]);
							}else{
								$keyer_12['keyer_permission_id'] = @$_POST['keyer_permission_id_9'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_9']['0'] == $i){
								$keyer_12['keyer_score'] = '1';
							}else{
								$keyer_12['keyer_score'] = '0';
							}

							$keyer_12['activity'] = @$_POST['activity_9'][$i];
							$keyer_12['round_month'] = '12';
							$keyer_12['mds_set_metrics_id'] = $id;
							if(@$keyer_12['keyer_users_id'] != ''){
								$this->keyer->save($keyer_12);
							}	
						}
						
					}else{
						// เริ่มรอบ 9 เดือน กรณี รอบ 12 เดือน ผู้รับผิดชอบไม่เหมือน รอบ 9 เดือน
						
						$kpr_12['kpr_users_id'] = $_POST['kpr_12'];
						if(@$_POST['kpr_permission_id_12'] == ''){
							$kpr_12['kpr_permission_id'] = chk_permission_id($_POST['kpr_12']);
						}else{
							$kpr_12['kpr_permission_id'] = @$_POST['kpr_permission_id_12'];
						}

						$kpr_12['control_users_id'] = $_POST['control_12'];
						if(@$_POST['control_permission_id_12'] == ''){
							$kpr_12['control_permission_id'] = chk_permission_id($_POST['control_12']);
						}else{
							$kpr_12['control_permission_id'] = @$_POST['control_permission_id_12'];
						}

						$kpr_12['round_month'] = '12';
						$kpr_12['mds_set_metrics_id'] = $id;
						$kpr_12_id = $this->kpr->save($kpr_12);
						
						$this->keyer->where("round_month = '12' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_12'] ; $i++) { 
							$keyer_12['keyer_users_id'] = @$_POST['keyer_12'][$i];
							if(@$_POST['keyer_permission_id_12'][$i] == ''){
								$keyer_12['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_12'][$i]);
							}else{
								$keyer_12['keyer_permission_id'] = @$_POST['keyer_permission_id_12'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_12']['0'] == $i){
								$keyer_12['keyer_score'] = '1';
							}else{
								$keyer_12['keyer_score'] = '0';
							}

							$keyer_12['activity'] = @$_POST['activity_12'][$i];
							$keyer_12['round_month'] = '12';
							$keyer_12['mds_set_metrics_id'] = $id;
							if(@$keyer_12['keyer_users_id'] != ''){
								$this->keyer->save($keyer_12);
							}	
						}
					}
				}else{
					// เริ่มรอบ 12 เดือน
					
						$kpr_12['kpr_users_id'] = $_POST['kpr_12'];
						if(@$_POST['kpr_permission_id_12'] == ''){
							$kpr_12['kpr_permission_id'] = chk_permission_id($_POST['kpr_12']);
						}else{
							$kpr_12['kpr_permission_id'] = @$_POST['kpr_permission_id_12'];
						}
						
						$kpr_12['control_users_id'] = $_POST['control_12'];
						if(@$_POST['control_permission_id_12'] == ''){
							$kpr_12['control_permission_id'] = chk_permission_id($_POST['control_12']);
						}else{
							$kpr_12['control_permission_id'] = @$_POST['control_permission_id_12'];
						}

						$kpr_12['round_month'] = '12';
						$kpr_12['mds_set_metrics_id'] = $id;
						$kpr_12_id = $this->kpr->save($kpr_12);
						
						$this->keyer->where("round_month = '12' and mds_set_metrics_id = '".$id."'")->delete();
						for($i=1; $i <= @$_POST['keyer_num_12'] ; $i++) { 
							$keyer_12['keyer_users_id'] = @$_POST['keyer_12'][$i];
							if(@$_POST['keyer_permission_id_12'][$i] == ''){
								$keyer_12['keyer_permission_id'] = chk_permission_id(@$_POST['keyer_12'][$i]);
							}else{
								$keyer_12['keyer_permission_id'] = @$_POST['keyer_permission_id_12'][$i];
							}
							
							// ผู้บันทึกคะแนน
							if(@$_POST['keyer_score_12']['0'] == $i){
								$keyer_12['keyer_score'] = '1';
							}else{
								$keyer_12['keyer_score'] = '0';
							}

							$keyer_12['activity'] = @$_POST['activity_12'][$i];
							$keyer_12['round_month'] = '12';
							$keyer_12['mds_set_metrics_id'] = $id;
							if(@$keyer_12['keyer_users_id'] != ''){
								$this->keyer->save($keyer_12);
							}	
						}	
					}
					
				
			}
		   if($_POST['id']>0){
		    
		   	new_save_logfile("EDIT",$this->modules_title_2,$this->metrics->table,"ID",$id,"metrics_name",$this->modules_name);
		   }else{
		   	
		   	new_save_logfile("ADD",$this->modules_title_2,$this->metrics->table,"ID",$id,"metrics_name",$this->modules_name);
		   }
		   
		   
		   set_notify('success', lang('save_data_complete'));	  
		}
		redirect($urlpage.'/index?sch_budget_year='.@$_POST['budget_year']);

	}
	
	
	function delete($budget_year = null,$ID=FALSE){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		$chk_metrics = $this->metrics->get("select * from mds_set_metrics where mds_set_indicator_id = '".$ID."' ");
		$num_chk = count($chk_metrics);
		if($num_chk == 0){
			new_save_logfile("DELETE",$this->modules_title,$this->indicator->table,"ID",$ID,"ass_name",$this->modules_name);					
			$this->indicator->delete($ID);
			set_notify('error', 'ลบข้อมูลเสร็จสิน');	
		}else{
			set_notify('error', 'ไม่สามารถลบข้อมูลได้เนื่องจากมีตัวชี้วัดในมิตินี้');	
		}	
		redirect($urlpage.'/index?sch_budget_year='.@$budget_year);
	}
	function delete_metrics($budget_year = null,$ID=FALSE){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		$chk_metrics = $this->metrics->get("select * from mds_set_metrics where parent_id = '".$id."' ");
		$num_chk = count($chk_metrics);
		if($num_chk == 0){
			$chk_metrics_result = $this->metrics_result->get("select * from mds_set_metrics_result where mds_set_metrics_id = '".$id."' ");
			$num_chk_result = count($chk_metrics_result);
			if($num_chk_result == 0){
				new_save_logfile("DELETE",$this->modules_title_2,$this->metrics->table,"ID",$ID,"ass_name",$this->modules_name);					
				
				$this->kpr->where("mds_set_metrics_id = '".$ID."' ")->delete($ID); // ลบ กพร. ตัวชี้วัดภายใต้  id นี้
				$this->keyer->where("mds_set_metrics_id = '".$ID."' ")->delete($ID); // ลบ ผู็จัดเก็บข้อมูล. ตัวชี้วัดภายใต้  id นี้
				$this->metrics->delete($ID);
				set_notify('error', 'ลบข้อมูลเสร็จสิน');	
			}else{
				set_notify('error', 'ไม่สามารถลบข้อมูลได้เนื่องจากมีตัวชี้นี้มีการบันทึกผลปฎิบัตราชการแล้ว');	
			}
		}else{
			set_notify('error', 'ไม่สามารถลบข้อมูลได้เนื่องจากมีตัวชี้วัดย่อยภายใต้ตัวชี้วัดนี้');	
		}	
		redirect($urlpage.'/index?sch_budget_year='.@$budget_year);
	}
	
	function chain_indicator()
	{
		if(!empty($_GET['sch_budget_year']))
			{	$qry = "SELECT ID, INDICATOR_NAME  AS TEXT,INDICATOR_ON FROM MDS_SET_INDICATOR WHERE BUDGET_YEAR = '".$_GET['sch_budget_year']."'";
				$course = $this->indicator->get($qry);
				
				$rs = '<option value=\'\'>-- เลือกชื่อมิติ --</option>';
				foreach($course as $tmp){
					$selected = '';
					if(@$_GET['sch_indicator_id'] == $tmp['id']){
						$selected=' selected="selected"';
					}
					 $rs .= "<option value='".$tmp['id']."' ".$selected.">"."มิติที่ ".$tmp['indicator_on']." : ".$tmp['text']."</option>"; 
				}
				 
			} else {
				$rs = '<option value=\'\'>-- เลือกชื่อมิติ --</option';
			}
		echo $rs;
	}
	function check_indicator_on(){
		if(@$_GET['indicator_on'] != '' && @$_GET['budget_year'] != ''){
			$sql = "select * 
					from mds_set_indicator 
					where indicator_on = '".@$_GET['indicator_on']."' 
					and budget_year = '".@$_GET['budget_year']."' ";
			$chk = $this->indicator->get($sql);
			$num_row = count($chk);
			if($num_row > 0){
				if($chk['0']['id'] == @$_GET['id']){
					echo 'true';
				}else{
					echo 'false';	
				}	
			}else{
				echo 'true';
			}
		}else{
			echo 'true';
		}
		
	}
	function check_indicator_name(){
		if(@$_GET['indicator_name'] != '' && @$_GET['budget_year'] != ''){
			$sql = "select * 
					from mds_set_indicator 
					where indicator_name = '".@$_GET['indicator_name']."' 
					and budget_year = '".@$_GET['budget_year']."' ";
			$chk = $this->indicator->get($sql);
			$num_row = count($chk);
			if($num_row > 0){
				if($chk['0']['id'] == @$_GET['id']){
					echo 'true';
				}else{
					echo 'false';	
				}		
			}else{
				echo 'true';
			}
		}else{
			echo 'true';
		}
		
	}
	
	function add_keyer(){
		$data['month'] = @$_GET['month'];
		$data['num'] = @$_GET['num'];
		$this->load->view('mds_set_indicator/_keyer',@$data);
	}
	
	function move_metrics(){
		$urlpage = $this->urlpage;
		$id = @$_GET['id'];
		$parent_id = @$_GET['parent_id'];
		$indicator_id = @$_GET['indicator_id'];
		$metrics_on = @$_GET['metrics_on'];
		$act = @$_GET['act'];
		$budget_year = @$_GET['year'];
	
		if(@$id != '' && @$indicator_id != '' && $parent_id != '' && $metrics_on != '' && $act=="down"){ // ตรวจสอบว่ามีเลขลำดับซ้ำกันหรือไม่
				$chk_metrics_on = "SELECT METRICS.ID,METRICS.METRICS_ON
							  FROM MDS_SET_METRICS METRICS
							  LEFT JOIN MDS_SET_INDICATOR INDICATOR ON METRICS.MDS_SET_INDICATOR_ID = INDICATOR.ID
							  WHERE METRICS.PARENT_ID = '".@$parent_id."' AND INDICATOR.ID = '".$indicator_id."'
							  AND METRICS.METRICS_ON = '".@$metrics_on."' AND METRICS.ID != '".$id."' 
							  ORDER BY METRICS.METRICS_ON ASC ";
				$result_chk_on = $this->metrics->get($chk_metrics_on);
				$num_chk_on = count($result_chk_on);
				
				if($num_chk_on > 0){ // ถ้ามีเลขลำดับซ้ำกัน
				save_logfile("EDIT","แก้ไขลำดับตัวชี้วัด ID :".$id,$this->modules_name);	
					foreach ($result_chk_on as $key => $result) {
						$update_on['id'] = $result['id'];
						$update_on['metrics_on'] = $result['metrics_on']-1;
						$this->metrics->save($update_on);
						
						$update_this['id'] = $id;
						$update_this['metrics_on'] = $metrics_on;
						$this->metrics->save($update_this);
					}
				}else{
					set_notify('error', 'ไม่สามารถเปลี่ยนลำดับตัวชี้วัดได้');
				}
		}else if(@$id != '' && @$indicator_id != '' && $parent_id != '' && $metrics_on != '' && $act=="up"){
			 echo $chk_metrics_on = "SELECT METRICS.ID,METRICS.METRICS_ON
							  FROM MDS_SET_METRICS METRICS
							  LEFT JOIN MDS_SET_INDICATOR INDICATOR ON METRICS.MDS_SET_INDICATOR_ID = INDICATOR.ID
							  WHERE METRICS.PARENT_ID = '".@$parent_id."' AND INDICATOR.ID = '".$indicator_id."'
							  AND METRICS.METRICS_ON = '".@$metrics_on."' AND METRICS.ID != '".$id."' 
							  ORDER BY METRICS.METRICS_ON ASC ";
				$result_chk_on = $this->metrics->get($chk_metrics_on);
				$num_chk_on = count($result_chk_on);
				
				if($num_chk_on > 0){ // ถ้ามีเลขลำดับซ้ำกัน
				save_logfile("EDIT","แก้ไขลำดับตัวชี้วัด ID :".$id,$this->modules_name);	
					foreach ($result_chk_on as $key => $result) {
						$update_on['id'] = $result['id'];
						$update_on['metrics_on'] = $result['metrics_on']+1;
						$this->metrics->save($update_on);
						
						$update_this['id'] = $id;
						$update_this['metrics_on'] = $metrics_on;
						$this->metrics->save($update_this);
					}
				}else{
					set_notify('error', 'ไม่สามารถเปลี่ยนลำดับตัวชี้วัดได้');
				}
		}

		redirect($urlpage.'/index?sch_budget_year='.@$budget_year);
	}
}
?>