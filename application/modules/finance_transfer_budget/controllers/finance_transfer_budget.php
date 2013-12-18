<?php
class Finance_transfer_budget extends Finance_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fn_transfer_budget_model','transfer_budget');
		$this->load->model('fn_transfer_budget_province_model','transfer_budget_province');
		$this->load->model('fn_transfer_budget_detail_model','transfer_budget_detail');
		$this->load->model('finance_budget_plan/fn_budget_type_detail_model','budget_type_detail');		
		$this->load->model('finance_budget_plan/fn_budget_master_model','budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');
		$this->load->model('c_province/province_model','province');
		$this->load->model('finance_cost_related/fn_cost_related_model','fcr');
		$this->load->model('finance_cost_related/fn_cost_related_detail_model','fcr_detail');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');	
		$this->load->model('finance_budget_plan/fn_budget_plan_model','fn_strategy');
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " WHERE 1=1 ";
		$condition .= @$_GET['book_no']!='' ? " AND book_no LIKE '%".$_GET['book_no']."%' " : "";
		/*
		$condition .= @$_GET['departmentid'] > 0 ? " AND departmentid=".$_GET['departmentid']: "";			
		$condition .= @$_GET['pdivision_id'] > 0 ? " AND DIVISIONID=".$_GET['pdivision_id']: "";
		$condition .= @$_GET['pworkgroup_id'] > 0 ? " AND WORKGROUPID=".$_GET['pworkgroup_id']: "";		 
		 */
		$s_date=(@$_GET['datestart'])?strtotime((date_to_mysql(@$_GET['datestart'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['dateend'])?strtotime((date_to_mysql(@$_GET['dateend'],TRUE))." 23:59:59"):"9999999999";
		$condition .= " and(transfer_date between ".$s_date." and ".$e_date.")"; 		
		
		$sql = "SELECT ftb.*,(SELECT SUM(TRANSFER_COMMIT)FROM FN_TRANSFER_BUDGET_DETAIL WHERE PID=ftb.id)summary FROM FN_TRANSFER_BUDGET ftb ".$condition;		
		$data['result'] =$this->transfer_budget->get($sql);
		$data['pagination']=$this->transfer_budget->pagination();
		$this->template->build('finance_transfer_budget_index',$data);		
	}
	function form($id=FALSE)
	{
		//$this->db->debug = true;			
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['id']=@$id;
		$data['rs'] = @$this->transfer_budget->get_row($id);		
		$newrow = '';	
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
			$newrow .= '<tr class="trbodylist"><td class="trbudgettype">'.$pbg['title'].'<input type=hidden name="pbudgettypeid[]" id="pbudgettypeid" value='.$pbg['id'].'></td>';
			$newrow .= '<td class="expensetype">'.$pep['title'].'<input type=hidden name="pexpenseid[]" id="pexpenseid" value='.$pep['id'].'></td>';						
			$newrow .= '<td align=right class=amt>'.number_format($item['transfer_commit'],2).'<input type=hidden name="pcharge[]" id="pcharge" value='.number_format($item['transfer_commit'],2).'></td><td><input type="button" class="btn_delete" /></td></tr>';
			endforeach;
		}			
		$data['data_list'] = $newrow;	

		$data['province'] = $this->get_province_transfer($id);
		
		$this->template->build('finance_transfer_budget_form',$data);
	}
	function save($id=FALSE){
		//$this->db->debug = true;
		$url_parameter = GetCurrentUrlGetParameter();
		if($_POST){
			if($id>0)$_POST['id']=$id;
			$_POST['gf_gen_date']=($_POST['gf_gen_date']!="")? th_to_stamp($_POST['gf_gen_date']):0;
			$_POST['gf_dgen_date']=($_POST['gf_dgen_date']!="")? th_to_stamp($_POST['gf_dgen_date']):0;		
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
							'transfer_commit'=>$_POST['pcharge'][$key]							
						));
					}
				}	
			}
			$this->transfer_budget_province->delete('pid',$pid);
			if(isset($_POST['transferprovince'])){
				foreach($_POST['transferprovince'] as $key=>$item){
					if($_POST['transferprovince'][$key]){
						$this->transfer_budget_province->save(array(
							'pid'=>$pid,							
							'provinceid'=>$_POST['transferprovince'][$key],
							'transfer_commit'=>$_POST['provincecharge'][$key]							
						));
					}
				}	
			}

			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_transfer_budget/index'.$url_parameter);
	}
	function delete($id=FALSE){
		$url_parameter = GetCurrentUrlGetParameter();
		if($id){
			$this->transfer_budget->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('finance_transfer_budget/index'.$url_parameter);
	}
	
	function select_budget_type(){
		$pid = @$_POST['pid'] > 0 ? $_POST['pid'] : 0;
		$controlname = @$_POST['controlname']=="" ? "": $_POST['controlname'];
		$condition = " 1=1 ";
		$condition .= $pid < 1 ? " AND PID=0" : " AND PID=".$pid;
		$result = $this->budget_type->where($condition)->get(FALSE,TRUE);
		
			echo"<select name='".$controlname."' id='".$controlname."'>";
			echo"<option value='0'>-- เลือกหมวดงบประมาณ --</option>";
				foreach($result as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		
	}

	function select_budget_charge(){
		//$this->db->debug=true;		
		$cost_id = @$_POST['cost_id'] > 0 ? $_POST['cost_id'] : 0;		
		$expensetypeID = @$_POST['expenseid'] > 0 ? $_POST['expenseid'] : 0;
		$current_id =@$_POST['id']>0 ? $_POST['id'] :0;			
		$summary = 0;
		if($expensetypeID > 0){
		$sql = " SELECT BUDGET_COMMIT FROM FN_COST_RELATED_DETAIL WHERE FN_COST_RELATED_ID=".$cost_id." AND BUDGETTYPE_ID=".$expensetypeID; 				
		$summary = $this->db->getone($sql);		
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPE_ID=".$expensetypeID;
		$bg_change = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET_CHANGE FT LEFT JOIN FN_TRANSFER_BUDGET_CHANGE_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND REXPENSETYPE_ID=".$expensetypeID;		
		$bg_change_receive = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_BUDGET FT LEFT JOIN FN_TRANSFER_BUDGET_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPE_ID=".$expensetypeID;
		$sql.= $current_id >0 ? " AND FT.ID <> ".$current_id : "";
		$bg_transfer = $this->db->getone($sql);
		
		$sql= " SELECT SUM(TRANSFER_COMMIT) FROM FN_TRANSFER_WITHIN FT LEFT JOIN FN_TRANSFER_WITHIN_DETAIL FTD
		ON FT.ID = FTD.PID WHERE FN_COST_RELATED_ID=".$cost_id." AND PEXPENSETYPEID=".$expensetypeID;		
		$bg_within = $this->db->getone($sql);	
		
		//อนุมัติเบิก
		$sql = " SELECT SUM(WITHDRAW) FROM FN_APPROVE_WITHDRAW FA LEFT JOIN FN_APPROVE_WITHDRAW_DETAIL FAD
		ON FA.ID = FAD.PID WHERE COSTID=".$cost_id." AND EXPENSETYPE_ID=".$expensetypeID;
		$bg_withdraw = $this->db->getone($sql);	
		
		$summary = $summary - ($bg_change + $bg_transfer + $bg_within + $bg_withdraw)+$bg_change_receive;
		}
		
		echo '<input type="hidden" name="hdsummary" id="hdsummary" value="'.$summary.'">';
		echo number_format($summary,2);
	}

	function get_province_transfer($id=FALSE){
		$result = $this->province->where("ID <> 2")->sort("title")->get(FALSE,TRUE);
		$charge = 0;
		$i=0;
		foreach($result as $item){
			$result = $id > 0 ?  $this->transfer_budget_province->where("pid=".$id." AND provinceid=".$item['id'])->get_row() : 0;
			$charge = @$result['transfer_commit']>0 ? $result['transfer_commit'] : 0;
			$province[$i] = array($item['id'],$item['title'],$charge);
			$i++;			
		}	
		return $province;
	}
	
	function get_budget_type_transfer($id=FALSE){
		$sql=" SELECT ftbt.masterid, ftbt.charge, ftbt.budgettypeid, fbbudgettype.title budgettypetitle , ftbt.expenseid, fbexpense.title expensetitle
				FROM fn_transfer_budget_type ftbt 
				LEFT JOIN fn_budget_type fbbudgettype ON ftbt.budgettypeid = fbbudgettype.id 
				LEFT JOIN fn_budget_type fbexpense ON ftbt.expenseid = fbexpense.id 
		WHERE pid=".$id;
		$result = $this->budget_type_detail->get($sql,TRUE);
		return $result;
	}
}
?>