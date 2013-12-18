<?php
class finance_approve_withdraw extends Finance_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('fn_approve_withdraw_model','withdraw');
		$this->load->model('fn_approve_withdraw_detail_model','withdraw_detail');
		$this->load->model('finance_cost_related/fn_cost_related_model','fcr');
		$this->load->model('finance_cost_related/fn_cost_related_detail_model','fcrd');
		$this->load->model('finance_budget_related/fn_budget_related_model','fbr');
		$this->load->model('finance_budget_plan/fn_budget_type_detail_model','budget_type_detail');		
		$this->load->model('finance_budget_plan/fn_budget_master_model','budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');
		$this->load->model('finance_budget_plan/fn_budget_plan_model','fn_strategy');
		$this->load->model('finance_budget_id/fn_budget_code_model','fn_budget_code');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " FN_COST_RELATED.ID NOT IN (SELECT cost_related_id FROM fn_budget_return)";
		$op_condition = '';
		$op_condition .= @$_GET['withdrawid']!='' ? " AND WITHDRAWID='".$_GET['withdrawid']."'" : "";		
		$s_date=(@$_GET['startdate'])?strtotime((date_to_mysql(@$_GET['startdate'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['enddate'])?strtotime((date_to_mysql(@$_GET['enddate'],TRUE))." 23:59:59"):"9999999999";
		$op_condition .= " and (WITHDRAWDATE between ".$s_date." and ".$e_date.")"; 	
		
		$condition .= $op_condition != '' ? " AND FN_COST_RELATED.ID IN (SELECT COSTID FROM FN_APPROVE_WITHDRAW WHERE 1=1 ".$op_condition." )" : "";
		$condition .= @$_GET['budgetyear']!='' ? " AND BUDGETYEAR=".$_GET['budgetyear'] : "";
		$condition .= @$_GET['budgetplantype']!='' ? " AND BUDGETPLANTYPE=".$_GET['budgetplantype'] : "";
		$condition .= @$_GET['budgetyeartype']!='' ? " AND BUDGETYEARTYPE=".$_GET['budgetyeartype'] : "";
		$condition .= @$_GET['departmentid'] != '' ? " AND FN_COST_RELATED.DEPARTMENTID=".$_GET['departmentid'] : "";
		$condition .= @$_GET['divisionid'] != '' ? " AND FN_COST_RELATED.DIVISIONID=".$_GET['divisionid'] : "";
		$condition .= @$_GET['workgroupid'] != '' ? " AND FN_COST_RELATED.WORKGROUPID=".$_GET['workgroupid'] : "";
		$data['dataList'] = $this->fcr->where($condition)->get();
		$data['pagination'] = $this->fcr->pagination();		
		$this->template->build('finance_approve_withdraw_index.php',$data);
	}
	function form($pid=FALSE,$id=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['pid'] = $pid;
		$data['id'] = $id;
		if($pid>0)
		{
			$projectID = $this->fcr->get_one("projectid",$pid);
			$data['parent'] = $this->fcr->get_row($pid);				
			$data['budgetList'] = $this->GetBudgetList($pid,$id,$projectID);		
			$data['budgetplantype']=$this->fn_strategy->get_row($data['parent']['budgetplantype']);
			$data['budgetyeartype']=$this->fn_strategy->get_row($data['parent']['budgetyeartype']);
			$data['plan']=$this->fn_strategy->get_row($data['parent']['planid']);
			$data['productivity']=$this->fn_strategy->get_row($data['parent']['productivityid']);
			$data['mainact']=$this->fn_strategy->get_row($data['parent']['mainactid']);
			$data['subact']=$this->fn_strategy->get_row($data['parent']['subactivityid']);
			$data['department']=$this->department->get_row($data['parent']['departmentid']);
			$data['division']=$this->division->get_row($data['parent']['divisionid']);
			$data['workgroup']=$this->workgroup->get_row($data['parent']['workgroupid']);
		}
		if($id>0)
		{
			$data['current'] = $this->withdraw->get_row($id);
		}
		$this->template->build('finance_approve_withdraw_form.php',$data);
	}
	function save($costid=FALSE,$id=FALSE){
		//$this->db->debug=true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			$withdrawdate =$_POST['withdrawdate']!=''? th_to_stamp($_POST['withdrawdate']):0;
			$budgetid = $_POST['budgetid']=='' ? 0 : $_POST['budgetid'];
			$pid = $this->withdraw->save(array(
			'id'=>$id,
			'costid'=>$costid,
			'withdrawid'=>$_POST['withdrawid'],
			'subject'=>$_POST['subject'],
			'remark'=>$_POST['remark'],
			'budgetid'=>$budgetid,
			'withdrawdate'=>$withdrawdate						
			));
			foreach($_POST['budgettypeid'] as $key=>$item){
				if($_POST['budgettypeid'][$key]){
					$this->withdraw_detail->save(array(
						'id'=>$_POST['wdDetailID'][$key],
						'pid'=>$pid,
						'budgettype_id'=>$_POST['budgettypeid'][$key],
						'expensetype_id'=>$_POST['expensetypeid'][$key],
						'withdraw'=>str_replace(',','',$_POST['withdraw'][$key])
					));
				}
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_approve_withdraw/index'.$url_parameter);
	}
	function delete($id=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		$this->withdraw->delete($id);
		$this->withdraw_detail->delete("PID",$id);
		set_notify('success', lang('delete_data_complete'));
		redirect('finance_approve_withdraw/index'.$url_parameter);		
	}
	function GetBudgetList($pid,$id,$projectID)
	{
		$dataList = '';		
		$budgettyperesult = $this->budget_type->where("PID=0")->get(FALSE,TRUE);				
		foreach($budgettyperesult as $budgettype):
		
		$budget_total = summary_expense_type($projectID,$budgettype['id'],0);
		$sql = " SELECT BUDGET_COMMIT FROM fn_cost_related_detail WHERE FN_COST_RELATED_ID=".$pid." AND BUDGETTYPE_ID=".$budgettype['id'];
		$budget_cost_net = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND PBUDGETTYPE_ID=".$budgettype['id'];
		$bg_change = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND RBUDGETTYPE_ID=".$budgettype['id'];		
		$bg_change_receive = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND FTD.PBUDGETTYPE_ID=".$budgettype['id'];
		$bg_transfer = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND FTD.PBUDGETTYPEID=".$budgettype['id'];		
		$bg_within = $this->db->getone($sql);
				
		$budget_cost_net = $budget_cost_net - ($bg_transfer + $bg_within);	
		
		$sql = "SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW FA LEFT JOIN 
		FN_APPROVE_WITHDRAW_DETAIL FAD ON FA.ID=FAD.PID WHERE BUDGETTYPE_ID =".$budgettype['id']." AND EXPENSETYPE_ID=0 AND COSTID=".$pid;
		$sql.= $id > 0 ? " AND FA.ID <> ".$id : "";
		$ex_withdraw = $this->db->getone($sql);
		$budget_cost_net=($budget_cost_net - ($ex_withdraw + $bg_change))+$bg_change_receive;
						
		if($id > 0){
		$sql = "SELECT * FROM FN_APPROVE_WITHDRAW_DETAIL WHERE PID=".$id." AND BUDGETTYPE_ID=".$budgettype['id']." AND EXPENSETYPE_ID=0";		
		$wdDetail = $this->db->getrow($sql);
		dbConvert($wdDetail);
		}
		$dataList .='<tr class="odd">';
			$dataList.='<td>'.$budgettype['title'].'</td>';
			$dataList.='<td align="center">&nbsp;</td>';  
			$dataList.='<td align="right">'.number_format(@$budget_cost_net,2).'</td>';
			$dataList.='<td align="right">
			<input type="text" name="withdraw[]" class="odd" style="border:0px" id="withdraw_'.$budgettype['id'].'" value="'.@$wdDetail['withdraw'].'" alt="decimal"">
			<input type="hidden" name="budgettypeid[]" id="budgettypeid" value="'.$budgettype['id'].'">
			<input type="hidden" name="expensetypeid[]" id="expensetypeid" value="0">
			<input type="hidden" name="wdDetailID[]" id="wdDetailID" value="'.@$wdDetail['id'].'">
			</td>';
		$dataList.='</tr>';		
			$rexpense  = $this->budget_type->where("PID=".$budgettype['id'])->get(FALSE,TRUE);						
			foreach($rexpense as $expense):
			
			$expense_total = summary_expense_type($projectID,$budgettype['id'],$expense['id']);			
			$sql = " SELECT BUDGET_COMMIT FROM fn_cost_related_detail WHERE FN_COST_RELATED_ID=".$pid." AND BUDGETTYPE_ID=".$expense['id'];
			$expense_cost_net = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND PEXPENSETYPE_ID=".$expense['id'];
			$bg_change = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND REXPENSETYPE_ID=".$expense['id'];		
			$bg_change_receive = $this->db->getone($sql);
			
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND FTD.PEXPENSETYPE_ID=".$expense['id'];
			$bg_transfer = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$pid." AND FTD.PEXPENSETYPEID=".$expense['id'];		
			$bg_within = $this->db->getone($sql);
			
			$expense_cost_net = $expense_cost_net - ($bg_transfer + $bg_within);
			
			$sql = "SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW FA LEFT JOIN 
			FN_APPROVE_WITHDRAW_DETAIL FAD ON FA.ID=FAD.PID WHERE BUDGETTYPE_ID =".$budgettype['id']." AND EXPENSETYPE_ID=".$expense['id']." AND COSTID=".$pid;
			$sql.= $id > 0 ? " AND FA.ID <> ".$id : "";
			$ex_withdraw = $this->db->getone($sql);
			$expense_cost_net=($expense_cost_net - ($ex_withdraw + $bg_change))+$bg_change_receive;
			
			if($id > 0){
			$sql = "SELECT * FROM FN_APPROVE_WITHDRAW_DETAIL WHERE PID=".$id." AND BUDGETTYPE_ID=".$budgettype['id']." AND EXPENSETYPE_ID=".$expense['id'];	
			$wdDetail = $this->db->getrow($sql);
			dbConvert($wdDetail);
			}
								 
			$dataList .='<tr>';				
				$dataList.='<td align="center">&nbsp;</td>';
				$dataList.='<td>'.$expense['title'].'</td>';  

				$dataList.='<td align="right">'.number_format(@$expense_cost_net,2).'</td>';
				$dataList.='<td align="right">				
				<input type="text" name="withdraw[]" id="withdraw_'.$expense['id'].'" value="'.@$wdDetail['withdraw'].'" alt="decimal" class="cost budget_type_'.$budgettype['id'].'" onkeyup="check_summary(\''.$expense['id'].'\',\''.$budgettype['id'].'\');">
				<input type="hidden" name="tmp_withdraw[]" id="tmp_withdraw_'.$expense['id'].'" value="'.@$wdDetail['withdraw'].'" alt="decimal" onkeyup="check_summary(\''.$expense['id'].'\');">				
				<input type="hidden" name="budgettypeid[]" id="budgettypeid" value="'.$budgettype['id'].'">
				<input type="hidden" name="expensetypeid[]" id="expensetypeid" value="'.$expense['id'].'">
				<input type="hidden" name="wdDetailID[]" id="wdDetailID" value="'.@$wdDetail['id'].'">
				<input type="hidden" name="expense_withdraw_limit_'.$expense['id'].'" id="expense_withdraw_limit_'.$expense['id'].'" value="'.number_format(@$expense_cost_net,2).'">
				</td>';
			$dataList.='</tr>';
			endforeach;
		endforeach;  
		return $dataList;
	}
}
?>