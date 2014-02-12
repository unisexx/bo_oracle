<? if($step!=''&& $mainactivity != ''){ ?>
<div id="main">
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
            <img title="Export to Excel" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" onclick="frmDelete.location='export/report_9.php?';" /></tr>
    </table>
</fieldset>
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานแผนงบประมาณรายจ่าย ประจำปีงบประมาณ	  <?=$thyear;?></td>
</tr>
  <tr>
    <td align="left" style="padding-bottom:10px;">ภาค :
      <?
	  			if($pzone == '' )
					echo "ทั้งหมด";
				else
				{
  					$provinceZone = SelectData("CNF_PROVINCE_ZONE"," WHERE CODE='".$pzone."' ");
					echo $provinceZone['TITLE'];
				}
  ?></td>
    <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :
      <?
	  			if($pgroup == '' )
					echo "ทั้งหมด";
				else
				{
				$provinceGroup = SelectData("CNF_PROVINCE_GROUP"," WHERE ID=".$pgroup." ");
				echo $provinceGroup['DESCRIPTION'];
				}
		  ?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;">
      <?
	  			if($province == '' )
					echo "ทั้งหมด";
				else
				{
				$province = SelectData("CNF_PROVINCE_CODE"," WHERE ID=".$province." ");
				echo $province['TITLE'];
				}
		  ?>
    </span></td>
  </tr>
  <tr>
  <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน :
  <?
  		if($userSection == '' )
			echo "ทั้งหมด";
		else
		{
  		$section = SelectData("CNF_SECTION_CODE"," WHERE ID=".$userSection." ");
		echo $section['TITLE'];
		}
  ?>
  </td>
  <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน :
  <?
		if($userWorkgroup=='')
		{
			echo "ทุกกลุ่มงาน";
		}
		else
		{
  		$workgroup = SelectData("CNF_WORK_GROUP"," WHERE ID=".$userWorkgroup." ");
		echo $workgroup['TITLE'];
		}
  ?>
  </td>
  <td width="33%" align="left">&nbsp;</td>
</tr>
  <tr>
    <td colspan="3" align="left" style="padding-bottom:10px;">
	<? //$stepName = GetStepName(); echo $stepName[$_GET['step']];?>
    &nbsp;</td>
    </tr>
</table>
<?
$mainActivityRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainactivity);
$planRow = SelectData("CNF_STRATEGY","WHERE ID=".$mainActivityRow["PLANID"]);
$ministryTargetRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainactivityRow["MINISTRYTARGETID"]);
$ministryStrategyRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainActivityRow['MINISTRYSTRATEGYID']);
$sectionTargetRow = SelectData("CNF_STRATEGY", " WHERE ID=".$mainactivityRow['SECTIONTARGETID']);
$productivityRow = SelectData("CNF_STRATEGY"," WHERE ID=".$mainActivityRow['PRODUCTIVITYID']);
?>
<table width="100%" cellpadding="5" cellspacing="2">
<tr>
	<td>
		แผนงาน : <?=$planRow['TITLE'];?>
    </td>
</tr>
<tr>
	<td>
    	เป้าหมายการให้บริการกระทรวง : <?=$ministryTargetRow['TITLE'];?>
    </td>
</tr>
<tr>
	<td>
    	ยุทธศาสตร์กระทรวง : <?=$ministryStrategyRow['TITLE'];?>
    </td>
</tr>
<tr>
	<td>
    	เป้าหมายการให้บริษัทหน่วยงาน : <?=$sectionTargetRow['TITLE'];?>
    </td>
</tr>
<tr>
	<td>
    	ผลผลิต : <?=$productivityRow['TITLE'];?>
    </td>
</tr>
<?
$sql = "SELECT * FROM CNF_STRATEGY_DETAIL WHERE PID=".$productivityRow['ID'];
$productivityKeyResult = db_query($sql);
while($productivityKeyRow = db_fetch_array($productivityKeyResult,0))
{
?>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตัวชี้วัดผลผลิต : <?=$productivityKeyRow['TITLE'];?></td>
</tr>
<? } ?>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กิจกรรมหลัก : <?=$mainActivityRow['TITLE'];?></td>
</tr>
<tr>
  <td align="right">หน่วย:ล้านบาท&nbsp;</td>
