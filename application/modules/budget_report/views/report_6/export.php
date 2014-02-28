<?php
	if($subactivity != '')
	{
		$subactivityData  = $this->cnf_strategy->get_row($subactivity);
		$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
		$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);
	}
	$productivityTitle = $subactivity == '' ? " ทั้งหมด  ": $productivityData['title'];
	$mainactivityTitle = $subactivity == '' ? " ทั้งหมด  ": $mainactivityData['title'];
	$subactivityTitle = $subactivity == '' ? " ทั้งหมด  ": $subactivityData['title'];

	$nBudgetType  = $this->db->GetOne("select count(ID) as cnt from cnf_budget_type where pid=0");
	$i = 0;
	$result = $this->cnf_budget_type->get("select * from cnf_budget_type where PID=0 order by orderno");
	foreach($result as $row)
	{
		$budgetTypeID[$i] = $row['id'];
		$budgetTypeTitle[$i] = $row['title'];
		$i++;
	}
	$nColumn = 2 + $nBudgetType;

	$condition = !empty($pzone) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$pzone."' " : "";
	//$condition .= $_GET['pgroup']!= '' ? " AND CNF_PROVINCE.PGROUP=".$_GET['pgroup']." " : "";
	$condition .= !empty($province) ? " AND CNF_PROVINCE.ID=".$province." " : "";
	$condition .= !empty($division) ? " AND CNF_DIVISION.ID=".$division." " : "";
	$condition .= !empty($workgroup) ? " AND USERS.WORKGROUPID=".$workgroup." " : "";
	$condition .= !empty($subactivity) ? " AND SUBACTIVITYID = ".$subactivity." " : "";
	$subactivityID = '';
	$sql = "SELECT BUDGET_MASTER.* FROM BUDGET_MASTER
	LEFT JOIN USERS ON BUDGET_MASTER.CREATEBY = USERS.ID
	LEFT JOIN CNF_DIVISION ON USERS.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_WORKGROUP ON USERS.WORKGROUPID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID = CNF_PROVINCE.ID
	WHERE  BUDGETYEAR=".$year." AND STEP=".$step.$condition." ORDER BY SUBACTIVITYID ";
	$result = $this->budget_master->get($sql);

?>
<br />
&nbsp;
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานตารางแสดงคำของบประมาณระดับโครงการ/งบรายจ่าย ประจำปี	  <?php echo $thyear;?></td>
</tr>
<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityTitle;?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityTitle;?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityTitle;?></td>
</tr>
  <tr>
    <td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
    <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :<?php echo $provinceGroup ?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
  </tr>
  <tr>
	 <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน :<?php echo $division_name?></td>
	 <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน :<?php echo $workgroup_name;?></td>
	 <td align="left">จำนวนโครงการทั้งหมด : <?php echo count($result);  ?> โครงการ</td>
</tr>
<tr>
  <td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo (!empty($_GET['step'])) ? $stepName[$_GET['step']]:'';?></td>
