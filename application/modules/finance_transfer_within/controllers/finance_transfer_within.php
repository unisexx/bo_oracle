<?php
class Finance_transfer_within extends Finance_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fn_transfer_within_model','transfer_within');
		$this->load->model('fn_transfer_within_detail_model','transfer_within_detail');
		$this->load->model('finance_budget_plan/fn_budget_plan_model','fn_strategy');
		$this->load->model('finance_budget_plan/fn_budget_master_model','budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');		
		$this->load->model('finance_budget_plan/fn_budget_plan_model','fn_strategy');
		$this->load->model('finance_budget_plan/fn_budget_type_detail_model','budget_type_detail');
		$this->load->model('finance_cost_related/fn_cost_related_model','fcr');
		$this->load->model('finance_cost_related/fn_cost_related_detail_model','fcr_detail');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');	
	}
	
	function index()
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = "";
		$condition .= @$_GET['documentno']!="" ? " AND transferappno LIKE '%".$_GET['documentno']."%'": "";
		$condition .= @$_GET['pdepartment_id'] > 0 ? " AND departmentid=".$_GET['pdepartment_id']: "";			
		$condition .= @$_GET['pdivision_id'] > 0 ? " AND divisionid=".$_GET['pdivision_id']: "";
		$condition .= @$_GET['pworkgroup_id'] > 0 ? " AND workgroupid=".$_GET['pworkgroup_id']: "";
		$s_date=(@$_GET['datestart'])?strtotime((date_to_mysql(@$_GET['datestart'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['dateend'])?strtotime((date_to_mysql(@$_GET['dateend'],TRUE))." 23:59:59"):"9999999999";
		$condition .= " and(transfer_date between ".$s_date." and ".$e_date.")";
		
		$data['result'] =$this->transfer_within->where(" 1=1 ".$condition)->get();
		$data['pagination']=$this->transfer_within->pagination();
		$this->template->build('finance_transfer_within_index',$data);		
	}
	function form($id=FALSE)
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['id']=$id;
		$data['rs'] = $this->transfer_within->get_row($id);
		if($id > 0 )
		{
			$cost = $this->fcr->get_row($data['rs']['fn_cost_related_id']);
			$data['cost'] = $cost;						
			$data['budgetyear'] = $cost['budgetyear'];
			$data['budgetplantype'] = $this->fn_strategy->get_row($cost['budgetplantype']);
			$data['budgetyeartype'] = $this->fn_strategy->get_row($cost['budgetyeartype']);
			$data['department'] = $this->department->get_row($cost['departmentid']);
			$data['division'] = $this->division->get_row($cost['divisionid']);
			$data['workgroup'] =$this->workgroup->get_row($cost['workgroupid']);
			$data['plan'] = $this->fn_strategy->get_row($cost['planid']);
			$data['productivity'] = $this->fn_strategy->get_row($cost['productivityid']);
			$data['mainact'] = $this->fn_strategy->get_row($cost['mainactid']);
			$data['subact'] = $this->fn_strategy->get_row($cost['subactivityid']);
			$data['project'] = $this->budget_master->get_row($cost['projectid']);			
			$budget_type = $this->budget_type->where("PID=0")->get(FALSE,TRUE);		
			
			$data['budget_detail'] = $this->transfer_within_detail->where("pid=".$id)->get(FALSE,TRUE);
		}	
		$this->template->build('finance_transfer_within_form',$data);
	}
	function save($id=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			$_POST['ID']= $id > 0 ? $id : 0 ;
			$_POST['gf_gen_date']=($_POST['gf_gen_date']!="")? th_to_stamp($_POST['gf_gen_date']):0;
			$_POST['gf_dgen_date']=($_POST['gf_dgen_date']!="")? th_to_stamp($_POST['gf_dgen_date']):0;
			$_POST['transfer_date']=($_POST['transfer_date']!="")? th_to_stamp($_POST['transfer_date']):0;
			
			$pid = $this->transfer_within->save($_POST);
			
			$this->transfer_within_detail->delete('pid',$pid);
			if(isset($_POST['pbudgettypeid'])){
				foreach($_POST['pbudgettypeid'] as $key=>$item){
					if($_POST['pbudgettypeid'][$key]){
						$this->transfer_within_detail->save(array(
							'pid'=>$pid,
							'pbudgettypeid'=>$_POST['pbudgettypeid'][$key],
							'pexpensetypeid'=>$_POST['pexpensetypeid'][$key],
							'rbudgettypeid'=>$_POST['rbudgettypeid'][$key],
							'rexpensetypeid'=>$_POST['rexpensetypeid'][$key],
							'transfer_commit'=>$_POST['pcharge'][$key]							
						));
					}
				}	
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_transfer_within/index'.$url_parameter);
	}
	function delete($id=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id){
			$this->transfer_within->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('finance_transfer_within/index'.$url_parameter);
	}

	function get_subactivity_summary(){
		//$this->db->debug=true;
		$cost_id = $_POST['cost_id'];
		$subactivityID = @$_POST['subactivityid'] > 0 ?$_POST['subactivityid'] : 0;
		$workgroupID = @$_POST['workgroupid'] > 0 ? $_POST['workgroupid'] : 0;		
		$expensetypeID = @$_POST['expensetype'] > 0 ? $_POST['expensetype'] : 0;
		$budgettypeID = @$_POST['budgettypeid']>0 ? $_POST['budgettypeid'] : 0 ;
		$current_id =@$_POST['id']>0 ? $_POST['id'] :0;
		$summary = 0;
		if($expensetypeID>0){
		$sql = " SELECT BUDGET_COMMIT FROM
		FN_COST_RELATED_DETAIL WHERE BUDGETTYPE_ID=".$expensetypeID." AND FN_COST_RELATED_ID=".$cost_id;				
		$summary = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPE_ID=".$expensetypeID;
		$bg_change = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND REXPENSETYPE_ID=".$expensetypeID;		
		$bg_change_receive = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPE_ID=".$expensetypeID;
		$bg_transfer = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPEID=".$expensetypeID;
		$sql.= $current_id >0 ? " AND FT.ID <> ".$current_id : "";
		$bg_within = $this->db->getone($sql);
		
		//อนุมัติเบิก
		$sql = " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW FA LEFT JOIN FN_APPROVE_WITHDRAW_DETAIL FAD
		ON FA.ID = FAD.PID WHERE COSTID=".$cost_id." AND EXPENSETYPE_ID=".$expensetypeID;
		$bg_withdraw = $this->db->getone($sql);	
		
		$summary = $summary - ($bg_change + $bg_transfer + $bg_within + $bg_withdraw)+$bg_change_receive;
				
		}
				
		echo '<input type="hidden" name="hdsummary" id="hdsummary" value="'.number_format($summary,2).'">';
		echo number_format($summary,2);
	}
}
?>