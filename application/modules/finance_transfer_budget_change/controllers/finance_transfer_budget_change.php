<?php
class Finance_transfer_budget_change extends Finance_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('fn_transfer_budget_change_model','transfer_budget');
		$this->load->model('fn_transfer_budget_change_detail_model','transfer_budget_detail');		
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
		$data['result'] =$this->transfer_budget->get();
		$data['pagination']=$this->transfer_budget->pagination();
		$this->template->build('finance_transfer_budget_change_index',$data);		
	}
	
	function select_cost_data()
	{
		//$this->db->debug = true;		
		
		$sql = "select * from fn_cost_related where book_cost_id = '".$_POST['book_cost_id']."'";								
		$cost = $this->db->getrow(ConvertCommand($sql));		
		dbConvert($cost);
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
		$newrow = "";
		/*
		foreach($budget_type as $item):
			$expense_type = $this->budget_type->where("PID=".$item['id'])->get(FALSE,TRUE);			
			foreach($expense_type as $sitem):
			$newrow .= '<tr>';
			$newrow .= '<td class="pbudgettype">'.$item['title'].'</id>';
			$newrow .= '<td class="pexpensetype">'.$sitem['title'].'</td>';
			$newrow .= '<td align=right>';
			$expense_limit = $this->fcr_detail->select("BUDGET_COMMIT")->where(" FN_COST_RELATED_ID=".$cost['id']." AND BUDGETTYPE_ID=".$sitem['id'])->get_one();
			$newrow .= number_format($expense_limit,2).'<input type="hidden" name="expense_limit[]" value="'.number_format($expense_limit,2).'" alt="decimal">';
			$newrow .= '</td>';			
			$newrow .= '<td class="rbudgettype">';
			$disable = $expense_limit > 0 ? "" : ' style="display:none"';
							$newrow .='<select name="rbudgettype_id[]" '.$disable.' onchange="ReloadRExpenseList(this.value,\''.$sitem['id'].'\');">';
							$newrow .='<option value="">ระบุหมวดงบที่รับโอน</option>';
							$rbudget_type = $this->budget_type->where("PID = 0 AND ID <> ".$item['id'])->get(FALSE,TRUE);
							foreach($rbudget_type as $ritem):
								$newrow .='<option value="'.$ritem['id'].'">'.$ritem['title'].'</option>';
							endforeach;
							$newrow .="</select>";
			$newrow .= '</id>';
			$newrow .= '<td class="td_rexpense_'.$sitem['id'].'">';
							$newrow .='<select name="rexpensetype_id[]" class="rexpensetype_id_'.$sitem['id'].'" '.$disable.'>';
							$newrow .='<option value="">ระบุประเภทค่าใช้จ่ายที่รับโอน</option>';
							$rexpense_type = $this->budget_type->where("PID > 0 AND EXPENSETYPEID=0")->get(FALSE,TRUE);
							foreach($rexpense_type as $ritem):
								$newrow .='<option value="'.$ritem['id'].'">'.$ritem['title'].'</option>';
							endforeach;
							$newrow .="</select>";
			$newrow .= '</td>';											
			$newrow .= '<td align=right class=amt>';			
			$newrow .= '<input type="text" name="transfer_commit[]" value="" alt="decimal"  '.$disable.'>';
			$newrow .= '<input type=hidden name="pexpensetype_id[]" id="pexpensetype_id" value="'.$sitem['id'].'" '.$disable.'>';
			$newrow .= '<input type="hidden" name="pbudgettype_id[]" id="pbudgettype_id" value="'.$item['id'].'" '.$disable.'>';
			$newrow .= '</td>';
			$newrow .= '</tr>';								
			endforeach;
		endforeach;	
		  */
		 
		$data['data_list'] = $newrow;		
		$this->load->view('select_change_from_cost', $data);		
	}

	function form($id=FALSE)
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$newrow='';
		$data['id']=@$id;
		$data['rs'] = @$this->transfer_budget->get_row($id);
		$data_list = '';		
		if($id > 0 )
		{
			$cost = $this->fcr->get_row($data['rs']['fn_cost_related_id']);		
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
			$data['cost'] = $cost;	
			$newrow="";
			$transfer = $this->transfer_budget_detail->where("pid=".$id)->get(FALSE,TRUE);
			foreach($transfer as $item):	
				$pbg = $this->budget_type->where("id=".$item['pbudgettype_id'])->get_row();
				$pep = $this->budget_type->where("id=".$item['pexpensetype_id'])->get_row();
				$rbg = $this->budget_type->where("id=".$item['rbudgettype_id'])->get_row();
				$rep = $this->budget_type->where("id=".$item['rexpensetype_id'])->get_row();
			$newrow .= '<tr class="trbodylist"><td class="trbudgettype">'.$pbg['title'].'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='.$pbg['id'].'></td>';
			$newrow .= '<td class="expensetype">'.$pep['title'].'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='.$pep['id'].'></td>';
			$newrow .= '<td class="rbudgettype">'.$rbg['title'].'<input type=hidden name="rbudgettypeid[]" id="rbudgettypeid" value='.$rbg['id'].'></td>';
			$newrow .= '<td class="rexpensetype">'.$rep['title'].'<input type=hidden name="rexpenseid[]" id="rexpenseid" value='.$rep['id'].'></td>';
			$newrow .= '<td align=right class=amt>'.number_format($item['transfer_commit'],2).'<input type=hidden name="pcharge[]" id="pcharge" value='.number_format($item['transfer_commit'],2).'></td><td><input type="button" class="btn_delete" /></td></tr>';
			endforeach;
		}			
		$data['data_list'] = $newrow;			
		$this->template->build('finance_transfer_budget_change_form',$data);
	}
	function save($id=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			if($id>0)
			$_POST['id']=$id;						
			//$_POST['regis_date']=($_POST['regis_date']!="")? th_to_stamp($_POST['regis_date']):0;
			$_POST['transfer_date']=($_POST['transfer_date']!="")? th_to_stamp($_POST['transfer_date']):0;											
			$pid = $this->transfer_budget->save($_POST);
			
			$this->transfer_budget_detail->delete('pid',$pid);
			if(isset($_POST['pbudgettypeid'])){
				foreach($_POST['pbudgettypeid'] as $key=>$item){
					if($_POST['pbudgettypeid'][$key]){
						$this->transfer_budget_detail->save(array(
							'pid'=>$pid,
							'pbudgettype_id'=>$_POST['pbudgettypeid'][$key],
							'pexpensetype_id'=>$_POST['pexpenseid'][$key],
							'rbudgettype_id'=>$_POST['rbudgettypeid'][$key],
							'rexpensetype_id'=>$_POST['rexpenseid'][$key],
							'transfer_commit'=>$_POST['pcharge'][$key]							
						));
					}
				}	
			}
			 
			 		

			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_transfer_budget_change/index'.$url_parameter);
	}
	function delete($id=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id){
			$this->transfer_budget->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('finance_transfer_budget_change/index'.$url_parameter);
	}
	
	function select_expensetype()
	{
		$newrow = "";
		$condition = $_POST['budget_type_id'] == "" ? "" : " AND PID=".$_POST['budget_type_id'];
		$newrow .='<select name="rexpensetype_id[]" class="rexpensetype_id_'.$_POST['pexpense_type_id'].'">';
		$newrow .='<option value="">ระบุประเภทค่าใช้จ่ายที่รับโอน</option>';
		$rexpense_type = $this->budget_type->where("PID > 0 AND EXPENSETYPEID=0".$condition)->get(FALSE,TRUE);
		foreach($rexpense_type as $ritem):
			$newrow .='<option value="'.$ritem['id'].'">'.$ritem['title'].'</option>';
		endforeach;
		$newrow.="</select>";
		echo $newrow;
	}
	function get_subactivity_summary(){
		//$this->db->debug=true;
		$cost_id = $_POST['cost_id'];
		$subactivityID = @$_POST['subactivityid'] > 0 ?$_POST['subactivityid'] : 0;
		$workgroupID = @$_POST['workgroupid'] > 0 ? $_POST['workgroupid'] : 0;		
		$expensetypeID = @$_POST['expensetype'] > 0 ? $_POST['expensetype'] : 0;
		$budgettypeID = @$_POST['budgettypeid']>0 ? $_POST['budgettypeid'] : 0 ;
		$current_id = @$_POST['id'] > 0 ? $_POST['id'] : 0;
		$summary = 0;
		
		if($expensetypeID>0){
		$sql = " SELECT BUDGET_COMMIT FROM
		FN_COST_RELATED_DETAIL WHERE BUDGETTYPE_ID=".$expensetypeID." AND FN_COST_RELATED_ID=".$cost_id;				
		$summary = $this->db->getone($sql);		
		
		//โอนเปลี่ยนแปลงงบประมาณ
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPE_ID=".$expensetypeID;
		$sql.= @$current_id >0 ? " AND FT.ID <> ".$current_id : "";
		$bg_change = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND REXPENSETYPE_ID=".$expensetypeID;
		$sql.= $current_id >0 ? " AND FT.ID <> ".$current_id : "";
		$bg_change_receive = $this->db->getone($sql);
		
		//โอนเจัดสรรงบประมาณ ให้ พมจ
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPE_ID=".$expensetypeID;		
		$bg_transfer = $this->db->getone($sql);
		
		//โอนภายในสำนัก
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPEID=".$expensetypeID;		
		$bg_within = $this->db->getone($sql);
		
		//อนุมัติเบิก
		$sql = " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW FA LEFT JOIN FN_APPROVE_WITHDRAW_DETAIL FAD
		ON FA.ID = FAD.PID WHERE COSTID=".$cost_id." AND EXPENSETYPE_ID=".$expensetypeID;
		$bg_withdraw = $this->db->getone($sql);		
		
		$summary = $summary - ($bg_change + $bg_transfer + $bg_within + $bg_withdraw) + $bg_change_receive;
		}
		echo '<input type="hidden" name="hdsummary" id="hdsummary" value="'.number_format($summary,2).'">';
		echo number_format($summary,2);
	}

}	