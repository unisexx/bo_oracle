<?php
Class Set_subplan extends  Act_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model("subplan_model","subplan");
	}
	
	function index(){
		$condition = @$_GET['search']!='' ? " and act_subplan.subplan_name like '%".$_GET['search']."%'" : "";
		$sql = "SELECT
		ACT_SUBPLAN.ID,
		ACT_SUBPLAN.SUBPLAN_NAME,
		ACT_PLAN.PLAN_NAME
		FROM
		ACT_PLAN
		INNER JOIN ACT_SUBPLAN ON ACT_PLAN.ID = ACT_SUBPLAN.PLAN_ID
		WHERE 1=1 ".$condition." order by id desc";
		$data['subplans'] = $this->subplan->get($sql,true);
		$data['pagination'] = $this->subplan->pagination();
		$this->template->build('set_subplan/index',$data);
	}
	
	function form($id=false){
		$data['subplan'] = $this->subplan->get_row($id);
		$this->template->build('set_subplan/form',$data);
	}
	
	function save(){
		if($_POST){
			$this->subplan->save($_POST);
			set_notify('success', lang('save_data_complete'));
		}
		redirect('act/set_subplan');
	}
	
	function delete($id){
		if($id){
			$this->subplan->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER["HTTP_REFERER"]);
	}
}
?>