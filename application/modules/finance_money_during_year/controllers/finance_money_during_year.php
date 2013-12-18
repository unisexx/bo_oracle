<?php
Class Finance_money_during_year extends Finance_Controller{
		
	function __construct(){
		parent::__construct();		
		$this->load->model('fn_money_during_year_model','fn_mdy');
		$this->load->model('fn_money_during_year_detail_model','fn_mdy_detail');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_department/department_model','department');	
	}
	
	function index(){
		//$this->db->debug=true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$bg_year=(@$_GET['bg_year']!="")?  " and budgetyear LIKE'%".@$_GET['bg_year']."%'":"";
		$s_date=(@$_GET['s_date'])?strtotime((date_to_mysql(@$_GET['s_date'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['e_date'])?strtotime((date_to_mysql(@$_GET['e_date'],TRUE))." 23:59:59"):"9999999999";
		$find_date=" and(book_date between ".$s_date." and ".$e_date.")";
		
		$data['result'] = $this->fn_mdy->where("1=1".$bg_year.$find_date)->order_by('id','desc')->get();
		$data['pagination'] = $this->fn_mdy->pagination();
		$this->template->build('finance_money_during_year_index',$data);
	}
	
	function form($id=false){
		//$this->db->debug =true;	
			
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$budgettype = $this->db->getarray("SELECT * FROM FN_BUDGET_TYPE WHERE PID=0");
		dbConvert($budgettype);
		$data_list = "";
		foreach($budgettype as $item):							
				$sql = "SELECT SUM(EXPENSE_COMMIT) FROM fn_money_during_year_detail WHERE PID=".$id." AND BUDGETTYPE_ID=".$item['id'];
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
				if($id > 0 )$rs = $this->fn_mdy_detail->where("PID=".$id." AND expensetype_id=".$sitem['id'])->get_row();
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
			$data['result'] =$this->fn_mdy->get_row($id);						
		} 	
		$this->template->build('finance_money_during_year_form',$data);
	}
	
	function save($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($_POST){
			
			$_POST['book_date'] = $_POST['book_date']=='' ? 0 : th_to_stamp($_POST['book_date']);

			$fn_mdy_id = $this->fn_mdy->save($_POST);
			
			$this->fn_mdy_detail->delete('pid',$fn_mdy_id);
			//$this->fn_rfw_detail->delete('master_id',$fn_rfw_id);
			if(isset($_POST['expensetype_id'])){
				foreach($_POST['expensetype_id'] as $key=>$item){
					if($_POST['expensetype_id'][$key]){
						$this->fn_mdy_detail->save(array(
							'id'=>$_POST['id'][$key],
							'pid'=>$fn_mdy_id,
							'budgettype_id'=>$_POST['budgettype_id'][$key],
							'expensetype_id'=>$_POST['expensetype_id'][$key],
							'expense_commit'=>str_replace(',','',$_POST['expense_commit'][$key])							
						));
					}
				}	
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_money_during_year/index');
	}
	
	function delete($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id){
			$this->fn_mdy->delete($id);
			$this->fn_mdy_detail->delete('pid',$id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function select_budget_2_find_charge(){
		if($_POST['bget']){
			$bget = $_POST['bget'];
			
			echo form_dropdown('',get_option('id','title',"fn_budget_type where pid = $bget"),'','id=charge','-- เลือกหมวดค่าใช้จ่าย --');
		}
	}
	
	function select_department_find_division()
	{
		if($_POST['department_id']){
			$department_id = $_POST['department_id'];			
			echo form_dropdown('division_id',get_option('id','title','cnf_division where departmentid = '.$department_id),'','','-- เลือกหน่วยงาน --');
		}
	}
	
	function select_division_find_workgroup()
	{			
		if($_POST['division_id']){
			$division_id = $_POST['division_id'];			
			echo form_dropdown('workgroup_id',get_option('id','title','cnf_workgroup where divisionid = '.$division_id),'','','-- เลือกกลุ่มงาน --');
		}
	}
}
?>