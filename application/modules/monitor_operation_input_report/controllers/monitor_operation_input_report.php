<?php		
class Monitor_operation_input_report extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitor_operation_withdraw/mt_project_withdraw_model','mt_project_withdraw');
		$this->load->model('monitor_operation_withdraw/mt_project_withdraw_detail_model','mt_project_withdraw_detail');
		$this->load->model('monitor_operation_withdraw/mt_project_withdraw_history_model','mt_project_withdraw_history');
		$this->load->model('monitor_budget_plan/mt_budget_plan_model','mt_strategy');
		$this->load->model('monitor_budget_plan/mt_strategy_key_model','mt_strategy_key');
		$this->load->model('monitor_budget_plan/mt_project_model','mt_project');
		$this->load->model('monitor_budget_plan/mt_project_detail_model','mt_project_detail');		
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_province/province_model','province');				
	}
	
	function index()
	{
		//$this->db->debug= true;
		$data='';
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] >0? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : ""; 
		$this->template->build('index',$data);		
	}	
	
	function print_page(){
		$data='';
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] > 0 ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] >0 ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] > 0 ? $this->province->get_row($_GET['pprovince_id']) : ""; 
		$this->load->view('print',$data);		
	}
	
	function export(){
		$data='';
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] > 0 ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id']>0  ? $this->province->get_row($_GET['pprovince_id']) : "";
		$filename= "export_input_report_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);		 
		$this->load->view('print',$data);		
	}
}