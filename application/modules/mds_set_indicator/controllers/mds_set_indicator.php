<?php
Class Mds_set_indicator extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/Mds_set_indicator_model','indicator');
		
	}
	
	public $urlpage = "mds_set_indicator";
	public $modules_name = "mds_set_indicator";
	public $modules_title = " ตั้งค่า มิติและตัวชี้วัด";
	
	function index(){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		$condition = " 1=1 ";
		if(@$_GET['sch_budget_year'] != ''){
			$condition .= " and budget_year = '".@$_GET['sch_budget_year']."' ";
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
		}else{
			$data['rs']['budget_year'] = $budget_year;
		}
		$this->template->build('form',@$data);

	}
	function form_2($indicator_id=null, $id_1=null){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		if($id_1 == '' && $indicator_id != ''){
			$data['rs']['mds_set_indicator_id'] = $indicator_id;
			$data['rs_indicator'] = $this->indicator->get_row($indicator_id);
			if($data['rs_indicator']['id'] == ''){
				set_notify('error', 'การเข้าถึงข้อมูลผิดพลาด');	
				redirect($data['urlpage']);
			}
		}else{
			$data['rs'] = $this->metrics->get_row($id);
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
		    $_POST['CREATE_DATE'] = date("Y-m-d");
			$_POST['CREATE_BY'] = login_data('name');
		   	new_save_logfile("EDIT",$this->modules_title,$this->indicator->table,"ID",$id,"ass_name",$this->modules_name);
		   }else{
		   	$_POST['UPDATE_DATE'] = date("Y-m-d");
			$_POST['UPDATE_BY'] = login_data('name');
		   	new_save_logfile("ADD",$this->modules_title,$this->indicator->table,"ID",$id,"ass_name",$this->modules_name);
		   }
		   
		   $id = $this->indicator->save($_POST);
		   set_notify('success', lang('save_data_complete'));	  
		}
		redirect($urlpage.'/index?sch_budget_year='.@$_POST['budget_year']);

	}
	function delete($budget_year = null,$ID=FALSE){
		$urlpage = $this->urlpage;
		if(!is_login())redirect("home");
		if(is_permit(login_data('id'),1) == '')redirect("mds"); // ตรวจสอบว่าเป็น กพร. หรือไม่
		
		new_save_logfile("DELETE",$this->modules_title,$this->indicator->table,"ID",$ID,"ass_name",$this->modules_name);					
		$this->indicator->delete($ID);
		set_notify('error', 'ลบข้อมูลเสร็จสิน');		
		redirect($urlpage.'/index?sch_budget_year='.@$budget_year);
	}
	function chain_indicator()
	{
		if(!empty($_GET['sch_budget_year']))
			{	$qry = "SELECT ID, INDICATOR_NAME  AS TEXT FROM MDS_SET_INDICATOR WHERE BUDGET_YEAR = '".$_GET['sch_budget_year']."'";
				$course = $this->indicator->get($qry);
				
				$rs = '<option value=\'\'>--กรุณาเลือก--</option>';
				foreach($course as $tmp){
					$selected = '';
					if(@$_GET['sch_indicator_id'] == $tmp['id']){
						$selected=' selected="selected"';
					}
					 $rs .= "<option value='".$tmp['id']."' ".$selected.">".$tmp['text']."</option>"; 
				}
				 
			} else {
				$rs = '<option value=\'\'>--กรุณาเลือกปีงบประมาณ--</option';
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
}
?>