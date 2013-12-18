<?php		
class Monitor_questionair_total_report extends Monitor_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('monitor_questionair/monitor_questionair_model','monitor_questionair');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');		
		//$this->load->model('finance_budget_plan/Fn_budget_type_model','fn_budget_type');
		$this->load->model('c_province/province_model','province');		
	}
	
	function index()
	{
		//$this->db->debug= true;
		$data='';
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['pprovince_id'];
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = "";		
		if(@$_GET['start_date']!='' && @$_GET['end_date']!='')
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");		
			$condition = " AND CREATE_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
		$condition .= @$_GET['pprovince_id'] != '' ? "  AND PROVINCEID <> 2  AND PROVINCEID > 0 AND PROVINCEID=".@$_GET['pprovince_id'] : " AND PROVINCEID <> 2  AND PROVINCEID > 0 ";
		$province_condition = @$_GET['pprovince_id'] != '' ? "  ID <> 2  AND ID > 0 AND ID=".@$_GET['pprovince_id'] : " ID <> 2  AND ID > 0 " ; 
		$sql = " SELECT COUNT(*) 
		FROM MT_QUESTIONAIR 
		 
		WHERE 1=1 ".$condition;
		$data['nrecord'] = $this->db->getone($sql);
		
		$data['province'] = $this->province->get_row(@$_GET['pprovince_id']);
		
		$data['province_list'] = $this->province->where($province_condition)->order_by('title','asc')->get(FALSE,TRUE);
		/*
		$sql = " SELECT DISTINCT GUIDE FROM (SELECT VARCHAR(GUIDE)GUIDE  FROM MT_QUESTIONAIR WHERE 1=1".$condition." ) WHERE GUIDE <> '' ORDER BY GUIDE ";
		$data['remark'] = $this->monitor_questionair->get($sql,TRUE);
		*/	
		$this->template->build('index',$data);		
	}
	
	function print_page(){
	$data='';
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['pprovince_id'];
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = "";		
		if(@$_GET['start_date']!='' && @$_GET['end_date']!='')
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");		
			$condition = " AND CREATE_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
		$condition .= @$_GET['pprovince_id'] != '' ? "  AND PROVINCEID <> 2  AND PROVINCEID > 0 AND PROVINCEID=".@$_GET['pprovince_id'] : " AND PROVINCEID <> 2  AND PROVINCEID > 0 ";
		$province_condition = @$_GET['pprovince_id'] != '' ? "  ID <> 2  AND ID > 0 AND ID=".@$_GET['pprovince_id'] : " ID <> 2  AND ID > 0 " ; 
		$sql = " SELECT COUNT(*) 
		FROM MT_QUESTIONAIR 
		 
		WHERE 1=1 ".$condition;
		$data['nrecord'] = $this->db->getone($sql);
		
		$data['province'] = $this->province->get_row(@$_GET['pprovince_id']);
		$data['province_list'] = $this->province->where($province_condition)->order_by('title','asc')->get(FALSE,TRUE);
				
		$this->load->view('print',$data);	
	}
	
	function export(){
		  			
	$data='';
		$data['start_date'] = @$_GET['start_date'];
		$data['end_date'] = @$_GET['end_date'];
		$data['provinceid'] = @$_GET['pprovince_id'];
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = "";		
		if(@$_GET['start_date']!='' && @$_GET['end_date']!='')
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");		
			$condition = " AND CREATE_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
		$condition .= @$_GET['pprovince_id'] != '' ? "  AND PROVINCEID <> 2  AND PROVINCEID > 0 AND PROVINCEID=".@$_GET['pprovince_id'] : " AND PROVINCEID <> 2  AND PROVINCEID > 0 ";
		$province_condition = @$_GET['pprovince_id'] != '' ? "  ID <> 2  AND ID > 0 AND ID=".@$_GET['pprovince_id'] : " ID <> 2  AND ID > 0 " ; 
		$sql = " SELECT COUNT(*) 
		FROM MT_QUESTIONAIR 
		 
		WHERE 1=1 ".$condition;
		$data['nrecord'] = $this->db->getone($sql);
		
		$data['province'] = $this->province->get_row(@$_GET['pprovince_id']);
		$data['province_list'] = $this->province->where($province_condition)->order_by('title','asc')->get(FALSE,TRUE);
		$filename= "export_questionair".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);		
		$this->load->view('print',$data);	
	}
}