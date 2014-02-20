<?php
class budget_report_6 extends Budget_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_province/province_model','province');
		$this->load->model('c_province_zone/province_zone_model','pzone');
		$this->load->model('budget_type/budget_type_model','budget_type');
		$this->load->model('cnf_strategy_model','cnf_strategy');
		$this->load->model('budget_request/budget_operation_area_model','budget_operation_area');
	}
	public function index($export=FALSE)
	{
		//$this->db->debug = true;
		if(!is_login())redirect("home");
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['budgetyear'] = @$_GET['budgetyear'];
		$data['year'] = (!empty($_GET['year'])) ? $_GET['year'] : date('Y')-1;
		$data['thyear'] = $data['year'] + 543;
		$data['step'] = (!empty($_GET['step'])) ? $_GET['step']:'';
		$data['productivity'] = (!empty($_GET['productivity'])) ? $_GET['productivity']:'';
		$data['mainactivity'] = (!empty($_GET['mainactivity'])) ? $_GET['mainactivity']:'';
		$data['subactivity']  = (!empty($_GET['subactivity']))  ? $_GET['subactivity'] :'';

		if(!empty($_GET['division'])){
			$data['division'] = $_GET['division'];
			$data['division_name'] = $this->division->get_one('title','id',$_GET['division']);
		}else{
			$data['division'] = "";
			$data['division_name'] = "ทั้งหมด";
		}
		if(!empty($_GET['workgroup'])){
			$data['workgroup'] = $_GET['workgroup'];
			$data['workgroup_name'] = $this->workgroup->get_one('title','id',$_GET['workgroup']);
		}else{
			$data['workgroup'] = '';
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


		if($export){
			$this->template->set_layout('export');
			$this->template->build('export',$data);
			header("Content-Type: application/vnd.ms-excel");
			header('Content-Disposition: attachment; filename="รายงานแผนงบประมาณรายจ่าย ประจำปีงบประมาณ'.$data['thyear'].'.xls"');
		}else{
			$this->template->build('index',$data);
		}
	}
	function test(){
		$this->db->debug = true;
		$where = " PRODUCTIVITYID = 0 AND SECTIONSTRATEGYID > 0 AND SYEAR=2013";
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
		/*$result = $this->cnf_strategy->get_row(231);
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