<?php		
class Monitor_questionair extends Monitor_Controller
{
	public $modules_name = "monitor_questionair";
	public $modules_title = "แบบสำรวจความพึงพอใจของผู้รับบริการต่อการให้บริการของ สำนักพัฒนาสังคมจังหวัด";
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitor_questionair_model','monitor_questionair');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');		
		//$this->load->model('finance_budget_plan/fn_budget_type_model','fn_budget_type');
		$this->load->model('c_province/province_model','province');		
	}
	
	function index()
	{
		if(!permission($this->modules_name,'canview'))redirect('monitor');
		$data='';			
		$this->template->build('index',$data);		
	}
	public function save(){
		//$this->db->debug = true;
		$_POST['create_by'] = login_data('id');
		$_POST['departmentid'] = login_data('departmentid');
		$_POST['divisionid'] = login_data('divisionid'); 
		$_POST['workgroupid'] = login_data('workgroupid');
		$_POST['provinceid'] = login_data('workgroup_provinceid') > 0 ? login_data('workgroup_provinceid') : login_data('division_provinceid') ; 
		$_POST['create_date'] = en_to_stamp(date("Y-m-d H:i:s"));
		$_POST['create_year'] = date("Y");
		$_POST['create_month'] = date("m");
		$_POST['create_day'] = date("d"); 
		$id = $this->monitor_questionair->save($_POST);
		$month_name = get_month();
		$month = $this->monitor_questionair->get_one("create_month","id",$id);
		$province = $this->province->get_row($_POST['provinceid']);
		new_save_logfile("ADD",$this->modules_title,$this->monitor_questionair->table,"ID",@$id,"id",$this->modules_name," ปี ".(@$_POST['create_year']+543)." เดือน ".$month_name[$month]." จังหวัด ".$province['title']);
		$this->template->build('complete');		
	}
}
?>