</tr>
</table>
<table class="tbToDoList">
	<tr bgcolor="#EFF7E8">
    	<td>ลำดับ&nbsp;</td>
        <td>งาน/โครงการ/รายการ</td>
        <td>งบประมาณปี <?php echo $thyear-2;?></td>
        <td>งบประมาณปี <?php echo $thyear-1;?></td>
        <td colspan="<?php echo $nColumn;?>">งบประมาณปี <?php echo $thyear;?> จำแนกตามงบรายจ่าย/รายการ</td>
        <td>พื้นที่ดำเนินการ</td>
        <td>ผลลัพธ์</td>
    </tr>
	<tr bgcolor="#EFF7E8">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>รายการ</td>
      <? for($i=0;$i<count($budgetTypeTitle);$i++){?>
	  <td><?php echo $budgetTypeTitle[$i];?>&nbsp;</td>
      <? } ?>
	  <td>รวม</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <?
	$i=0;
	$p=0;
	foreach($result as $budgetMaster)
	{
		if($subactivityID != $budgetMaster['subactivityid'])
		{
				$subactivityID = $budgetMaster['subactivityid'];
				if(!empty($subactivityID)){
					$subactivityData  = $this->cnf_strategy->get_row($subactivityID);
					if(!empty($subactivityData)){
						$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
						$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);
						$productivityTitle = $subactivityID == '' ? " ทั้งหมด  ": $productivityData['title'];
						$mainactivityTitle = $subactivityID == '' ? " ทั้งหมด  ": $mainactivityData['title'];
						$subactivityTitle = $subactivityID == '' ? " ทั้งหมด  ": $subactivityData['title'];
					}
				}

				$p++;
				$i=0;
		?>
				 <tr style="background-color:#D7EEFF">
                  <td valign="top"><?php echo $p;?>&nbsp;</td>
                  <td valign="top">
                  	<?php if(!empty($subactivityTitle)){ ?>
                  	กิจกรรมย่อย : <?php echo $subactivityTitle;?>&nbsp;[ <?php echo CountProject($subactivityID,$step,$year);?> โครงการ]
                  	<?php } ?>
                  	</td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <?
                  $gtotal = 0;
                  for($b=0;$b<count($budgetTypeID);$b++){?>
                  <td valign="top">&nbsp;</td>
                  <? } ?>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                </tr>
        <?
		}

	$i++;
	?>
	<tr>
	  <td valign="top"><?php echo $p.".".$i;?>&nbsp;</td>
	  <td valign="top"><?php echo $budgetMaster['projecttitle'];?>&nbsp;</td>
	  <td valign="top"><? if($budgetMaster['lastestimatebudget_y1'] > 0 )echo number_format($budgetMaster["lastestimatebudget_y1"],2);?>&nbsp;</td>
	  <td valign="top"><? if($budgetMaster['lastestimatebudget_y2'] > 0 )echo number_format($budgetMaster["lastestimatebudget_y2"],2);?>&nbsp;</td>
	  <td valign="top">&nbsp;</td>
      <?
	  $gtotal = 0;
	  for($b=0;$b<count($budgetTypeID);$b++){?>
	  <td valign="top">
	  <?
	  $total = GetSummaryBudgetTypeExpense($budgetTypeID[$b],$budgetMaster['id'],$year,$productivity,$mainactivity,$subactivity);
	  if($total > 0 )echo number_format($total,2);
	  $gtotal += $total ;
	  ?>
      &nbsp;</td>
      <? } ?>
	  <td valign="top"><? if($gtotal > 0 ) echo number_format($gtotal,2);?>&nbsp;</td>
	  <td valign="top">
	  <?
		$operationArea = '';
		$operationArea .= $budgetMaster['chkoperationcentral']!='' ? " ส่วนกลาง " : "";

		if($budgetMaster['chkoperationregion']!='' && $operationArea!='')
			$operationArea .=" <br/>"."ส่วนภูมิภาค ";
		elseif($budgetMaster["chkoperationregion"]!='')
			$operationArea .=" <br/>"."ส่วนภูมิภาค ";

		$sql = "SELECT * FROM BUDGET_OPERATION_AREA
				LEFT JOIN CNF_PROVINCE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE.ID
		 		WHERE BUDGETID=".$budgetMaster['id']." ORDER BY CNF_PROVINCE.TITLE ";
		$provinceResult = $this->budget_operation_area->get($sql);
		foreach($provinceResult as $provinceRow)
		{
			$operationArea .="<br/>&nbsp;&nbsp;-&nbsp;".$provinceRow['title'];
		}
	  echo $operationArea;
	  ?>
      &nbsp;</td>
	  <td valign="top">
      <?
	  			$sql = " SELECT * FROM BUDGET_TYPE_DETAIL WHERE BUDGETID=".$budgetMaster['id'];
				$rresult = $this->budget_type_detail->get($sql);
				foreach($rresult as $rrow)
				{
						if($rrow['remark'] != '') echo $rrow['remark']."<br/>";
						if($rrow['allowanceremark'] != '') echo $rrow['allowanceremark']."<br/>";
						if($rrow['accomodationremark'] != '') echo $rrow['accomodationremark']."<br/>";
						if($rrow['vehicleremark'] != '') echo $rrow['vehicleremark']."<br/>";
						if($rrow['documentremark'] != '') echo $rrow['documentremark']."<br/>";
						if($rrow['humanremark'] != '') echo $rrow['humanremark']."<br/>";
						if($rrow['serviceremark'] != '') echo $rrow['serviceremark']."<br/>";
				}
	  ?>
      &nbsp;</td>
    </tr>
    <?
	$sql = " SELECT CNF_BUDGET_TYPE.*,(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12)AS BUDGETTOTAL
			 FROM BUDGET_TYPE_DETAIL LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_TYPE_DETAIL.BUDGETTYPEID = CNF_BUDGET_TYPE.ID
			 WHERE BUDGETID=".$budgetMaster['id'];
	$itemResult = $this->budget_type_detail->get($sql);
    foreach($itemResult as $itemRow)
    {
		if($itemRow['budgettotal'] > 0 ){
	?>
    <tr>
    	<td valign="top">&nbsp;</td>
   	  <td valign="top">&nbsp;</td>
   	  <td valign="top">&nbsp;</td>
   	  <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?php echo $itemRow['title'];?></td>
		<?  for($b=0;$b<count($budgetTypeID);$b++){?>
          <td valign="top">
          <?
		  if($itemRow['budgettypeid']==$budgetTypeID[$b])
		  {
		    echo number_format($itemRow['budgettotal'],2);
		  //if($total > 0 )echo number_format($total,2);
          //$gtotal += $total ;
		  }
          ?>
          &nbsp;
       </td>
      <? } ?>
    <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
    </tr>
    <?
		}
    }
    ?>
    <?
	} ?>
</table>
</div>