</tr>
</table>
<table class="tbToDoList">
  <tr bgcolor="#EFF7E8">
		<td valign="top">กิจกรรมหลัก/กิจกรรมย่อย/โครงการ</td>
      <td valign="top">เป้าหมาย</td>
    <td colspan="2" valign="top">งบประมาณ<br />(ล้านบาท)</td>
      <td colspan="2" valign="top">ไตรมาส 1 (ต.ค.-ธ.ค.)</td>
      <td colspan="2" valign="top">ไตรมาส 2 (ม.ค.-มี.ค.)</td>
      <td colspan="2" valign="top">ไตรมาส 3 (เม.ย.-มิ.ย.)</td>
      <td colspan="2" valign="top">ไตรมาส 4 (ก.ค.-ก.ย.)</td>
        <td rowspan="2" valign="top">พื้นที่ดำเนินการ</td>
    </tr>
    <tr bgcolor="#EFF7E8">
   	  <td valign="top">&nbsp;</td>
        <td align="center" valign="top">&nbsp;</td>
    <td align="center" valign="top">เป้าหมาย</td>
      <td valign="top">งบประมาณ</td>
      <td valign="top">เป้าหมาย</td>
      <td valign="top">งบประมาณ</td>
      <td valign="top">เป้าหมาย</td>
      <td valign="top">งบประมาณ</td>
      <td valign="top">เป้าหมาย</td>
      <td valign="top">งบประมาณ</td>
      <td valign="top">เป้าหมาย</td>
        <td valign="top">งบประมาณ</td>
    </tr>
    <?
			$section = $userSection;
			$workgroup = $userWorkgroup;
			$zone = $pzone;
			$group = $pgroup;
			$province = $_GET['province'];
			$subactivityCondition = $subactivity != '' ? " AND ID=".$subactivity : "";
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND MAINACTID =".$mainActivityRow['ID'].$subactivityCondition;
			$sresult = db_query($sql);
			while($subActivityRow = db_fetch_array($sresult,0)){
				$totalBudgetA = GetSummarySubActivity($subActivityRow['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummarySubActivity($subActivityRow['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummarySubActivity($subActivityRow['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummarySubActivity($subActivityRow['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr bgcolor="#FFF7EC">
                  <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$subActivityRow['TITLE'];?>&nbsp;</td>
                  <td align="center" valign="top">&nbsp;</td>
                  <td align="right" valign="top">&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
                  <td align="right" valign="top">&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
                  <td align="right" valign="top">&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
                  <td align="right" valign="top">&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
                  <td align="right" valign="top">&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                </tr>

                	                <?
			$sql = "SELECT * FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subActivityRow['ID']." AND STEP=".$step;
			$projectResult = db_query($sql);
			while($project = db_fetch_array($projectResult,0)){
				$totalBudgetA = GetSummaryProject($project['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryProject($project['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryProject($project['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryProject($project['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?=$project['PROJECTTITLE'];?>&nbsp;</td>
                  <td align="center" valign="top">
                  <?
				  	$sql = "SELECT BUDGET_PRODUCTIVITY_KEY.*,CNF_COUNT_UNIT.TITLE UNITNAME FROM BUDGET_PRODUCTIVITY_KEY LEFT JOIN CNF_STRATEGY_DETAIL ON BUDGET_PRODUCTIVITY_KEY.PRODKEYID=CNF_STRATEGY_DETAIL.ID LEFT JOIN CNF_COUNT_UNIT ON CNF_STRATEGY_DETAIL.UNITTYPEID=CNF_COUNT_UNIT.ID WHERE CHKWORKPLAN <> '' AND BUDGETID=".$project['ID'];
					$keyResult = db_query($sql);
					$keyRow = db_fetch_array($keyResult,0);
					echo $keyRow['UNITNAME'];
					$totalKeyA = GetSummaryKeyProject($keyRow['ID'],1);
					$totalKeyB = GetSummaryKeyProject($keyRow['ID'],2);
					$totalKeyC = GetSummaryKeyProject($keyRow['ID'],3);
					$totalKeyD = GetSummaryKeyProject($keyRow['ID'],4);
					$totalSummaryKey = $totalKeyA + $totalKeyB + $totalKeyC + $totalKeyD;
				  ?>
                  &nbsp;
                  </td>
                  <td align="right" valign="top"><? if($totalSummaryKey>0)echo number_format($totalSummaryKey,0);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
                  <td align="right" valign="top"><? if($totalKeyA>0)echo number_format($totalKeyA,0);?></td>
                  <td align="right" valign="top"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalKeyB>0)echo number_format($totalKeyB,0);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalKeyC>0)echo number_format($totalKeyC,0);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalKeyD>0)echo number_format($totalKeyD,0);?>&nbsp;</td>
                  <td align="right" valign="top"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
                  <td align="left" valign="top">
                  <?
				  	$operationArea = '';
				  	$operationArea .= $project['CHKOPERATIONCENTRAL']!='' ? " ส่วนกลาง " : "";

					if($project['CHKOPERATIONREGION']!='' && $operationArea!='')
						$operationArea .=" <br/>"."ส่วนภูมิภาค ";
					elseif($project["CHKOPERATIONREGION"]!='')
						$operationArea .=" <br/>"."ส่วนภูมิภาค ";

				  	$sql = "SELECT * FROM BUDGET_OPERATION_AREA LEFT JOIN CNF_PROVINCE_CODE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE_CODE.ID WHERE BUDGETID=".$project['ID']." ORDER BY CNF_PROVINCE_CODE.TITLE ";
					$provinceResult = db_query($sql);
					while($provinceRow = db_fetch_array($provinceResult,0))
					{
						$operationArea .="<br/>&nbsp;&nbsp;-&nbsp;".$provinceRow['TITLE'];
					}
				  echo $operationArea;
				  ?>

                  &nbsp;</td>

                </tr>
                <? } ?>
            <? } ?>
</table>
</div>
<?php } ?>