<?php
class Finance_year_overlap extends Finance_Controller{

	function __construct()
	{
		parent::__construct();
		$this->load->model('fn_year_overlap_model','overlap');
		$this->load->model('fn_year_overlap_detail_model','overlap_detail');
		$this->load->model('finance_approve_withdraw/fn_approve_withdraw_model','withdraw');
		$this->load->model('finance_approve_withdraw/fn_approve_withdraw_detail_model','withdraw_detail');
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
	public function index()
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['result'] = $this->overlap->get();
		$data['pagination'] = $this->overlap->pagination();
		$this->template->build('index',$data);
	}

	
	function form($id=FALSE,$cost_id=FALSE)
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['id']=@$id;
		$data['rs'] = @$this->overlap->get_row($id);
		$newrow='';		
		$cost='';
		if($id > 0 )
		{
			$sql = "select fn_cost_related.*,fn_budget_related.book_id budget_related_book_id,fn_budget_related.book_date budget_related_book_date from fn_cost_related
		left join fn_budget_related on fn_cost_related.book_id = fn_budget_related.id 
		where fn_cost_related.id = '".$data['rs']['fn_cost_related_id']."'";								
		$cost = $this->db->getrow(ConvertCommand($sql));		
		}else if($cost_id > 0){
			$sql = "select fn_cost_related.*,fn_budget_related.book_id budget_related_book_id,fn_budget_related.book_date budget_related_book_date from fn_cost_related
		left join fn_budget_related on fn_cost_related.book_id = fn_budget_related.id 
		where fn_cost_related.id = '".$cost_id."'";								
		$cost = $this->db->getrow(ConvertCommand($sql));
		}
		if($cost!='')
		{		
		dbConvert($cost);
		$data['cost'] = $cost;
		$data['reserve_no'] = @$data['rs']['reserve_no'];
		$data['reserve_date'] = @$data['rs']['reserve_date'];
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
		
		$btype = $this->budget_type->where("pid=0")->get();
				
		foreach($btype as $bt):
			$budget = $this->db->getone("select budget_commit from fn_cost_related_detail where budgettype_id=".$bt['id']." and fn_cost_related_id=".$cost['id']);
			
			//$this->db->debug=true;
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PBUDGETTYPE_ID=".$bt['id'];
			$bg_change = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND RBUDGETTYPE_ID=".$bt['id'];		
			$bg_change_receive = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PBUDGETTYPE_ID=".$bt['id'];	
			$bg_transfer = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PBUDGETTYPEID=".$bt['id'];				
			$bg_within = $this->db->getone($sql);
			
			$sql= " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW LEFT JOIN 
			FN_APPROVE_WITHDRAW_DETAIL ON FN_APPROVE_WITHDRAW.ID = FN_APPROVE_WITHDRAW_DETAIL.PID
			 WHERE COSTID=".$cost['id']." AND BUDGETTYPE_ID=".$bt['id']." AND EXPENSETYPE_ID=0";
			$bg_withdraw = $this->db->getone($sql);
			
					
			$budget = $budget - ( $bg_change + $bg_transfer + $bg_within + $bg_withdraw) + $bg_change_receive;
			
			
			
			$newrow .= '<tr class="odd"><td>'.$bt['title'].'</td><td></td>
			<td align="right">'.number_format($budget,2).'
			<input type="hidden" name="budgettype_id[]" value="'.$bt['id'].'">
			<input type="hidden" name="expensetype_id[]" value="0">
			<input type="hidden" name="budget_commit[]" value="'.$budget.'">
			</td></tr>';
			$etype = $this->budget_type->where("pid=".$bt['id'])->get();
			foreach($etype as $et):
				$budget = $this->db->getone("select budget_commit from fn_cost_related_detail where budgettype_id=".$et['id']." and fn_cost_related_id=".$cost['id']);
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PEXPENSETYPE_ID=".$et['id'];
				$bg_change = $this->db->getone($sql);
				
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND REXPENSETYPE_ID=".$et['id'];		
				$bg_change_receive = $this->db->getone($sql);
				
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PEXPENSETYPE_ID=".$et['id'];	
				$bg_transfer = $this->db->getone($sql);
				
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PEXPENSETYPEID=".$et['id'];				
				$bg_within = $this->db->getone($sql);
				
				$sql= " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW LEFT JOIN 
				FN_APPROVE_WITHDRAW_DETAIL ON FN_APPROVE_WITHDRAW.ID = FN_APPROVE_WITHDRAW_DETAIL.PID
				 WHERE COSTID=".$cost['id']." AND BUDGETTYPE_ID=".$bt['id']." AND EXPENSETYPE_ID=".$et['id'];
				$bg_withdraw = $this->db->getone($sql);
						
				$budget = $budget - ( $bg_change + $bg_transfer + $bg_within + $bg_withdraw) + $bg_change_receive;
				
				$newrow .= '<tr ><td></td><td>'.$et['title'].'</td><td align="right" class="amt">'.number_format($budget,2).'
				<input type="hidden" name="budgettype_id[]" value="'.$bt['id'].'">
				<input type="hidden" name="expensetype_id[]" value="'.$et['id'].'">
				<input type="hidden" name="budget_commit[]" value="'.$budget.'">
				</td></tr>';
			endforeach;
		endforeach;		 		 				
		
		}
					
