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
  <th>กิจกรรมย่อย <span class="red">(กรุณาเลือก)</span></th>
  <td>
    <div id="dvSubActivity">
        <?
		$condition = (!empty($productivity)) ? "  and productivityid =".$productivity : "";
		$condition = (!empty($mainactivity)) ? " and  mainactid =".$mainactivity : $condition;
		$condition = (!empty($missionType)) ? " and missiontype = '".trim($missionType)."' " : $condition;
		echo $sql = "select * from cnf_strategy where MAINACTID > 0 AND SYEAR=".$year.$condition;
	    echo form_dropdown('subactivity',get_option('id','title','cnf_strategy',' MAINACTID > 0 AND SYEAR='.$year.$condition),$subactivity,'id="subactivity"','เลือกกิจกรรมย่อย','0');  ?>
      </div>
     </td>
</tr>
<tr>
  <th>ภาค</th>
  <td><?php echo form_dropdown('pzone',get_option('id','title ','cnf_province_zone','zone_type_id=2','id'),$pzone,'id="pzone"','ทุกภาค') ?></td>
</tr>
<tr>
  <th>กลุ่มจังหวัด</th>
  <td>
  	<?php echo form_dropdown('pgroup',get_option('id','title','cnf_province_zone',' zone_type_id =3','title'),$pgroup,'id="pgroup"','ทุกกลุ่มจังหวัด') ?></td>
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
   	<option value="<?php echo $item['id'] ?>"><?php echo $item['title'] ?></option>
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
<? if($step!=''){ ?>
<div id="main">

<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">

            <img title="Export to Excel" class="highlightit" src="../images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" onclick="frmDelete.location='export/report_8.php?<?=$querystring;?>';" /></tr>
    </table>
</fieldset>
<table width="95%" align="center" >
      <tr style="padding-bottom:10px;">
        <td style="padding-bottom:10px;" colspan="3" align="center">แผนการปฏิบัติงานและแผนการใช้จ่ายงบประมาณรายจ่ายประจำปีงบประมาณ          <?=$thyear;?></td>
      </tr>
      <tr>
		  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityTitle;?></td>
		  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityTitle;?></td>
		  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityTitle;?></td>
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
        <td align="left" style="padding-bottom:10px;">หน่วยงาน :
          <?
  		if($userSection == '' )
			echo "ทั้งหมด";
		else
		{
  		$section = SelectData("CNF_SECTION_CODE"," WHERE ID=".$userSection." ");
		echo $section['TITLE'];
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
  		$workgroup = SelectData("CNF_WORK_GROUP"," WHERE ID=".$userWorkgroup." ");
		echo $workgroup['TITLE'];
		}
  ?></td>
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
			$province = $_GET['province'];
			$workgroup = $_GET['workgroup'];
			$section = $_GET['section'];
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
	$planresult = db_query($sql);
	while($plan = db_fetch_array($planresult,0)){
	?>
    <tr>
      <td bgcolor="#FFFFCC"><?=$plan['TITLE'];?>&nbsp;</td>
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
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=".$plan['ID']."  AND SECTIONSTRATEGYID > 0 AND PRODUCTIVITYID = 0 ".$productivityCondition ;
			$presult = db_query($sql);
			while($productivityRow = db_fetch_array($presult,0)){
				$totalBudgetA = GetSummaryProductivity($productivityRow['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryProductivity($productivityRow['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryProductivity($productivityRow['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryProductivity($productivityRow['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
            <tr bgcolor="#F5FEE0">
              <td><?=$productivityRow['TITLE'];?>&nbsp;</td>
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
			$sql = "SELECT * FROM CNF_STRATEGY_DETAIL WHERE PID=".$productivityRow['ID']." AND KEYTYPE='เชิงปริมาณ'";
			$pkresult = db_query(ConvertCommand($sql));
			while($productivityKey = db_fetch_array($pkresult,0)){
			$summaryKeyA = GetSummaryBudgetKey($productivityKey['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
			$summaryKeyB = GetSummaryBudgetKey($productivityKey['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
			$summaryKeyC = GetSummaryBudgetKey($productivityKey['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
			$summaryKeyD = GetSummaryBudgetKey($productivityKey['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
			$totalSummaryKey = $summaryKeyA + $summaryKeyB + $summaryKeyC + $summaryKeyD;

			?>
      <tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$productivityKey['TITLE'];?>&nbsp;</td>
                  <td align="center"><? $unit = SelectData("CNF_COUNT_UNIT"," WHERE ID=".$productivityKey['UNITTYPEID']);echo $unit['TITLE'];?> &nbsp;</td>
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
			$sql = "SELECT * FROM CNF_STRATEGY_DETAIL WHERE PID=".$productivityRow['ID']." AND KEYTYPE='เชิงคุณภาพ'";
			$pkresult = db_query(ConvertCommand($sql));
			while($productivityKey = db_fetch_array($pkresult,0)){
			?>
              	<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$productivityKey['TITLE'];?>&nbsp;</td>
                  <td align="center"><? $unit = SelectData("CNF_COUNT_UNIT"," WHERE ID=".$productivityKey['UNITTYPEID']);echo $unit['TITLE'];?> &nbsp;</td>
                  <td align="right"><?=$productivityKey['QTY'];?>&nbsp;</td>
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
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=".$plan['ID']." AND PRODUCTIVITYID=".$productivityRow['ID']." AND BUDGETPOLICYID > 0 AND MAINACTID = 0 ".$mainactivityCondition;
			$mresult = db_query($sql);
			while($mainActivityRow = db_fetch_array($mresult,0)){
				$totalBudgetA = GetSummaryMainActivity($mainActivityRow['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryMainActivity($mainActivityRow['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryMainActivity($mainActivityRow['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryMainActivity($mainActivityRow['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td><?=$mainActivityRow['TITLE'];?>&nbsp;</td>
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
			$sql = "SELECT * FROM CNF_STRATEGY WHERE SYEAR=".$year." AND PLANID=".$plan['ID']." AND PRODUCTIVITYID=".$productivityRow['ID']." AND BUDGETPOLICYID > 0 AND MAINACTID =".$mainActivityRow['ID'].$subactivityCondition;
			$sresult = db_query($sql);
			while($subActivityRow = db_fetch_array($sresult,0)){
				$totalBudgetA = GetSummarySubActivity($subActivityRow['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummarySubActivity($subActivityRow['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummarySubActivity($subActivityRow['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummarySubActivity($subActivityRow['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$subActivityRow['TITLE'];?>&nbsp;</td>
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
			$condition = $zone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$zone."' ": "";
		$condition .= $group != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$group." " : "";
		$condition .= $province != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$province." " : "";
		$condition .= $section != '' ? " AND CNF_SECTION_CODE.ID=".$section." " : "";
		$condition .= $workgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$workgroup." " : "";
			$sql = "SELECT * FROM BUDGET_MASTER
			LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
			LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
			LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
			WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subActivityRow['ID']." AND STEP=".$step.$condition;
			$projectResult = db_query($sql);
			while($project = db_fetch_array($projectResult,0)){
				$totalBudgetA = GetSummaryProject($project['ID'],1,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetB = GetSummaryProject($project['ID'],2,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetC = GetSummaryProject($project['ID'],3,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudgetD = GetSummaryProject($project['ID'],4,$year, $zone, $group, $province, $section,$workgroup,$step);
				$totalBudget = $totalBudgetA + $totalBudgetB + $totalBudgetC + $totalBudgetD;
			?>
              	<tr>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?=$project['PROJECTTITLE'];?>&nbsp;</td>
                  <td align="center">
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
                  <td>
                  <?
					$projectWorkgroup = SelectData("CNF_WORK_GROUP","WHERE ID=".$project['WORKGROUP_ID']);
					$projectSection = SelectData("CNF_SECTION_CODE"," WHERE ID=".$projectWorkgroup['SECTIONID']);
					echo "หน่วยงาน : ".$projectSection['TITLE']."<br/>";
					echo "กลุ่มงาน : ".$projectWorkgroup['TITLE'];
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
<?
function GetSummaryBudget($pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step,$pSubactivity,$pMainActivity,$pProductivity)
{

		$condition = $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";

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
	  $option = $pSubactivity != '' ? " AND ID=".$pSubactivity." " : "";
	  $option .= $pMainActivity != '' ? " AND MAINACTID = ".$pMainActivity." " : "";
	  $option .= $pProductivity != '' ? " AND PRODUCTIVITYID=".$pProductivity." " : "";
			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
			LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
			LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 ".$option."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}


function GetSummaryProductivity($pProductivity,$pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{
		$condition = $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";
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

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
			LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
			LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 AND PRODUCTIVITYID=".$pProductivity."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
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

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
			LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
			LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID=".$pMainActID."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear."
			";
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
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

		$condition = $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
			LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
			LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
			WHERE  SUBACTIVITYID =".$pSubActID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
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

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			WHERE  BUDGET_MASTER.ID =".$pProjectID."
			";
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
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

			$sql = "
			SELECT ".$summary."	FROM BUDGET_PRODUCTIVITY_KEY
			WHERE ID=".$pKeyID
			;
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}

function GetSummaryBudgetKey($pKey,$pQuarter,$year, $zone, $group, $province, $section,$workgroup,$step)
{
			$condition = $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";
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

			$sql = "
			SELECT ".$summary."	FROM BUDGET_PRODUCTIVITY_KEY
			LEFT JOIN BUDGET_MASTER ON BUDGET_PRODUCTIVITY_KEY.BUDGETID=BUDGET_MASTER.ID WHERE CHKWORKPLAN <> '' AND PRODKEYID=".$pKey." AND STEP=".$step.$condition.$option."
			"
			;
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}
?>