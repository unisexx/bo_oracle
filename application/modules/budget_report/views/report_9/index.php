<h3 id="topic">แผนงบประมาณรายจ่ายประจำปีงบประมาณ <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report_9/index" method="get">
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
  <th>กิจกรรมหลัก <span class="red">(กรุณาเลือก)</span></th>
  <td>
    <div id="dvMainActivity">
        <?php
        $condition = $productivity != '' ? " and productivityid =".$productivity : "";
        echo form_dropdown('mainactivity',get_option('id','title','cnf_strategy',' mainactid = 0 and budgetpolicyid > 0 and syear='.$year.$condition),$mainactivity,'id="mainactivity"','เลือกกิจกรรมหลัก','0') ?>
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

<? if($step!=''&& $mainactivity != ''){ ?>
<div id="main">
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
        	<a href="budget_report/index/9/export<?php echo GetCurrentUrlGetParameter(); ?>">
            <img title="Export to Excel" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" /></a></tr>
    </table>
</fieldset>
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
</div>
<? } ?>
</body>
</html>
<?
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
		$condition .= $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER 		   ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP 		   ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION 			   ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE 			   ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON  CNF_PROVINCE_ZONE_DETAIL.PROVINCEID = CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = $this->budget_type->get($sql);
			return  (!empty($result[0]['total'])) ? $result[0]['total']:0;


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
		$condition .= $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON CNF_PROVINCE_ZONE_DETAIL.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 AND PRODUCTIVITYID=".$pProductivity."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = $this->budget_type->get($sql);
			return (!empty($result[0][total])) ? $result[0]['total']:0;

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

		$condition .= $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON CNF_PROVINCE_ZONE_DETAIL.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID IN (
				SELECT ID FROM CNF_STRATEGY WHERE MAINACTID=".$pMainActID."
			)
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = $this->budget_type->get($sql);
			return (!empty($result[0]['total'])) ? $result[0]['total']:0;
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

		$condition = $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON CNF_PROVINCE_ZONE_DETAIL.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID =".$pSubActID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = $this->budget_type_detail->get($sql);
			return (!empty($result[0]['total'])) ? $result[0]['total']:0;
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
		$condition = $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON CNF_PROVINCE_ZONE_DETAIL.PROVINCEID =  CNF_PROVINCE.ID
			WHERE  BUDGET_MASTER.ID =".$pProjectID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			$result = $this->budget_type->get($sql);
			return (!empty($result[0]['total'])) ? $result[0]['total']:0;
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

		$condition = $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_PRODUCTIVITY_KEY
			LEFT JOIN BUDGET_MASTER ON BUDGET_PRODUCTIVITY_KEY.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON CNF_PROVINCE_ZONE_DETAIL.PROVINCEID =  CNF_PROVINCE.ID
			WHERE ID=".$pKeyID
			;
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];

}

function GetSummaryBudgetKey($pKey,$pQuarter,$year, $zone, $group, $province, $section,$workgroup,$step)
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

		$condition = $pZone != '' ? " AND CNF_PROVINCE_ZONE_DETAIL.ZONEID='".$pZone."' ": "";
		//$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_PRODUCTIVITY_KEY
			LEFT JOIN BUDGET_MASTER ON BUDGET_PRODUCTIVITY_KEY.BUDGETID=BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			LEFT JOIN CNF_PROVINCE_ZONE_DETAIL ON CNF_PROVINCE_ZONE_DETAIL.PROVINCEID =  CNF_PROVINCE.ID
			WHERE CHKWORKPLAN <> '' AND PRODKEYID=".$pKey." AND STEP=".$step.$condition.$option."
			"
			;
			$result = db_query(ConvertCommand($sql));
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}

?>

<script type="text/javascript">
<?php include('js/function.js'); ?>
$(document).ready(function(){
	var pgroup,yy;
	yy = $('#year option:selected').val();
	alert(yy);
	$('#year').change(function(){
		yy = $('#year option:selected').val();
		LoadMainActivity(yy,$('#year option:selected').val(),'dvMainActivity');
		LoadSubActivity(yy,$('#year option:selected').val(),'','dvSubActivity');
	})
	$('#productivity').live('change',function(){
		pProductivity = $(this).val();
		//alert(pProductivity);
		LoadMainActivity(yy,$('#productivity option:selected').val(),'dvMainActivity');
		LoadSubActivity(yy,$('#productivity option:selected').val(),'','dvSubActivity');
	});
	$('#province').live('change',function(){
		var pProvince = $('#province option:selected').val();
		if(pProvince.length>0){
			LoadSection(pProvince);
		}
	});
	$('#division').live('change',function(){
		var pSection = $('#division option:selected').val();
		if(pSection.length>0){
			LoadWorkgroup(pSection);
		}
	});
	$('#pgroup').change(function(){
		pgroup = $('#pgroup option:selected').val();
		//alert(pgroup);
		if(pgroup.length>0){
			LoadProvinceGroup(pGroup);
		}
	})
});
</script>


