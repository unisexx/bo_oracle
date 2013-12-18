<?php
class c_log extends Admin_Controller
{
	public $modules_name = "c_log";
	public $modules_title = "ประวัติการใช้งาน";
	function __construct()
	{
		parent::__construct();
		$this->load->model('c_log_model','clog');
		$this->load->model('c_province/province_model','province');			
	}
	
	function index()
	{
		//$this->db->debug = true;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$condition = " 1=1 ";
		$condition .= @$_GET['txtsearch']!="" ? " AND ( varchar(action) LIKE '%".$_GET['txtsearch']."%' OR users.name LIKE '%".$_GET['txtsearch']."%' ) " : "";
		$condition .= @$_GET['actiontype']!="" ? " AND actiontype='".$_GET['actiontype']."' " : ""; 
		$condition .= @$_GET['system']!="" ? " AND module_name like '".$_GET['system']."%' " : "";
		
		if(@$_GET['start_date']!='' && @$_GET['end_date']!='')
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");		
			$condition .= " AND PROCESS_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
		
		
		$data['per_export_set'] = 10000;
		
		$data['result']= $this->clog->where($condition)->order_by('process_date','desc')->get();
		$data['pagination'] = $this->clog->pagination();
		$pos = strrpos($_SERVER['REQUEST_URI'],'?');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		
		$data['nrow'] = $this->clog->select("count(*)")->where($condition)->get_one();
		
		$this->template->build('index',$data);		
	}
	
	function export(){
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$condition = " 1=1 ";
		$condition .= @$_GET['txtsearch']!="" ? " AND ( varchar(action) LIKE '%".$_GET['txtsearch']."%' OR users.name LIKE '%".$_GET['txtsearch']."%' ) " : "";
		$condition .= @$_GET['actiontype']!="" ? " AND actiontype='".$_GET['actiontype']."' " : ""; 
		$condition .= @$_GET['system']!="" ? " AND module_name like '".$_GET['system']."%' " : "";
		
		if(@$_GET['start_date']!='' && @$_GET['end_date']!='')
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");		
			$condition .= " AND PROCESS_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
		
		switch(@$_GET['system']){
			case 'c':
				$data['system_name'] = 'ข้อมูล Backoffice';
			break;
			case 'budget':
				$data['system_name'] = 'ระบบจัดทำคำของบประมาณ';
			break;
			case 'finance':
				$data['system_name'] = 'ระบบการคลัง';
			break;
			case 'monitor':
				$data['system_name'] = 'ระบบติดตามและประเมินผล';
			break;
			case 'inspect':
				$data['system_name'] = 'ระบบตรวจราชการ';
			break;
			default:
				$data['system_name'] = '';
			break;
		}
		
		$per_export_set = 10000;
		$data['perpage'] = $per_export_set;
		$data['result']= $this->clog->where($condition)->order_by('process_date','desc')->limit($per_export_set)->get();
		$data['pagination'] = $this->clog->pagination();			
		
		$filename= "export_logfile_".date("Y-m-d_H_i_s").".xls";
		header("Content-Disposition: attachment; filename=".$filename);  					
		$this->load->view('export',$data);		
	}

	function loging_report(){
		$data['province'] = $this->province->order_by('title','asc')->get(false,true);
		$this->template->build('loging_report',$data);
	}
}
?>