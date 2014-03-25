<?php
Class Mds_report_compare extends  Mdevsys_Controller{
	
		
	
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
	
	public $urlpage = "mds_report_compare";
	public $modules_name = "mds_report_compare";
	public $modules_title = " การเปรียบเทียบปีการประเมินผลจากตัวชี้วัด";
	
	function index($mode=false){
		$data['urlpage'] = $this->urlpage;
		if(!is_login())redirect("home");
		
		$condition = " 1=1 ";
		$condition_join = '';
		if(@$_GET['sch_budget_year'] != ''){
			$condition .= " and mds_set_indicator.budget_year = '".@$_GET['sch_budget_year']."' ";
		}
	
		 $sql = "select mds_set_indicator.* 
				from mds_set_indicator
				where $condition order by  mds_set_indicator.indicator_on asc";
		
		$data['rs'] = $this->metrics->get($sql,'true');
		
		switch($mode){
			case 'export':
				header('Content-type:application/xls');
				$filename= "mds_report_compare".date("YmdHis").".xls";
				header("Content-Disposition: attachment; filename=".$filename);
				$this->load->view('loop_export',@$data);
			break;
			case 'print':
				$this->load->view('loop_print',@$data);
			break;
			default:
				$this->template->build('loop_index',@$data);
			break;
		}
		
		

	}
}
?>