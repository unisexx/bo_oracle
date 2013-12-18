<?php
class Fund_log extends Fund_Controller
{
	public $modules_name = "fund_log";
	public $modules_title = "ประวัติการใช้งานระบบบริหารกองทุน";
	function __construct()
	{
		parent::__construct();
		$this->load->model('c_log/c_log_model','clog');			
	}
	
	function index()
	{
		//$this->db->debug = true;
		if(!permission($this->modules_name,'canview'))redirect('c_front');
		$condition = " 1=1 ";
		$condition .= @$_GET['txtsearch']!="" ? " AND ( varchar(action) LIKE '%".$_GET['txtsearch']."%' OR users.name LIKE '%".$_GET['txtsearch']."%' ) " : "";
		$condition .= @$_GET['actiontype']!="" ? " AND actiontype='".$_GET['actiontype']."' " : ""; 
		$condition .= " AND module_name like 'fund%' ";
		
		if(@$_GET['start_date']!='' && @$_GET['end_date']!='')
		{
			$s_date= strtotime((date_to_mysql(@$_GET['start_date'],TRUE))." 00:00:01");			
			$e_date= strtotime((date_to_mysql(@$_GET['end_date'],TRUE))." 23:59:59");		
			$condition .= " AND PROCESS_DATE BETWEEN ".$s_date." AND ".$e_date;
		}
		
		$data['result']= $this->clog->where($condition)->order_by('process_date','desc')->get();
		$data['pagination'] = $this->clog->pagination();
		$pos = strrpos($_SERVER['REQUEST_URI'],'?');
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$this->template->build('index',$data);		
	}
}
?>