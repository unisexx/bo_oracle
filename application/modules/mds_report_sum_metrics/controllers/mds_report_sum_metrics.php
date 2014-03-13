<?php
Class Mds_report_sum_metrics extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/Mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/Mds_set_metrics_model','metrics');
		$this->load->model('mds_set_indicator/Mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/Mds_set_metrics_keyer_model','keyer');
		$this->load->model('mds_indicator/Mds_metrics_result_model','metrics_result');
		$this->load->model('mds_indicator/Mds_metrics_document_model','doc');
		$this->load->model('mds_indicator/Mds_metrics_result_status_model','result_status');
		$this->load->model('mds_set_score/Mds_set_score_model','score');
		/*
		if(is_permit(login_data('id'),'1') == ''){
			 set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds"); // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		}
		 * 
		 */
	}
	
	public $urlpage = "mds_report_sum_metrics";
	public $modules_name = "mds_report_sum_metrics";
	public $modules_title = " รายงานสรุปรายละเอียดตัวชี้วัด";
	
	function index($mode=false){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		
		$condition = " 1=1 ";
		$condition_join = '';
		if(@$_GET['sch_budget_year'] != '' && $_GET['sch_round_month'] != ''){
			$condition .= " and mds_set_indicator.budget_year = '".@$_GET['sch_budget_year']."' and mds_set_metrics.metrics_start <= '".$_GET['sch_round_month']."' ";
		}
	
		$sql = "select distinct mds_set_indicator.* 
				from mds_set_indicator
				join mds_set_metrics on mds_set_indicator.id = mds_set_metrics.mds_set_indicator_id
				where $condition order by  mds_set_indicator.indicator_on asc";
		
		$data['rs'] = $this->metrics->get($sql,'true');
		
		switch($mode){
			case 'export':
				header('Content-type:application/xls');
				$filename= "mds_report_sum_metrics_".date("Y-m-d_H_i_s").".xls";
				header("Content-Disposition: attachment; filename=".$filename);
				$this->load->view('export',@$data);
			break;
			case 'print':
				$this->load->view('print',@$data);
			break;
			default:
				$this->template->build('index',@$data);
			break;
		}
		
		

	}
}
?>