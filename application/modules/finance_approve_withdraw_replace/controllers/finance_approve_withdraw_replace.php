<?php
class finance_approve_withdraw_replace extends Finance_Controller
{
	function __construct()
	{
		parent::__construct();		
		$this->load->model('fn_approve_withdraw_replace_model','withdraw');
		$this->load->model('fn_approve_withdraw_replace_detail_model','withdraw_detail');
		$this->load->model('finance_withdraw_replace/fn_withdraw_replace_model','withdraw_replace');
		$this->load->model('finance_withdraw_replace/fn_withdraw_replace_detail_model','withdraw_replace_detail');
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

	function index(){
		$data='';
		$data['dataList']=$this->withdraw_replace->get();
		$data['pagination'] = $this->withdraw_replace->pagination();
		$this->template->build('finance_approve_withdraw_replace_index',$data);		
	}
	function form($pid=FALSE,$id=FALSE){
		$data='';
		$data['pid']=$pid;
		$data['id']=$id;
		if($pid>0){
			$data['parent'] = $this->withdraw_replace->get_row($pid);
			$data['budgetList'] = $this->GetBudgetList($pid,$id,$data['parent']['projectid']);
			
			$data['budgetplantype'] = $this->fn_strategy->get_row($data['parent']['budgetplantype']);
			$data['budgetyeartype'] = $this->fn_strategy->get_row($data['parent']['budgetyeartype']);
			$data['plan'] = $this->fn_strategy->get_row($data['parent']['planid']);
			$data['productivity'] = $this->fn_strategy->get_row($data['parent']['productivityid']);			
			$data['mainact'] = $this->fn_strategy->get_row($data['parent']['mainactid']);
			$data['subact'] =$this->fn_strategy->get_row($data['parent']['subactivityid']);
			
			$data['department'] = $this->department->get_row($data['parent']['departmentid']);
			$data['division'] = $this->division->get_row($data['parent']['divisionid']);
			$data['workgroup'] = $this->workgroup->get_row($data['parent']['workgroupid']);
					
		}
		if($id>0)
		{
			$data['current'] = $this->withdraw->get_row($id);
		}	    
		$this->template->build('finance_approve_withdraw_replace_form',$data);
	}
	
	function save($pid=FALSE,$id=FALSE)
	{		
		if($_POST){
			$withdrawdate =$_POST['withdrawdate']!=''? th_to_stamp($_POST['withdrawdate']):0;
			$pid = $this->withdraw->save(array(
			'id'=>$id,
			'replaceid'=>$pid,
			'approveid'=>$_POST['approveid'],
			'subject'=>$_POST['subject'],
			'remark'=>$_POST['remark'],
			'budgetid'=>$_POST['budgetid'],
			'withdrawdate'=>$withdrawdate						
			));
			$this->withdraw_detail->delete($pid);
			foreach($_POST['budgettype_id'] as $key=>$item){
				if($_POST['budgettype_id'][$key]){
					$this->withdraw_detail->save(array(						
						'pid'=>$pid,
						'budgettype_id'=>$_POST['budgettype_id'][$key],
						'expensetype_id'=>$_POST['expensetype_id'][$key],
						'withdraw'=>$_POST['withdraw'][$key]
					));
				}
			}
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_approve_withdraw_replace/index');
	}
	function delete($id=FALSE){
		$this->withdraw->delete($id);
		$this->withdraw_detail->delete("PID",$id);
		set_notify('success', lang('delete_data_complete'));
		redirect('finance_approve_withdraw_replace/index');	
	}
	function GetBudgetList($pid,$id,$projectID)
	{
		$dataList = '';		
		$budgettyperesult = $this->budget_type->where("PID=0")->get(FALSE,TRUE);				
		foreach($budgettyperesult as $budgettype):
		$budget_cost_net = $this->db->getone("SELECT BUDGET_COMMIT FROM FN_WITHDRAW_REPLACE_DETAIL WHERE WITHDRAW_REPLACE_ID=".$pid." AND BUDGETTYPE_ID=".$budgettype['id']);
		if($id>0){
		$sql = "SELECT * FROM FN_APPROVE_WITHDRAW_REPLACE_DETAIL WHERE PID=".$id." AND BUDGETTYPE_ID=".$budgettype['id']." AND EXPENSETYPE_ID=0 ";		
			$wdDetail = $this->db->getrow($sql);
			dbConvert($wdDetail);
			
		$budget_wd = $this->db->getone("SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW_REPLACE FA LEFT JOIN FN_APPROVE_WITHDRAW_REPLACE_DETAIL FAD ON FA.ID=FAD.PID			
		WHERE REPLACEID=".$pid." AND FA.ID <> ".$id." AND  BUDGETTYPE_ID=".$budgettype['id']." AND EXPENSETYPE_ID=0");
		}
		else{
		$budget_wd = $this->db->getone("SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW_REPLACE FA LEFT JOIN FN_APPROVE_WITHDRAW_REPLACE_DETAIL FAD ON FA.ID=FAD.PID			
		WHERE REPLACEID=".$pid." AND  BUDGETTYPE_ID=".$budgettype['id']." AND EXPENSETYPE_ID=0");					
		}
			$budget_cost_net = $budget_cost_net - $budget_wd;
			
							
		$dataList .='<tr class="odd">';
			$dataList.='<td>'.$budgettype['title'].'</td>';
			$dataList.='<td align="center">&nbsp;</td>';  						
			$dataList.='<td align="right">'.number_format(@$budget_cost_net,2).'</td>';
			$dataList.='<td align="center">';
			$dataList.='
			<input type="text" name="withdraw[]" id="withdraw_'.$budgettype['id'].'" value="'.@$wdDetail['withdraw'].'" style="border:0" class="odd" alt="decimal">
			<input type="hidden" name="budget_limit[]" id="budget_type_limit_'.$budgettype['id'].'" value="'.number_format(@$budget_cost_net,2).'">
			<input type="hidden" name="budgettype_id[]" id="budgettype_id" value="'.$budgettype['id'].'">
			<input type="hidden" name="expensetype_id[]" id="expensetype_id" value="0">
			&nbsp;
			</td>';
		$dataList.='</tr>';		
			$rexpense  = $this->budget_type->where("PID=".$budgettype['id'])->get(FALSE,TRUE);						
			foreach($rexpense as $expense):			
			//$this->db->debug=true;
			$budget_total = $this->db->getone("SELECT BUDGET_COMMIT FROM FN_WITHDRAW_REPLACE_DETAIL WHERE WITHDRAW_REPLACE_ID=".$pid." AND EXPENSETYPE_ID=".$expense['id']);
			
			$budget_wd = 0;
																
			if($id > 0){
			$sql = "SELECT * FROM FN_APPROVE_WITHDRAW_REPLACE_DETAIL WHERE PID=".$id." AND EXPENSETYPE_ID=".$expense['id'];		
			$wdDetail = $this->db->getrow($sql);
			dbConvert($wdDetail);
			
			$budget_wd = $this->db->getone("SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW_REPLACE FA LEFT JOIN FN_APPROVE_WITHDRAW_REPLACE_DETAIL FAD ON FA.ID=FAD.PID
				WHERE REPLACEID=".$pid." AND FA.ID <> ".$id." AND  EXPENSETYPE_ID=".$expense['id']);
			}
			else{
			$sql = "SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW_REPLACE FA LEFT JOIN FN_APPROVE_WITHDRAW_REPLACE_DETAIL FAD ON FA.ID=FAD.PID
				WHERE REPLACEID=".$pid." AND EXPENSETYPE_ID=".$expense['id'];
			$budget_wd = $this->db->getone($sql);				
			}
			$budget_total = $budget_total - $budget_wd;
								 
			$dataList .='<tr>';				
				$dataList.='<td align="center">&nbsp;</td>';
				$dataList.='<td>'.$expense['title'].'</td>';  				
				$dataList.='<td align="right">'.number_format(@$budget_total,2).'</td>';
				$dataList.='<td align="center">
				<input type="text" name="withdraw[]" id="withdraw_'.$expense['id'].'" value="'.@$wdDetail['withdraw'].'" alt="decimal" class="cost budget_type_'.$budgettype['id'].'" onkeyup="check_summary(\''.$expense['id'].'\',\''.$budgettype['id'].'\');">
				<input type="hidden" name="tmp_withdraw[]" id="tmp_withdraw_'.$expense['id'].'" value="'.@$wdDetail['withdraw'].'" alt="decimal" onkeyup="check_summary(\''.$expense['id'].'\');">																
				<input type="hidden" name="budgettype_id[]" id="budgettype_id" value="'.$budgettype['id'].'">
				<input type="hidden" name="expensetype_id[]" id="expensetype_id" value="'.$expense['id'].'">
				<input type="hidden" name="wdDetailID[]" id="wdDetailID" value="'.@$wdDetail['id'].'">
				<input type="hidden" name="tmp_withdraw[]" id="tmp_withdraw_'.$expense['id'].'" value="'.@$wdDetail['withdraw'].'">
				<input type="hidden" id="expense_withdraw_limit_'.$expense['id'].'" value="'.$budget_total.'">
				</td>';
			$dataList.='</tr>';
			endforeach;
		endforeach;  
		return $dataList;
	}
}
?>