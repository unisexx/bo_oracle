<? if($step!=''&& $subactivity != ''){
	//$subactivityData = SelectData("CNF_STRATEGY"," WHERE ID=".$subactivity);
	$subactivityData = $this->cnf_strategy->get_row($subactivity);
	//$mainactivityData = SelectData("CNF_STRATEGY"," WHERE ID=".$subactivityData['MAINACTID']);
	$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
	//$productivityData = SelectData("CNF_STRATEGY"," WHERE ID=".$subactivityData['PRODUCTIVITYID']);
	$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);
?>
<div id="main">

<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">

            <img title="Export to Excel" class="highlightit" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" onclick="frmDelete.location='export/report_10.php'" /></td></tr>
    </table>
</fieldset>

<?
//$subActivityRow = SelectData("CNF_STRATEGY"," WHERE ID=".$subactivity);
$subActivityRow = $this->cnf_strategy->get_row($subactivity);
$missionType = $subActivityRow['missiontype'];
//$mainActivityRow = SelectData("CNF_STRATEGY"," WHERE ID=".$subActivityRow['MAINACTID']);
$mainActivityRow = $this->cnf_strategy->get_row($subActivityRow['mainactid']);
//$planRow = SelectData("CNF_STRATEGY","WHERE ID=".$mainActivityRow["PLANID"]);
$planRow = $this->cnf_strategy->get_row($mainActivityRow["planid"]);
//$ministryTargetRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainactivityRow["MINISTRYTARGETID"]);
$ministryTargetRow = $this->cnf_strategy->get_row($mainActivityRow["ministrytargetid"]);
//$ministryStrategyRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainActivityRow['MINISTRYSTRATEGYID']);
$ministryStrategyRow = $this->cnf_strategy->get_row($mainActivityRow['ministrystrategyid']);
//$sectionTargetRow = SelectData("CNF_STRATEGY", " WHERE ID=".$mainactivityRow['SECTIONTARGETID']);
$sectionTargetRow = $this->cnf_strategy->get_row($mainActivityRow['sectiontargetid']);
//$productivityRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainActivityRow['PRODUCTIVITYID']);
$productivityRow = $this->cnf_strategy->get_row($mainActivityRow['productivityid']);
?>
<br />
&nbsp;
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
  <td align="left" style="padding-bottom:10px;">ภาค :
    <?
	  			if($pzone == '' )
					echo "ทั้งหมด";
				else
				{
					$provinceZone = $this->pzone->get_one("title",'id',$pzone);
					echo $provinceZone['title'];
				}
  ?></td>
  <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :
    <?
	  			if($pgroup == '' )
					echo "ทั้งหมด";
				else
				{
				//$provinceGroup = SelectData("CNF_PROVINCE_GROUP"," WHERE ID=".$pgroup." ");
				//echo $provinceGroup['DESCRIPTION'];
				}
		  ?></td>
  <td align="left">จังหวัด : <span style="padding-bottom:10px;">
    <?
	  			if($province == '' )
					echo "ทั้งหมด";
				else
				{
					$province = $this->privince->get_one('title','id',$province);
					echo $province['title'];
				}
		  ?>
  </span></td>
</tr>
<tr>
  <td align="left" style="padding-bottom:10px;">หน่วยงาน :
    <?
  		if($userSection == '' )
			echo "ทั้งหมด";
		else
		{
			$section = $this->division->get_one('title','id',$userSection);
			echo $section['title'];
		}
  ?></td>
  <td align="left" style="padding-bottom:10px;">กลุ่มงาน :
    <?
		if($userWorkgroup=='')
		{
			echo "ทุกกลุ่มงาน";
		}
		else
		{
			$workgroup = $this->workgroup->get_one('title','id',$userWorkgroup);
			echo $workgroup['title'];
		}
  ?></td>
  <td align="left">&nbsp;</td>
</tr>
<tr>
  <td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?>
    &nbsp;</td>
</tr>
</table>
<div style="display:block; padding-top:10px; padding-bottom:10px;" align="center"><?php echo "missionType = ".$missionType; ?>
<input type="checkbox" id="chkMisstype" disabled="disabled" value="ภารกิจพื้นฐาน" <? if($missionType=='ภารกิจพื้นฐาน')echo "checked";?>  /> ภารกิจพื้นฐาน
<input type="checkbox" id="chkMisstype" disabled="disabled" value="ภารกิจพื้นฐาน" <? if($missionType=='ภารกิจยุทธศาสตร์')echo "checked";?>  /> ภารกิจยุทธศาสตร์
<input type="checkbox" id="chkPolicy" disabled="disabled" value="นโยบายต่อเนื่อง" <? if($missionType=='นโยบายต่อเนื่อง')echo "checked";?>  /> นโยบายต่อเนื่อง
<input type="checkbox" id="chkPolicy" disabled="disabled" value="นโยบายใหม่" <? if($missionType=='นโยบายใหม่')echo "checked";?>  /> นโยบายใหม่
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
		$mainTypeResult = $this->budget_type->get($sql);
		foreach($mainTypeResult  as $mainTypeRow)
		{
			$i++;
	?>
    <tr bgcolor="#ECFCFF">
      <td><h4><?php echo$i;?>.&nbsp;<?php echo $mainTypeRow['title'];?></h4></td>
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
				$secondTypeResult = $this->budget_type->get($sql);
				foreach($secondTypeResult as $secondTypeRow)
				{
			?>
			<tr bgcolor="#FCF0FF">
			  <td><h5>- <?php echo $secondTypeRow['title'];?></h5></td>
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
						$thirdTypeResult = $this->budget_type->get($sql);
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
</div>
<?php }else{ ?>
	<div style="width:80%; margin-left:auto; margin-right:auto; height:250px; vertical-align:middle; text-align:center; background-color:#F5F5F5; border:1 #999 solid" align="center">
    <br /><br /><br /><br /><br /><br />กรุณาเลือกกิจกรรมย่อย</div>
<?php } ?>
