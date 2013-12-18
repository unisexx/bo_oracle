<?php
Class Finance_receive_for_withdraw_replace extends Finance_Controller{
		
	function __construct(){
		parent::__construct();
		$this->load->model('fn_receive_for_withdraw_replace_model','fn_rfw');
		$this->load->model('fn_receive_for_withdraw_replace_detail_model','fn_rfw_detail');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_department/department_model','department');			
		
	}
	
	function index(){
		//$this->db->debug=true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " 1=1 ";
		$condition .= @$_GET['documentno']!="" ? " AND documentno LIKE '%".$_GET['documentno']."%'": "";
		$condition .= @$_GET['pdepartment_id'] > 0 ? " AND PDEPARTMENT_ID=".$_GET['pdepartment_id']: "";			
		$condition .= @$_GET['pdivision_id'] > 0 ? " AND PDIVISION_ID=".$_GET['pdivision_id']: "";
		$condition .= @$_GET['pworkgroup_id'] > 0 ? " AND PWORKGROUP_ID=".$_GET['pworkgroup_id']: "";
		$s_date=(@$_GET['datestart'])?strtotime((date_to_mysql(@$_GET['datestart'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['dateend'])?strtotime((date_to_mysql(@$_GET['dateend'],TRUE))." 23:59:59"):"9999999999";
		$condition .= " and(receive_date between ".$s_date." and ".$e_date.")"; 
		$data['result'] = $this->fn_rfw->where($condition)->get();
		$data['pagination'] = $this->fn_rfw->pagination();
		
		$data['menuindex'] = 4;
		$this->template->build('finance_receive_for_withdraw_replace_index',$data);
	}
	
	function form($id=false){
		//$this->db->debug=true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$budgettype = $this->db->getarray("SELECT * FROM FN_BUDGET_TYPE WHERE PID=0");
		dbConvert($budgettype);
		$data_list = "";
		foreach($budgettype as $item):							
				$sql = "SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_FOR_WITHDRAW_REPLACE_DETAIL WHERE PID=".$id." AND BUDGETTYPE_ID=".$item['id'];
				$budget_commit = @$this->db->getone($sql);
							
				$data_list .= '<tr class="odd">';  		
			  		$data_list.='<td>';
			  		$data_list.=$item['title'];
			  		$data_list.='</td>';
			  		$data_list.='<td>&nbsp;</td>';
			  		$data_list.='<td>';
			  		$data_list.='<input type="text" name="budget_type_commit_'.$item['id'].'" value="'.@$budget_commit.'" class="odd" style="border:0px"  alt="decimal"></td>';			  		
			  	$data_list.='</tr>';
				$expensetype = $this->db->getarray("SELECT * FROM FN_BUDGET_TYPE WHERE PID=".$item['id']);
				dbConvert($expensetype);
				foreach($expensetype as $sitem):
				if($id > 0 )$rs = $this->fn_rfw_detail->where("PID=".$id." AND expensetype_id=".$sitem['id'])->get_row();
				$data_list .= '<tr>';  	
					$data_list.='<td>&nbsp;</td>';	
			  		$data_list.='<td>';
			  		$data_list.=$sitem['title'].'<input type="hidden" name="expensetype_id[]" value="'.$sitem['id'].'" /><input type="hidden" name="id[]" value="'.@$rs['id'].'" />';
			  		$data_list.='</td>';			  		
			  		$data_list.='<td><input type="hidden" name="budgettype_id[]" value="'.$item['id'].'" />
			  		<input type="text" name="expense_commit[]" class="budgettype_'.$item['id'].'" value="'.@$rs['expense_commit'].'" alt="decimal" onkeyup="CaluculateBudgetTypeSummary(\''.$item['id'].'\')"></td>';			  		
			  	$data_list.='</tr>';			
				endforeach;
		endforeach;
		$data['data_list'] =$data_list;
		if($id > 0)
		{		
			$data['result'] =$this->fn_rfw->get_row($id);						
		} 	
		$this->template->build('finance_receive_for_withdraw_replace_form',$data);
	}
	
	function save($id=false){
		//$this->db->debug=TRUE;	
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		if($_POST){
			$_POST['ID'] = $id; 
			$_POST['book_date'] = th_to_stamp($_POST['book_date']);				
			$_POST['finance_date'] = th_to_stamp($_POST['finance_date']);
			$_POST['receive_date'] = th_to_stamp($_POST['receive_date']);
			//$_POST['item_date'] = th_to_stamp($_POST['item_date']);
			
			$fn_rfw_id = $this->fn_rfw->save($_POST);
			
			//$this->fn_rfw_detail->delete('master_id',$fn_rfw_id);
			if(isset($_POST['expensetype_id'])){
				foreach($_POST['expensetype_id'] as $key=>$item){
					if($_POST['expensetype_id'][$key]){
						$this->fn_rfw_detail->save(array(
							'id'=>$_POST['id'][$key],
							'pid'=>$fn_rfw_id,
							'budgettype_id'=>$_POST['budgettype_id'][$key],
							'expensetype_id'=>$_POST['expensetype_id'][$key],
							'expense_commit'=>str_replace(',','',$_POST['expense_commit'][$key])							
						));
					}
				}	
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_receive_for_withdraw_replace/index'.$data['url_parameter']);
	}
	
	function delete($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();	
		if($id){
			$this->fn_rfw_detail->delete('pid',$id);
			$this->fn_rfw->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect('finance_receive_for_withdraw_replace/index'.$data['url_parameter']);
	}
	
	function select_budget_2_find_charge(){
		if($_POST['bget']){
			$bget = $_POST['bget'];
			
			echo form_dropdown('',get_option('id','title',"fn_budget_type where pid = $bget"),'','id=charge','-- เลือกหมวดค่าใช้จ่าย --');
		}
	}
}
?>