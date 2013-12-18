<?php
class Finance_cost_related extends Finance_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('fn_cost_related_model','fcr');
		$this->load->model('fn_cost_related_detail_model','fcrd');
		$this->load->model('finance_budget_related/fn_budget_related_model','fbr');
		$this->load->model('finance_budget_plan/fn_budget_type_detail_model','budget_type_detail');		
		$this->load->model('finance_budget_plan/fn_budget_master_model','budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');
	}
	
	function index()
	{
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$condition = " 1=1 ";
		$condition .= @$_GET['book_cost_id'] != '' ? " and book_cost_id like '%".$_GET['book_cost_id']."%'":"";
		$condition .= @$_GET['budgetyear'] > 0 ? " and budgetyear = ".$_GET['budgetyear']:"";
		$condition .= @$_GET['budgetplantype'] > 0 ? " and budgetplantype = ".$_GET['budgetplantype']:"";
		$condition .= @$_GET['departmentid'] > 0 ? " and departmentid = ".$_GET['departmentid']:"";
		$condition .= @$_GET['divisionid'] > 0 ? " and divisionid = ".$_GET['divisionid']:"";
		$condition .= @$_GET['workgroup_id'] > 0 ? " and workgroup_id = ".$_GET['workgroup_id']:"";
		$s_date=(@$_GET['datestart'])?strtotime((date_to_mysql(@$_GET['datestart'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['dateend'])?strtotime((date_to_mysql(@$_GET['dateend'],TRUE))." 23:59:59"):"9999999999";
		$condition .= " and (related_cost_date between ".$s_date." and ".$e_date.")"; 	
		
		$data['cost_relateds'] = $this->fcr->where($condition)->get();
		$data['pagination'] = $this->fcr->pagination();
		$this->template->build('finance_cost_related_index',$data);
	}
	
	function form($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['rs'] = $this->fcr->get_row($id);
		if($id > 0)
		{
			if($data['rs']['book_id'] > 0){			
				$data['budgetdata'] = $this->show_expense_detail_headonly($id,$data['rs']['budget_type'],$data['rs']['projectid'],$data['rs']['book_id']);
			}else{
				$data['budgetdata'] = $this->show_expense_detail_headonly_ajax($data['rs']['budget_type'],$data['rs']['projectid'],$id);
			}
		}		
		$this->template->build('finance_cost_related_form',$data);
	}
	
	function form_budget_related($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		$data['rs'] = $this->fbr->get_row($id);
		$data['rs']['book_id'] = $id;
		$data['fn_budget_related_id'] = $data['rs']['id'];
		if($id > 0)
		{			
			$data['budgetdata'] = $this->show_expense_detail_headonly(0,$data['rs']['budget_type'],$data['rs']['projectid'],$id);
		}
		$this->template->build('finance_cost_related_form',$data);
	}
	
	function save(){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		/*
		echo '<pre>';
		var_dump($_POST);
		echo '</pre>';exit;
		*/
		//$this->db->debug = true;
		if($_POST){
			$_POST['book_cost_date']=($_POST['book_cost_date']!="")? th_to_stamp($_POST['book_cost_date']):0;
			$_POST['finance_cost_date']=($_POST['finance_cost_date']!="")? th_to_stamp($_POST['finance_cost_date']):0;
			$_POST['related_cost_date']=($_POST['related_cost_date']!="")? th_to_stamp($_POST['related_cost_date']):0;
			
			$id = $this->fcr->save($_POST);
			
			if($_POST['budgettype_id']){
				foreach($_POST['budgettype_id'] as $key=>$item){
					if($_POST['budgettype_id'][$key]){
						$this->fcrd->save(array(
							'id'=>$_POST['fcrd_id'][$key],
							'fn_cost_related_id'=>$id,
							'budgettype_id'=>$_POST['budgettype_id'][$key],
							'budget_commit'=>str_replace(",",'',$_POST['budget_commit'][$key])
						));
					}
				}
			}	
			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_cost_related/index');
	}
	
	function delete($id=false){
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		if($id){
			$this->fcr->delete($id);
			$this->fcrd->delete('fn_cost_related_id',$id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	function show_expense_detail_headonly($id=FALSE,$budget_type=FALSE,$projectID=FALSE,$book_id=FALSE)
	{
		
		$projectID = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectID;
		$data='<table id="tblist2" class="tblist2">
		<tr>
	  		<th style="text-align:left">หมวดงบประมาณ</th>
	  		<th style="text-align:left">หมวดรายจ่าย</th>
	  		';
	  		switch($budget_type):
						case 1:
						$data .='<th style="text-align:right">งบจัดสรร</th>';
						break;
						case 2:
						$data .='<th style="text-align:right">งบจัดสรรจากหน่วยงานอื่น</th>';
						break;
						case 3:
						$data .='<th style="text-align:right">เงินกันเหลื่อมปี</th>';
						break;
						case 4:
						$data .='<th style="text-align:right">งบประมาณระหว่างปี</th>';
						break;					
					endswitch;
	  		$data.='
	  		<th style="text-align:right">จำนวนเงินผูกพันทั้งหมด </th>
	  		<th style="text-align:right">คงเหลือ</th>
	  		<th style="text-align:right">ผูกพันหลักการ</th>
	  		<th style="text-align:right">ยอดเงินผูกพันค่าใช้จ่าย</th>
	  		<th style="text-align:right">ยอดผูกพันหลักการคงเหลือ</th>
	  		<th style="text-align:right">ขอผูกพันงบประมาณจำนวน</th>
	  	</tr>';
		//$this->db->debug = true;
		$result = $this->budget_type->where("PID=0")->get();		
		foreach($result as $item):					
		
		switch($budget_type):
				case 2:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_FOR_WITHDRAW_REPLACE FM 
					LEFT JOIN FN_RECEIVE_FOR_WITHDRAW_REPLACE_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectID." AND BUDGETTYPE_ID =".$item['id'];										
				break;
				case 3:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_YEAR_OVERLAP FM 
					LEFT JOIN FN_RECEIVE_YEAR_OVERLAP_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectID." AND BUDGETTYPE_ID =".$item['id'];		
				break;
				case 4:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_MONEY_DURING_YEAR FM 
					LEFT JOIN FN_MONEY_DURING_YEAR_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectID." AND BUDGETTYPE_ID =".$item['id'];		
				break;
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
					WHERE PROJECTID=".$projectID." AND BUDGET_TYPE=".$budget_type." AND BUDGETTYPE_ID=".$item['id']." AND FBR.ID=".$book_id;
			$curr_b_related = $this->db->getone($sql_b_relate); //ยอดผูกพันหลักการ (กรณีเป็นการแก้ไข จะไม่รวมตัวมันเอง )
			
			$sql_c_relate = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED FCR
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE PROJECTID=".$projectID." AND BUDGET_TYPE=".$budget_type." AND BOOK_ID=".$book_id." AND BUDGETTYPE_ID=".$item['id'];
			$sql_c_relate.= $id > 0 ? " AND FCR.ID <> ".$id : "";					
			$curr_c_related = $this->db->getone($sql_c_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
			
			$curr_related_net = $curr_b_related - $curr_c_related;
			
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
			WHERE BUDGETTYPE_ID=".$item['id']." AND FC.BUDGET_TYPE = ".$budget_type." AND (FB.PROJECTID=".$projectID." OR FC.PROJECTID=".$projectID.")";
			
			$b_return = $this->db->getone($sql_b_return);
			/*--4--*/$total_relate = ($b_related + $c_related)-$b_return; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)	
			
						
			/*--5--*/$budget_total = $budget_alloc - $total_relate; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			/*--6--*$b_related;
			/*--7--*$c_related;*/	
			/*--8--*/$budget_related_net = $b_related - $c_related;					
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET_COMMIT FROM  FN_COST_RELATED FCR 
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE FCR.ID=".$id." AND BUDGETTYPE_ID=".$item['id'];
			$budget_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)			
			$fcrd = $this->fcrd->where('fn_cost_related_id = '.$id.' and budgettype_id = '.$item['id'])->get_row();
			}
			
			$tmp_budget_total = $budget_total - $budget_relate_net;
			
			$data .= '<tr class="odd">';
			  $data .= '<td height="36" nowrap="nowrap">'.$item['title'].'</td>';
			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  /*--3--*/$data .= '<td align="right" class="">'.number_format($budget_alloc,2).'</td>';
			  /*--4--*/$data .= '<td align="right" class="">'.number_format($total_relate,2).'</td>';
			  /*--5--*/$data .= '<td align="right" class="">'.number_format($budget_total,2).'</td>';
			  /*--6--*/$data .= '<td align="right" class="">'.number_format($curr_b_related,2).'</td>';
			  /*--7--*/$data .= '<td align="right" class="">'.number_format($curr_c_related,2).'</td>';
			  /*--8--*/$data .= '<td align="right" class="">'.number_format($curr_related_net,2).'</td>';
			  /*--9--*/$data .= '<td align="right" class="">
			  
			  <input class="budget_type_limit_'.$item['id'].'" value="'.number_format($curr_related_net,2).'" type="hidden">
			  <input name="budget_commit[]" class="taRight inputcost odd sum_budget_'.$item['id'].'" style="border:0px;" type="text" value="'.@$fcrd['budget_commit'].'" alt="decimal">			  
			  <input type="hidden" name="budgettype_id[]" value='.$item['id'].'>
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
			  </td>';
		    $data .= '</tr>';
			
			$sresult =  $this->budget_type->where("PID=".$item['id'])->get();
			foreach($sresult as $srow):
				
			switch($budget_type):
				case 2:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_FOR_WITHDRAW_REPLACE FM 
					LEFT JOIN FN_RECEIVE_FOR_WITHDRAW_REPLACE_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectID." AND EXPENSETYPE_ID =".$srow['id'];										
				break;
				case 3:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_RECEIVE_YEAR_OVERLAP FM 
					LEFT JOIN FN_RECEIVE_YEAR_OVERLAP_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectID." AND EXPENSETYPE_ID =".$srow['id'];		
				break;
				case 4:
					$sql = " SELECT SUM(EXPENSE_COMMIT) FROM FN_MONEY_DURING_YEAR FM 
					LEFT JOIN FN_MONEY_DURING_YEAR_DETAIL FD	ON FM.ID = FD.PID
					WHERE PROJECTID=".$projectID." AND EXPENSETYPE_ID =".$srow['id'];		
				break;
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
			$sql_e_relate.= $id > 0 ? " AND FCR.ID <> ".$id : "";					
			$expense_relate = $this->db->getone($sql_e_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ			
			
			$sql_e_return = " SELECT SUM(BUDGET_COMMIT) FROM FN_BUDGET_RETURN FBR 
			LEFT JOIN FN_BUDGET_RETURN_DETAIL FBRD ON FBR.ID = FBRD.FN_BOOK_RETURN_ID
			LEFT JOIN FN_BUDGET_RELATED FB ON FBR.BUDGET_RELATED_ID = FB.ID
			LEFT JOIN FN_COST_RELATED FC ON FBR.COST_RELATED_ID = FC.ID
			WHERE BUDGETTYPE_ID=".$srow['id']." AND FC.BUDGET_TYPE = ".$budget_type." AND (FB.PROJECTID=".$projectID." OR FC.PROJECTID=".$projectID.")";
			$e_return = $this->db->getone($sql_e_return);
			$expense_relate = $expense_relate - $e_return;			
			/*--4--/$expense_relate; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)			
			/*--5--*/$expense_total = ($expense - $expense_relate); //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			/*--6--*$b_related;
			/*--7--*$c_related;*/	
			/*--8--*/$budget_related_net = ($b_related - $c_related);								
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET FROM  FN_COST_RELATED FCR 
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE FCR.ID=".$id." AND BUDGETTYPE_ID=".$item['id'];
			$expense_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)		
			$fcrd = $this->fcrd->where('fn_cost_related_id = '.$id.' and budgettype_id = '.$srow['id'])->get_row();
			}				
			
			$tmp_budget_total = $expense - $expense_relate_net;
			
			  $data .= '<tr>';
  			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  $data .= '<td height="36" nowrap="nowrap">'.$srow['title'].'</td>';
			  
			  
			  ///*--3--*/$data .= '<td align="right" class="sc1">'.number_format(@$expense,2).'</td>';
			  /*--3--*/$data .= '<td align="right" class="sc1"></td>';
			  
			  
			  ///*--4--*/$data .= '<td align="right" class="">'.number_format(@$expense_relate,2).'</td>';
			  ///*--5--*/$data .= '<td align="right" class="">'.number_format(@$expense_total,2).'</td>';
			  
			  /*--4--*/$data .= '<td align="right" class=""></td>';
			  /*--5--*/$data .= '<td align="right" class=""></td>';
			  
			  /*--6--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--7--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--8--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--9--*/$data .= '<td align="right" class="">
			  
			  <input class="expense_type_limit_'.$srow['id'].'" type="hidden" value="'.number_format(@$expense_total,2).'">
			  <input class="tmp_cost_'.$item['id'].'_'.$srow['id'].'" type="hidden" value="'.@$fcrd['budget_commit'].'" alt="decimal">
			  <input name="budget_commit[]" class="taRight inputcost budget_'.$item['id'].' cost_'.$item['id'].'_'.$srow['id'].'" type="text" value="'.@$fcrd['budget_commit'].'" alt="decimal" onkeyup="CalculateSummary(\''.$item['id'].'\',\''.$srow['id'].'\')">			  			  
			  <input type="hidden" name="budgettype_id[]" value='.$srow['id'].'>
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
			  </td>';
		    $data .= '</tr>';
			endforeach;
		endforeach;
		$data .= '</table>';
			return $data;
	}

	function show_expense_detail_headonly_ajax($budget_type=FALSE,$projectID=FALSE,$id=FALSE)
	{		
		$projectID = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectID;
		$data='<table id="tblist2" class="tblist2">
		<tr>
	  		<th style="text-align:left">หมวดงบประมาณ</th>
	  		<th style="text-align:left">หมวดรายจ่าย</th>
	  		<th style="text-align:right">งบจัดสรร</th>
	  		<th style="text-align:right">จำนวนเงินผูกพันทั้งหมด </th>
	  		<th style="text-align:right">คงเหลือ</th>
	  		<th style="text-align:right">ผูกพันหลักการ</th>
	  		<th style="text-align:right">ยอดเงินผูกพันค่าใช้จ่าย</th>
	  		<th style="text-align:right">ยอดผูกพันหลักการคงเหลือ</th>
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
			echo $sql_c_relate.= $id > 0 ? " AND FCR.ID <> ".$id : "";					
			$c_related = $this->db->getone($sql_c_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
			
			$sql_b_return = " SELECT SUM(BUDGET_COMMIT) FROM FN_BUDGET_RETURN FBR 
			LEFT JOIN FN_BUDGET_RETURN_DETAIL FBRD ON FBR.ID = FBRD.FN_BOOK_RETURN_ID
			LEFT JOIN FN_BUDGET_RELATED FB ON FBR.BUDGET_RELATED_ID = FB.ID
			LEFT JOIN FN_COST_RELATED FC ON FBR.COST_RELATED_ID = FC.ID
			WHERE BUDGETTYPE_ID=".$item['id']." AND (FB.PROJECTID=".$projectID." OR FC.PROJECTID=".$projectID.")";
			$b_return = $this->db->getone($sql_b_return);
			
			/*--4--*/$total_relate = $b_related + $c_related - $sql_b_return; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)			
			/*--5--*/$budget_total = $budget_alloc - $total_relate; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			/*--6--*$b_related;
			/*--7--*$c_related;*/	
			/*--8--*/$budget_related_net = $b_related - $c_related;					
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET_COMMIT FROM  FN_COST_RELATED FCR 
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE FCR.ID=".$id." AND BUDGETTYPE_ID=".$item['id'];
			$budget_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)			
			$fcrd = $this->fcrd->where('fn_cost_related_id = '.$id.' and budgettype_id = '.$item['id'])->get_row();
			}
			
			$tmp_budget_total = $budget_total - $budget_relate_net;
			
			$data .= '<tr class="odd">';
			  $data .= '<td height="36" nowrap="nowrap">'.$item['title'].'</td>';
			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  /*--3--*/$data .= '<td align="right" class="">'.number_format($budget_alloc,2).'</td>';
			  /*--4--*/$data .= '<td align="right" class="">'.number_format($total_relate,2).'</td>';
			  /*--5--*/$data .= '<td align="right" class="">'.number_format($budget_total,2).'</td>';
			  /*--6--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--7--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--8--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--9--*/$data .= '<td align="right" class="">
			  <input class="budget_type_limit_'.$item['id'].'" value="'.number_format($budget_total,2).'" type="hidden">
			  <input name="budget_commit[]" class="taRight inputcost odd sum_budget_'.$item['id'].'" style="border:0px;" type="text" value="'.@$fcrd['budget_commit'].'" alt="decimal">			  
			  <input type="hidden" name="budgettype_id[]" value='.$item['id'].'>
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
			$sql_e_relate.= $id > 0 ? " AND FCR.ID <> ".$id : "";					
			$expense_relate = $this->db->getone($sql_e_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
			
			/*--4--/$expense_relate; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)			
			/*--5--*/$expense_total = $expense - $expense_relate; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			/*--6--*$b_related;
			/*--7--*$c_related;*/	
			/*--8--*/$budget_related_net = $b_related - $c_related;								
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET FROM  FN_COST_RELATED FCR 
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE FCR.ID=".$id." AND BUDGETTYPE_ID=".$item['id'];
			$expense_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)		
			$fcrd = $this->fcrd->where('fn_cost_related_id = '.$id.' and budgettype_id = '.$srow['id'])->get_row();
			}				
			
			$tmp_budget_total = $expense - $expense_relate_net;
			
			  $data .= '<tr>';
  			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  $data .= '<td height="36" nowrap="nowrap">'.$srow['title'].'</td>';
			  /*--3--*/$data .= '<td align="right" class="sc1">'.number_format(@$expense,2).'</td>';
			  /*--4--*/$data .= '<td align="right" class="">'.number_format(@$expense_relate,2).'</td>';
			  /*--5--*/$data .= '<td align="right" class="">'.number_format(@$expense_total,2).'</td>';
			  /*--6--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--7--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--8--*/$data .= '<td align="right" class="">0.00</td>';
			  /*--9--*/$data .= '<td align="right" class="">
			  
			  <input class="expense_type_limit_'.$srow['id'].'" type="hidden" value="'.number_format(@$expense_total,2).'">
			  <input class="tmp_cost_'.$item['id'].'_'.$srow['id'].'" type="hidden" value="'.@$fcrd['budget_commit'].'" alt="decimal">
			  <input name="budget_commit[]" class="taRight inputcost budget_'.$item['id'].' cost_'.$item['id'].'_'.$srow['id'].'" type="text" value="'.@$fcrd['budget_commit'].'" alt="decimal" onkeyup="CalculateSummary(\''.$item['id'].'\',\''.$srow['id'].'\')">			  			  
			  <input type="hidden" name="budgettype_id[]" value='.$srow['id'].'>
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
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