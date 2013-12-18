<?php
function GetSummaryBudgetType($budgetID,$budgetTypeID)
{
	$CI=& get_instance();
	$summaryMonth = '';
	for($i=1;$i<=12;$i++)
	{
		$summaryMonth .= $summaryMonth != '' ? " + " : "";
		$summaryMonth .=" BUDGET_M".$i;
	}
	$sql = "SELECT SUM(".$summaryMonth.")TOTAL FROM BUDGET_TYPE_DETAIL WHERE BUDGETID=".$budgetID." AND BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE BUDGETTYPEID=".$budgetTypeID." ) ";
	return $CI->db->getone($sql);
	
}
function GetBudgetType($id){
	$CI=& get_instance();
	$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE ID=".$id;
	$bType = $CI->db->getrow($sql);	
	dbConvert($bType);	
	return $bType;
}
function GetBudgetSummary($year,$subActivityID, $budgetID,$step,$workgroup=FALSE,$sectionID)
{
		$CI=& get_instance();
		$budget = 0;
		if($subActivityID=='' && $step!='')
		{				
			$workgroupCondition = $workgroup < 1 && $sectionID > 0  ?  " AND BUDGET_MASTER.WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$sectionID.") " :  "";
			$workgroupCondition .= $workgroup > 0 ?  " AND BUDGET_MASTER.WORKGROUP_ID=".$workgroup : "";				
			$budget_condition = " SELECT ID FROM BUDGET_MASTER  WHERE  BUDGETYEAR=".$year.$workgroupCondition ;		 
			$budget_condition.= " AND STEP=".$step;
			$budget=0;
			$sql = " SELECT DISTINCT SUBACTIVITYID FROM BUDGET_MASTER WHERE  BUDGETYEAR=".$year.$workgroupCondition." AND STEP=".$step;		 
			$sresult = $CI->db->getarray($sql);
			foreach($sresult as $srow)
			{
						 $subActivityID = $srow['SUBACTIVITYID'];
						 $budget_condition = " SELECT ID FROM BUDGET_MASTER WHERE  SUBACTIVITYID=".$subActivityID." AND BUDGETYEAR=".$year.$workgroupCondition." AND STEP=".$step;			 
						 $sql = "SELECT SUM((BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12))BUDGET 
						 FROM BUDGET_TYPE_DETAIL   
						 WHERE BUDGETID IN (".$budget_condition." )
						 AND BUDGET_TYPE_DETAIL.BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE PID IN (SELECT DISTINCT EXPENSETYPEID FROM BUDGET_EXPENSE_TYPE WHERE BUDGETID IN (".$budget_condition.")
						 ))";
						$budget += $CI->db->getone($sql);						
			}			 			 
		}
		else if($subActivityID != '' )
		{
			$workgroupCondition = $workgroup < 1 && $sectionID > 0  ?  " AND BUDGET_MASTER.WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$sectionID.") " :  " ";
     		$workgroupCondition .= $workgroup > 0 ?  " AND BUDGET_MASTER.WORKGROUP_ID=".$workgroup : "";						 			
			 
			 $sql = "SELECT 
			 SUM((BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12))BUDGET 
			 FROM BUDGET_TYPE_DETAIL
			 LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID   
			 WHERE SUBACTIVITYID=".$subActivityID." AND BUDGET_MASTER.BUDGETYEAR=".$year.$workgroupCondition." AND STEP=".$step;			 
			 $budget= $CI->db->getone($sql);			
		}
		else if($budgetID != '')
		{
			 $sql = "SELECT SUM((BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12))BUDGET 
			 FROM BUDGET_TYPE_DETAIL   
			 WHERE BUDGETID=".$budgetID." AND BUDGET_TYPE_DETAIL.BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE PID IN (SELECT EXPENSETYPEID FROM BUDGET_EXPENSE_TYPE WHERE BUDGETID=".$budgetID."))";
			 $budget = $CI->db->getone($sql);
		}
		return $budget;			
}
function GetBudgetAdjustSummary($year,$subActivityID,$step,$workgroup,$sectionID)
{
	$CI=& get_instance();			
			$sCondition = $sectionID > 0 ? 	" AND SECTION_ID=".$sectionID : "";
			$sql = "SELECT SUM(BUDGET_VALUE)BUDGET FROM BUDGET_ADJUST 
			WHERE SUBACTIVITY_ID=".$subActivityID." AND BUDGET_YEAR=".$year." 
			AND ADJUST_STEP=".($step-1).$sCondition;
			//echo $sql;
			$budget = $CI->db->getone($sql);					
			return $budget;			
}

function GetBudgetStatus($budgetyear=FALSE,$divisionid=FALSE,$workgroup=FALSE,$step)
{
	$CI=& get_instance();	
	if($divisionid >0 && $workgroup < 1)
		$sql = "SELECT MAX(STATUS)  FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$budgetyear." AND WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.") AND STEP =".$step;
	else
		$sql = "SELECT STATUS  FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$budgetyear." AND WORKGROUP_ID=".$workgroup." AND STEP =".$step;
	//echo $sql;	  
	$status = $CI->db->getone($sql);
	$status = $status <1 ? 1 : $status;						
	return $status;
}

