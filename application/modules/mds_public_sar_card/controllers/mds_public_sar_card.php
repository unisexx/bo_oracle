<?php
Class Mds_public_sar_card extends  Mdevsys_Controller{
	
		
	
	function __construct(){
		parent::__construct();
		$this->load->model('mds_set_indicator/mds_set_indicator_model','indicator');
		$this->load->model('mds_set_indicator/mds_set_metrics_model','metrics');
		$this->load->model('mds_set_indicator/mds_set_metrics_kpr_model','kpr');
		$this->load->model('mds_set_indicator/mds_set_metrics_keyer_model','keyer');
		$this->load->model('mds_indicator/mds_metrics_result_model','metrics_result');
		$this->load->model('mds_indicator/mds_metrics_document_model','doc');
		$this->load->model('mds_indicator/mds_metrics_result_status_model','result_status');
		$this->load->model('mds_set_score/mds_set_score_model','score');
		
		/*
		if(is_permit(login_data('id'),'1') == ''){
			 set_notify('error', 'ท่านไม่มีสิทธิ์ในการใช้งาน'); redirect("mds"); // ตรวจสอบว่ามีสิทธิ์ การใช่งาน หรือไม่
		}
		 * 
		 */
	}
	
	public $urlpage = "mds_sar_card";
	public $modules_name = "mds_sar_card";
	public $modules_title = " SAR Card หน่วยงาน";
	
	function index($mode=false){
		$data['urlpage'] = $this->urlpage;	
		$condition = " 1=1 ";
		$condition_join = '';
		if(@$_GET['sch_budget_year'] != ''){
			$condition .= " and mds_set_indicator.budget_year = '".@$_GET['sch_budget_year']."' ";
		}
	
		 $sql = "select mds_set_indicator.* 
				from mds_set_indicator
				where $condition order by  mds_set_indicator.indicator_on asc";
		
		$data['rs'] = $this->metrics->get($sql,'true');
		$this->template->set_layout('public_layout')->build('loop_index',@$data);
	}
}
?>