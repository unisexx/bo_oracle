<?php
class Finance_withdraw_replace extends Finance_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('fn_withdraw_replace_model','withdraw_replace');
		$this->load->model('fn_withdraw_replace_detail_model','withdraw_replace_detail');
		$this->load->model('finance_budget_plan/fn_budget_type_detail_model','budget_type_detail');		
		$this->load->model('finance_budget_plan/fn_budget_master_model','budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');
	}
	
	function index()
	{
		//$this->db->debug = true;
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " 1=1 ";
		$condition .= @$_GET['withdrawid'] != '' ? " AND withdrawid LIKE '%".$_GET['withdrawid']."%'": "";
		$condition .= @$_GET['pdepartment_id'] > 0 ? " AND RDEPARTMENT_ID=".$_GET['pdepartment_id']: "";			
		$condition .= @$_GET['pdivision_id'] > 0 ? " AND RDIVISION_ID=".$_GET['pdivision_id']: "";
		$condition .= @$_GET['pworkgroup_id'] > 0 ? " AND RWORKGROUP_ID=".$_GET['pworkgroup_id']: "";
		$s_date=(@$_GET['datestart'])?strtotime((date_to_mysql(@$_GET['datestart'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['dateend'])?strtotime((date_to_mysql(@$_GET['dateend'],TRUE))." 23:59:59"):"9999999999";
		$condition .= " and(relate_date between ".$s_date." and ".$e_date.")"; 		
		$data['result'] =$this->withdraw_replace->where($condition)->get();
		$data['pagination']=$this->withdraw_replace->pagination();		
		$this->template->build('finance_withdraw_replace_index',$data);		
	}
	function form($id=FALSE)
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['rs'] = $this->withdraw_replace->get_row($id);
		if($id > 0)
		{
		$data['budgetdata'] =  $this->show_expense_detail($data['rs']['budget_type'],$data['rs']['projectid'],$id);				
		}
		$this->template->build('finance_withdraw_replace_form',$data);
	}
	function save($id=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		//$this->db->debug = true;
		if($_POST){
			if($id>0)$_POST['id']=$id;
			$_POST['book_date']=($_POST['book_date']!="")? th_to_stamp($_POST['book_date']):0;
			$_POST['cost_date']=($_POST['cost_date']!="")? th_to_stamp($_POST['cost_date']):0;
			$_POST['finance_date']=($_POST['finance_date']!="")? th_to_stamp($_POST['finance_date']):0;
			$_POST['transfer_date']=($_POST['transfer_date']!="")? th_to_stamp($_POST['transfer_date']):0;
			$_POST['relate_date']=($_POST['relate_date']!="")? th_to_stamp($_POST['relate_date']):0;
			$masterID = $this->withdraw_replace->save($_POST);
			$this->withdraw_replace_detail->delete('withdraw_replace_id',$masterID);			
			if(isset($_POST['budgettype_id'])){
				foreach($_POST['budgettype_id'] as $key=>$item){
					if($_POST['budgettype_id'][$key]){
						$this->withdraw_replace_detail->save(array(
							'id'=>$_POST['fcrd_id'][$key],
							'withdraw_replace_id'=>$masterID,
							'budgettype_id'=>$_POST['budgettype_id'][$key],
							'expensetype_id'=>$_POST['expensetype_id'][$key],
							'budget_commit'=>str_replace(',','',$_POST['budget_commit'][$key])													
						));
					}
				}	
			}
			
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_withdraw_replace/index');
	}
	function delete($id=FALSE){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id){
			$this->withdraw_replace->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function genbudgetdata($id=FALSE)
	{
		$result = $this->withdraw_replace_detail->where("MASTERID=".$id)->get("",TRUE);		
	}
	
	
	
	
	function show_expense_detail($budget_type=FALSE,$projectID=FALSE,$id=FALSE)
	{		
		$projectID = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectID;
		$data='<table id="tblist2" class="tblist2">
		<tr>
	  		<th style="text-align:left">หมวดงบประมาณ</th>
	  		<th style="text-align:left">หมวดรายจ่าย</th>
	  		<th style="text-align:right">เงินงบประมาณทั้งหมด</th>
	  		<th style="text-align:right">เงินงบประมาณคงเหลือ</th>
	  		<th style="text-align:right">ขอผูกพันงบประมาณจำนวน</th>	  		
	  	</tr>';
		//$this->db->debug = true;
		$result = $this->budget_type->where("PID=0")->get();		
		foreach($result as $item):					
		
		switch($budget_type):
			default:
				$sql = "SELECT SUM(BUDGET) FROM FN_BUDGET_TYPE_DETAIL 
				WHERE BUDGETID=".$projectID." AND 
				BUDGETTYPEID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=".$item['id']." AND EXPENSETYPEID=0)";														
			break;			
		endswitch;			
			/*--3--*/$budget_alloc = $this->db->getone($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)
			
			$budget_relate_net=0;
			
			$sql_b_relate = " SELECT SUM(BUDGET) FROM FN_BUDGET_RELATED FBR 
					LEFT JOIN FN_BUDGET_RELATED_DETAIL FBRD ON FBR.ID = FBRD.BUDGET_RELATED_ID 
					WHERE PROJECTID=".$projectID." AND BUDGET_TYPE=".$budget_type." AND BUDGETTYPE_ID=".$item['id'];
			$b_related = $this->db->getone($sql_b_relate); //ยอดผูกพันหลักการ (กรณีเป็นการแก้ไข จะไม่รวมตัวมันเอง )		
					
			$sql_c_relate = " SELECT BUDGET_COMMIT FROM FN_COST_RELATED FCR
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE PROJECTID=".$projectID." AND BUDGET_TYPE=".$budget_type." AND BOOK_ID < 1 AND BUDGETTYPE_ID=".$item['id'];
			$sql_c_relate.= $id > 0 ? " AND FCR.ID <> ".$id : "";					
			$c_related = $this->db->getone($sql_c_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
			
			$sql_b_return = " SELECT SUM(BUDGET_COMMIT) FROM FN_BUDGET_RETURN FBR 
			LEFT JOIN FN_BUDGET_RETURN_DETAIL FBRD ON FBR.ID = FBRD.FN_BOOK_RETURN_ID
			LEFT JOIN FN_BUDGET_RELATED FB ON FBR.BUDGET_RELATED_ID = FB.ID
			LEFT JOIN FN_COST_RELATED FC ON FBR.COST_RELATED_ID = FC.ID
			WHERE BUDGETTYPE_ID=".$item['id']." AND (FB.PROJECTID=".$projectID." OR FC.PROJECTID=".$projectID.")";
			$b_return = $this->db->getone($sql_b_return);
			/*--4--*/$total_relate = ($b_related + $c_related)-$b_return; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)			
			/*--5--*/$budget_total = $budget_alloc - $total_relate; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			/*--6--*$b_related;
			/*--7--*$c_related;*/	
			/*--8--*/$budget_related_net = $b_related - $c_related;					
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET_COMMIT FROM  FN_WITHDRAW_REPLACE FWR 
					LEFT JOIN FN_WITHDRAW_REPLACE_DETAIL FWRD ON FWR.ID = FWRD.WITHDRAW_REPLACE_ID 
					WHERE FWR.ID=".$id." AND BUDGETTYPE_ID=".$item['id'];
			$budget_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)			
			$fcrd = $this->withdraw_replace_detail->where('withdraw_replace_id = '.$id.' and budgettype_id = '.$item['id'])->get_row();
			}
			
			$tmp_budget_total = $budget_total - $budget_relate_net;
			
			$data .= '<tr class="odd">';
			  $data .= '<td height="36" nowrap="nowrap">'.$item['title'].'</td>';
			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  /*--3--*/$data .= '<td align="right" class="">'.number_format($budget_alloc,2).'</td>';			  
			  /*--5--*/$data .= '<td align="right" class="">'.number_format($budget_total,2).'</td>';			  
			  /*--9--*/$data .= '<td align="right" class="">
			  <input class="budget_type_limit_'.$item['id'].'" value="'.number_format($budget_total,2).'" type="hidden">
			  <input name="budget_commit[]" class="taRight inputcost odd sum_budget_'.$item['id'].'" style="border:0px;" type="text" value="'.@$fcrd['budget_commit'].'" alt="decimal">			  
			  <input type="hidden" name="budgettype_id[]" value="'.$item['id'].'">
			  <input type="hidden" name="expensetype_id[]" value="0">
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
			  </td>';
		    $data .= '</tr>';
			
			$sresult =  $this->budget_type->where("PID=".$item['id'])->get();
			foreach($sresult as $srow):
				
			switch($budget_type):
				default:
					$sql = "SELECT SUM(BUDGET) FROM FN_BUDGET_TYPE_DETAIL 
					WHERE BUDGETID=".$projectID." AND 
					BUDGETTYPEID =".$srow['id'];														
				break;			
			endswitch;
			/*--3--*/$expense = $this->db->getone($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)
			
			$with_id_condition = "";
			$expense_relate_net=0;
			
			$sql_b_relate = " SELECT SUM(BUDGET) FROM FN_BUDGET_RELATED FBR 
					LEFT JOIN FN_BUDGET_RELATED_DETAIL FBRD ON FBR.ID = FBRD.BUDGET_RELATED_ID 
					WHERE PROJECTID=".$projectID." AND BUDGET_TYPE=".$budget_type." AND BUDGETTYPE_ID=".$item['id'];
			$b_related = $this->db->getone($sql_b_relate); //ยอดผูกพันหลักการ (กรณีเป็นการแก้ไข จะไม่รวมตัวมันเอง )		
					
			$sql_e_relate = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED FCR 
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID  
					WHERE PROJECTID=".$projectID." AND BUDGET_TYPE=".$budget_type." AND BUDGETTYPE_ID=".$srow['id'];							
			$expense_relate = $this->db->getone($sql_e_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
												
			$sql_e_return = " SELECT SUM(BUDGET_COMMIT) FROM FN_BUDGET_RETURN FBR 
			LEFT JOIN FN_BUDGET_RETURN_DETAIL FBRD ON FBR.ID = FBRD.FN_BOOK_RETURN_ID
			LEFT JOIN FN_BUDGET_RELATED FB ON FBR.BUDGET_RELATED_ID = FB.ID
			LEFT JOIN FN_COST_RELATED FC ON FBR.COST_RELATED_ID = FC.ID
			WHERE BUDGETTYPE_ID=".$srow['id']." AND (FB.PROJECTID=".$projectID." OR FC.PROJECTID=".$projectID.")";
			$e_return = $this->db->getone($sql_e_return);
			
			$sql_w_replace = " SELECT SUM(BUDGET_COMMIT) FROM FN_WITHDRAW_REPLACE FWR LEFT JOIN 
			FN_WITHDRAW_REPLACE_DETAIL FWRD ON FWR.ID = FWRD.WITHDRAW_REPLACE_ID WHERE BUDGETTYPE_ID=".$srow['id'];
			$sql_w_replace.= $id > 0 ? " AND FWD.ID <> ".$id : "";
			echo $w_replace = $this->db->getone($sql_w_replace);
			
			$expense_relate = ($expense_relate - $e_return) + $w_replace;
			/*--4--/$expense_relate; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)			
			/*--5--*/$expense_total = $expense - $expense_relate ; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			/*--6--*$b_related;
			/*--7--*$c_related;*/	
			/*--8--*/$budget_related_net = $b_related - $c_related + $e_return;								
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET FROM  FN_COST_RELATED FCR 
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE FCR.ID=".$id." AND BUDGETTYPE_ID=".$item['id'];
			$expense_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)		
			$fcrd = $this->withdraw_replace_detail->where('withdraw_replace_id = '.$id.' and expensetype_id = '.$srow['id'])->get_row();
			}				
			
			$tmp_budget_total = $expense - $expense_relate_net;
			
			  $data .= '<tr>';
  			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  $data .= '<td height="36" nowrap="nowrap">'.$srow['title'].'</td>';
			  /*--3--*/$data .= '<td align="right" class="sc1"></td>';			  
			  /*--5--*/$data .= '<td align="right" class=""></td>';			  
			  /*--9--*/$data .= '<td align="right" class="">			  			  
			  <input name="budget_commit[]" class="taRight inputcost budget_'.$item['id'].' cost_'.$item['id'].'_'.$srow['id'].'" type="text" value="'.@$fcrd['budget_commit'].'" alt="decimal" onkeyup="CalculateSummary(\''.$item['id'].'\',\''.$srow['id'].'\')">			  			  
			  <input type="hidden" name="budgettype_id[]" value="'.$item['id'].'">
			  <input type="hidden" name="expensetype_id[]" value="'.$srow['id'].'">
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
			  <input class="tmp_cost_'.$item['id'].'_'.$srow['id'].'" type="hidden" value="'.@$fcrd['budget_commit'].'" alt="decimal">
			  <input class="expense_type_limit_'.$srow['id'].'" type="hidden" value="'.number_format(@$expense_total,2).'">
			  </td>';
		    $data .= '</tr>';
			endforeach;
		endforeach;
		$data .= '</table>';
		if($id>0)
		{
			return $data;
		}			
		else
		{
			echo $data;
		}		
	}
	
}
?>