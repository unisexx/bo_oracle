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
function GetStepName()
{
    $title = array('','ขั้นตอนที่ 1 : เสนอคำของงบประมาณ','ขั้นตอนที่ 2 : ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ','ขั้นตอนที่ 3 : ปรับปรุงคำของบประมาณตามมติ ครม.', 'ขั้นตอนที่ 4 : ปรับปรุงคำของบประมาณตามมติ กระทรวง','ขั้นตอนที่ 5 : แปรญิตติเพิ่ม','ขั้นตอนที่ 6 : ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ','ขั้นตอนที่ 7 : รายละเอียดงบประมาณตาม พรบ.','ขั้นตอนที่ 8 : ปรับปรุงงบประมาณเพื่อการบริหาร');
	return $title;
}
function GetSummaryBudget($pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		$condition  = (!empty($pZone)) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= (!empty($pGroup)) ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($pSection)) ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER 		   ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP 		   ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION 			   ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE 			   ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON  CNF_PROVINCE_DETAIL_ZONE.PROVINCEID = CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}


function GetSummaryProductivity($pProductivity,$pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		$condition  = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($pSection)) ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 AND PRODUCTIVITYID=".$pProductivity."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;

}


function GetSummaryMainActivity($pMainActID,$pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{

		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}

		$condition  = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($pSection)) ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID=".$pMainActID."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummarySubActivity($pSubActID,$pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{

		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}

		$condition  = (!empty($pZone)) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($pSection))? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= (!empty($pPolicyType)) ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID =  CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID =".$pSubActID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			//echo $sql."<br/>";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummaryProject($pProjectID,$pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{

		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		//$condition  = $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition  = (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($pSection)) ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  BUDGET_MASTER.ID =".$pProjectID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;

}

