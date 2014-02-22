<?php budget_type_config(); ?>
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานแผนงบประมาณรายจ่าย ประจำปีงบประมาณ	  <?php echo $thyear;?></td>
  </tr>
  <tr>
    <td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
    <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :<?php echo $provinceGroup ?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
  </tr>
  <tr>
	  <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน :<?php echo $division_name?></td>
	  <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน :<?php echo $workgroup_name;?></td>
	  <td width="33%" align="left">&nbsp;</td>
  </tr>
  <tr>
    	<td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?>&nbsp;</td>
  </tr>
</table>
<?
$mainActivityRow 	 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainactivity);
$planRow 			 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainActivityRow[0]["planid"]);
$ministryTargetRow 	 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainActivityRow[0]["ministrytargetid"]);
$ministryStrategyRow = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainActivityRow[0]['ministrystrategyid']);
$sectionTargetRow 	 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainActivityRow[0]['sectiontargetid']);
$productivityRow 	 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainActivityRow[0]['productivityid']);
?>
<table width="100%" cellpadding="5" cellspacing="2">
<tr>
	<td>
		แผนงาน : <?php echo $planRow[0]['title'];?>
    </td>
</tr>
<tr>
	<td>
    	เป้าหมายการให้บริการกระทรวง : <?php echo $ministryTargetRow[0]['title'];?>
    </td>
</tr>
<tr>
	<td>
    	ยุทธศาสตร์กระทรวง : <?php echo $ministryStrategyRow[0]['title'];?>
    </td>
</tr>
<tr>
	<td>
    	เป้าหมายการให้บริษัทหน่วยงาน : <?php echo $sectionTargetRow[0]['title'];?>
    </td>
</tr>
<tr>
	<td>
    	ผลผลิต : <?php echo $productivityRow[0]['title'];?>
    </td>
</tr>
<?
$sql = "SELECT * FROM CNF_STRATEGY_DETAIL WHERE PID=".$productivityRow[0]['id'];
$productivityKeyResult = $this->cnf_strategy_detail->get($sql);
foreach($productivityKeyResult as $productivityKeyRow){
?>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตัวชี้วัดผลผลิต : <?php echo $productivityKeyRow['title'];?></td>
</tr>
<? } ?>
<tr>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;กิจกรรมหลัก : <?php echo $mainActivityRow[0]['title'];?></td>
</tr>
<tr>
  <td colspan="13">หน่วย:ล้านบาท</td>
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
			//$section = $userSection;
			//$workgroup = $userWorkgroup;
			$zone = $pzone;
			$group = $pgroup;
			$province = $_GET['province'];
			$subactivityCondition = $subactivity != '' ? " AND ID=".$subactivity : "";
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND MAINACTID =".$mainActivityRow[0]['id'].$subactivityCondition;
			$result = $this->cnf_strategy->get($sql);

			foreach($result as $subActivityRow){
				$totalBudgetA = GetSummarySubActivity($subActivityRow['id'],1,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudgetB = GetSummarySubActivity($subActivityRow['id'],2,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudgetC = GetSummarySubActivity($subActivityRow['id'],3,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudgetD = GetSummarySubActivity($subActivityRow['id'],4,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr bgcolor="#FFF7EC">
                  <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $subActivityRow['title'];?>&nbsp;</td>
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
			$sql = "SELECT * FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subActivityRow['id']." AND STEP=".$step;
			$projectResult = $this->cnf_strategy->get($sql);
			foreach($projectResult as $project){
				$totalBudgetA = GetSummaryProject($project['id'],1,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudgetB = GetSummaryProject($project['id'],2,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudgetC = GetSummaryProject($project['id'],3,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudgetD = GetSummaryProject($project['id'],4,$year, $zone, $group, $province, $division,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?php echo $project['projecttitle'];?>&nbsp;</td>
                  <td align="center" valign="top">
                  <?
				  	$sql = "SELECT BUDGET_PRODUCTIVITY_KEY.*,CNF_COUNT_UNIT.TITLE UNITNAME
				  		    FROM BUDGET_PRODUCTIVITY_KEY
				  		    LEFT JOIN CNF_STRATEGY_DETAIL ON BUDGET_PRODUCTIVITY_KEY.PRODKEYID=CNF_STRATEGY_DETAIL.ID
				  		    LEFT JOIN CNF_COUNT_UNIT ON CNF_STRATEGY_DETAIL.UNITTYPEID=CNF_COUNT_UNIT.ID WHERE CHKWORKPLAN <> '' AND BUDGETID=".$project['id'];
					$keyResult = db_query($sql);
					$keyRow = db_fetch_array($keyResult,0);
					echo $keyRow['UNITNAME'];
					$totalKeyA = GetSummaryKeyProject($keyRow['id'],1);
					$totalKeyB = GetSummaryKeyProject($keyRow['id'],2);
					$totalKeyC = GetSummaryKeyProject($keyRow['id'],3);
					$totalKeyD = GetSummaryKeyProject($keyRow['id'],4);
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

				  	$sql = "SELECT * FROM BUDGET_OPERATION_AREA
				  			LEFT JOIN CNF_PROVINCE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE.ID
				  			WHERE BUDGETID=".$project['id']." ORDER BY CNF_PROVINCE.TITLE ";
					$provinceResult = $this->province->get($sql);
					foreach($provinceResult as $provinceRow)
					{
						$operationArea .="<br/>&nbsp;&nbsp;-&nbsp;".$provinceRow['title'];
					}
				  echo $operationArea;
				  ?>

                  &nbsp;</td>

                </tr>
                <? } ?>
            <? } ?>
</table>