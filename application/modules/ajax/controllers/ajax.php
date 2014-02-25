<?php
header("content-type: application/x-javascript; charset=UTF-8");
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

	function ajax_productivity_list()
	{ $year = !empty($_GET['year']) ? $_GET['year']:0;
		if($_GET['type']=="productivity"){
			$where = " PRODUCTIVITYID = 0 AND SECTIONSTRATEGYID > 0 AND SYEAR=".$year;
			$text = "เลือกผลผลิต";
			$name= 'productivity';

		}
		else if($_GET['type']=="productivity1"){
			$where = " PRODUCTIVITYID < 1 AND SECTIONSTRATEGYID > 0 AND SYEAR=".$year;
			$text = "เลือกผลผลิต";
			$name= 'productivity';
		}else if($_GET['type']=="main"){
			$condition = (!empty($_GET['productivity'])) ? " AND BUDGETPOLICYID > 0 AND PRODUCTIVITYID=".$_GET['productivity'] : " AND BUDGETPOLICYID > 0 ";
			$where = " MAINACTID = 0 $condition AND SYEAR=".$year;
			$text = "เลือกกิจกรรมหลัก";
			$name= "mainactivity";
		}else if($_GET['type']=="main1"){
		   $where = " MAINACTID < 1 AND BUDGETPOLICYID > 0  AND SYEAR=".$year;
		   $where .= (!empty($_GET['productivity'])  && $_GET['productivity'] >0) ? " AND PRODUCTIVITYID=".$_GET['productivity'] : "";
		   $text = "เลือกกิจกรรมหลัก";
		   $name= "mainactivity";
		}else if($_GET['type']=="sub"){
			$condition = (!empty($_GET['productivity'])) ? " AND PRODUCTIVITYID=".$_GET['productivity'] : " AND BUDGETPOLICYID > 0 ";
			$condition .= (!empty($_GET['mainactivity'])) ? " AND MAINACTID=".$_GET['mainactivity'] : " AND MAINACTID > 0 ";
			$condition .= (!empty($_GET['missiontype'])) ? " AND MISSIONTYPE='".trim($_GET['missiontype'])."' ": "";
			$where = " syear=".$year.$condition;
			$text = "เลือกกิจกรรมย่อย";
			$name = "subactivity";
		}else if($_GET['type']=="sub1"){
			$where  =" MAINACTID > 0 AND SYEAR=".$year;
			if(!empty($_GET['productivity'])) {$where .= " AND PRODUCTIVITYID=".$_GET['productivity'];}
			if(!empty($_GET['mainactivity'])) {$where .= " AND MAINACTID=".$_GET['mainactivity'];}

			$text = "เลือกกิจกรรมย่อย";
			$name = "subactivity";
		}
		$extra = 'id ="'.$name.'"';
		$CI =& get_instance();
	 	$CI->load->model('cnf_strategy_model','cnf_strategy');
		$sql = "select id,title from cnf_strategy where $where";
		//echo $sql;
		$result = $CI->cnf_strategy->get($sql);
		echo '<select name="'.$name.'" id="'.$name.'">';
		echo '<option value="0">'.$text.'</optionv>';
		foreach($result as $key =>$item){
			echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
		}
		echo '</select>';
	}
	function ajax_province_list()
	{
		$CI =& get_instance();
		$CI->load->model('c_province/province_model','province');
		$condition = "WHERE 1=1 ";
		$condition .= !empty($_GET['zone']) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$_GET['zone']."' " : "";
		$sql = "SELECT DISTINCT CNF_PROVINCE.* FROM CNF_PROVINCE  LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID  = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID $condition ORDER BY TITLE ";
		$result = $CI->province->get($sql,true);
		echo '<select name="province" id="province">';
		echo '<option value="">เลือกจังหวัด</option>';
		foreach($result as $item){
			echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
		}
		echo '</select>';
	}
	function ajax_section_list()
	{// หน่วยงาน
		$CI =& get_instance();
		$CI->load->model('c_division/division_model','division');
		$condition = " WHERE 1=1 ";
		$condition .= (!empty($_GET['zone'])) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$_GET['zone']."' " : "";
		$condition .= (!empty($_GET['province'])) ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$sql = "SELECT DISTINCT CNF_DIVISION.*  FROM CNF_DIVISION
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID  = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID $condition ORDER BY CNF_DIVISION.TITLE ";
		echo $sql;
		$result = $CI->division->get($sql,true);
		echo '<select name="division" id="division">';
		echo '<option value="">เลือกหน่วยงาน</option>';
		foreach($result as $item){
			echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
		}
		echo '</select>';
	}
	function ajax_workgroup_list()
	{// กลุ่มงาน
		$CI =& get_instance();
		$CI->load->model('c_workgroup/workgroup_model','workgroup');
		$condition = " WHERE 1=1 ";
		$condition .= (!empty($_GET['zone'])) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$_GET['zone']."' " : "";
		$condition .= (!empty($_GET['province'])) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($_GET['section'])) ? " AND CNF_WORKGROUP.DIVISIONID=".$_GET['section']." " : "";
		$sql = "SELECT  DISTINCT CNF_WORKGROUP.* FROM CNF_WORKGROUP
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID  =  CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID  = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID $condition ORDER BY TITLE ";
		//echo $sql;
		$result = $CI->workgroup->get($sql,true);
		echo '<select id="workgroup" name="workgroup">';
    	echo '<option value="0">เลือกกลุ่มงาน</option>';
		foreach($result as $srow){
        	echo '<option value="'.$srow["id"].'">'.$srow['title'].'</option>';
		}
        echo '</select>';
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