		$data['data_list'] = $newrow;			
		$this->template->build('form',$data);
	}
	function save()
	{
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){			
			$_POST['reserve_date']=($_POST['reserve_date']!="")? th_to_stamp($_POST['reserve_date']):0;
			
			$pid = $this->overlap->save($_POST);
			
			$this->overlap_detail->delete('pid',$pid);
			if(isset($_POST['budgettype_id'])){
				foreach($_POST['budgettype_id'] as $key=>$item){
					if($_POST['budgettype_id'][$key]){
						$this->overlap_detail->save(array(
							'pid'=>$pid,
							'budgettype_id'=>$_POST['budgettype_id'][$key],
							'expensetype_id'=>$_POST['expensetype_id'][$key],
							'budget_commit'=>$_POST['budget_commit'][$key]							
						));
					}
				}	
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_year_overlap/index'.$url_parameter);
	}
	function delete($id=FALSE)
	{
		$url_parameter = GetCurrentUrlGetParameter();
		if($id>0)
		{
			$this->overlap->delete($id);
			$this->overlap_detail->delete($id);
		}
		redirect('finance_year_overlap/index'.$url_parameter);
	}
	function select_cost_data()
	{
		//$this->db->debug = true;
		$gtotal = 0;		
		$sql = "select fn_cost_related.*,fn_budget_related.book_id budget_related_book_id,fn_budget_related.book_date budget_related_book_date from fn_cost_related
		left join fn_budget_related on fn_cost_related.book_id = fn_budget_related.id 
		where book_cost_id = '".$_POST['book_cost_id']."'";								
		$cost = $this->db->getrow(ConvertCommand($sql));		
		dbConvert($cost);
		$data['cost'] = $cost;
		$data['reserve_no'] = $_POST['reserve_no'];
		$data['reserve_date'] = $_POST['reserve_date'];
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
		
		$btype = $this->budget_type->where("pid=0")->get();
		$newrow='';
		$data['id'] = @$_POST['id'];		
		foreach($btype as $bt):
			$budget = $this->db->getone("select budget_commit from fn_cost_related_detail where budgettype_id=".$bt['id']." and fn_cost_related_id=".$cost['id']);
			
			//$this->db->debug=true;
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PBUDGETTYPE_ID=".$bt['id'];
			$bg_change = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND RBUDGETTYPE_ID=".$bt['id'];		
			$bg_change_receive = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PBUDGETTYPE_ID=".$bt['id'];	
			$bg_transfer = $this->db->getone($sql);
			
			$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
			ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PBUDGETTYPEID=".$bt['id'];				
			$bg_within = $this->db->getone($sql);
			
			$sql= " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW LEFT JOIN 
			FN_APPROVE_WITHDRAW_DETAIL ON FN_APPROVE_WITHDRAW.ID = FN_APPROVE_WITHDRAW_DETAIL.PID
			 WHERE COSTID=".$cost['id']." AND BUDGETTYPE_ID=".$bt['id']." AND EXPENSETYPE_ID=0";
			$bg_withdraw = $this->db->getone($sql);
			
					
			$budget = $budget - ( $bg_change + $bg_transfer + $bg_within + $bg_withdraw) + $bg_change_receive;
			
			
			
			$newrow .= '<tr class="odd"><td>'.$bt['title'].'</td><td></td>
			<td align="right">'.number_format($budget,2).'
			<input type="hidden" name="budgettype_id[]" value="'.$bt['id'].'">
			<input type="hidden" name="expensetype_id[]" value="0">
			<input type="hidden" name="budget_commit[]" value="'.$budget.'">
			</td></tr>';
			$etype = $this->budget_type->where("pid=".$bt['id'])->get();
			foreach($etype as $et):
				$budget = $this->db->getone("select budget_commit from fn_cost_related_detail where budgettype_id=".$et['id']." and fn_cost_related_id=".$cost['id']);
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PEXPENSETYPE_ID=".$et['id'];
				$bg_change = $this->db->getone($sql);
				
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND REXPENSETYPE_ID=".$et['id'];		
				$bg_change_receive = $this->db->getone($sql);
				
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PEXPENSETYPE_ID=".$et['id'];	
				$bg_transfer = $this->db->getone($sql);
				
				$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
				ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost['id']." AND PEXPENSETYPEID=".$et['id'];				
				$bg_within = $this->db->getone($sql);
				
				$sql= " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW LEFT JOIN 
				FN_APPROVE_WITHDRAW_DETAIL ON FN_APPROVE_WITHDRAW.ID = FN_APPROVE_WITHDRAW_DETAIL.PID
				 WHERE COSTID=".$cost['id']." AND BUDGETTYPE_ID=".$bt['id']." AND EXPENSETYPE_ID=".$et['id'];
				$bg_withdraw = $this->db->getone($sql);
						
				$budget = $budget - ( $bg_change + $bg_transfer + $bg_within + $bg_withdraw) + $bg_change_receive;
				
				$newrow .= '<tr ><td></td><td >'.$et['title'].'</td><td align="right" class="amt">'.number_format($budget,2).'
				<input type="hidden" name="budgettype_id[]" value="'.$bt['id'].'">
				<input type="hidden" name="expensetype_id[]" value="'.$et['id'].'">
				<input type="hidden" name="budget_commit[]" value="'.$budget.'">
				</td></tr>';
				$gtotal +=$budget;
			endforeach;
		endforeach;		 		
		$newrow.='<tr class="total">';
		  $newrow.='<td colspan="2" align="right"><strong>รวมงบประมาณ</strong></td>';
		  $newrow.='<td align="right" class="amount" id="summary"><strong>'.number_format($gtotal,2).'</strong></td>';  
		$newrow.='</tr>'; 				
		$data['data_list'] = $newrow;
		$this->load->view('select_overlap_from_cost', $data);		
	}
}
?>