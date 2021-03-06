<?php
Class Mds_indicator extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/mds_set_metrics_model','metrics');
		$this->load->model('mds_set_indicator/mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/mds_set_metrics_keyer_model','keyer');
		$this->load->model('mds_indicator/mds_metrics_result_model','metrics_result');
		$this->load->model('mds_indicator/mds_metrics_document_model','doc');
		$this->load->model('mds_indicator/mds_metrics_result_status_model','result_status');
		$this->load->model('mds_indicator/mds_status_topic_model','status_topic');
	}
	
	public $urlpage = "mds_indicator";
	public $modules_name = "mds_indicator";
	public $modules_title = " บันทึก ตัวชี้วัด";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id'),'1');
		if($premit == ''){
			$premit_2 = is_permit(login_data('id'),'3');
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		
		
		$condition = " 1=1 ";
		$condition_join = '';
		if(@$_GET['sch_budget_year'] != ''){
			$condition .= " and indicator.budget_year = '".@$_GET['sch_budget_year']."' ";
		}
		if(@$_GET['sch_indicatorn'] != ''){
			$condition .=" and indicator.id = '".@$_GET['sch_indicatorn']."' ";
		}
		if(@$_GET['sch_metrics_name'] != ''){
			$condition .=" and metrics.metrics_name like '%".@$_GET['sch_metrics_name']."%' ";
		}	
		
		
		 $sql = "select distinct metrics.*,assessment.ass_name
				from mds_set_metrics metrics
				inner join mds_set_indicator indicator on metrics.mds_set_indicator_id = indicator.id
				left join mds_set_assessment assessment on metrics.mds_set_assessment_id = assessment.id
				where $condition and metrics.metrics_responsible = 'Y' ";
				
		if(@$_GET['sch_metrics_name'] != ''){
			$sql .= "order by  metrics.id asc";
		}else{
			$sql .= "and metrics.parent_id = '0' order by  metrics.metrics_on asc";
		}
		$data['rs'] = $this->metrics->get($sql,'true');
		
		
		$this->template->build('index',@$data);

	}
	
	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id'),'1');
		if($premit == ''){
			$premit_2 = is_permit(login_data('id'),'3');
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		if($id != ''){
			
				$sql_result = "select distinct result.*,mds_set_metrics_keyer.keyer_name ,mds_set_metrics_keyer.keyer_tel,mds_set_metrics_keyer.keyer_email 
								from mds_metrics_result result 
								left join mds_set_metrics_keyer on result.mds_set_metrics_id = mds_set_metrics_keyer.mds_set_metrics_id 
																and result.round_month = mds_set_metrics_keyer.round_month and result.keyer_users_id = mds_set_metrics_keyer.keyer_users_id 
								where result.mds_set_metrics_id = '".$id."' order by result.round_month asc ";
									
				$data['rs'] = $this->metrics_result->get($sql_result);
			
				
			$data['rs_metrics'] = $this->metrics->get_row($id);
				if($premit == "")
				{
				  $chk_keyer_indicator = chk_keyer_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id']);
				  if($chk_keyer_indicator != 'Y'){
				  	set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");
				  }	
				}
			
			
			$data['parent_on'] = '';
			$parent_on_id = $data['rs_metrics']['id'];
			if(@$data['rs_metrics']['parent_id'] != '0'){
				for ($i=1; $i <= 8 ; $i++) {
					
					$parent_on = '';
					$parent_on = $this->metrics->get_row($parent_on_id);
					$parent_on_id = $parent_on['parent_id'];
					
					
					if($data['parent_on'] != ''){
						$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
					}else{
						$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
					}
					if($parent_on['parent_id'] == '0'){
						$i = 9;
					}
					
				}
			}else{
				$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
			}
			
			$data['rs_indicator'] = $this->indicator->get_row($data['rs_metrics']['mds_set_indicator_id']);
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
			redirect($data['urlpage'].'/index/');
		}
			
		$this->template->build('form',@$data);

	}

	
	function form_2($metrics_id=null,$result_id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id'),'1');
		if($premit == ''){
			$premit_2 = is_permit(login_data('id'),'3');
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		
		
		
		if($result_id == '' && $metrics_id != ''){
			
			$data['rs_metrics'] = $this->metrics->get_row($metrics_id);
				if($metrics_id != ''){
					$chk_round_month = chk_result_round_month(login_data('id'),$metrics_id,@$data['rs_metrics']['metrics_start']);
					if(@$chk_round_month['error'] != ''){
						set_notify('error', $chk_round_month['error']);
						redirect($data['urlpage'].'/form/'.@$metrics_id);
					}
				}
				  $data['round_month'] = $chk_round_month['round_month']; //รอบการส่งประเมิน
				  //return false;
				  $chk_keyer_indicator = chk_keyer_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id'],$data['round_month']);
				  if($chk_keyer_indicator != 'Y'){
				  	set_notify('error', 'ท่านไม่มีสิทธิ์ในบันทึกตัวชี้วัดรอบ '.$data['round_month'].' เดือน'); 
				  	redirect($data['urlpage'].'/form/'.$metrics_id);
				  }	
				
				if(@$data['rs_metrics']['metrics_cancel'] != ''){

					if($data['round_month'] >= @$data['rs_metrics']['metrics_cancel']){
						set_notify('error', 'ท่านไม่บันทึกตัวชี้วัดในรอบถัดไป เนื่องจากมีการยกเลิกตัวชี้วัดแล้ว'); 
				  		redirect($data['urlpage'].'/form/'.$metrics_id);
					}
				}
				
				
				$data['parent_on'] = '';
				$parent_on_id = $data['rs_metrics']['id'];
				if(@$data['rs_metrics']['parent_id'] != '0'){
					for ($i=1; $i <= 8 ; $i++) {
						
						$parent_on = '';
						$parent_on = $this->metrics->get_row($parent_on_id);
						$parent_on_id = $parent_on['parent_id'];
						
						
						if($data['parent_on'] != ''){
							$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
						}else{
							$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
						}
						if($parent_on['parent_id'] == '0'){
							$i = 9;
						}
						
					}
				}else{
					$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
				}
				$data['rs_indicator'] = $this->indicator->get_row($data['rs_metrics']['mds_set_indicator_id']);
				
					
				// หา น้ำหนักของทั้งมิติ //
				$data['weight_perc_tot'] = indicator_all_weight($data['rs_indicator']['budget_year'],$data['round_month']);
				// หา น้ำหนักของทั้งมิติ //
				
				$chk_kpr = "select mds_set_metrics_kpr.*,
							mds_set_position.pos_name , cnf_division.title , cnf_department.title as department_name 
							from mds_set_metrics_kpr 
							left join mds_set_position on mds_set_metrics_kpr.control_position_id = mds_set_position.id 
							left join cnf_division on mds_set_metrics_kpr.control_division_id = cnf_division.id 
							left join cnf_department on mds_set_metrics_kpr.control_department_id = cnf_department.id 
							where mds_set_metrics_kpr.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_kpr.round_month = '".@$data['round_month']."'";
				$result_kpr = $this->kpr->get($chk_kpr);
				$data['kpr'] = @$result_kpr['0'];
				//$this->db->debug =true;
				$chk_keyer = "select mds_set_metrics_keyer.*
								from mds_set_metrics_keyer 
								where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."'";
				$data['keyer'] = $this->keyer->get($chk_keyer);
				
				// เช็คว่ามีการแต่งตั้งผู้จักเก็บแทนหรือไหม
				foreach ($data['keyer'] as $key => $chk_change_keyer) {
					if(@$chk_change_keyer['change_keyer_users_id'] != '0' && @$chk_change_keyer['change_keyer_users_id'] != '' && @$chk_change_keyer['keyer_users_id'] == login_data('id')){
						set_notify('error', 'ไม่สามารถเข้าแก้ไขข้อมูลได้เนื่องจากมีผู้จัดเก็บข้อมูลแทน ท่านแล้ว');
						redirect($data['urlpage'].'/form/'.@$metrics_id);
					}
				}
				
				
				// หาคะแนนขอผู้บันทึกคะแนน
				$chk_keyer_score = "select mds_set_metrics_keyer.*,mds_metrics_result.score_metrics
									from mds_set_metrics_keyer 
									join mds_metrics_result on mds_set_metrics_keyer.mds_set_metrics_id = mds_metrics_result.mds_set_metrics_id 
																					and mds_metrics_result.round_month = mds_set_metrics_keyer.round_month
																					and mds_metrics_result.keyer_users_id = mds_set_metrics_keyer.keyer_users_id
									where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' 
										  and mds_set_metrics_keyer.keyer_score = '1'";
				$data['score'] = $this->keyer->get($chk_keyer_score);
				$data['score'] = @$data['score']['0'];
				
				$chk_keyer_activity = "select mds_set_metrics_keyer.*
										from mds_set_metrics_keyer 
										where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' 
										and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' 
										and ( mds_set_metrics_keyer.keyer_users_id = '".login_data('id')."' or mds_set_metrics_keyer.change_keyer_users_id = '".login_data('id')."' )";
				//$result_keyer_activity = $this->keyer->get($chk_keyer_activity);
				$result_keyer_activity = $this->db->getrow($chk_keyer_activity); 
				dbConvert($result_keyer_activity);
				
				$data['keyer_activity'] = @$result_keyer_activity;
				
				$data['rs']['keyer_users_id'] = @$data['keyer_activity']['keyer_users_id'];
		}else if($result_id != '' && $metrics_id != ''){
				$data['rs_metrics'] = $this->metrics->get_row($metrics_id);
				if($premit == ''){
				  $chk_keyer_indicator = chk_keyer_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id']);
				  if($chk_keyer_indicator != 'Y'){
				  	et_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");
				  }	
				}
				
				  $data['rs'] = $this->metrics_result->get_row($result_id);
					if($data['rs']['id'] == ''){
						set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
						redirect($data['urlpage'].'/form/'.@$metrics_id);
					} 
				save_logfile("VIEW","ดูรายละเอียด  ".$this->modules_title." ID : ".$result_id." รอบ ".$data['rs']['round_month']." ผู้บันทึก ".get_one('name', 'users','id',$data['rs']['keyer_users_id']),$this->modules_name);
				$data['parent_on'] = '';
				
				if(@$data['rs_metrics']['metrics_cancel'] != ''){
					if($data['rs']['round_month'] >= @$data['rs_metrics']['metrics_cancel']){
						set_notify('error', 'ท่านไม่บันทึกตัวชี้วัดในรอบถัดไปได้ เนื่องจากมีการยกเลิกตัวชี้วัดแล้ว'); 
				  		redirect($data['urlpage'].'/form/'.$metrics_id);
					}
				}
				
				$parent_on_id = $data['rs_metrics']['id'];
				if(@$data['rs_metrics']['parent_id'] != '0'){
					for ($i=1; $i <= 8 ; $i++) {
						
						$parent_on = '';
						$parent_on = $this->metrics->get_row($parent_on_id);
						$parent_on_id = $parent_on['parent_id'];
						
						
						if($data['parent_on'] != ''){
							$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
						}else{
							$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
						}
						if($parent_on['parent_id'] == '0'){
							$i = 9;
						}
						
					}
				}else{
					$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
				}
				$data['rs_indicator'] = $this->indicator->get_row($data['rs_metrics']['mds_set_indicator_id']);
				
				$data['round_month'] = $data['rs']['round_month']; //รอบการส่งประเมิน
					
				// หา น้ำหนักของทั้งมิติ //
				$data['weight_perc_tot'] = indicator_all_weight($data['rs_indicator']['budget_year'],$data['rs']['round_month']);
				// หา น้ำหนักของทั้งมิติ //
				
				//$this->db->debug = true;
				$chk_kpr = "select mds_set_metrics_kpr.*,
							mds_set_position.pos_name , cnf_division.title , cnf_department.title as department_name 
							from mds_set_metrics_kpr 
							left join mds_set_position on mds_set_metrics_kpr.control_position_id = mds_set_position.id 
							left join cnf_division on mds_set_metrics_kpr.control_division_id = cnf_division.id 
							left join cnf_department on mds_set_metrics_kpr.control_department_id= cnf_department.id 
							where mds_set_metrics_kpr.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_kpr.round_month = '".@$data['round_month']."'";
				$result_kpr = $this->kpr->get($chk_kpr);
				$data['kpr'] = @$result_kpr['0'];
				
				//$this->db->debug =true;
				$chk_keyer = "select mds_set_metrics_keyer.*
								from mds_set_metrics_keyer 
								where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."'";
				$data['keyer'] = $this->keyer->get($chk_keyer);
				
				// เช็คว่ามีการแต่งตั้งผู้จักเก็บแทนหรือไหม
				foreach ($data['keyer'] as $key => $chk_change_keyer) {
					if(@$chk_change_keyer['change_keyer_users_id'] != '0' && @$chk_change_keyer['change_keyer_users_id'] != ''  && @$chk_change_keyer['keyer_users_id'] == login_data('id')){
						set_notify('error', 'ไม่สามารถเข้าแก้ไขข้อมูลได้เนื่องจากมีผู้จัดเก็บข้อมูลแทน ท่านแล้ว');
						redirect($data['urlpage'].'/form/'.@$metrics_id);
					}
				}
				
				// หาคะแนนขอผู้บันทึกคะแนน
				$chk_keyer_score = "select mds_set_metrics_keyer.*,mds_metrics_result.score_metrics,mds_metrics_result.result_metrics
									from mds_set_metrics_keyer 
									join mds_metrics_result on mds_set_metrics_keyer.mds_set_metrics_id = mds_metrics_result.mds_set_metrics_id 
																					and mds_metrics_result.round_month = mds_set_metrics_keyer.round_month
																					and mds_metrics_result.keyer_users_id = mds_set_metrics_keyer.keyer_users_id
									where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' 
									      and mds_set_metrics_keyer.keyer_score = '1'";
				$data['score'] = $this->keyer->get($chk_keyer_score);
				$data['score'] = @$data['score']['0'];
				
				$chk_keyer_activity = "select mds_set_metrics_keyer.*
										from mds_set_metrics_keyer 
										where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' 
										and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' and mds_set_metrics_keyer.keyer_users_id = '".@$data['rs']['keyer_users_id']."'";
				//$result_keyer_activity = $this->keyer->get($chk_keyer_activity);
				$result_keyer_activity = $this->db->getrow($chk_keyer_activity); 
				dbConvert($result_keyer_activity);
				$data['keyer_activity'] = @$result_keyer_activity;
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
			redirect($data['urlpage'].'/form/'.@$metrics_id);
		}
		$this->template->build('form_2',@$data);

	}
	
	function form_show($metrics_id=null,$result_id=null){
		if($metrics_id != '' && $result_id != ''){
				  $data['rs_metrics'] = $this->metrics->get_row($metrics_id);
				
				  $data['rs'] = $this->metrics_result->get_row($result_id);
					if($data['rs']['id'] == ''){
						set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
						redirect($data['urlpage'].'/form/'.@$metrics_id);
					} 
				$data['parent_on'] = '';
				
				if(@$data['rs_metrics']['metrics_cancel'] != ''){
					if($data['rs']['round_month'] >= @$data['rs_metrics']['metrics_cancel']){
						set_notify('error', 'ท่านไม่บันทึกตัวชี้วัดในรอบถัดไปได้ เนื่องจากมีการยกเลิกตัวชี้วัดแล้ว'); 
				  		redirect($data['urlpage'].'/form/'.$metrics_id);
					}
				}
				
				$parent_on_id = $data['rs_metrics']['id'];
				if(@$data['rs_metrics']['parent_id'] != '0'){
					for ($i=1; $i <= 8 ; $i++) {
						
						$parent_on = '';
						$parent_on = $this->metrics->get_row($parent_on_id);
						$parent_on_id = $parent_on['parent_id'];
						
						
						if($data['parent_on'] != ''){
							$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
						}else{
							$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
						}
						if($parent_on['parent_id'] == '0'){
							$i = 9;
						}
						
					}
				}else{
					$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
				}
				$data['rs_indicator'] = $this->indicator->get_row($data['rs_metrics']['mds_set_indicator_id']);
				
				$data['round_month'] = $data['rs']['round_month']; //รอบการส่งประเมิน
					
				// หา น้ำหนักของทั้งมิติ //
				$data['weight_perc_tot'] = indicator_all_weight($data['rs_indicator']['budget_year'],$data['rs']['round_month']);
				// หา น้ำหนักของทั้งมิติ //
				
				
				//$this->db->debug = true;
				$chk_kpr = "select mds_set_metrics_kpr.*,
							mds_set_position.pos_name , cnf_division.title , cnf_department.title as department_name 
							from mds_set_metrics_kpr 
							left join mds_set_position on mds_set_metrics_kpr.control_position_id = mds_set_position.id 
							left join cnf_division on mds_set_metrics_kpr.control_division_id = cnf_division.id 
							left join cnf_department on mds_set_metrics_kpr.control_department_id = cnf_department.id 
							where mds_set_metrics_kpr.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_kpr.round_month = '".@$data['round_month']."'";
				$result_kpr = $this->kpr->get($chk_kpr);
				$data['kpr'] = @$result_kpr['0'];
				
				//$this->db->debug =true;
				$chk_keyer = "select mds_set_metrics_keyer.*
								from mds_set_metrics_keyer 
								where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."'
								order by mds_set_metrics_keyer.id asc";
				$data['keyer'] = $this->keyer->get($chk_keyer);
				
				
				
				// หาคะแนนขอผู้บันทึกคะแนน
				$chk_keyer_score = "select mds_set_metrics_keyer.*,mds_metrics_result.score_metrics,mds_metrics_result.result_metrics
									from mds_set_metrics_keyer 
									join mds_metrics_result on mds_set_metrics_keyer.mds_set_metrics_id = mds_metrics_result.mds_set_metrics_id 
																					and mds_metrics_result.round_month = mds_set_metrics_keyer.round_month
																					and mds_metrics_result.keyer_users_id = mds_set_metrics_keyer.keyer_users_id
									where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' 
									      and mds_set_metrics_keyer.keyer_score = '1'";
				$data['score'] = $this->keyer->get($chk_keyer_score);
				$data['score'] = @$data['score']['0'];
				
				$chk_keyer_activity = "select mds_set_metrics_keyer.*
										from mds_set_metrics_keyer 
										where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' 
										and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' and mds_set_metrics_keyer.keyer_users_id = '".@$data['rs']['keyer_users_id']."'";
				//$result_keyer_activity = $this->keyer->get($chk_keyer_activity);
				$result_keyer_activity = $this->db->getrow($chk_keyer_activity); 
				dbConvert($result_keyer_activity);
				$data['keyer_activity'] = @$result_keyer_activity;
				
				$this->template->build('form_show',@$data);
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
			redirect('mds');
		}
	}
	
	function save(){
		$urlpage = $this->urlpage;
		if (!is_login()) {
			redirect("home");
		}
		$premit = is_permit(login_data('id'),'1');
		
		$premit_2 = is_permit(login_data('id'),'3');
		if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		$chk_keyer_indicator = chk_keyer_indicator(@$_POST['mds_set_indicator_id'],$_POST['mds_set_metrics_id']);
		// ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		$chk_keyer_activity = "select mds_set_metrics_keyer.*
										from mds_set_metrics_keyer 
										where mds_set_metrics_keyer.mds_set_metrics_id = '".@$_POST['mds_set_metrics_id']."' 
										and mds_set_metrics_keyer.round_month = '".@$_POST['round_month']."' and mds_set_metrics_keyer.keyer_users_id = '".@$_POST['keyer_users_id']."'";
		$result_keyer_activity = $this->db->getrow($chk_keyer_activity); 
		dbConvert($result_keyer_activity);
			
		if(login_data('id') != $result_keyer_activity['keyer_users_id'] && @$result_keyer_activity['change_keyer_users_id'] != login_data('id')){
			set_notify('error', 'ท่านไม่มีสิทธิ์ในการบันทึกผลการปฎิบัติราชการ'); 
			redirect($urlpage.'/form/'.@$_POST['mds_set_metrics_id']);
		}
		
		if($_POST){
			
			if($_POST['id']>0){
				$_POST['UPDATE_BY'] = login_data('name');
			}else{
				$_POST['CREATE_BY'] = login_data('name');
			}
			
			// ถ้าไม่ใช่ผู้บันทึกคะแนนให้ คะแนน เป็น ค่าว่าง
			if(@$_POST['keyer_score'] == '0'){
				$_POST['score_metrics'] = '';
				$_POST['result_metrics'] = '';
			}
			
			$id = $this->metrics_result->save($_POST);
			
				if(@$_FILES['document_plan']['name'] != ''){
					$correct_type = array('doc', 'docx');
					$ext = pathinfo($_FILES['document_plan']['name'], PATHINFO_EXTENSION);
					if(in_array($ext, $correct_type)) {
						$upload_1['TYPE_DOC']= '1';	
						$upload_1['MDS_METRICS_RESULT_ID'] = $id;
						$upload_1['CREATE_BY'] = login_data('name');
						$file_name = pathinfo($_FILES['document_plan']['name'], PATHINFO_FILENAME)."_".date("YmdHis").'.'.$ext;
						$upload_1['DOC_NAME_UPLOAD'] = $file_name;
						$upload_1['DOC_NAME']=$_FILES['document_plan']['name'];
						$this->doc->save($upload_1);
						$uploaddir = 'uploads/mds/';
						$fpicname = $uploaddir.$file_name;
						move_uploaded_file($_FILES['document_plan']['tmp_name'], $fpicname);
					}else{
						set_notify('error', 'ไม่สามารถอัพโหลดไฟล์ ที่ไม่ใช่นามสกุล doc,docx ได้'); 
						redirect($urlpage.'/form/'.@$_POST['mds_set_metrics_id']);
					}
				}
				
				if(@$_FILES['new_document_plan']['name'] != ''){
					
					$ext = pathinfo($_FILES['new_document_plan']['name'], PATHINFO_EXTENSION);
					$correct_type = array('doc', 'docx');
					if(in_array($ext, $correct_type)) {
						$doc_name = $this->doc->get_row($_POST['document_plan_id']);
						if($doc_name['id'] != ''){
							$this->doc->delete($_POST['document_plan_id']);
							unlink("uploads/mds/".$doc_name['doc_name_upload']);	
						}
					
						$upload_new_1['TYPE_DOC']= '1';	
						$upload_new_1['MDS_METRICS_RESULT_ID'] = $id;
						$upload_new_1['CREATE_BY'] = login_data('name');
						$file_name_new = pathinfo($_FILES['new_document_plan']['name'], PATHINFO_FILENAME)."_".date("YmdHis").'.'.$ext;
						$upload_new_1['DOC_NAME_UPLOAD'] = $file_name_new;
						$upload_new_1['DOC_NAME']=$_FILES['new_document_plan']['name'];
						$this->doc->save($upload_new_1);
						$uploaddir = 'uploads/mds/';
						$fpicname_new = $uploaddir.$file_name_new;
						move_uploaded_file($_FILES['new_document_plan']['tmp_name'], $fpicname_new);
					}else{
						set_notify('error', 'ไม่สามารถอัพโหลดไฟล์ ที่ไม่ใช่นามสกุล doc,docx ได้'); 
						redirect($urlpage.'/form/'.@$_POST['mds_set_metrics_id']);
					}
				}
			
			for ($i=1; $i <= $_POST['num_ref']; $i++) { 
				if (@$_FILES['document_plan_ref']['name'][$i] !='') {
					$correct_type = array('exe');
					$ext_2 = pathinfo($_FILES['document_plan_ref']['name'][$i], PATHINFO_EXTENSION);
					if (in_array($ext_2, $correct_type)) {
						set_notify('error', 'ไม่สามารถอัพโหลดไฟล์ ที่เป็นนามสกุล exe ได้'); 
						redirect($urlpage.'/form/'.@$_POST['mds_set_metrics_id']);
					}
					
					$upload_2['TYPE_DOC']= '2';	
					$upload_2['MDS_METRICS_RESULT_ID'] = $id;
					$upload_2['CREATE_BY'] = login_data('name');
					$file_name_2 = pathinfo($_FILES['document_plan_ref']['name'][$i], PATHINFO_FILENAME)."_".date("YmdHis").$i.".".$ext_2;
					$upload_2['DOC_NAME_UPLOAD'] = $file_name_2;
					$upload_2['DOC_NAME']=$_FILES['document_plan_ref']['name'][$i];
					$this->doc->save($upload_2);
					$uploaddir_2 = 'uploads/mds/';
					$fpicname_2 = $uploaddir_2.$file_name_2;
					move_uploaded_file($_FILES['document_plan_ref']['tmp_name'][$i], $fpicname_2);		
				}
			}
			if ($_POST['is_save'] == '2') {
				$update_status['mds_metrics_result_id'] = $id;
				$update_status['permit_type_id'] = '3';
				$update_status['result_status_id'] = '2';
				$update_status['users_id'] = login_data('id');
				$update_status['CREATE_BY'] = login_data('name');
				$this->result_status->save($update_status);
			}
			//return false;
		   if($_POST['id']>0){
		   	save_logfile("EDIT","แก้ไข  ".$this->modules_title." ID : ".$id." รอบ ".$_POST['round_month']." ผู้บันทึก ".get_one('name', 'users','id',$_POST['keyer_users_id']),$this->modules_name);
		   }else{
		   	save_logfile("ADD","เพิ่ม ".$this->modules_title." ID : ".$id." รอบ ".$_POST['round_month']." ผู้บันทึก ".get_one('name', 'users','id',$_POST['keyer_users_id']),$this->modules_name);
		   }
		   
		   
		   set_notify('success', lang('save_data_complete'));	  
		}
		redirect($urlpage.'/form/'.@$_POST['mds_set_metrics_id']);

	}

	function delete($budget_year = null,$ID=FALSE){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id'),'1');
		if($premit == ''){
			$premit_2 = is_permit(login_data('id'),'3');
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		$id = $_GET['id'];
		$metrics_id = $_GET['metrics_id'];
		if(@$id != '' && @$metrics_id != ''){
			$chk_result = $this->metrics_result->get_row($id);
			if(count($chk_result) > 0){
				$chk_keyer_activity = "select mds_set_metrics_keyer.*
										from mds_set_metrics_keyer 
										where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' 
										and mds_set_metrics_keyer.round_month = '".@$chk_result['round_month']."' and mds_set_metrics_keyer.keyer_users_id = '".@$chk_result['keyer_users_id']."'";
				//$result_keyer_activity = $this->keyer->get($chk_keyer_activity);
				$result_keyer_activity = $this->db->getrow($chk_keyer_activity); 
				dbConvert($result_keyer_activity);
				
				if(login_data('id') == $chk_result['keyer_users_id'] || @$result_keyer_activity['change_keyer_users_id'] == login_data('id')){
					
					if($chk_result['is_save'] != 2){
						$chk_doc = $this->doc->where("mds_metrics_result_id = '".$id."' ")->get();
						foreach ($chk_doc as $key => $doc_name) {
							$this->doc->delete($doc_name['id']);
							unlink("uploads/mds/".$doc_name['doc_name_upload']);
						}		
						save_logfile("DELETE","ลบ  ".$this->modules_title." ID : ".$id." รอบ ".$chk_result['round_month']." ผู้บันทึก ".get_one('name', 'users','id',$chk_result['keyer_users_id']),$this->modules_name);					
							
							$this->metrics_result->delete($id);
							$this->result_status->where("mds_metrics_result_id = '".$id."'")->delete();
							//return false;
						set_notify('error', 'ลบข้อมูลเสร็จสิน');	
					}else{
						set_notify('error', 'ไม่สามารถลบผลการปฎิบัติราชการได้ เนื่องจากทำการบันทึกส่งไปแล้ว');		
					}	
					redirect($urlpage.'/form/'.$metrics_id);
				}else{
					set_notify('error', 'ท่านไม่สามารถลบผลการปฎิบัติราชการได้ เนื่องจากท่านไม่ใช่ผู้กรอกข้อมูลผลการปฎิบัติราชการ');
					redirect($urlpage.'/form/'.$metrics_id);
				}
				
			}else{
				set_notify('error', 'ไม่พบข้อมูลที่ท่านต้องการลบ');
				redirect($urlpage.'/form/'.$metrics_id);
			}
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
			redirect($urlpage);
		}
		
	}
	
	function delete_doc(){
		$urlpage = $this->urlpage;
		$id = $_GET['id'];
		$result_id = $_GET['result_id'];
		$metrics_id = $_GET['metrics_id'];
		$keyer_users_id = $_GET['keyer_users_id'];
		$round_month = $_GET['round_month'];
		$type_doc = $_GET['type_doc'];
		if($id != '' && $result_id != '' && $metrics_id != '' && $keyer_users_id != '' && $round_month != '' && $type_doc != ''){
			$chk_result = $this->metrics_result->get_row($result_id);
			print($chk_result);
			$chk_keyer_activity = "select mds_set_metrics_keyer.*,
										mds_set_permission_dtl.name , mds_set_permission_dtl.email , mds_set_permission_dtl.tel , mds_set_permission_dtl.username 
										from mds_set_metrics_keyer 
										left join mds_set_permission_dtl on mds_set_metrics_keyer.keyer_permission_id = mds_set_permission_dtl.mds_set_permission_id 
										where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' 
										and mds_set_metrics_keyer.round_month = '".@$chk_result['round_month']."' and mds_set_metrics_keyer.keyer_users_id = '".@$chk_result['keyer_users_id']."'";
			//$result_keyer_activity = $this->keyer->get($chk_keyer_activity);
			$result_keyer_activity = $this->db->getrow($chk_keyer_activity); 
			dbConvert($result_keyer_activity);
			
			if($chk_result['keyer_users_id'] == $keyer_users_id || @$result_keyer_activity['change_keyer_users_id'] == login_data('id')){
				if($chk_result['is_save'] != '2'){
					$doc_name = $this->doc->get_row($id);
					if($doc_name['id'] != ''){
						$this->doc->delete($id);
						unlink("uploads/mds/".$doc_name['doc_name_upload']);	
						if($type_doc == '1'){
						    $doc = "เอกสารแบบฟอร์มรายงาน";
						}else{
							$doc = "เอกสารหลักฐานอ้างอิง ";
						}
						save_logfile("DELETE","ลบ เอกสาร  ".$doc." ".$this->modules_title." ID : ".$result_id." รอบ ".$round_month." ของผู้บันทึก ".get_one('name', 'users','id',$keyer_users_id)." ชื่อไฟล์เอกสาร  ".$doc_name['doc_name'],$this->modules_name);
						set_notify('error', 'ลบ '.$doc.' เรียบร้อย');
						redirect($urlpage.'/form_2/'.$metrics_id.'/'.$result_id);
					}else{
						set_notify('error', 'ไม่พบไฟล์เอกสารแนบ');
						redirect($urlpage.'/form_2/'.$metrics_id.'/'.$result_id);
					}		
				}else{
					set_notify('error', 'ไม่สามารถลบเอกสารได้เนื่องจากบันทึกส่งไปแล้ว');
					redirect($urlpage.'/form_2/'.$metrics_id.'/'.$result_id);	
				}
				
			}else{
				set_notify('error', 'ท่านไม่มีสิทธิในการลบเอกสาร');
				redirect($urlpage.'/form_2/'.$metrics_id.'/'.$result_id);
			}
			
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
			redirect($urlpage);
		}
	}

	function chk_keyer_result(){
		$metrics_id = @$_GET['metrics_id'];
		$round_month = @$_GET['round_month'];
		$keyer_users_id = @$_GET['keyer_users_id'];
		$chk = 'Y';
		if($metrics_id != '' && $round_month != '' && $keyer_users_id != ''){
			// ตรวจสอบว่า มีการบันทึกข้อมูลครบทุกคนและผ่าน กพร. แล้ว
			$chk_keyer_result ="SELECT KEYER.KEYER_USERS_ID , RESULT.ID AS RESULT_ID ,RESULT.IS_SAVE ,RESULT.CONTROL_STATUS ,RESULT.KPR_STATUS,RESULT.RESULT_METRICS
								FROM  MDS_SET_METRICS_KEYER KEYER
								LEFT JOIN MDS_METRICS_RESULT RESULT  ON KEYER.MDS_SET_METRICS_ID = RESULT.MDS_SET_METRICS_ID 
									 AND KEYER.ROUND_MONTH = RESULT.ROUND_MONTH AND KEYER.KEYER_USERS_ID = RESULT.KEYER_USERS_ID
								WHERE KEYER.MDS_SET_METRICS_ID = '".$metrics_id."' AND KEYER.ROUND_MONTH = '".$round_month."' AND KEYER.KEYER_USERS_ID != '".$keyer_users_id."' ";
			$result_chk = $this->keyer->get($chk_keyer_result);
			foreach ($result_chk as $key => $result) {
				if($result['result_id'] == '' || $result['is_save'] != '2' || $result['control_status'] != '1' || $result['kpr_status'] != '1'){   
						$chk = "N";
				}
			}
		}else{
			$chk = "N";
		}
		echo $chk;
	}

	function check_result_metrics(){
		if(@$_GET['result_metrics'] != ''){
			$result_metrics = $_GET['result_metrics'];
			if(!is_numeric($result_metrics)){
				if($result_metrics != "N/A"){
					echo 'false';
				}else{
					echo 'true';
				}
			}else{
				$chk_result = explode('.', $result_metrics);
				if(strlen(@$chk_result['1']) > 4){
					echo 'false';
				}else if(@$chk_result['2'] != ''){
					echo 'false';
				}else{
					echo "true";
				}
			}
		}else{
			echo 'true';
		}
	}
}
?>