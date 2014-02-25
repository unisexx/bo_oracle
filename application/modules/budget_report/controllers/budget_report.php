<?php
class budget_report extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_zone/province_zone_model','pzone');
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('budget_request/budget_type_detail_model','budget_type_detail');
		$this->load->model('budget_request/budget_master_model','budget_master');
		$this->load->model('budget_request/budget_operation_area_model','budget_operation_area');
		$this->load->model('budget_request/budget_master_model','budget_master');
		$this->load->model('budget_productivity_key_model','budget_product');
		$this->load->model('cnf_strategy_model','cnf_strategy');
		$this->load->model('cnf_strategy_detail_model','cnf_strategy_detail');
		$this->load->model('cnf_budget_type_model','cnf_budget_type');
	}
	public function index($index=FALSE,$export=FALSE)
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['year'] = (!empty($_GET['year'])) ? $_GET['year'] : date('Y');
		$data['thyear'] = $data['year'] + 543;
		if($index=="6"){
			$data['step'] = (!empty($_GET['step'])) ? $_GET['step']:'1';
		}else{
			$data['step'] = (!empty($_GET['step'])) ? $_GET['step']:'';
		}

		$data['productivity'] = (!empty($_GET['productivity'])) ? $_GET['productivity']:'';
		$data['mainactivity'] = (!empty($_GET['mainactivity'])) ? $_GET['mainactivity']:'';
		$data['subactivity']  = (!empty($_GET['subactivity']))  ? $_GET['subactivity'] :'';
		$data['missionType'] = (!empty($_GET['missiontype'])) ? $_GET['missiontype']:'';
		if(!empty($_GET['division'])){
			$data['division'] = $_GET['division'];
			$data['userSection'] = $_GET['division'];
			$data['division_name'] = $this->division->get_one('title','id',$_GET['division']);
		}else{
			$data['division'] = "";
			$data['userSection'] = "";
			$data['division_name'] = "ทั้งหมด";
		}
		if(!empty($_GET['workgroup'])){
			$data['workgroup'] = $_GET['workgroup'];
			$data['userWorkgroup'] =  $_GET['workgroup'] ;
			$data['workgroup_name'] = $this->workgroup->get_one('title','id',$_GET['workgroup']);
		}else{
			$data['workgroup'] = '';$data['userWorkgroup'] ="";
			$data['workgroup_name'] = 'ทั้งหมด';
		}

		if(!empty($_GET['pzone'])){
			$data['pzone'] = $_GET['pzone'];
			$data['provinceZone'] = $this->pzone->get_one("title",'id',$_GET['pzone']);
		}else{
			$data['pzone']="";
			$data['provinceZone'] = "ทั้งหมด";
		}
		if(!empty($_GET['province'])){
			$data['province'] = $_GET['province'];
			$data['provinceName'] = $this->province->get_one('title','id',$_GET['province']);
		}else{
			$data['province'] ="";
			$data['provinceName'] = "ทั้งหมด";

		}
		if(!empty($_GET['pgroup'])){
			$data['pgroup'] = $_GET['pgroup'];
			$data['provinceGroup']  = $this->pzone->get_one("title","zone_type_id=3 and id ",$_GET['pgroup']);
		}else{
			$data['pgroup'] ="";
			$data['provinceGroup'] = "ทั้งหมด";
		}

		if($export)
		{
			$this->template->set_layout('export');
			$this->template->build('report_'.$index.'/export',$data);
			header("Content-Type: application/vnd.ms-excel");
			switch($index){
				case "3":
					$filename = "รายงานแผนการใช้จ่ายงบประมาณจำแนกตามรายจ่ายประจำปีงบประมาณ".$data['thyear'].".xls";break;
				case "5":
					$filename = "รายงานแผนการจัดสรรงบประมาณไปจังหวัดประจำปี".$data['thyear'].".xls";break;
				case "6":
					$filename = "รายงานตารางแสดงคำของบประมาณระดับโครงการ ปี ".$data['thyear'].".xls";break;
				case "8":
					$filename = "รายงานตารางแสดงคำของบประมาณระดับโครงการ ปี".$data['thyear'].".xls";break;
				case "9":
					$filename = "รายงานแผนงบประมาณรายจ่าย ประจำปีงบประมาณ".$data['thyear'].".xls";break;
				case "10":
					$filename = "รายงานการประมาณการรายจ่ายล่วงหน้าระยะปานกลาง ปีงบประมาณ".$data['thyear'].".xls";break;
			}
			header('Content-Disposition: attachment; filename="'.$filename.'"');

		}else{
			$this->template->build('report_'.$index.'/index',$data);
		}
	}
	function test(){
		$this->db->debug = true;
		$result = $this->budget_type->select("count(*) as cnt,*")->where("PID=0")->get()->order_by('',"orderno");
		//select("mainactid,productivityid,trim(TRAILING ' ' from title) as title")->get_row(232);
		var_dump($subactivityData);
		/*$where = " PRODUCTIVITYID = 0 AND SECTIONSTRATEGYID > 0 AND SYEAR=2013";
		$text = "เลือกผลผลิต";
		$name= 'productivity';
		$extra = 'id ="'.$name.'"';
		$sql = "select id,title from cnf_strategy where $where";
		$result = $this->cnf_strategy->get($sql);
		var_dump($result);
		echo '<select name="'.$name.'" id="'.$name.'">';
		echo '<option value="0">'.$text.'</optionv>';
		foreach($result as $key =>$item){
			echo '<option value="'.$item['id'].'">'.$item['title'].'</option>';
		}
		echo '</select>';
		$result = $this->cnf_strategy->get_row(231);
		var_dump($result);
		$rs = $this->cnf_strategy->where("id =231")->get();
		var_dump($rs);
		$res = $this->division->get();
		var_dump($res);
		$test = $this->cnf_strategy->get();
		var_dump($test);*/
	}


}
?>