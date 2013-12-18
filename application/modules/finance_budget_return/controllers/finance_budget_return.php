<?php
class Finance_budget_return extends Finance_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('finance_budget_id/fn_strategy_model','strategy');
		$this->load->model('finance_budget_related/fn_budget_related_model','fbr');
		$this->load->model('finance_budget_related/fn_budget_related_detail_model','fbrd');
		$this->load->model('c_department/department_model','department');
		$this->load->model('c_division/division_model','division');
		$this->load->model('c_workgroup/workgroup_model','workgroup');
		$this->load->model('finance_budget_plan/fn_budget_master_model','budget_master');
		$this->load->model('finance_budget_plan/fn_budget_type_model','budget_type');
		$this->load->model('finance_cost_related/fn_cost_related_model','fcr');
		$this->load->model('finance_cost_related/fn_cost_related_detail_model','fcrd');
		$this->load->model('finance_approve_withdraw/fn_approve_withdraw_model','approve_withdraw');
		$this->load->model('fn_budget_return_model','budget_return');
		$this->load->model('custom_fn_budget_return_model','view_budget_return');
		$this->load->model('fn_budget_return_detail_model','budget_return_detail');
	}
	
	function index()
	{		
		//$this->db->debug=TRUE;
		/* search */
		$data['url_parameter'] = GetCurrentUrlGetParameter();
		
		$condition = " 1=1 ";
		$condition  .= @$_GET['related_id']!=""? " and book_related_id like '%".$_GET['related_id']."%' " : "";
		$condition .= @$_GET['cost_id'] != "" ? " and book_cost_id='".$_GET['cost_id']."' " : "";						
		$condition .= @$_GET['budgetyear']!="" ? " and budgetyear=".@$_GET['budgetyear']:"";
		$condition .= @$_GET['budgetplantype']!= "" ? " and budgetplantype=".$_GET['budgetplantype'] : "";
		$condition .= @$_GET['budgetyeartype']!= "" ? " and budgetyeartype=".$_GET['budgetyeartype'] : "";		
		$condition .=@$_GET['departmentid']!=""? " and departmentid=".@$_GET['departmentid']:"";
		$condition .=@$_GET['divisionid']!=""? " and divisionid=".@$_GET['divisionid']:"";
		$condition .=@$_GET['workgroupid']!=""? " and workgroupid=".@$_GET['workgroupid']:"";
		
		$op_condition = '';		
		$s_date=(@$_GET['startdate'])?strtotime((date_to_mysql(@$_GET['startdate'],TRUE))." 00:00:01"):"0000000000";
		$e_date=(@$_GET['enddate'])?strtotime((date_to_mysql(@$_GET['enddate'],TRUE))." 23:59:59"):"9999999999";
		$op_condition .= " and (WITHDRAWDATE between ".$s_date." and ".$e_date.")"; 	
		//$related_date=(@$_GET['related_date1']!="" && @$_GET['related_date2']!="")? "and(related_date BETWEEN ".th_to_stamp(@$_GET['related_date1'])." and ".$related_date1.") AND ( related_date BETWEEN ".th_to_stamp(@$_GET['related_date2'])." and ".$related_date2.")":"";
		
		$related_date="";
		
		if(@$_GET['related_date1']!="" && @$_GET['related_date2']!="")
		{
			$related_date=" AND(related_date BETWEEN ".th_to_stamp(@$_GET['related_date1'])." AND ".$related_date1.") 
						    AND(related_date BETWEEN ".th_to_stamp(@$_GET['related_date2'])." AND ".$related_date2.")";
		}
		else{
			if(@$_GET['related_date1']!="")
			{
				$related_date=" AND(related_date BETWEEN ".th_to_stamp(@$_GET['related_date1'])." AND ".$related_date1.")";
			}else if(@$_GET['related_date2']!=""){
				$related_date=" AND(related_date BETWEEN ".th_to_stamp(@$_GET['related_date2'])." AND ".$related_date2.")";
			}
		} 
						
		$data['datalist'] =$this->view_budget_return->where($condition)->get();		  		
		$data['pagination']=$this->view_budget_return->pagination();
		$this->template->build('finance_budget_return_index',$data);
	}
	
	function form($id=FALSE)
	{		
		$rs =$this->fbr->get_row($id);
		$data['id']=$rs['id'];
		$data['book_id']=$rs['book_id'];
		$data['book_date']=($rs['book_date']!="0")?stamp_to_th_fulldate($rs['book_date']):"";
		$data['finance_id']=$rs['finance_id'];
		$data['finance_date']=($rs['finance_date']!="0")?stamp_to_th_fulldate($rs['finance_date']):"";
		$data['return_date']=$rs['return_date'];
		$data['title']=$rs['title'];
		$data['detail']=$rs['detail'];
		$data['budgetyear']=$rs['budgetyear'];
		$data['budgetplantype']=$this->fn_strategy->get_one("title","id",$rs['budgetplantype']);
		$data['budgetyeartype']=$this->fn_strategy->get_one("title","id",$rs['budgetyeartype']);
		$data['planid']=$this->fn_strategy->get_one("title","id",$rs['planid']);
		$data['productivityid']=$this->fn_strategy->get_one("title","id",$rs['productivityid']);
		$data['mainactid']=$this->fn_strategy->get_one("title","id",$rs['mainactid']);
		$data['subactivityid']=$this->fn_strategy->get_one("title","id",$rs['subactivityid']);
		$data['departmentid']=$this->department->get_one("title","id",$rs['departmentid']);
		$data['divisionid']=$this->division->get_one("title","id",$rs['divisionid']);
		$data['workgroupid']=$this->workgroup->get_one("title","id",$rs['workgroupid']);
		$data['projectid']=$rs['projectid'];						
			
		/*ยอดผูกผันงบประมาณทั้งหมด  */
	    $data['budgettype']=$this->fn_budget_type->select("fn_budget_type.title as title,fn_budget_related_detail.id as detail_id,fn_budget_related_detail.*")
								 ->join("inner join fn_budget_related_detail  on fn_budget_type.id=fn_budget_related_detail.budgettype_id")
								 ->where("budget_related_id=".$id)->get();
								 
	    
	    //sum รวมทั้งหมด ไม่แยกประเภทงบ
	    $data['budget_all']=$this->fn_budget_related_detail->get_one("sum(budget_return) as budget_all","budget_related_id",$id);
		//sum ของ fn_budget_cost_related
		$budget_cost=cal_budget_other($rs['projectid']);

		
		$this->template->build('finance_budget_return_form',$data);
	}
	
	function save()
	{
		//$this->db->debug= true;
		if($_POST)
		{	
			$_POST['returndate']= $_POST['returndate']!="" ? th_to_stamp($_POST['returndate']):0;						
			$id=$this->budget_return->save($_POST);						

			$this->budget_return_detail->delete("fn_book_return_id",$id);
			if($_POST['budgettype_id']){
				foreach($_POST['budgettype_id'] as $key=>$item){
					if($_POST['budgettype_id'][$key]){
						$this->budget_return_detail->save(array(						
							'fn_book_return_id'=>$id,
							'budgettype_id'=>$_POST['budgettype_id'][$key],
							'budget_commit'=>str_replace(",",'',$_POST['budget_commit'][$key])
						));
					}
				}
			}								


			set_notify('success', lang('save_data_complete'));
		}
		redirect('finance_budget_return/index');
	}
	
	function delete($id=FALSE){
		if($id){
			$this->fn_budget_related->delete($id);
			set_notify('success', lang('delete_data_complete'));
		}
		redirect($_SERVER['HTTP_REFERER']);
	}

	function list_return(){
		//$this->db->debug=true;
		$data='';
		$page = (isset($_GET['page']))? $_GET['page']:1;
  		$i=(isset($_GET['page']))? (($_GET['page'] -1)* 20)+1:1;
		$class = "";
		$dataList='';
		if(@$_GET['related_type']=='budget')
		{
			$condition = " 1=1 ";
			$condition .= @$_GET['book_no'] != "" ? " and book_id like '%".$_GET['book_no']."%' " : "";
			
			$s_date=(@$_GET['startdate'])?strtotime((date_to_mysql(@$_GET['startdate'],TRUE))." 00:00:00"):"0000000000";
			$e_date=(@$_GET['enddate'])?strtotime((date_to_mysql(@$_GET['enddate'],TRUE))." 23:59:59"):"9999999999";
			$condition .= " and (related_date between ".$s_date." and ".$e_date.")"; 	
			$condition .= @$_GET['department_id'] != '' ? " and fn_budget_related.departmentid=".$_GET['department_id'] : "";
			$condition .= @$_GET['division_id'] != '' ? " and fn_budget_related.divisionid=".$_GET['division_id'] : "";
			$condition .= @$_GET['workgroup_id'] != '' ? " and fn_budget_related.workgroupid=".$_GET['workgroup_id'] : "";
			
			$result = $this->fbr->where($condition)->get();
			$data['pagination'] = $this->fbr->pagination();						
			foreach($result as $row):		
			$class = $class == ''? "odd" : "";	
			$dataList.='<tr class="'.$class.'">';
			  $dataList.='<td valign="middle">'.$i.'</td>';
			  $dataList.='<td valign="top" nowrap="nowrap">'.$row['book_id'].'</td>';
			  $dataList.='<td valign="top">';				  			 
			  	$sresult = $this->fcr->select("fn_cost_related.*")->where("book_id=".$row['id'])->get(FALSE,TRUE);
				foreach($sresult as $srow):
					$dataList.=$srow['book_cost_id']."<br/>";	
				endforeach;				
			  $dataList.='&nbsp;';
			  $dataList.='</td>';
			  $dataList.='<td valign="top">';
			    if(count($sresult)>0){			    
				foreach($sresult as $srow):
					$dataList.= $srow['related_cost_date'] > 0 ? stamp_to_th_fulldate($srow['related_cost_date'])."<br/>" : "&nbsp;<br/>";	
				endforeach;			
				}else{
					$dataList.= $row['related_date'] > 0 ? stamp_to_th_fulldate($row['related_date'])."<br/>" : "&nbsp;<br/>";
				}
			  
			  $dataList.='</td>';	
			  $dataList.='<td valign="top" align="right">';
			  if(count($sresult)>0){			 			 
				foreach($sresult as $srow):
					$sql = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED_DETAIL WHERE FN_COST_RELATED_ID=".$srow['id']." 
					AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID > 0 AND EXPENSETYPEID=0) ";
					$budget = $this->db->getone($sql);
					$dataList.= number_format($budget,2)."<br/>";	
				endforeach;
			  }else{
			  		$sql = " SELECT SUM(BUDGET) FROM FN_BUDGET_RELATED_DETAIL WHERE BUDGET_RELATED_ID=".$row['id']." 
					AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=0) ";
					$budget = $this->db->getone($sql);
					$dataList.= number_format($budget,2)."<br/>";
			  }
			  $dataList.='</td>';
			  $dataList.='<td valign="top" align="right">';
		      if(count($sresult)>0){			 			 
				foreach($sresult as $srow):
					$sql = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED_DETAIL WHERE FN_COST_RELATED_ID=".$srow['id']." 
					AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID > 0 AND EXPENSETYPEID=0) ";
					$budget = $this->db->getone($sql);
					$dataList.= number_format($budget,2)."<br/>";	
				endforeach;
			  }else{
			  		$sql = " SELECT SUM(BUDGET) FROM FN_BUDGET_RELATED_DETAIL WHERE BUDGET_RELATED_ID=".$row['id']." 
					AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=0) ";
					$budget = $this->db->getone($sql);
					$dataList.= number_format($budget,2)."<br/>";
			  }		  
			  $dataList.='</td>';
			  $dataList.='<td valign="top" align="center">';
			  if(count($sresult) > 0){
				foreach($sresult as $srow):
				$exist = $this->db->getone("SELECT COUNT(*) FROM FN_BUDGET_RETURN WHERE COST_RELATED_ID=".$srow['id']);				
				$dataList.=$exist == 0 ? '<input type="submit" name="button" id="button" title="คืนงบประมาณ" value=" " class="btn_return_budget cursor vtip" 
			  			  onclick="window.location=\'finance_budget_return/return_form/'.$row['id'].'/'.$srow['id'].'\'"/><br/>' : "&nbsp;<br/>";
				endforeach;
				}else{
				$exist = $this->db->getone("SELECT COUNT(*) FROM FN_BUDGET_RETURN WHERE BUDGET_RELATED_ID=".$row['id']." AND COST_RELATED_ID=0 ");				
				$dataList.=$exist == 0 ? '<input type="submit" name="button" id="button" title="คืนงบประมาณ" value=" " class="btn_return_budget cursor vtip" 
			  			  onclick="window.location=\'finance_budget_return/return_form/'.$row['id'].'/\'"/><br/>' : "&nbsp;<br/>";
				}							  
			  $dataList.='</td>';
			$dataList.='</tr>';
			$i++;
			endforeach;
			
		}
		else if(@$_GET['related_type']=='cost')
		{
			$result = $this->fcr->where("book_id =0 ")->get();
			$data['pagination'] = $this->fcr->pagination();	
			$dataList='';
			foreach($result as $row):		
			$class = $class == ''? "odd" : "";	
			$dataList.='<tr class="'.$class.'">';
			  $dataList.='<td valign="middle">'.$i.'</td>';
			  $dataList.='<td valign="top" nowrap="nowrap">&nbsp;</td>';
			  $dataList.='<td valign="top">';				  			 			  	
			  $dataList.=$row['book_cost_id']."<br/>";								
			  $dataList.='&nbsp;';
			  $dataList.='</td>';
			  $dataList.='<td valign="top">';			    				
			  $dataList.= $row['related_cost_date'] > 0 ? stamp_to_th_fulldate($row['related_cost_date']) : "&nbsp;";										  
			  $dataList.='</td>';	
			  $dataList.='<td valign="top" align="right">';			 			 				
					$sql = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED_DETAIL WHERE FN_COST_RELATED_ID=".$row['id']." 
					AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID > 0 AND EXPENSETYPEID=0) ";
					$budget = $this->db->getone($sql);
			  $dataList.= number_format($budget,2);				
			  $dataList.='</td>';
			  $dataList.='<td valign="top" align="right">';				
					$sql = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED_DETAIL WHERE FN_COST_RELATED_ID=".$row['id']." 
					AND BUDGETTYPE_ID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID > 0 AND EXPENSETYPEID=0) ";
					$budget = $this->db->getone($sql);
			  $dataList.= number_format($budget,2)."<br/>";				
			  $dataList.='</td>';
			  $dataList.='<td valign="top" align="center">';				
			  $dataList.='<input type="submit" name="button" id="button" title="คืนงบประมาณ" value=" " class="btn_return_budget cursor vtip" 
			  onclick="window.location=\'finance_budget_return/return_form/0/'.$row['id'].'\'"/><br/>';							 
			  $dataList.='</td>';
			$dataList.='</tr>';
			$i++;
			endforeach;
		}	
		$data['dataList']=$dataList;	
		$this->template->build('finance_list_return',$data);
	}
	function return_form($budget_related_id=FALSE , $cost_related_id=FALSE,$id=FALSE){		
		//$this->db->debug = true;
		$data = "";
		$dataList = "";
		if($id>0){
			$budget_return = $this->view_budget_return->where("id=".$id)->get_row();
			$budget_related_id = $budget_return['budget_related_id'];
			$cost_related_id = $budget_return['cost_related_id'];
			$data['budget_return'] = $budget_return;		
		}
		if($budget_related_id > 0)
		{
			$data['budget_related'] = $this->fbr->get_row($budget_related_id);	
			$data['budgetplantype'] = $this->strategy->get_row($data['budget_related']['budgetplantype']);
			$data['plan'] = $this->strategy->get_row($data['budget_related']['planid']);
			$data['productivity'] = $this->strategy->get_row($data['budget_related']['productivityid']);
			$data['mainact'] = $this->strategy->get_row($data['budget_related']['mainactid']);
			$data['subact'] = $this->strategy->get_row($data['budget_related']['subactivityid']);
			$data['department'] = $this->department->get_row($data['budget_related']['departmentid']);
			$data['division'] = $this->division->get_row($data['budget_related']['divisionid']);
			$data['workgroup'] = $this->workgroup->get_row($data['budget_related']['workgroupid']);
			$dataList = $this->show_budget_table($data['budget_related']['budget_type'],$data['budget_related']['projectid'],$budget_related_id);
			$data['budget_type']=$data['budget_related']['budget_type'];
		}
		if($cost_related_id > 0)
		{
			$data['cost_related'] = $this->fcr->get_row($cost_related_id);
			$dataList = $this->show_cost_table($cost_related_id,$data['cost_related']['budget_type'],$data['cost_related']['projectid'],$budget_related_id);
			$data['approve_withdraw'] = $this->approve_withdraw->get_row("costid",$cost_related_id);
			$data['budgetplantype'] = $this->strategy->get_row($data['cost_related']['budgetplantype']);
			$data['plan'] = $this->strategy->get_row($data['cost_related']['planid']);
			$data['productivity'] = $this->strategy->get_row($data['cost_related']['productivityid']);
			$data['mainact'] = $this->strategy->get_row($data['cost_related']['mainactid']);
			$data['subact'] = $this->strategy->get_row($data['cost_related']['subactivityid']);
			$data['department'] = $this->department->get_row($data['cost_related']['departmentid']);
			$data['division'] = $this->division->get_row($data['cost_related']['divisionid']);
			$data['workgroup'] = $this->workgroup->get_row($data['cost_related']['workgroupid']);
			$data['budget_type']=$data['cost_related']['budget_type'];
		}
		
		
		$data['dataList'] = $dataList;
		$this->template->build('return_form',$data);
	}
	function show_budget_table($budget_type=FALSE,$projectid=FALSE,$id=FALSE)
	{
				$projectid = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectid;			

		
		$data='<h3>รายการยอดผูกพันงบประมาณ </h3>';
		$data .='<table id="tblist2" class="tblist2">';
				$data .='<tr>';
			  		$data .='<th style="text-align:left">หมวดงบประมาณ</th>';
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
					$data .='<th style="text-align:right">คงเหลือ</th>';
			  		$data .='<th style="text-align:right">เงินผูกผันงบประมาณ </th>';			  		
			  		$data .='<th style="text-align:right">คืนเงินงบประมาณจำนวน</th>';
			  	$data .='</tr>';
		$budgettype = $this->budget_type->where("PID=0")->get(FALSE,TRUE);								
		foreach($budgettype as $b):		
			switch($budget_type):
				default:
					$sql = "SELECT SUM(BUDGET) FROM FN_BUDGET_TYPE_DETAIL 
					WHERE BUDGETID=".$projectid." AND 
					BUDGETTYPEID IN (SELECT ID FROM FN_BUDGET_TYPE WHERE PID=".$b['id']." AND EXPENSETYPEID=0)";														
				break;			
			endswitch;			
			$budget_alloc = $this->db->getone($sql);//ยอดจัดสรร ของโครงการ (ตามประเภทงบ)
			
			$with_id_condition = "";
			$budget_relate_net=0;
			if($id > 0 )
			{
			$sql_relate_net = " SELECT BUDGET FROM  FN_BUDGET_RELATED FBR 
					LEFT JOIN FN_BUDGET_RELATED_DETAIL FBRD ON FBR.ID = FBRD.BUDGET_RELATED_ID 
					WHERE FBR.ID=".$id." AND BUDGETTYPE_ID=".$b['id'];
			$budget_relate_net = $this->db->getone($sql_relate_net);//ยอดผูกพันหลักการแต่ล่ะหมวด(กรณีแก้ไข)
			$with_id_condition = " AND FBR.ID <>".$id;
			}
			$sql_b_relate = " SELECT SUM(BUDGET) FROM FN_BUDGET_RELATED FBR 
					LEFT JOIN FN_BUDGET_RELATED_DETAIL FBRD ON FBR.ID = FBRD.BUDGET_RELATED_ID 
					WHERE PROJECTID=".$projectid." AND BUDGET_TYPE=".$budget_type." AND BUDGETTYPE_ID=".$b['id'].$with_id_condition;
			$b_related = $this->db->getone($sql_b_relate); //ยอดผูกพันหลักการ (กรณีเป็นการแก้ไข จะไม่รวมตัวมันเอง )		
					
			$sql_c_relate = " SELECT SUM(BUDGET_COMMIT) FROM FN_COST_RELATED FCR
					LEFT JOIN FN_COST_RELATED_DETAIL FCRD ON FCR.ID = FCRD.FN_COST_RELATED_ID 
					WHERE PROJECTID=".$projectid." AND BUDGET_TYPE=".$budget_type." AND BOOK_ID < 1  AND BUDGETTYPE_ID=".$b['id'];			
			$c_related = $this->db->getone($sql_c_relate); //ยอดผูกพันค่าใช้จ่าย ที่ไม่อ้างอิงจากผูกพันหลักการ
			
			$total_relate = $b_related + $c_related; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)
			$budget_total = $budget_alloc - $total_relate; //เงินคงเหลือทั้งหมด หลังหักยอด ผูกพัน (จัดสรร - ผูกพัน)
			$tmp_budget_total = $budget_total - $budget_relate_net;
			$tmp_budget_total = $id > 0 ? $budget_relate_net : $tmp_budget_total;
			//
			#2 $budget_alloc			
			#3 $total_relate
			#4 $budget_total
			#5 $budget_relate_net
		if(@$budget_relate_net > 0 ){
		$data .='<tr class="trbudget odd">';
		$data .='<td>'.$b['title'].'<input type="hidden" name="budgettype_id[]" value="'.$b['id'].'"></td>';#1
		$data .='<td align="right" class="td_budget_alloc">';#2
		$data .='<input type="hidden" name="budget_alloc[]" class="budget_alloc" value="'.number_format(@$budget_alloc,2).'">'.number_format(@$budget_alloc,2);
		$data .='</td>';
		$data .='<td align="right" class="td_budget_related">';#3
		$data .='<input type="hidden" name="total_relate[]" class="total_relate" value="'.number_format(@$total_relate,2).'">'.number_format(@$total_relate,2);
		$data .='</td>';
		$data .='<td align="right" class="td_budget_net">';#4
		$data .=number_format(@$budget_total,2);
		$data .='</td>';
		$data .='<td align="right" class="td_budget_related_net">';#5
		$data .= number_format(@$budget_relate_net,2);		
		$data .='<input name="budget_commit[]" type="hidden" class="text_related" alt="decimal"  value="'.@$budget_relate_net.'" style="text-align:right"/>';
		$data .='</td>';
		$data .='</tr>';
		}
		endforeach;
		$data .='</table>';		
		return $data;
	}
	function show_cost_table($id=FALSE,$budget_type=FALSE,$projectID=FALSE,$book_id=FALSE)
	{
	$projectID = @$_POST['projectid']> 0 ? @$_POST['projectid'] : $projectID;
		$data='<table id="tblist2" class="tblist2">
		<tr>
	  		<th style="text-align:left">หมวดงบประมาณ</th>
	  		<th style="text-align:left">หมวดรายจ่าย</th>
	  		<th style="text-align:right">งบจัดสรร</th>	  		
	  		<th style="text-align:right">คงเหลือ</th>
	  		<th style="text-align:right">เงินผูกผันงบประมาณ</th>	  		
	  		<th style="text-align:right">คืนเงินงบประมาณจำนวน</th>
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
			
			/*--4--*/$total_relate = $b_related + $c_related; //เงินผูกพันทั้งหมด  (หลักการ + ค่าใช้จ่าย)			
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
			$budget_total = $budget_alloc - @$fcrd['budget_commit'];
			}
			
			$tmp_budget_total = $budget_total - $budget_relate_net;
			if(@$fcrd['budget_commit']>0):
			$data .= '<tr class="odd">';
			  $data .= '<td height="36" nowrap="nowrap">'.$item['title'].'</td>';
			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  /*--3--*/$data .= '<td align="right" class="">'.number_format($budget_alloc,2).'</td>';
			  
			  /*--5--*/$data .= '<td align="right" class="">'.number_format($budget_total,2).'</td>';
			  /*--6--*/$data .= '<td align="right" class="">'.number_format(@$fcrd['budget_commit'],2).'</td>';			  
			  /*--9--*/$data .= '<td align="right" class="tdbudgetcommit">
			  '.number_format(@$fcrd['budget_commit'],2).'
			  <input class="budget_type_limit_'.$item['id'].'" value="'.number_format($curr_related_net,2).'" type="hidden">
			  <input name="budget_commit[]" class="taRight inputcost odd sum_budget_'.$item['id'].'" style="border:0px;" type="hidden" value="'.@$fcrd['budget_commit'].'" alt="decimal">			  
			  <input type="hidden" name="budgettype_id[]" value='.$item['id'].'>
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
			  </td>';
		    $data .= '</tr>';
			endif;
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
			$expense_net = $expense - @$fcrd['budget_commit'];
			}				
			
			$tmp_budget_total = $expense - $expense_relate_net;
			  if(@$fcrd['budget_commit']>0):
			  $data .= '<tr>';
  			  $data .= '<td height="36" nowrap="nowrap">&nbsp;</td>';
			  $data .= '<td height="36" nowrap="nowrap">'.$srow['title'].'</td>';
			  /*--3--*/$data .= '<td align="right" class="sc1">'.number_format(@$expense,2).'</td>';
			  /*--6--*/$data .= '<td align="right" class="">'.number_format(@$expense_net,2).'</td>';	
			  /*--6--*/$data .= '<td align="right" class="">'.number_format(@$fcrd['budget_commit'],2).'</td>';			  		 
			  /*--9--*/$data .= '<td align="right" class="">
			  '.number_format(@$fcrd['budget_commit'],2).'
			  <input class="expense_type_limit_'.$srow['id'].'" type="hidden" value="'.number_format(@$expense_total,2).'">
			  <input class="tmp_cost_'.$item['id'].'_'.$srow['id'].'" type="hidden" value="'.@$fcrd['budget_commit'].'" alt="decimal">
			  <input name="budget_commit[]" class="taRight inputcost budget_'.$item['id'].' cost_'.$item['id'].'_'.$srow['id'].'" type="hidden" value="'.@$fcrd['budget_commit'].'" alt="decimal" onkeyup="CalculateSummary(\''.$item['id'].'\',\''.$srow['id'].'\')">			  			  
			  <input type="hidden" name="budgettype_id[]" value='.$srow['id'].'>
			  <input type="hidden" name="fcrd_id[]" value="'.@$fcrd['id'].'">
			  </td>';
		    $data .= '</tr>';
			endif;
			endforeach;
		endforeach;		
		$data.='<tr class="total">';
		  $data.='<td colspan="5" align="right"><strong>ยอดรวมคืนงบประมาณทั้งหมด</strong></td>';
		  $data.='<td align="right" class="tdtotal"><strong><span id="sptotal" name="sptotal"></span></strong></td>';
		$data.='</tr>';
		$data .= '</table>';
			return $data;
}
	function select_fnyear_2_find_bgplantype(){
		if($_POST['fnyear']){
			$fnyear = $_POST['fnyear'];
			
			$bgplantypes = $this->fn_strategy->where("fnyear = ".$fnyear." and budgetplantype =0")->get();
			
			echo"<select name='budgetplantype' id='budgetplantype'>";
			echo"<option value='0'>-- เลือกช่วงแผนงบประมาณ --</option>";
				foreach($bgplantypes as $bgplantype){
					echo "<option value='".$bgplantype['id']."'>".$bgplantype['title']."</option>";
				}
			echo "</select>";
			}
	}
	function select_bgplantype_find_bgyeartype(){
		if($_POST['budgetplantype']){
			$budgetplantype = $_POST['budgetplantype'];
			
			$budgetplantype = $this->fn_strategy->where("budgetyeartype <1 and budgetplantype=".$budgetplantype)->get();
			
			echo"<select name='budgetyeartype' id='budgetyeartype'>";
			echo"<option value='0'>-- เลือกประเภทงบประมาณ --</option>";
				foreach($budgetplantype as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_department_find_division()
	{
		if($_POST['departmentid']){
			$department = $_POST['departmentid'];			
			$division = $this->division->where("departmentid=".$department)->get(FALSE,TRUE);		
			echo"<select name='divisionid' id='divisionid'>";
			echo"<option value='0'>-- เลือกกรมที่รับผิดชอบ --</option>";
				foreach($division as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_department()
	{
			$department = $this->department->get(FALSE,TRUE);		
			echo"<select name='departmentid' id='departmentid'>";
			echo"<option value='0'>-- เลือกหน่วยงาน (กลุ่ม/ฝ่าย)--</option>";
				foreach($department as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
	}	
	function select_division_find_workgroup()
	{			
		if($_POST['divisionid']){
			$division = $_POST['divisionid'];			
			$workgroup = $this->workgroup->where("divisionid=".$division)->get();		
			echo"<select name='workgroupid' id='workgroupid'>";
			echo"<option value='0'>-- เลือกกลุ่มงาน --</option>";
				foreach($workgroup as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_workgroup_find_plan()
	{
		
		if($_POST['budgetplantype']){
			$budgetplantype = $_POST['budgetplantype'];	
			$workgroupid=$_POST['workgroupid'];	
			$sql="select * from fn_strategy where id in(select planid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype;
					
			$planid = $this->fn_strategy->get($sql,FALSE,TRUE);		
			echo"<select name='planid' id='planid'>";
			echo"<option value='0'>-- เลือกแผนงาน --</option>";
				foreach($planid as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_plan_find_product()
	{			
		if($_POST['planid']){
			$planid = $_POST['planid'];	
			$workgroupid=$_POST['workgroupid'];	
			$budgetplantype=$_POST['budgetplantype'];		
			//$product = $this->fn_strategy->where("pid=".$planid)->get(FALSE,FALSE,TRUE);
			
			$sql="select * from fn_strategy where id in(select productivityid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype;			
			$product = $this->fn_strategy->get($sql,FALSE,TRUE);		
			//$product=$this->fn_strategy->get($sql,FALSE,TRUE);
			echo"<select name='productivityid' id='productivityid'>";
			echo"<option value='0'>-- เลือกผลผลิต --</option>";
				foreach($product as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_product_find_mainact()
	{
						
		if($_POST['productivityid']){
			$productivityid= $_POST['productivityid'];
			$workgroupid=$_POST['workgroupid'];	
			$budgetplantype=$_POST['budgetplantype'];			
			
			$sql="select * from fn_strategy where id in(select mainactid from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype;			
			$mainact = $this->fn_strategy->get($sql,FALSE,TRUE);		
			echo"<select name='mainactid' id='mainactid'>";
			echo"<option value='0'>-- เลือกกิจกกรรมหลัก --</option>";
				foreach($mainact as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_mainact_find_subact()
	{			
		if($_POST['mainactid']){
			$mainactid= $_POST['mainactid'];
			$workgroupid=$_POST['workgroupid'];	
			$budgetplantype=$_POST['budgetplantype'];					
			//$subact = $this->fn_strategy->where("subactivityid <1 and mainactid=".$mainactid)->get();		
			$sql="select * from fn_strategy where id in(select id from fn_strategy where id in(
					select subactivityid from fn_budget_master
					where workgroup_id=".$workgroupid.")
					)and budgetplantype=".$budgetplantype;	
							
			$subact = $this->fn_strategy->get($sql,FALSE,TRUE);
			
			echo"<select name='subactivityid' id='subactivityid'>";
			echo"<option value='0'>-- เลือกกิจกกรรมย่อย --</option>";
				foreach($subact as $rs){
					echo "<option value='".$rs['id']."'>".$rs['title']."</option>";
				}
			echo "</select>";
		}
	}
	function select_subact_find_project()
	{
					
		if($_POST['subactivityid']){
			$subactivityid= $_POST['subactivityid'];
			$workgroupid=$_POST['workgroupid'];			
			
			$sql="SELECT projecttitle,id  from fn_budget_master 
				WHERE workgroup_id=$workgroupid and subactivityid =".$subactivityid;				
							
			$projectid = $this->fn_strategy->get($sql,FALSE,TRUE);
			echo"<select name='projectid' id='projectid'>";
			echo"<option value='0'>-- เลือกโครงการ --</option>";
				foreach($projectid as $rs){
					echo "<option value='".$rs['id']."'>".$rs['projecttitle']."</option>";
				}
			echo "</select>";
		}
	}
	
}
?>