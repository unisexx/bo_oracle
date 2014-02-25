<h3 id="topic">แผนการปฏิบัติงานและแผนการใช้จ่ายงบประมาณรายจ่ายประจำปีงบประมาณ <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report/index/8" method="get">
<fieldset>
    <legend> ค้นหา </legend>
<table id="tbsearch">
<tr>
	<th>ปีงบประมาณ</th>
    <td>
        <?php echo form_dropdown('year',get_option('(byear-543) as byear_id','byear','cnf_set_time',' 1=1 order by byear'),$year,'id="year"','เลือกปีงบประมาณ'); ?>
    </td>
</tr>
<tr>
	<th>ขั้นตอน </th>
    <td>
        <select name="step" id="step">
             <option value="1" <? if($step=='1')echo "selected";?>>ขั้นตอนที่ 1 : เสนอคำของงบประมาณ  </option>
             <option value="2" <? if($step=='2')echo "selected";?>>ขั้นตอนที่ 2 : ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ</option>
             <option value="3" <? if($step=='3')echo "selected";?>>ขั้นตอนที่ 3 : ปรับปรุงคำของบประมาณตามมติ ครม.</option>
             <option value="4" <? if($step=='4')echo "selected";?>>ขั้นตอนที่ 4 : ปรับปรุงคำของบประมาณตามมติ กระทรวง</option>
             <option value="5" <? if($step=='5')echo "selected";?>>ขั้นตอนที่ 5 : แปรญัตติเพิ่ม</option>
             <option value="6" <? if($step=='6')echo "selected";?>>ขั้นตอนที่ 6 : ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ</option>
             <option value="7" <? if($step=='7')echo "selected";?>>ขั้นตอนที่ 7 : รายละเอียดงบประมาณตาม พรบ.</option>
             <option value="8" <? if($step=='8')echo "selected";?>>ขั้นตอนที่ 8 : ปรับปรุงงบประมาณเพื่อการบริหาร</option>
          </select>
    </td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td>
    <div id="dvProductivity" >

        <?php echo form_dropdown('productivity',get_option('id','title','cnf_strategy',' productivityid = 0 and sectionstrategyid > 0 and syear ='.$year),$productivity,'id="productivity"','เลือกผลผลิต','0'); ?>
      </div>
	</td>
</tr>
<tr>
  <th>กิจกรรมหลัก </th>
  <td>
    <div id="dvMainActivity">
        <?php
        $condition = $productivity != '' ? " and productivityid =".$productivity : "";
        echo form_dropdown('mainactivity',get_option('id','title','cnf_strategy',' mainactid = 0 and budgetpolicyid > 0 and syear='.$year.$condition),$mainactivity,'id="mainactivity"','เลือกกิจกรรมหลัก','0') ?>
      </div>
    </td>
</tr>
<tr>
  <th>กิจกรรมย่อย </th>
  <td>
    <div id="dvSubActivity">
        <?
		$condition = (!empty($productivity)) ? "  and productivityid =".$productivity : "";
		$condition = (!empty($mainactivity)) ? " and  mainactid =".$mainactivity : $condition;
		$condition = (!empty($missionType)) ? " and missiontype = '".trim($missionType)."' " : $condition;
		//echo $sql = "select * from cnf_strategy where MAINACTID > 0 AND SYEAR=".$year.$condition;
	    echo form_dropdown('subactivity',get_option('id','title','cnf_strategy',' MAINACTID > 0 AND SYEAR='.$year.$condition),$subactivity,'id="subactivity"','เลือกกิจกรรมย่อย','0');  ?>
      </div>
     </td>
</tr>
<tr>
  <th>ภาค</th>
  <td><?php echo form_dropdown('pzone',get_option('id','title ','cnf_province_zone','zone_type_id=2','id'),$pzone,'id="pzone"','ทุกภาค') ?></td>
</tr>

