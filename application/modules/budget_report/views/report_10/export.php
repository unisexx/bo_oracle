<? if($step!=''&& $subactivity != ''){
	$subactivityData  = $this->cnf_strategy->get_row($subactivity);
	$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
	$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);

	$subActivityRow 	 = $this->cnf_strategy->get_row($subactivity);
	$missionType 		 = $subActivityRow['missiontype'];
	$mainActivityRow 	 = $this->cnf_strategy->get_row($subActivityRow['mainactid']);
	$planRow 			 = $this->cnf_strategy->get_row($mainActivityRow["planid"]);
	$ministryTargetRow 	 = $this->cnf_strategy->get_row($mainActivityRow["ministrytargetid"]);
	$ministryStrategyRow = $this->cnf_strategy->get_row($mainActivityRow['ministrystrategyid']);
	$sectionTargetRow 	 = $this->cnf_strategy->get_row($mainActivityRow['sectiontargetid']);
	$productivityRow 	 = $this->cnf_strategy->get_row($mainActivityRow['productivityid']);

?>

<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">การประมาณการรายจ่ายล่วงหน้าระยะปานกลางประจำปีงบประมาณ ปี <?php echo $thyear;?></td>
</tr>
<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityData['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityData['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityData['title'];?></td>
</tr>
<tr>
    <td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
    <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน :<?php echo $division_name?></td>

</tr>
<tr>
	 <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน :<?php echo $workgroup_name;?></td>
  	 <td align="left">&nbsp;</td>
  	 <td align="left">&nbsp;</td>
</tr>
<tr>
  <td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?>
    &nbsp;</td>
</tr>
</table>
<div style="display:block; padding-top:10px; padding-bottom:10px;" align="center">
<input type="checkbox" id="chkMisstype" disabled="disabled" value="ภารกิจพื้นฐาน" <? if($missionType=='ภารกิจพื้นฐาน')echo "checked";?>  /> ภารกิจพื้นฐาน
<input type="checkbox" id="chkMisstype" disabled="disabled" value="ภารกิจพื้นฐาน" <? if($missionType=='ภารกิจยุทธศาสตร์')echo "checked";?>  /> ภารกิจยุทธศาสตร์
<input type="checkbox" id="chkPolicy"   disabled="disabled" value="นโยบายต่อเนื่อง" <? if($missionType=='นโยบายต่อเนื่อง')echo "checked";?>  /> นโยบายต่อเนื่อง
<input type="checkbox" id="chkPolicy"   disabled="disabled" value="นโยบายใหม่" <? if($missionType=='นโยบายใหม่')echo "checked";?>  /> นโยบายใหม่
</div>
<table class="tbToDoList">
<tr bgcolor="#EFF7E8">
		<td>งบรายจ่าย - รายการ</td>
        <td align="center">ปี <?php echo($thyear - 1);?> <br /> (ตาม พ.ร.บ.)</td>
        <td align="center">ปี <?php echo($thyear);?> <br /> (คำขอ)</td>
        <td align="center">ปี <?php echo($thyear + 1);?> </td>
        <td align="center">ปี <?php echo($thyear + 2);?> </td>
        <td align="center">ปี <?php echo($thyear + 3);?> </td>
        <td align="center">หมายเหตุ</td>
    </tr>
    <tr bgcolor="#FFF7EC">
      <td bgcolor="#FFF7EC">รวมทั้งสิ้น</td>
        <td align="right"></td>
        <td align="right">
		<?
			$zone = $pzone;
			$group = $pgroup;
			$province = $_GET['province'];
			$total = GetBudgetSummaryCurrentYear(($year),$subactivity,$step,$missionType,$userSection,$userWorkgroup,$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?>
        </td>
        <td align="right">
		<?
			$total = GetBudgetSummaryNextYear($year,1,$subactivity,$step,$missionType,$userSection,$userWorkgroup,$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?>
        </td>
        <td align="right">
		<?
			$total = GetBudgetSummaryNextYear($year,2,$subactivity,$step,$missionType,$userSection,$userWorkgroup,$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?>
        </td>
        <td align="right">
		<?
			$total = GetBudgetSummaryNextYear($year,3,$subactivity,$step,$missionType,$userSection,$userWorkgroup,$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?>
        </td>
        <td align="right">&nbsp;</td>
    </tr>
    <?
		$i=0;
		$sql = " SELECT * FROM CNF_BUDGET_TYPE WHERE PID=0 ORDER BY ORDERNO ";
		$mainTypeResult = $this->cnf_budget_type->get($sql);
		foreach($mainTypeResult  as $mainTypeRow)
		{
			$i++;
	?>
    <tr bgcolor="#ECFCFF">
      <td><?php echo$i;?>.&nbsp;<?php echo $mainTypeRow['title'];?></td>
      <td align="right">&nbsp;</td>
      <td align="right"><?
			$total = GetBudgetSummaryCurrentYearType(($year),$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$mainTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
      <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),1,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$mainTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
      <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),2,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$mainTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
      <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),3,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$mainTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
      <td align="right">&nbsp;</td>
    </tr>
    	    <?
				$sql = " SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$mainTypeRow['id']." ORDER BY ORDERNO ";
				$secondTypeResult = $this->cnf_budget_type->get($sql);
				foreach($secondTypeResult as $secondTypeRow)
				{
			?>
			<tr bgcolor="#FCF0FF">
			  <td>- <?php echo $secondTypeRow['title'];?></td>
			  <td align="right">&nbsp;</td>
			  <td align="right"><?
			$total = GetBudgetSummaryCurrentYearType(($year),$subactivity,$step,$missionType,$userSection,$userWorkgroup,2,$secondTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
			  <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),1,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$secondTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
			  <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),2,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$secondTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
			  <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),3,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$secondTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
			  <td align="right">&nbsp;</td>
	</tr>
					<?
                        $sql = " SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$secondTypeRow['id']." ORDER BY ORDERNO ";
						$thirdTypeResult = $this->cnf_budget_type->get($sql);
						foreach($thirdTypeResult as $thirdTypeRow )
                        {
                    ?>
                    <tr>
                      <td>&nbsp;&nbsp;&nbsp;- <?php echo $thirdTypeRow['title'];?></td>
                      <td align="right">&nbsp;</td>
                      <td align="right"><?
			$total = GetBudgetSummaryCurrentYearType(($year),$subactivity,$step,$missionType,$userSection,$userWorkgroup,3,$thirdTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
                      <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),1,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$thirdTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
                      <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),2,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$thirdTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
                      <td align="right"><?
			$total = GetBudgetSummaryNextYearType(($year),3,$subactivity,$step,$missionType,$userSection,$userWorkgroup,1,$thirdTypeRow['id'],$zone,$group,$province);
			if($total > 0 )echo number_format($total,2);
		?></td>
                      <td align="right">&nbsp;</td>
                    </tr>
                   <? } ?>
		   <? } ?>
   <? } ?>
</table>
 <? } ?>