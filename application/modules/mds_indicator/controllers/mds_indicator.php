<?php
Class Mds_indicator extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/Mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/Mds_set_metrics_model','metrics');
		$this->load->model('mds_set_indicator/Mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/Mds_set_metrics_keyer_model','keyer');
		$this->load->model('mds_indicator/Mds_metrics_result_model','metrics_result');
	}
	
	public $urlpage = "mds_indicator";
	public $modules_name = "mds_indicator";
	public $modules_title = " บันทึก ตัวชี้วัด";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id','1'));
		if($premit == ''){
			$premit_2 = is_permit(login_data('id','3'));
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
				where $condition and metrics.parent_id = '0' order by  metrics.metrics_on asc";
		
		$data['rs'] = $this->metrics->get($sql,'true');
		
		
		$this->template->build('index',@$data);

	}
	
	function form($id=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id','1'));
		if($premit == ''){
			$premit_2 = is_permit(login_data('id','3'));
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		if($id != ''){
			$data['rs'] = $this->metrics_result->get_row($id);
			
			$data['rs_metrics'] = $this->metrics->get_row($id);
				if($premit == "")
				{
				  $chk_keyer_indicator = chk_keyer_indicator(@$data['rs_metrics']['mds_set_indicator_id'],$data['rs_metrics']['id']);
				  if($chk_keyer_indicator != 'Y'){
				  	et_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");
				  }	
				}
			$data['parent_on'] = '';
			$parent_on_id = $data['rs_metrics']['id'];
			if(@$data['rs_metrics']['parent_id'] != '0'){
				for ($i=1; $i <= 4 ; $i++) {
					
					$parent_on = '';
					$parent_on = $this->metrics->get_row($parent_on_id);
					$parent_on_id = $parent_on['parent_id'];
					
					
					if($data['parent_on'] != ''){
						$data['parent_on'] = @$parent_on['metrics_on'].'.'.@$data['parent_on'];
					}else{
						$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
					}
					if($parent_on['parent_id'] == '0'){
						$i = 5;
					}
					
				}
			}else{
				$data['parent_on'] = @$data['rs_metrics']['metrics_on'];
			}
			
			$data['rs_indicator'] = $this->indicator->get_row($data['rs_metrics']['mds_set_indicator_id']);
		}
		$this->template->build('form',@$data);

	}

	
	function save(){
		$urlpage = $this->urlpage;
		$this->db->debug = true;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id','1'));
		if($premit == ''){
			$premit_2 = is_permit(login_data('id','3'));
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		if($_POST){
			
			if($_POST['id']>0){
		   		$_POST['UPDATE_DATE'] = date("Y-m-d");
				$_POST['UPDATE_BY'] = login_data('name');
			}else{
				$_POST['CREATE_DATE'] = date("Y-m-d");
				$_POST['CREATE_BY'] = login_data('name');
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

	function delete($budget_year = null,$ID=FALSE){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		$premit = is_permit(login_data('id','1'));
		if($premit == ''){
			$premit_2 = is_permit(login_data('id','3'));
			if($premit_2 == ''){ set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds");} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		} // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		
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
	
}
?>