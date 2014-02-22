<h3><br />แผนการปฏิบัติงานและแผนการใช้จ่ายงบประมาณรายจ่ายประจำปีงบประมาณ <?php echo $thyear;?></h3>
<div id="main">
<table border="1" bordercolor="#CCCCCC" cellpadding="0" cellspacing="0" >
	<tr>
		<td>แผนงาน/ผลผลิต/ตัวชี้วัด/กิจกรรมหลัก/กิจกรรมย่อย/โครงการ</td>
        <td>หน่วยนับ</td>
        <td colspan="2">รวมทั้งสิ้น</td>
        <td colspan="2">ไตรมาส 1 (ต.ค.-ธ.ค.)</td>
        <td colspan="2">ไตรมาส 2 (ม.ค.-มี.ค.)</td>
        <td colspan="2">ไตรมาส 3 (เม.ย.-มิ.ย.)</td>
        <td colspan="2">ไตรมาส 4 (ก.ค.-ก.ย.)</td>
        <td rowspan="2">พื้นที่ดำเนินการ</td>
        <td rowspan="2">หน่วยงานรับผิดชอบ</td>
    </tr>
    <tr>
   	  <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">เป้าหมาย</td>
        <td>งบประมาณ</td>
        <td>เป้าหมาย</td>
        <td>งบประมาณ</td>
        <td>เป้าหมาย</td>
        <td>งบประมาณ</td>
        <td>เป้าหมาย</td>
        <td>งบประมาณ</td>
        <td>เป้าหมาย</td>
        <td>งบประมาณ</td>
    </tr>    <?
			$zone = $pzone;
			$group = $pgroup;
			//$province = $_GET['province'];
			//$workgroup = $_GET['workgroup'];
			$section = $_GET['division'];
		$totalBudgetA = GetSummaryBudget(1,$year, $zone, $group, $province, $section,$workgroup,$step,$subactivity,$mainactivity,$productivity);
		$totalBudgetB = GetSummaryBudget(2,$year, $zone, $group, $province, $section,$workgroup,$step,$subactivity,$mainactivity,$productivity);
		$totalBudgetC = GetSummaryBudget(3,$year, $zone, $group, $province, $section,$workgroup,$step,$subactivity,$mainactivity,$productivity);
		$totalBudgetD = GetSummaryBudget(4,$year, $zone, $group, $province, $section,$workgroup,$step,$subactivity,$mainactivity,$productivity);
		$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
	?>
    <tr bgcolor="#F9F9F9">
      <td>ยอดรวมทั้งสิ้น&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
	<?
	$planCondition = '';
	$planCondition = $productivity!='' ? " AND ID=( SELECT PLANID FROM CNF_STRATEGY WHERE ID=".$productivity." ) " : $planCondition;
	$planCondition = $mainactivity!='' ? " AND ID=( SELECT PLANID FROM CNF_STRATEGY WHERE ID=".$mainactivity." ) " : $planCondition;
	$planCondition = $subactivity != '' ? " AND ID=( SELECT PLANID FROM CNF_STRATEGY WHERE ID=".$subactivity.") " : $planCondition;
	$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=0 AND BUDGETSTRATEGYID > 0 ".$planCondition;
	$planresult = $this->cnf_strategy->get($sql);
	foreach($planresult as $plan){
	?>
    <tr>
      <td bgcolor="#FFFFCC"><?=$plan['title'];?>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    		<?
			$productivityCondition = $productivity != '' ? " AND ID=".$productivity : $productivityCondition;
			$productivityCondition = $mainactivity!='' ? " AND ID=( SELECT PRODUCTIVITYID FROM CNF_STRATEGY WHERE ID=".$mainactivity." ) " : $productivityCondition;
			$productivityCondition = $subactivity != '' ? " AND ID=( SELECT PRODUCTIVITYID FROM CNF_STRATEGY WHERE ID=".$subactivity.") " : $productivityCondition;
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=".$plan['id']."  AND SECTIONSTRATEGYID > 0 AND PRODUCTIVITYID = 0 ".$productivityCondition ;
			$presult = $this->cnf_strategy->get($sql);
			foreach($presult as $productivityRow){
				$totalBudgetA = GetSummaryProductivity($productivityRow['id'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryProductivity($productivityRow['id'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryProductivity($productivityRow['id'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryProductivity($productivityRow['id'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
            <tr bgcolor="#F5FEE0">
              <td><?=$productivityRow['title'];?>&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
            </tr>
            <?
			$sql = "SELECT * FROM CNF_STRATEGY_DETAIL WHERE PID=".$productivityRow['id']." AND KEYTYPE='เชิงปริมาณ'";
			$pkresult = $this->cnf_strategy_detail->get($sql);
			foreach($pkresult as $productivityKey){
			$summaryKeyA = GetSummaryBudgetKey($productivityKey['id'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
			$summaryKeyB = GetSummaryBudgetKey($productivityKey['id'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
			$summaryKeyC = GetSummaryBudgetKey($productivityKey['id'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
			$summaryKeyD = GetSummaryBudgetKey($productivityKey['id'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
			$totalSummaryKey = $summaryKeyA + $summaryKeyB + $summaryKeyC + $summaryKeyD;

			?>
      		<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$productivityKey['title'];?>&nbsp;</td>
                  <td align="center"><?php echo $this->db->GetOne("select title from CNF_COUNT_UNIT where id = ".$productivityKey['unittypeid']); ?></td>
			      <td align="right"><? if($totalSummaryKey > 0 )echo number_format($totalSummaryKey,0);?>&nbsp;</td>
			      <td align="right">&nbsp;</td>
                  <td align="right"><? if($summaryKeyA > 0 )echo number_format($summaryKeyA,0);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($summaryKeyB > 0 )echo number_format($summaryKeyB,0);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($summaryKeyC > 0 )echo number_format($summaryKeyC,0);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($summaryKeyD > 0 )echo number_format($summaryKeyD,0);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
    		</tr>
            <? } ?>
            <?
			$sql = "SELECT * FROM CNF_STRATEGY_DETAIL WHERE PID=".$productivityRow['id']." AND KEYTYPE='เชิงคุณภาพ'";
			$pkresult = $this->cnf_strategy_detail->get($sql);
			foreach($pkresult as $productivityKey){
			?>
              	<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$productivityKey['title'];?>&nbsp;</td>
                  <td align="center"><?php echo $this->db->GetOne("select title from CNF_COUNT_UNIT where id = ".$productivityKey['unittypeid']); ?></td>
                  <td align="right"><?=$productivityKey['qty'];?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
            <? } ?>
    		<?
			$mainactivityCondition = $mainactivity != '' ? " AND ID=".$mainactivity : "";
			$mainactivityCondition = $subactivity != '' ? " AND ID=( SELECT MAINACTID FROM CNF_STRATEGY WHERE ID=".$subactivity.") " : $mainactivityCondition;
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=".$plan['id']." AND PRODUCTIVITYID=".$productivityRow['id']."
					AND BUDGETPOLICYID > 0 AND MAINACTID = 0 ".$mainactivityCondition;
			$mresult = $this->cnf_strategy->get($sql);
			foreach($mresult as $mainActivityRow){
				$totalBudgetA = GetSummaryMainActivity($mainActivityRow['id'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryMainActivity($mainActivityRow['id'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryMainActivity($mainActivityRow['id'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryMainActivity($mainActivityRow['id'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td><?=$mainActivityRow['title'];?>&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <?
			$subactivityCondition = $subactivity != '' ? " AND ID=".$subactivity : "";
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=".$plan['id']." AND PRODUCTIVITYID=".$productivityRow['id']."
					AND BUDGETPOLICYID > 0 AND MAINACTID =".$mainActivityRow['id'].$subactivityCondition;
			$sresult = $this->cnf_strategy->get($sql);
			foreach($sresult as $subActivityRow){
				$totalBudgetA = GetSummarySubActivity($subActivityRow['id'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummarySubActivity($subActivityRow['id'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummarySubActivity($subActivityRow['id'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummarySubActivity($subActivityRow['id'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$subActivityRow['title'];?>&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
                  <td align="right">&nbsp;</td>
                  <td align="right"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>

	<?
			$condition = !empty($zone) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$zone."' ": "";
			//$condition .= $group != '' ? " AND CNF_PROVINCE.PGROUP=".$group." " : "";
			$condition .= !empty($province) ? " AND CNF_DIVISION.PROVINCEID=".$province." " : "";
			$condition .= !empty($section) ? " AND CNF_DIVISION.ID=".$section." " : "";
			$condition .= !empty($workgroup) ?  " AND CNF_WORKGROUP.ID=".$workgroup." " : "";
			$sql = "SELECT * FROM BUDGET_MASTER
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID = CNF_PROVINCE.ID
			WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subActivityRow['id']." AND STEP=".$step.$condition;
			$projectResult = $this->budget_master->get($sql);
			foreach($projectResult as $project){
				$totalBudgetA = GetSummaryProject($project['id'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryProject($project['id'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryProject($project['id'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryProject($project['id'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?=$project['projecttitle'];?>&nbsp;</td>
                  <td align="center">
                  <?
				  	$sql = "SELECT BUDGET_PRODUCTIVITY_KEY.*,CNF_COUNT_UNIT.TITLE UNITNAME
				  			FROM BUDGET_PRODUCTIVITY_KEY
				  			LEFT JOIN CNF_STRATEGY_DETAIL 	ON BUDGET_PRODUCTIVITY_KEY.PRODKEYID=CNF_STRATEGY_DETAIL.ID
				  			LEFT JOIN CNF_COUNT_UNIT 		ON CNF_STRATEGY_DETAIL.UNITTYPEID=CNF_COUNT_UNIT.ID
				  	 		WHERE CHKWORKPLAN <> '' AND BUDGETID=".$project['id'];
					$keyRow = $this->budget_product->get($sql);

					echo $keyRow[0]['UNITNAME'];
					$totalKeyA = GetSummaryKeyProject($keyRow[0]['id'],1);
					$totalKeyB = GetSummaryKeyProject($keyRow[0]['id'],2);
					$totalKeyC = GetSummaryKeyProject($keyRow[0]['id'],3);
					$totalKeyD = GetSummaryKeyProject($keyRow[0]['id'],4);
					$totalSummaryKey = $totalKeyA + $totalKeyB + $totalKeyC + $totalKeyD;
				  ?>
                  &nbsp;
                  </td>
                  <td align="right"><? if($totalSummaryKey>0)echo number_format($totalSummaryKey,0);?>&nbsp;</td>
                  <td align="right"><? if($totalBudget > 0 ) echo number_format($totalBudget/1000000,4);?>&nbsp;&nbsp;</td>
                  <td align="right"><? if($totalKeyA>0)echo number_format($totalKeyA,0);?></td>
                  <td align="right"><? if($totalBudgetA > 0 ) echo number_format($totalBudgetA/1000000,4);?>&nbsp;</td>
                  <td align="right"><? if($totalKeyB>0)echo number_format($totalKeyB,0);?>&nbsp;</td>
                  <td align="right"><? if($totalBudgetB > 0 ) echo number_format($totalBudgetB/1000000,4);?>&nbsp;</td>
                  <td align="right"><? if($totalKeyC>0)echo number_format($totalKeyC,0);?>&nbsp;</td>
                  <td align="right"><? if($totalBudgetC > 0 ) echo number_format($totalBudgetC/1000000,4);?>&nbsp;</td>
                  <td align="right"><? if($totalKeyD>0)echo number_format($totalKeyD,0);?>&nbsp;</td>
                  <td align="right"><? if($totalBudgetD > 0 ) echo number_format($totalBudgetD/1000000,4);?>&nbsp;</td>
                  <td align="left">
                  <?
				  	$operationArea = '';
				  	$operationArea .= $project['chkoperationcentral']!='' ? " ส่วนกลาง " : "";

					if($project['chkoperationregion']!='' && $operationArea!='')
						$operationArea .=" <br/>"."ส่วนภูมิภาค ";
					elseif($project["chkoperationregion"]!='')
						$operationArea .=" <br/>"."ส่วนภูมิภาค ";

				  	$sql = "SELECT * FROM BUDGET_OPERATION_AREA LEFT JOIN CNF_PROVINCE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE.ID WHERE BUDGETID=".$project['id']." ORDER BY CNF_PROVINCE.TITLE ";
					$provinceResult = $this->budget_operation_area->get($sql);
					foreach($provinceResult as $provinceRow)
					{
						$operationArea .="<br/>&nbsp;&nbsp;-&nbsp;".$provinceRow['title'];
					}
				  echo $operationArea;
				  ?>

                  &nbsp;</td>
                  <td>
                  <?
					//$projectWorkgroup = SelectData("CNF_WORKGROUP","WHERE ID=".$project['WORKGROUP_ID']);
					$projectWorkgroup = $this->workgroup->get_one($project['workgroup_id']);
					$projectSection = $this->division->get_one($projectWorkgroup['divisionid']);
					echo "หน่วยงาน : ".$projectSection."<br/>";
					echo "กลุ่มงาน : ".$projectWorkgroup;
				  ?>
                  &nbsp;
                  </td>
                </tr>
                <? } ?>
                <? } ?>
            <? } ?>
    <? } ?>
    <? } ?>
</table>
</div>