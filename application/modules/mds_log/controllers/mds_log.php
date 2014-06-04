<?php
class mds_log extends Mdevsys_Controller
{
	public $modules_name = "c_log";
	public $modules_title = "ประวัติการใช้งาน";
	function __construct()
	{
		parent::__construct();
		$this->load->model('mds_log/mds_log_model','mds_log');
		
	}
	
	function index()
	{
		//$this->db->debug = true;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$condition = " 1=1 AND MODULE_NAME LIKE 'mds%'";
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
		
		$data['result']= $this->mds_log->where($condition)->order_by('process_date','desc')->get();
		$data['pagination'] = $this->mds_log->pagination();
		$pos = strrpos($_SERVER['REQUEST_URI'],'?');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		
		$data['nrow'] = $this->mds_log->select("count(*)")->where($condition)->get_one();
		
		$this->template->build('index',$data);		
	}
	
}
?>