function GetSummaryKeyProject($pKeyID,$pQuarter)
{
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(M1 + M2 + M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(M4 + M5 + M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(M7 + M8 + M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(M10 + M11 + M12) AS TOTAL ";
				break;
			}
		}

		$condition = (!empty($pZone)) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= (!empty($pSection)) ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_PRODUCTIVITY_KEY
			LEFT JOIN BUDGET_MASTER ON BUDGET_PRODUCTIVITY_KEY.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE ID=".$pKeyID
			;
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummaryBudgetKey($pKey,$pQuarter,$year, $pZone, $group, $pProvince, $pSection,$pWorkgroup,$step)
{
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(M1 + M2 + M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(M4 + M5 + M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(M7 + M8 + M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(M10 + M11 + M12) AS TOTAL ";
				break;
			}
		}


		if($_GET['subactivity']!='')
		{
			$option = " AND BUDGET_MASTER.SUBACTIVITYID=".$_GET['subactivity'];
		}
		elseif($_GET['mainactivity']!='')
		{
			$option = " AND BUDGET_MASTER.SUBACTIVITYID IN (SELECT ID FROM CNF_STRATEGY WHERE MAINACTID=".$_GET['mainactivity'].") ";
		}
		elseif($_GET['productivity']!='')
		{
			$option = " AND BUDGET_MASTER.SUBACTIVITYID IN (SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 AND PRODUCTIVITYID=".$_GET['productivity'].") ";
		}

		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		$condition .= (!empty($pProvince)) ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= (!empty($pSection)) ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= (!empty($pWorkgroup))&& $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		//$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_PRODUCTIVITY_KEY
			LEFT JOIN BUDGET_MASTER ON BUDGET_PRODUCTIVITY_KEY.BUDGETID=BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE CHKWORKPLAN <> '' AND PRODKEYID=".$pKey." AND STEP=".$step.$condition.$option."
			"
			;
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}
function budget_type_config()
{
	$CI=& get_instance();
	$CI->load->model('budget_type/budget_type_model','budget_type');
	$haveQTY = array(3,11,17,80,4);//มีจำนวนอัตรา
	$isFoodOverTime = array(26);//ค่าอาหารนอกเวลาราชการ

	$haveAllowanceRemark = array(43); //คำชี้แจงค่าเบี้ยเลี้ยง
	$haveAccomodationRemark = array(43); //คำชี้แจงค่าเช่าที่พัก
	$haveVehicleRemark = array(43); //คำชี้แจงค่าเช่าพาหนะ
	$haveDocumentRemark = array(46);//คำชี้แจงค่าเช่าเหมาเอกสารสื่อสิ่งพิมพ์
	$haveHumanRemark = array(46);//คำชี้แจ้งค่าเช่าเหมาบุคคล
	$haveServiceRemark = array(46);// คำชี้แจงบริการอื่น ๆ
	$haveRemark = array();
	$result = $CI->budget_type->get("SELECT ID FROM CNF_BUDGET_TYPE WHERE LV=3 ");
	foreach($result as $row)
	{
		array_push($haveRemark, $row['id']);
	}
	$haveRemark = array_diff($haveRemark,$haveAllowanceRemark);
	$haveRemark = array_diff($haveRemark,$haveDocumentRemark);
}
function GetSummaryBudgetTypeExpense($pBudgetTypeID,$pProjectID,$pYear,$pProductivity,$pMainactivity,$pSubactivity)
{
			$sql = "
			SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID=".$pProjectID." AND BUDGETTYPEID IN (
				SELECT ID FROM CNF_BUDGET_TYPE WHERE BUDGETTYPEID=".$pBudgetTypeID." AND
				(
					EXPENSETYPEID > 0 OR ASSETTYPEID > 0
				)
			)
			";

			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}
function CalculateBySummaryProductivity($pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
	$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
//	$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
//	$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
			$sql = "SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					 MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;

			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function CalculateByProductivity($pProductivityID, $pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
	$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
//	$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
//	$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
			$sql = "SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					PRODUCTIVITYID =".$pProductivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;

			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function CalculateByMainActivity($pProductivityID,$pMainActivityID, $pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
//	$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
//	$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
//	$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
			$sql = "
			SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					ProductivityID=".$pProductivityID." AND MainActID =".$pMainActivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;

			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function CalculateByProvince($pProductivityID,$pMainActivityID,$pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID ='".$pZone."' ": "";
	//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_PROVINCE.ID=".$pProvince." " : "";
	//$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
	//$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		 	$sql = "
		 	SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					ProductivityID=".$pProductivityID." AND MainActID =".$pMainActivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}
function GetSummaryMainBudgetTypeByMonth($pBudgetTypeID,$pMonth,$pQuarter,$pYear, $pSection,$pWorkgroup,$step,$pProductivity,$pMainactivity, $pSubactivity,$pZone,$pGroup,$pProvince)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";

		if($quarter != '')
		{
			switch($quarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		else
		{
				$summary = " SUM(BUDGET_M".$pMonth.") TOTAL ";
		}

		$pcondition = $pProductivity != '' ? " AND CNF_STRATEGY.ID IN ( SELECT ID FROM CNF_STRATEGY WHERE PRODUCTIVITYID = ".$pProductivity." AND MAINACTID > 0 " : "";
		$pcondition = $pMainactivity != '' ? " AND CNF_STRATEGY.ID IN (SELECT ID FROM CNF_STRATEGY WHERE MAINACTID = ".$pMainactivity : "";
		$pcondition = $pSubactivity != '' ? " AND CNF_STRATEGY.ID = ".$pSubactivity : "" ;

		$sql = "
				SELECT ".$summary." FROM BUDGET_TYPE_DETAIL
				LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY ON BUDGET_MASTER.SUBACTIVITYID = CNF_STRATEGY.ID
				WHERE
				BudgetTypeID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE CNF_BUDGET_TYPE.BudgetTypeID=".$pBudgetTypeID." AND ExpenseTypeID > 0 )
				AND BUDGET_MASTER.BUDGETYEAR = ".$pYear." AND STEP=".$step.$condition.$pcondition;
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummaryExpenseTypeByMonth($pBudgetTypeID,$pMonth,$pQuarter,$pYear,$pSection,$pWorkgroup,$step,$pProductivity,$pMainactivity, $pSubactivity,$pZone,$pGroup,$pProvince)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";

		if($quarter != '')
		{
			switch($quarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		else
		{
				$summary = " SUM(BUDGET_M".$pMonth.") TOTAL ";
		}

		$pcondition = $pProductivity != '' ? " AND CNF_STRATEGY.ID IN ( SELECT ID FROM CNF_STRATEGY WHERE PRODUCTIVITYID = ".$pProductivity." AND MAINACTID > 0 " : "";
		$pcondition = $pMainactivity != '' ? " AND CNF_STRATEGY.ID IN (SELECT ID FROM CNF_STRATEGY WHERE MAINACTID = ".$pMainactivity : "";
		$pcondition = $pSubactivity != '' ? " AND CNF_STRATEGY.ID = ".$pSubactivity : "" ;


		$sql = "
				SELECT ".$summary." FROM BUDGET_TYPE_DETAIL
				LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY ON BUDGET_MASTER.SUBACTIVITYID = CNF_STRATEGY.ID

				WHERE
				BudgetTypeID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE ExpenseTypeID=".$pBudgetTypeID.")
				AND BUDGET_MASTER.BUDGETYEAR = ".$pYear." AND STEP=".$step.$condition.$pcondition;
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummaryBudgetTypeByMonth($pBudgetTypeID,$pMonth,$pQuarter,$pYear, $pSection,$pWorkgroup,$step,$pProductivity,$pMainactivity, $pSubactivity,$pZone,$pGroup,$pProvince)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
//		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";

		if($quarter != '')
		{
			switch($quarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		else
		{
				$summary = " SUM(BUDGET_M".$pMonth.") TOTAL ";
		}

		$pcondition = $pProductivity != '' ? " AND CNF_STRATEGY.ID IN ( SELECT ID FROM CNF_STRATEGY WHERE PRODUCTIVITYID = ".$pProductivity." AND MAINACTID > 0 " : "";
		$pcondition = $pMainactivity != '' ? " AND CNF_STRATEGY.ID IN (SELECT ID FROM CNF_STRATEGY WHERE MAINACTID = ".$pMainactivity : "";
		$pcondition = $pSubactivity != '' ? " AND CNF_STRATEGY.ID = ".$pSubactivity : "" ;


		 $sql = "
				SELECT ".$summary." FROM BUDGET_TYPE_DETAIL
				LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY ON BUDGET_MASTER.SUBACTIVITYID = CNF_STRATEGY.ID

				WHERE
				BudgetTypeID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE AssetTypeID=".$pBudgetTypeID." OR CNF_BUDGET_TYPE.ID=".$pBudgetTypeID." )
				AND BUDGET_MASTER.BUDGETYEAR = ".$pYear." AND STEP=".$step.$condition.$pcondition;
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummaryProductivity2($pProductivity,$pQuarter,$pYear, $pSection,$pWorkgroup,$step,$pLProductivity,$pMainactivity, $pSubactivity,$pZone,$pGroup,$pProvince)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}

		$condition .= $pMainactivity != '' ? " AND MAINACTID = ".$pMainactivity : "";
		$condition .= $pSubactivity != '' ? " AND ID= ".$pSubactivity : "";
			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 AND PRODUCTIVITYID=".$pProductivity.$condition."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}


function GetSummaryMainActivity2($pMainActID,$pQuarter,$pMonth,$pYear,$pSection,$pWorkgroup,$step,$pProductivity,$pMainactivity, $pSubactivity,$pZone,$pGroup,$pProvince)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}
		if($pMonth != '')
		{
			$summary = " SUM(BUDGET_M".$pMonth.") AS TOTAL ";
		}

		$condition .= $pSubactivity != '' ? " AND ID= ".$pSubactivity : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID=".$pMainActID.$condition."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}

function GetSummarySubActivity2($pSubActID,$pQuarter, $pMonth,$pYear,$pSection,$pWorkgroup,$step,$pProductivity,$pMainactivity, $pSubactivity,$pZone,$pGroup,$pProvince)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		if($pQuarter != '')
		{
			switch($pQuarter)
			{
				case 1:
					$summary = " SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3) AS TOTAL ";
				break;
				case 2:
					$summary = " SUM(BUDGET_M4 + BUDGET_M5 + BUDGET_M6) AS TOTAL ";
				break;
				case 3:
					$summary = " SUM(BUDGET_M7 + BUDGET_M8 + BUDGET_M9) AS TOTAL ";
				break;
				case 4:
					$summary = " SUM(BUDGET_M10 + BUDGET_M11 + BUDGET_M12) AS TOTAL ";
				break;
			}
		}

		if($pMonth != '')
		{
			$summary = " SUM(BUDGET_M".$pMonth.") AS TOTAL ";
		}

			 $sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID
			WHERE  SUBACTIVITYID =".$pSubActID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$CI=& get_instance();
			$result = $CI->db->getone($sql);
			return $result;
}
function getUser($userID)
{
	$sql  = "SELECT * From USERS INNER JOIN USER_TYPE_TITLE  ON USERS.UserType = USER_TYPE_TITLE.ID WHERE users.ID=".$userID;
	$CI=& get_instance();
	$result = $CI->db->GetRow($sql);
	array_walk($result,'dbConvert');
	return  array_change_key_case($result);

}
function GetBudgetSummaryNextYear($pYear,$pIndex,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pZone,$pGroup,$pProvince)
{  $CI=& get_instance();
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$summaryYear = "BUDGET_NY".$pIndex;
	$sql = "
	SELECT SUM(".$summaryYear.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")";
	$total="";
	$result = $CI->db->GetArray($sql);
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;
}

function GetBudgetSummaryLastYear($pYear,$pSubactivity,$pStep,$pMissionType)
{   $CI=& get_instance();
	$sql = " SELECT * FROM BUDGET_MASTER WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear;
	$result = $CI->db->GetArray($sql);
	$total="";
	foreach($result as $row)
	{
			$total += $row['LASTESTIMATEBUDGET_Y'.$pIndex];
	}
	return $total;

}
function GetBudgetSummaryCurrentYear($pYear,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pZone,$pGroup,$pProvince)
{	$CI=& get_instance();
	    $summaryMonth='';
		$condition = $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	for($i=1;$i<=12;$i++)
	{
		$summaryMonth .= $summaryMonth != '' ? " + " : "";
		$summaryMonth .=" BUDGET_M".$i;
	}
	$sql = "
	SELECT SUM(".$summaryMonth.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")";

	$result = $CI->db->GetArray($sql);
	$total="";
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;

}
function GetBudgetSummaryCurrentYearType($pYear,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pLV,$pTypeID,$pZone,$pGroup,$pProvince)
{

	$CI=& get_instance();
	$conditionType = "";
	$conditionType .= $pLV == '1' ? " AND BUDGETTYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '2' ? " AND EXPENSETYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '3' ? " AND ID=".$pTypeID : "";

		$condition =  $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$summaryMonth="";
	for($i=1;$i<=12;$i++)
	{
		$summaryMonth .= $summaryMonth != '' ? " + " : "";
		$summaryMonth .=" BUDGET_M".$i;
	}
	$sql = "
	SELECT SUM(".$summaryMonth.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")
	AND BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE 1=1 ".$conditionType
	.")";
	$result = $CI->db->GetArray($sql);
	$total = "";
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;

}

function GetBudgetSummaryNextYearType($pYear,$pIndex,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pLV,$pTypeID,$pZone,$pGroup,$pProvince)
{
	$CI=& get_instance();
	$conditionType = "";
	$conditionType .= $pLV == '1' ? " AND BUDGETTYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '2' ? " AND EXPENSETYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '3' ? " AND ID=".$pTypeID : "";

		$condition =  $pZone != '' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_WORKGROUP.WPROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$summaryYear = "BUDGET_NY".$pIndex;
	$sql = "
	SELECT SUM(".$summaryYear.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")
	AND BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE 1=1 ".$conditionType
	.")";
	$result = $CI->db->GetArray($sql);
	$total="";
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;
}
?>