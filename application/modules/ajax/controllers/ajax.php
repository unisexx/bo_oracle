<?php
class ajax extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('c_workgroup/workgroup_model','workgroup');		
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_province/province_model','province');				
		$this->load->model('finance_budget_plan/fn_budget_type_model','fn_budget_type');
		$this->load->model('c_user/user_model','user');
	}

	function load_department_list($controlname="department_id")
	{
		//$this->db->debug = true;		
			$controlname = @$_POST['controlname'] != '' ? $_POST['controlname'] : "";			
			$select_data = @$_POST['select_data'];					
			$can_access_all = $_POST['canaccessall'];
			$condition =" 1=1 ";
			$condition .= @$_POST['condition'] !='' ? " AND ".$_POST['condition'] : "";
			$condition .= $can_access_all == "on" ? "" : " AND id=".login_data('departmentid');
			echo form_dropdown($controlname,get_option('id','title','cnf_department',$condition),$select_data,'','-- เลือกกรม --','0');
				
	}
	
	function load_division_list($controlname="division_id")
	{
		
			$controlname = @$_POST['controlname'] != '' ? $_POST['controlname'] : "";	
			$department = @$_POST['departmentid'];			
			$select_data = @$_POST['select_data'];					
			$can_access_all = @$_POST['canaccessall'];
			$condition =" 1=1 ";
			$condition .= @$_POST['condition']!='' ? " AND ".$_POST['condition'] : "";			
			$condition .= $department > 0 ? " AND departmentid=".$department : "";
			$condition .= $can_access_all == "on" ? "" : " AND id=".login_data('divisionid');
			
			echo form_dropdown($controlname,get_option('id','title','cnf_division',$condition),$select_data,'','-- เลือกหน่วยงาน --','0');
				
	}
	
	function load_workgroup_list($controlname="workgroup_id")
	{			
			$controlname = @$_POST['controlname'] != '' ? $_POST['controlname'] : $controlname;	
			$division = @$_POST['divisionid'];			
			$select_data = @$_POST['select_data'];
			$can_access_all = @$_POST['canaccessall'];
			$condition =" 1=1 ";
			$condition .= $can_access_all == "on" ? "" : " and id=".login_data('workgroupid');
			$condition .= $division > 0 ? " AND divisionid=".$division : "";
			echo form_dropdown('workgroupid',get_option('id','title','cnf_workgroup',$condition),$select_data,'','-- เลือกกลุ่มงาน --','0');
		}
	

	function mt_load_productivity(){
		$control_name = @$_POST['control_name']!='' ? $_POST['control_name'] : "productivityid";
		$mtyear = @$_POST['bg_year'];
		$departmentid = @$_POST['department_id'];
		$divisionid = @$_POST['divisionid'];
		
			
		$sql = "SELECT count(*) FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
		$sql .= $divisionid > 0 ? " AND DIVISIONID=".$divisionid : "";
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		$sql .=")";
		$nrow = $this->db->getarray($sql);
		
		$sql = "SELECT * FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
		$sql .= $divisionid > 0 ? " AND DIVISIONID=".$divisionid : "";
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		 $sql .=")";
				
		
		//$this->db->debug = true;
		$result = $this->db->getarray($sql);
		dbConvert($result);
				
		echo '<select name="'.$_POST['control_name'].'" id="'.$_POST['control_name'].'">';
		echo '<option value="0">--เลือกผลผลิต--</optionv>';
		if($nrow > 0){
			foreach($result as $item):
				echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
			endforeach;
		}
		echo '</select>';
	}

	function mt_load_mainactivity(){
		$controlname = @$_POST['controlname'] != '' ? $_POST['controlname'] : "";	
		$mtyear = @$_POST['bg_year'];
		$departmentid = @$_POST['department_id'];
		$divisionid = @$_POST['divisionid'];
		$productivityid = @$_POST['productivity_id'];			
		$condition = $_POST['productivity_id'] > 0 ? "  PID=".$_POST['productivity_id'] : "";
		echo form_dropdown($controlname,get_option("ID","TITLE","MT_STRATEGY",$condition),"","","-- เลือกกิจกรรมหลัก --","");
	}

	function mt_load_subactivity(){
		$controlname = @$_POST['control_name'] != '' ? $_POST['control_name'] : "subact_id";	
		$mtyear = @$_POST['bg_year'];
		$departmentid = @$_POST['department_id'];
		$divisionid = @$_POST['divisionid'];
		$productivityid = @$_POST['productivity_id'];
		$mainactid = @$_POST['mainact_id'];	
		$condition = $mainactid> 0 ? "  PID=".$mainactid : "";
		echo form_dropdown($controlname,get_option("ID","TITLE","MT_STRATEGY",$condition),"","","-- เลือกกิจกรรมหลัก --","");		
	}
	function mt_load_project(){
		$controlname = @$_POST['control_name'] != '' ? $_POST['control_name'] : "subact_id";
		$subactid = @$_POST['subactid'];
		$condition = @$_POST['subactid'] > 0 ? " subactid=".$subactid : "";
		echo form_dropdown($controlname,get_option("id","title","mt_project",$condition),"","","-- เลือกโครงการ --","");
	}
		
	function load_expense_type(){
		
		$budget_type_id = @$_POST['budget_type_id'];
					
		$sql = "SELECT count(*) FROM FN_BUDGET_TYPE WHERE PID=".$budget_type_id;
		$nrow = $this->db->getarray($sql);
		
		$sql = "SELECT * FROM FN_BUDGET_TYPE WHERE PID=".$budget_type_id;		 				
		
		//$this->db->debug = true;
		$result = $this->db->getarray($sql);
		dbConvert($result);
		
		echo '<select name="'.$_POST['control_name'].'" id="'.$_POST['control_name'].'">';
		echo '<option value="0">--ทุกหมวดค่าใช้จ่าย--</optionv>';
		if($nrow > 0){
			foreach($result as $item):
				echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
			endforeach;
		}
		echo '</select>';
		
	}
	function check_username(){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$patt_1 = $firstname.'.'.substr($lastname,0,1);
		$patt_2 = $firstname.'.'.substr($lastname,0,2);
		$nrec = $this->user->get_one("count(*)","username",$patt_1);
		$username = $nrec > 0 ? $patt_2 : $patt_1;
		echo $username;
	}	
	function check_exist_user(){
		$userid = $_POST['id'];
		$fullname = $_POST['fullname'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$patt_1 = $firstname.'.'.substr($lastname,0,1);
		$patt_2 = $firstname.'.'.substr($lastname,0,2);
		$condition = $userid > 0 ? " AND ID <> ".$userid : "";
		$nrec = $this->user->select("count(*)")->where("name ='".trim($fullname)."'".$condition)->get_one();
		$status = $nrec > 0 ? 'exist' : 'nexist';
		echo $status;
	}
}
?>