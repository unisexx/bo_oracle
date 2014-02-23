<?
	$subactivityData  = $this->cnf_strategy->get_row($subactivity);
	$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
	$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);
?>
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
    <td style="padding-bottom:10px;" colspan="3" align="center">
      <h3 id="topic2">รายงานแผนการจัดสรรงบประมาณไปจังหวัดประจำปี<?php echo $thyear;?>&nbsp;</h3></td>
  </tr>
<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityData['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityData['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityData['title'];?></td>
</tr>
  <tr>
<td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
<td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :<?php echo $provinceGroup ?></td>
<td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
  </tr>
  <tr>
    <td colspan="2" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?></td>
    <td align="right">หน่วย : บาท</td>
  </tr>
</table>
<?
	$i = 0;
	$ColID = array(-1);
	$ColTitle = array(-1);
    $ColParent = array(-1);
    $ColParent2 = array(-1);

	$condition  = "SELECT CNF_BUDGET_TYPE.BUDGETTYPEID
				  FROM BUDGET_MASTER
				  LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID
				  LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID
				  WHERE BUDGET_MASTER.BUDGETYEAR=".$year;

	$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE
			LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID
			WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY ORDERNO ";
	//$result = db_query($sql);
	$result = $this->cnf_budget_type->get($sql);
	foreach($result as $BudgetType_1)
	{
			 array_push($ColID,$BudgetType_1['id']);
			 array_push($ColTitle,$BudgetType_1['title']);
			 array_push($ColParent,0);
			 array_push($ColParent2,-1);

					$ncolumn1 = 0;
					$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." ORDER BY ORDERNO ";
					$sresult = $this->cnf_budget_type->get($sql);
					foreach($sresult as $BudgetType_2)
					{
							 array_push($ColID,$BudgetType_2['id']);
							 array_push($ColTitle,$BudgetType_2['title']);
							 array_push($ColParent,$BudgetType_1['id']);
							 array_push($ColParent2,-1);

							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY ORDERNO ";
                            $ssresult = $this->cnf_budget_type->get($sql);
                            foreach($ssresult as $BudgetType_3)
                            {
								 array_push($ColID,$BudgetType_3['id']);
								 array_push($ColTitle,$BudgetType_3['title']);
								 array_push($ColParent,$BudgetType_1['id']);
								 array_push($ColParent2,$BudgetType_2['id']);
							 }

					}
	}
?>
<table class="tbToDoList">
<tr bgcolor="#EFF7E8">
	<td rowspan="3" nowrap="nowrap">ผลผลิต/กิจกรรมหลัก/กิจกรรมย่อย</td>
    <td rowspan="3" nowrap="nowrap" align="center">งบประมาณ <br />
      ปี
<?php echo ($thyear-1);?> <br />
ตาม พรบ.</td>
    <td rowspan="3"  nowrap="nowrap" align="center">งบประมาณ <br />
      ปี
<?php echo ($thyear);?>  <br />
(เสนอตั้ง)</td>
  <?
  for($i=0;$i<count($ColID);$i++)
  {
      if($ColParent[$i]==0)
      {
          $ncolumn =0;
          $bType = GetBudgetType($ColID[$i]);
            for($r=0;$r<count($ColParent);$r++)
            {
                    if($ColParent[$r]==$ColID[$i] && $ColParent2[$r] > -1)$ncolumn++;
            }
            $totalColumn += $ncolumn;
  ?>
      <td align="center" colspan="<?=$ncolumn;?>" ><?=$bType['title'];?></td>
  <?
      }
  }
  ?>
</tr>

<tr bgcolor="#EFF7E8">
	  <?
      for($i=0;$i<count($ColID);$i++)
      {
          if($ColParent[$i] > 0 && $ColParent2[$i] == -1)
          {
              $ncolumn =0;
              $bType = GetBudgetType($ColID[$i]);
                for($r=0;$r<count($ColParent2);$r++)
                {
                        if($ColParent2[$r]==$ColID[$i])$ncolumn++;
                }
      ?>
	  <td colspan="<?=$ncolumn;?>" align="center"><?=$bType['title']?></td>
      <? }
	  }
	  ?>
  </tr>
<tr bgcolor="#EFF7E8">
	  <?
      for($i=0;$i<count($ColID);$i++)
      {
          if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
          {
              $ncolumn =0;
              $bType = GetBudgetType($ColID[$i]);

      ?>
	  <td align="center"><?=$bType['title'];?></td>
      <? }
	  }
	  ?>
  </tr>
  <tr>
  	<td>รวมงบประมาณทั้งสิ้น</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
          <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center">
        <? $total = CalculateBySummaryProductivity($ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?>
        </td>
        <? } ?>
        <? } ?>
  </tr>
  <tr>
  	<td>รวมงบประมาณผลผลิตทั้งสิ้น</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
          <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center">
        <? $total = CalculateBySummaryProductivity($ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?>
        </td>
        <? } ?>
        <? } ?>
  </tr>
  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select productivityid from cnf_strategy
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subactivity."
				GROUP BY SUBACTIVITYID
				)
				GROUP BY PRODUCTIVITYID
				)
			";
	  $presult = $this->cnf_strategy->get($sql);
	  foreach($presult as $productivity)
	  {
		?>
    <tr bgcolor="#00CCFF">
        <td><strong><?=$productivity['title'];?></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
          <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center"><? $total = CalculateByProductivity($productivity['id'],$ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
              <? }
              }
              ?>
  	</tr>
  	  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select mainactid from cnf_strategy
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year."
				GROUP BY SUBACTIVITYID
				)
				AND PRODUCTIVITYID=".$productivity['id']."
				GROUP BY mainactid
				)
			";
	  $aresult = $this->cnf_strategy->get($sql);
	  foreach($aresult as $activity)
	  {
	 ?>
     <tr bgcolor="#00CC99">
        <td><strong><?=$activity['title'];?></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center"><? $total = CalculateByMainActivity($productivity['id'],$activity['id'],$ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
	  <? }
      }
      ?>
     </tr>
     	<?
			$pcondition = " WHERE 1 = 1 ";
			$pcondition .= $pzone != '' ?  " AND ZONEID='".$pzone."' " : "";
			//$pcondition .= $pgroup != '' ?  " AND PGROUP=".$pgroup." " : "";
			$sql = "SELECT * FROM CNF_PROVINCE
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON PROVINCEID = CNF_PROVINCE.ID ".$pcondition."  ORDER BY ZONEID ";
			$saresult = $this->province->get($sql);
			foreach($saresult as$provinceRow)
			{
		?>
             <tr>
                <td> - <?=$provinceRow['title'];?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?
                  for($i=0;$i<count($ColID);$i++)
                  {
                      if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
                      {
                          $ncolumn =0;
                          $bType = GetBudgetType($ColID[$i]);

                  ?>
                <td align="center"><? $total = CalculateByProvince($productivity['id'],$activity['id'],$ColID[$i],$year,$pzone,$pgroup,$provinceRow['id'],$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
                  <? }
                  }
                  ?>
                 </tr>
          <? }//ENDSubActivity ?>
     <? }//EndMainActivity ?>
  <? } ?>
</table>
