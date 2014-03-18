<?php
Class Mds_indicator_certify extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id'),'1');
		if($premit == ''){
			$premit_2 = is_permit(login_data('id'),'2');
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		
		parent::__construct();
		$this->load->model('mds_set_indicator/Mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/Mds_set_metrics_model','metrics');
		$this->load->model('mds_set_indicator/Mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/Mds_set_metrics_keyer_model','keyer');
		$this->load->model('mds_indicator/Mds_metrics_result_model','metrics_result');
		$this->load->model('mds_indicator/Mds_metrics_document_model','doc');
		$this->load->model('mds_indicator/Mds_metrics_result_status_model','result_status');
		$this->load->model('mds_indicator/Mds_status_topic_model','status_topic');
	}
	
	public $urlpage = "mds_indicator_certify";
	public $modules_name = "mds_indicator_certify";
	public $modules_title = " บันทึก ตัวชี้วัด";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		
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
				where $condition and metrics.parent_id = '0' order by  metrics.metrics_on asc";
		
		$data['rs'] = $this->metrics->get($sql,'true');
		
		
		$this->template->build('index',@$data);

	}

	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id'),'1');
		if($id != ''){
			if($premit == ''){
				$sql_result = "select distinct result.*,mds_set_metrics_keyer.keyer_name ,mds_set_metrics_keyer.keyer_tel,mds_set_metrics_keyer.keyer_email 
								from mds_metrics_result result
								join mds_set_metrics_kpr on result.mds_set_metrics_id = mds_set_metrics_kpr.mds_set_metrics_id and result.round_month = mds_set_metrics_kpr.round_month
								left join mds_set_metrics_keyer on result.mds_set_metrics_id = mds_set_metrics_keyer.mds_set_metrics_id 
										  and result.round_month = mds_set_metrics_keyer.round_month and result.keyer_users_id =  mds_set_metrics_keyer.keyer_users_id
								where result.mds_set_metrics_id = '".$id."' and mds_set_metrics_kpr.control_users_id = '".login_data('id')."' 
								order by result.round_month asc,result.id desc ";
									
				$data['rs'] = $this->metrics_result->get($sql_result);
				$data['pagination'] = $this->metrics_result->pagination();
			}else{
				$sql_result = "select distinct result.*,mds_set_metrics_keyer.keyer_name ,mds_set_metrics_keyer.keyer_tel,mds_set_metrics_keyer.keyer_email 
								from mds_metrics_result result 
								left join mds_set_metrics_keyer on result.mds_set_metrics_id = mds_set_metrics_keyer.mds_set_metrics_id 
										  and result.round_month = mds_set_metrics_keyer.round_month and result.keyer_users_id =  mds_set_metrics_keyer.keyer_users_id
								where result.mds_set_metrics_id = '".$id."' order by result.round_month asc,result.id desc ";
									
				$data['rs'] = $this->metrics_result->get($sql_result);
				$data['pagination'] = $this->metrics_result->pagination();
			}
			
				
			$data['rs_metrics'] = $this->metrics->get_row($id);
				if($premit == "")
				{
				  $chk_keyer_indicator = chk_control_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id']);
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
	
	
	function form_list($result_id=null){
		$data['urlpage'] = $this->urlpage;
		$premit = is_permit(login_data('id'),'1');
		$data['result_id'] = $result_id;
		if($result_id !=''){
			
				$sql_result_status = "select result_status.*,result.mds_set_metrics_id ,topic.status_dtl,topic.status_steps,topic.code_colors,result.round_month
										from mds_metrics_result result 
										join mds_metrics_result_status result_status on result.id = result_status.mds_metrics_result_id
										join mds_status_topic topic on result_status.permit_type_id = topic.permit_type_id and result_status.result_status_id = topic.status_id
										where result.id = '".$result_id."' order by result_status.id asc ";
														
				
									
				$data['rs'] = $this->metrics_result->get($sql_result_status);
				$data['pagination'] = $this->metrics_result->pagination();
				
				// หา หน่วยงานรับผิดชอบ
				$chk_kpr = "select mds_set_metrics_kpr.*,cnf_division.title , cnf_department.title as department_name 
							from mds_set_metrics_kpr 
							left join cnf_division on mds_set_metrics_kpr.control_division_id = cnf_division.id 
							left join cnf_department on mds_set_metrics_kpr.control_department_id = cnf_department.id 
							where mds_set_metrics_kpr.mds_set_metrics_id = '".@$data['rs']['0']['mds_set_metrics_id']."' and mds_set_metrics_kpr.round_month = '".@$data['rs']['0']['round_month']."'";
				$result_kpr = $this->kpr->get($chk_kpr);
				$data['kpr'] = @$result_kpr['0'];
				
				
			$data['rs_metrics'] = $this->metrics->get_row(@$data['rs']['0']['mds_set_metrics_id']);
			
				if($premit == "")
				{
				  $chk_control_indicator = chk_control_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id']);
				  if($chk_control_indicator != 'Y'){
				  	set_notify('error', 'ท่านไม่มีสิทธิ์ในการการตรวจสอบตัวชี้วัดนี้'); 
				  	redirect("mds");
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
			
		$this->template->build('form_list',@$data);

	}
	
	function form_2($result_id=null,$metrics_id=null){
		$data['urlpage'] = $this->urlpage;
		if($result_id != '' && $metrics_id != ''){
			
				$data['rs_metrics'] = $this->metrics->get_row($metrics_id);
				$data['rs'] = $this->metrics_result->get_row($result_id);
				if($data['rs']['id'] != ''){
						$chk_control_indicator = chk_control_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id'],$data['rs']['id']);
						$chk_kpr_indicator = chk_kpr_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id'],$data['rs']['id']);
						  if($chk_control_indicator != 'Y' && $chk_kpr_indicator != 'Y'){
						  	set_notify('error', 'ท่านไม่มีสิทธิ์ในการตรวจสอบตัวชี้วัดนี้'); 
						  	redirect("mds");
						  }
				// log
				save_logfile("VIEW","ดูลายละเอียด  ".$this->modules_title." ID : ".$result_id." รอบ ".$data['rs']['round_month']." ผู้บันทึก ".get_one('name', 'users','id',$data['rs']['keyer_users_id']),$this->modules_name);
				
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
					
					/*
					//$this->db->debug =true;
					$chk_keyer = "select mds_set_metrics_keyer.*,
								mds_set_permission_dtl.name , mds_set_permission_dtl.email , mds_set_permission_dtl.tel , mds_set_permission_dtl.username 
								from mds_set_metrics_keyer 
								left join mds_set_permission_dtl on mds_set_metrics_keyer.keyer_permission_id = mds_set_permission_dtl.mds_set_permission_id 
								where mds_set_metrics_keyer.mds_set_metrics_id = '".$metrics_id."' and mds_set_metrics_keyer.round_month = '".@$data['round_month']."'";
					$data['keyer'] = $this->keyer->get($chk_keyer);
					*/
					
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
										and mds_set_metrics_keyer.round_month = '".@$data['round_month']."' and mds_set_metrics_keyer.keyer_users_id = '".$data['rs']['keyer_users_id']."' ";
					$result_keyer_activity = $this->keyer->get($chk_keyer_activity);
					$data['keyer_activity'] = @$result_keyer_activity['0'];
					
					$data['rs']['keyer_users_id'] = login_data('id');
			}else{
				set_notify('error', 'ไม่พลข้อมูลผลการปฎิบัติราชการที่ท่านเลือก');
				redirect($data['urlpage'].'/index/');
			}
		}else{
			set_notify('error', 'การเข้าถึงข้อมูลไม่ถูกต้อง');
			redirect($data['urlpage'].'/index/');
		}

		$this->template->build('form_2',@$data);

	}
	
	
	function save(){
		$urlpage = $this->urlpage;
		//$this->db->debug = true;
		if(!is_login())redirect("home");	
			$chk_control_indicator = chk_control_indicator(@$_POST['mds_set_indicator_id'],$_POST['mds_set_metrics_id'],$_POST['id']);
			$chk_kpr_indicator = chk_kpr_indicator(@$_POST['mds_set_indicator_id'],$_POST['mds_set_metrics_id'],$_POST['id']);
			if($chk_control_indicator != 'Y' && $chk_kpr_indicator != 'Y'){
				set_notify('error', 'ท่านไม่มีสิทธิ์ในการตรวจสอบตัวชี้วัดนี้'); 
				redirect("mds");
			}
		
		if($_POST){
			
			if($_POST['id']>0){
		   		$update_result['UPDATE_DATE'] = date("Y-m-d");
				$update_result['UPDATE_BY'] = login_data('name');
			}else{
				$update_result['CREATE_DATE'] = date("Y-m-d");
				$update_result['CREATE_BY'] = login_data('name');
			}
			if($_POST['permit_type_id'] == '2'){
				if($_POST['control_status'] == '1'){
					$update_result['control_status'] = $_POST['control_status'];
				}else{
					$update_result['control_status'] = '';
					$update_result['is_save'] = '1';
				}
				
				$result = $this->metrics_result->get_row($_POST['id']);
				if($result['is_save'] != '2' || $result['control_status'] == '1' || $result['kpr_status'] == '1'){
					set_notify('error', 'ไม่สามารถบันทึกผลการตรวจสอบตัวชี้วัดได้');
					redirect($urlpage.'/form_list/'.@$_POST['id']);
				}
				
			}
			
			if($_POST['permit_type_id'] == '1'){
				if($_POST['kpr_status'] == '1'){
					$update_result['kpr_status'] = $_POST['kpr_status'];
				}else{
					$update_result['kpr_status'] = '';
					$update_result['control_status'] = '';
					$update_result['is_save'] = '1';
				}
				$result = $this->metrics_result->get_row($_POST['id']);
				if($result['is_save'] != '2' || $result['control_status'] != '1' || $result['kpr_status'] == '1'){
					set_notify('error', 'ไม่สามารถบันทึกผลการตรวจสอบตัวชี้วัดได้');
					redirect($urlpage.'/form_list/'.@$_POST['id']);
				}
			}
			
			$update_result['id'] = $_POST['id'];
			$id = $this->metrics_result->save($update_result);
			
			if($_POST['permit_type_id'] == '2'){
				$update_status['mds_metrics_result_id'] = $id;
				$update_status['permit_type_id'] = '2';
				$update_status['result_status_id'] = $_POST['control_status'];
				if($_POST['control_status'] == '1'){
					$update_status['result_comment'] = '';
					$status = "อนุมัติ";
				}else{
					$update_status['result_comment'] = $_POST['result_comment'];
					$status = "ไม่อนุมัติ";
				}		
				$update_status['users_id'] = login_data('id');
				$update_status['CREATE_DATE'] = date("Y-m-d");
				$update_status['CREATE_BY'] = login_data('name');
				$this->result_status->save($update_status);
			}
			
			if($_POST['permit_type_id'] == '1'){
				$update_status['mds_metrics_result_id'] = $id;
				$update_status['permit_type_id'] = '1';
				$update_status['result_status_id'] = $_POST['kpr_status'];
				if($_POST['kpr_status'] == '1'){
					$update_status['result_comment'] = '';
					$status = "ผ่าน";
				}else{
					$update_status['result_comment'] = $_POST['result_comment'];
					$status = "ไม่ผ่าน";
				}		
				$update_status['users_id'] = login_data('id');
				$update_status['CREATE_DATE'] = date("Y-m-d");
				$update_status['CREATE_BY'] = login_data('name');
				$this->result_status->save($update_status);
			}
			//return false;
		  
		   	save_logfile("ADD","เปรียนสถานะ  ".$this->modules_title." ID : ".$id." รอบ ".$_POST['round_month']." ผู้บันทึก ".get_one('name', 'users','id',$_POST['keyer_users_id'])." ".$status,$this->modules_name);
		   
		   
		   
		   set_notify('success', lang('save_data_complete'));	  
		}
		redirect($urlpage.'/form_list/'.@$_POST['id']);

	}

}
?>