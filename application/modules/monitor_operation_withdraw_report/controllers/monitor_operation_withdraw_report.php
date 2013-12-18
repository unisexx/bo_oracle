<?php		
class Monitor_operation_withdraw_report extends Monitor_Controller
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
		$data['month_value'] = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_dec'] = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] != '' ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : "";
		
		$data['select_productivity'] = $this->mt_strategy->get_row(@$_GET['pproductivity_id']);
		$data['select_mainact'] = $this->mt_strategy->get_row(@$_GET['mainact_id']);
		$data['select_subact'] = $this->mt_strategy->get_row(@$_GET['subact_id']);
		$data['select_project'] = $this->mt_project->get_row(@$_GET['project_id']);
		$data['start_month_idx'] = @$_GET['start_month_idx'];
		$data['end_month_idx'] = @$_GET['end_month_idx'];
		$select_productivity = @$_GET['pproductivity_id'];
		$mtyear = @$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		if($mtyear>0)		
			$data['productivity_list']=$this->select_productivity_list($mtyear,$departmentid,$divisionid,$provinceid,$select_productivity,TRUE);
		
		$this->template->build('index',$data);		
	}

function print_page()
	{
		//$this->db->debug= true;
		$data['month_value'] = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_dec'] = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] != '' ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : "";
		
		$data['select_productivity'] = $this->mt_strategy->get_row(@$_GET['pproductivity_id']);
		$data['select_mainact'] = $this->mt_strategy->get_row(@$_GET['mainact_id']);
		$data['select_subact'] = $this->mt_strategy->get_row(@$_GET['subact_id']);
		$data['select_project'] = $this->mt_project->get_row(@$_GET['project_id']);
		
		$data['start_month_idx'] = @$_GET['start_month_idx'];
		$data['end_month_idx'] = @$_GET['end_month_idx'];
		$select_productivity = @$_GET['pproductivity_id'];
		$mtyear = @$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		$this->load->view('print',$data);		
	}

function export()
	{
		//$this->db->debug= true;
		$data['month_value'] = array(10,11,12,1,2,3,4,5,6,7,8,9);
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['province'];		
		$data['month'] = array('ตุลาคม','พฤศจิกายน','ธันวาคม','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฏาคม','สิงหาคม','กันยายน');
		$data['month_dec'] = array('ต.ค.','พ.ย.','ธ.ค.','ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.');
		$data['month_idx'] = array('10','11','12','1','2','3','4','5','6','7','8','9');		
		$data['department'] = @$_GET['pdepartment_id'] != '' ? $this->department->get_row($_GET['pdepartment_id']) : '';
		$data['province'] = @$_GET['pprovince_id'] != '' ? $this->province->where("title <> 'กรุงเทพมหานคร' and id=".$_GET['pprovince_id'])->get(FALSE,TRUE) : $this->province->where("title <> 'กรุงเทพมหานคร'")->get(FALSE,TRUE);
		$data['province_data'] = @$_GET['pprovince_id'] != '' ? $this->province->get_row($_GET['pprovince_id']) : "";
		
		$data['select_productivity'] = $this->mt_strategy->get_row(@$_GET['pproductivity_id']);
		$data['select_mainact'] = $this->mt_strategy->get_row(@$_GET['mainact_id']);
		$data['select_subact'] = $this->mt_strategy->get_row(@$_GET['subact_id']);
		$data['select_project'] = $this->mt_project->get_row(@$_GET['project_id']);
		
		$data['start_month_idx'] = @$_GET['start_month_idx'];
		$data['end_month_idx'] = @$_GET['end_month_idx'];
		$select_productivity = @$_GET['pproductivity_id'];
		$mtyear = @$_GET['bg_year'];
		$departmentid = @$_GET['pdepartment_id'];
		$divisionid = @$_GET['pdivision_id'];		
		$provinceid = @$_GET['pprovince_id'];
		$filename= "export_report_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);			
		$this->load->view('print',$data);		
	}
	function select_productivity_list($mtyear=FALSE,$departmentid=FALSE,$divisionid=FALSE,$provinceid=FALSE,$select_productivity=FALSE,$return_list=FALSE)
	{
		if($mtyear==FALSE){
		$mtyear = @$_POST['mtyear'];
		$departmentid = @$_POST['departmentid'];
		$divisionid = @$_POST['divisionid'];
		$provinceid = @$_POST['provinceid'];
		}
		$sql = "SELECT count(*) FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT 
		LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  
		WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		
		
		$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		
		if($provinceid==2)
		{
			$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";			
			
		}
		$sql .=")";
		
		$nrow = $this->db->getone($sql);
		
		 $sql = "SELECT * FROM MT_STRATEGY
		WHERE 
		ID IN(
		SELECT PRODUCTIVITYID FROM MT_PROJECT 
		LEFT JOIN MT_BUDGET_RECORD ON MT_PROJECT.ID = MT_BUDGET_RECORD.MASTERID
		LEFT JOIN MT_STRATEGY ON MT_PROJECT.SUBACTID=MT_STRATEGY.ID  WHERE 1=1 ";
		$sql .= $mtyear > 0 ? " AND MTYEAR=".$mtyear : "";		

		$sql .= $provinceid > 0 ? " AND MT_BUDGET_RECORD.PROVINCEID=".$provinceid : "";
		$sql .= $departmentid > 0 ? " AND MT_STRATEGY.DEPARTMENTID=".$departmentid : "";
		
		if($provinceid==2)
		{
		$sql .= $divisionid > 0 ? " AND MT_BUDGET_RECORD.DIVISIONID=".$divisionid : "";				
		}
		$sql .=") ORDER BY TITLE ";
				
		//echo $sql;
		//$this->db->debug = true;
		$result = $this->db->getarray($sql);
		dbConvert($result);
		
		$data_list= '<select name="pproductivity_id" id="pproductivity_id">';
		$data_list.= '<option value="0">--เลือกผลผลิต--</optionv>';
		if($nrow > 0){
			foreach($result as $item):
				$selected = $select_productivity == $item['id'] ? 'selected="selected"' : "";
				$data_list.= '<option value="'.$item['id'].'" '.$selected.'>'.$item['title'].'</option>';
			endforeach;
		}
		$data_list.= '</select>';
		if($return_list==TRUE)
			return $data_list;
		else
			echo $data_list;

	}	
}