function GetBudgetStatusDesc($status){
	switch($status):
		case '1':
			$status= " เพิ่ม แก้ไข - ปรับงบฯ";
		break;
		case '2':
			$status =" อยู่ในระหว่างให้ สนย. ทำการตรวจสอบ";
		break;
		case '3':
			$status =" เสร็จเรียบร้อยเข้าสู่ขั้นตอนต่อไป";
		break;
		case '4':
			$status =" อยู่ในระหว่างให้ ผอ. ทำการตรวจสอบ ";
		break;
	endswitch;
	return $status;
}
function GetWorkGroupSendStatus($wid, $year, $step)
{
	$CI=& get_instance();
	$sql = " SELECT count(*) FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$year." AND WORKGROUP_ID=".$wid." AND STEP=$step ";
	$nrow = $CI->db->getone($sql);
	
	if($nrow > 0){
		$sql = " SELECT status FROM WORKGROUP_SEND_CONFIRM WHERE BUDGET_YEAR=".$year." AND WORKGROUP_ID=".$wid." AND STEP=$step ";
		$status = $CI->db->getone($sql);		
	}
	else	
	{
				$sql = " SELECT status FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year." AND WORKGROUP_ID=".$wid." AND STEP=$step ";
				$status = $CI->db->getone($sql);				
	}		
	$status = $status < 1 ? 1 : $status;
	return $status;
}
function GetSetTime($year,$step)
{
	$CI=& get_instance();
	$sql = " SELECT BDATE_".$step." FROM CNF_SET_TIME WHERE BYEAR=".$year;	
	return $date = $CI->db->getone($sql);	
}