<tr>
  <th>จังหวัด</th>
  <td><div id="dvProvinceList">
    <?php
    $condition = (!empty($province)) ? " where  provinceid=".$province:'';
	$sql = "select distinct cnf_province.id as id,cnf_province.title as title from cnf_province left join cnf_province_detail_zone ON cnf_province.id = provinceid $condition order by title";
    $result = $this->province->get($sql,true);
    ?>
    <select name="province" id="province">
    <option value="0">เลือกจังหวัด</option>
	<?php foreach($result as $item){ ?>
   	<option value="<?php echo $item['id'] ?>" <?php if($item['id']==$province){echo 'selected="selected"';}?>><?php echo $item['title'] ?></option>
  	<?php } ?>
  	</select>
  </div></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><div id="dvSectionList">
  	<?php echo form_dropdown('division',get_option('id','title','cnf_division','','title'),$division,'id="division"','เลือกหน่วยงาน'); ?>
  </div></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><div id="dvWorkgroupList">
    <?php
     $condition = (!empty($_GET['division'])) ? " divisionid=".$_GET['division']: "";
     echo form_dropdown('workgroup',get_option('id','title','cnf_workgroup',$condition),$workgroup,'id="workgroup"','เลือกทุกกลุ่ม','0'); ?>
  </div></td>
</tr>
<tr>
  <th></th>
  <td><input type="submit" id="btnSubmit" name="btnSubmit" value="ค้นหา" class="btn_search" /></td>
</tr>
</table>
</fieldset>
</form>
</div>
<? if($step!=''){
$subactivityData  = $this->cnf_strategy->get_row($subactivity);
$mainactivityData = $this->cnf_strategy->get_one("trim(TRAILING '' from title) as title",'id',$subactivityData['mainactid']);
$productivityData = $this->cnf_strategy->get_one("trim(TRAILING '' from title) as title",'id',$subactivityData['productivityid']);
 ?>
<div id="main">

<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
			<a href="budget_report/index/8/export<?php echo GetCurrentUrlGetParameter(); ?>">
            <img title="Export to Excel" class="highlightit" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" /></a></tr>
    </table>
</fieldset>
<table width="95%" align="center" >
      <tr style="padding-bottom:10px;">
        <td style="padding-bottom:10px;" colspan="3" align="center">แผนการปฏิบัติงานและแผนการใช้จ่ายงบประมาณรายจ่ายประจำปีงบประมาณ          <?php echo $thyear;?></td>
      </tr>
      <tr>
		  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo @$productivityData['title'];?></td>
		  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo @$mainactivityData['title'];?></td>
		  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo @$subactivityData['title'];?></td>
      </tr>
      <tr>
	      <td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
	      <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :<?php echo $provinceGroup ?></td>
	      <td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
      </tr>
      <tr>
	 	  <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน :<?php echo $division_name?></td>
	 	  <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน :<?php echo $workgroup_name;?></td>
          <td align="left">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?>
          &nbsp;</td>
      </tr>
    </table>
<div align="right">( หน่ว่ย : ล้านบาท)
<table class="tbToDoList">
	<tr bgcolor="#EFF7E8">
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
    <tr bgcolor="#EFF7E8">
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
    </tr>
    <?
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
<? } ?>
</body>
</html>

<script type="text/javascript">
<?php include('js/function.js'); ?>
$(document).ready(function(){
	var pProductivity,pMainActivity,pProvince,pZone,pSection;
	var yy = $('#year option:selected').val();
	$('#year').change(function(){
		yy = $('#year option:selected').val();
		LoadProductivity(yy,'dvProductivity');
		LoadMainActivity(yy,'','dvMainActivity');
		LoadSubActivity(yy,'','','dvSubActivity');
	})
	$('#missiontype').change(function(){
		LoadSubActivity(yy,'','','dvSubActivity');
	});
	$('#productivity').live('change',function(){
		pProductivity = $('#productivity option:selected').val();
		LoadMainActivity(yy,pProductivity,'dvMainActivity');
		LoadSubActivity(yy,pProductivity,'','dvSubActivity');
	});
	$('#pzone').change(function(){
		pZone = $('#pzone option:selected').val();
		LoadProvinceZone(pZone);
	});

	$('#province').live('change',function(){
		pProvince = $('#province option:selected').val();
		//LoadSection(pProvince);
		LoadWorkgroup('',pZone,pProvince);
	});
	$('#division').live('change',function(){
		var pSection = $('#division option:selected').val();
		//LoadWorkgroup(pSection);
		LoadWorkgroup(pSection,pZone,pProvince);
	});

});
</script>