function GetProjectList($budgetyear=FALSE,$divisionid=FALSE,$workgroupid=FALSE,$step=FALSE,$isAdmin=FALSE)
{
		$url_parameter = GetCurrentUrlGetParameter();
		$CI=& get_instance();		
		$bg_status = GetBudgetStatus($budgetyear,$divisionid,$workgroupid,$step);
		$message='';
		if($step > 1){
	    $message='	    
	    <table class="type1 clear">
        <tr>
            <th width="5%">ลำดับ</th>
            <th width="19%">กิจกรรมย่อย</th>
            <th width="24%">ชื่อโครงการ</th>            
            <th width="11%">งบประมาณที่ปรับปรุงแล้ว</th>
            <th width="11%">งบประมาณที่ได้รับ</th>
            <th width="9%">กลุ่มงาน</th>
            <th width="9%">วันที่</th>
            <th width="7%">แก้ไข/ลบ</th>
        </tr>';      
		}else{
			$message.='<table class="type1 clear">
	        <tr>
	            <th width="5%">ลำดับ</th>
	            <th width="19%">กิจกรรมย่อย</th>
	            <th width="24%">ชื่อโครงการ</th>            	            
	            <th width="11%">งบประมาณที่ได้รับ</th>
	            <th width="9%">กลุ่มงาน</th>
	            <th width="9%">วันที่</th>
	            <th width="7%">แก้ไข/ลบ</th>
	        </tr>';      
		}  		
		$typeNo = 0;$nRec=0;
		$workgroup_condition = $workgroupid > 0 ? " AND WORKGROUP_ID=".$workgroupid : " AND WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID = ".$divisionid.") "; 
		$sql = "SELECT * FROM CNF_STRATEGY WHERE ID IN (SELECT DISTINCT SUBACTIVITYID  FROM BUDGET_MASTER
		 LEFT JOIN CNF_STRATEGY ON BUDGET_MASTER.SUBACTIVITYID = CNF_STRATEGY.ID  
		 WHERE BUDGETYEAR=".$budgetyear.$workgroup_condition." AND STEP = ".$step
		 ." )";
		$result = $CI->db->getarray($sql);
		@array_walk($result,'dbConvert');
		if(count($result) > 0):
		foreach($result as $row):		
			$typeNo ++;
			$summaryAdjustBudget = GetBudgetSummary($budgetyear,$row['id'],'',$step,$workgroupid,$divisionid); 
			$summaryBudget = GetBudgetAdjustSummary($budgetyear,$row['id'],$step,$workgroupid,$divisionid); 							 		
        	$message.='
        	<tr style="background-color:#D4FFAA;">
          		<td>'.$typeNo.'</td>
          		<td>'.$row['title'].'</td>
          		<td>&nbsp;</td>';
				if($step>1){
          		$message.='<td>'.number_format(@$summaryAdjustBudget,2).'</td>
          		<td>'.number_format(@$summaryBudget,2).'</td>';
				}else{
					$message.='<td>'.number_format(@$summaryAdjustBudget,2).'</td>';	
				}
          		$message.='<td>&nbsp;</td>
          		<td>&nbsp;</td>
          		<td>&nbsp;</td>
        	</tr>
        	';
			
			$i = 0;
			$sql = " SELECT BUDGET_MASTER.* FROM BUDGET_MASTER
			LEFT JOIN CNF_STRATEGY ON BUDGET_MASTER.SUBACTIVITYID = CNF_STRATEGY.ID  
			WHERE BUDGETYEAR=".@$budgetyear." AND STEP= ".$step.$workgroup_condition." AND SUBACTIVITYID=".$row['id'];
			$sresult = $CI->db->getarray($sql);
			@array_walk($sresult,'dbConvert');
			foreach($sresult as $srow)
			{
				$i++;
				$nRec++;
				$summaryBudget = GetBudgetAdjustSummary($budgetyear,$row['id'],$step,$workgroupid,$divisionid);  
				$summaryAdjustBudget = GetBudgetSummary('','', $srow['id'],'','','');
				$workgroup = $CI->db->getrow("SELECT * FROM cnf_workgroup WHERE id=".$srow['workgroup_id']);
				$division = $CI->db->getrow("SELECT * FROM cnf_division WHERE id=".$workgroup['DIVISIONID']);
				dbConvert($workgroup);
				dbConvert($division);
								
	            $message.='
	            <tr>
	              <td>'.$typeNo.".".$i.'</td>
	              <td>&nbsp;</td>
	              <td>'.$srow['projecttitle'].'</td>';
	              
	              if($step>1){
	          			$message.='<td>'.number_format(@$summaryAdjustBudget,2).'</td>		          		
						<td>&nbsp;</td>';//<td>'.number_format(@$summaryBudget,2).'</td>';
					}else{
						$message.='<td>'.number_format(@$summaryAdjustBudget,2).'</td>';	
					}
	              
	              $message.='<td class="Txt_gray2">
	                 <img src="images/ico_group.gif" width="24" height="24" title="&lt;p&gt;'.$workgroup['title'].'<br/>&lt;p&gt;
	                 '.$division['title'].'" class="tip"/>
	              </td>
	              <td class="Txt_gray2">                          	
	                <img src="images/ico_calendar.gif" width="24" height="24" title="<p>บันทึก '.date('d/m/Y H:i',$srow['createdate']).'</p><p>ปรับปรุงล่าสุด '.date('d/m/Y H:i',$srow['lastmodify']).'</p>" class="tip"/>
	               </td>
	              <td>	              		                 
	                 <img src="images/view.png" alt="ดูรายละเอียด"  width="16" height="16" onclick="window.location=\''.JS_FIX_URLPATH.'/budget_request/form1/view/'.$srow['id'].$url_parameter.'&step='.$step.'\'" style="cursor:pointer;" />
					';
					if($isAdmin)
					{
                  	                
	              	 $message.='<img src="images/edit.gif" title="แก้ไขรายการนี้"  class="tip" width="16" height="16" onclick="window.location=\''.JS_FIX_URLPATH.'/budget_request/form1/edit/'.$srow['id'].$url_parameter.'&step='.$step.'\'" style="cursor:pointer;" />&nbsp;';	                
					
	                 $message.='<img src="images/delete.gif"  title="ลบรายการนี้" class="tip"  width="16" height="16" style="cursor:pointer" onclick="window.location=\''.JS_FIX_URLPATH.'/budget_request/delete/'.$srow['id'].$url_parameter.'&step='.$step.'\'" style="cursor:pointer;" />&nbsp;';
					 	
					}
					else	
					{
						if($bg_status==1)	                  	                
	    	          	 $message.='<img src="images/edit.gif" title="แก้ไขรายการนี้"  class="tip" width="16" height="16" onclick="window.location=\''.JS_FIX_URLPATH.'/budget_request/form1/edit/'.$srow['id'].$url_parameter.'&step='.$step.'\'" style="cursor:pointer;" />&nbsp;';	                
						if($bg_status==1)
		                 $message.='<img src="images/delete.gif"  title="ลบรายการนี้" class="tip"  width="16" height="16" style="cursor:pointer" onclick="window.location=\''.JS_FIX_URLPATH.'/budget_request/delete/'.$srow['id'].$url_parameter.'&step='.$step.'\'" style="cursor:pointer;" />&nbsp;';	
					}											               			                 
	                 $message.='<img src="images/print.jpg" title="พิมพ์แบบฟอร์มคำขอ" class="tip" width="16" height="16" onclick="window.open(\''.JS_FIX_URLPATH.'/budget_request/budget_request_form/'.$srow['id'].'\')" border="0" style="cursor:pointer;" />
	               </td>
	            </tr>';
             } 
			 
				endforeach;
				endif;
			                                            
            $message.='
            <tr>
            </table>            
            <input type="hidden" id="hdNProject'.$step.'" name="hdNProject'.$step.'" value="'.$nRec.'" />';
			
			echo $message;
}
?>