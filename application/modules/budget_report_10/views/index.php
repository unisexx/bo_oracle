<h3 id="topic">การประมาณการรายจ่ายล่วงหน้าระยะปานกลางประจำปีงบประมาณ <?=$year+543;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report_10/index" method="get">
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
	<th>ขั้นตอน</th>
    <td>
        <select name="step" id="step">
             <option value="1" <? if($step=='1')echo "selected";?>>ขั้นตอนที่ 1 : เสนอคำของงบประมาณ  </option>
             <option value="2" <? if($step=='2')echo "selected";?>>ขั้นตอนที่ 2 : ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ</option>
             <option value="3" <? if($step=='3')echo "selected";?>>ขั้นตอนที่ 3 : ปรับปรุงคำของบประมาณตามมติ ครม.</option>
             <option value="4" <? if($step=='4')echo "selected";?>>ขั้นตอนที่ 4 : ปรับปรุงคำของบประมาณตามมติ กระทรวง</option>
             <option value="5" <? if($step=='5')echo "selected";?>>ขั้นตอนที่ 5 : แปรญิตติเพิ่ม</option>
             <option value="6" <? if($step=='6')echo "selected";?>>ขั้นตอนที่ 6 : ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ</option>
             <option value="7" <? if($step=='7')echo "selected";?>>ขั้นตอนที่ 7 : รายละเอียดงบประมาณตาม พรบ.</option>
             <option value="8" <? if($step=='8')echo "selected";?>>ขั้นตอนที่ 8 : ปรับปรุงงบประมาณเพื่อการบริหาร</option>
             </select>
    </td>
</tr>
<tr>
  <th>ประเภทภารกิจ</th>
  <td><?php
  		$mission = array('ภารกิจยุทธศาสตร์'=>'ภารกิจยุทธศาสตร์','ภารกิจพื้นฐาน'=>'ภารกิจพื้นฐาน');
  		echo form_dropdown('missiontype',$mission,@$_GET['missiontype'],'id="missiontype"','เลือกประเภทภารกิจ');
  	?>
   </td>
</tr>
<tr>
  <th>ผลผลิต</th>
  <td><div id="dvProductivity" >
    <?php echo form_dropdown('productivity',get_option('id','title','cnf_strategy','PRODUCTIVITYID = 0 AND SECTIONSTRATEGYID > 0 AND SYEAR='.$year),$productivity,'id="productivity"','เลือกผลผลิต','0'); ?>
  </div>
   </td>
</tr>
<tr>
  <th>กิจกรรมหลัก</th>
  <td><div id="dvMainActivity">
        <?php
        $condition = $productivity != '' ? " AND PRODUCTIVITYID=".$productivity : "";
        echo form_dropdown('mainactivity',get_option('id','title','cnf_strategy','MAINACTID = 0 AND BUDGETPOLICYID > 0 AND SYEAR='.$year.$condition),$mainactivity,'id="mainactivity"','เลือกกิจกรรมหลัก','0') ?>
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
  <td><?php echo form_dropdown('pzone',get_option('id','title ','cnf_province_zone','zone_type_id=2','id'),@$_GET['zone'],'id="pzone"','ภาคทั้งหมด') ?></td>
</tr>
<tr>
  <th>กลุ่มจังหวัด</th>
  <td><?php echo form_dropdown('pgroup',get_option('id','title','cnf_province_zone',' zone_type_id =3','title'),$pgroup,'id="pgroup"','ทุกกลุ่มจังหวัด') ?></td>
</tr>
<tr>
  <th>จังหวัด</th>
  <td><div id="dvProvinceList">
     <?php echo form_dropdown('province',get_option('id','title','cnf_province','','title'),@$_GET['province'],'id="province"','เลือกจังหวัด'); ?>
  </div></td>
</tr>
<tr>
  <th>หน่วยงาน</th>
  <td><div id="dvSectionList">
    <?php echo form_dropdown('division',get_option('id','title','cnf_division','','title'),$divisionid,'id="division"','เลือกหน่วยงาน'); ?>
  </div></td>
</tr>
<tr>
  <th>กลุ่มงาน</th>
  <td><div id="dvWorkgroupList">
    <?php
     $condition = (!empty($_GET['division'])) ? " divisionid=".$_GET['division']: "";
     echo form_dropdown('workgroup',get_option('id','title','cnf_workgroup',$condition),$workgroupid,'id="workgroup"','เลือกทุกกลุ่ม','0'); ?>
  </div></td>
</tr>
<tr>
  <th>&nbsp;</th>
  <td>
    <input type="submit" id="btnSubmit" name="btnSubmit" value="ค้นหา" class="btn_search" />
    </td>
</tr>
</table>
</fieldset>
</form>
</div>


<? if($step!=''&& $subactivity != ''){
	$subactivityData  = $this->cnf_strategy->get("select * from cnf_strategy where id =$subactivity");
	$mainactivityData = $this->cnf_strategy->get("select * from cnf_strategy where id =".$subactivityData[1]['mainactid']);
	$productivityData = $this->cnf_strategy->get("select * from cnf_strategy where id=".$subactivityData[1]['productivityid']);


?>
<div id="main">
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
			<a href="budget_report_10/index/export<?php echo $url_parameter;?>">
            <img title="Export to Excel" class="highlightit" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" /></a></td></tr>
    </table>
</fieldset>

<?
$subActivityRow 	 = $this->cnf_strategy->get("select * from cnf_strategy where id =$subactivity");
$missionType 		 = $subActivityRow[1]['missiontype'];
$mainActivityRow 	 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$subActivityRow[1]['mainactid']);
$planRow 			 = $this->cnf_strategy->get("select * from cnf_strategy where id =".$mainActivityRow[1]["planid"]);
$ministryTargetRow 	 = $this->cnf_strategy->get_row($mainActivityRow[1]["ministrytargetid"]);
$ministryStrategyRow = $this->cnf_strategy->get_row($mainActivityRow[1]['ministrystrategyid']);
$sectionTargetRow 	 = $this->cnf_strategy->get_row($mainActivityRow[1]['sectiontargetid']);
$productivityRow 	 = $this->cnf_strategy->get_row($mainActivityRow[1]['productivityid']);

?>
<br />
&nbsp;
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">การประมาณการรายจ่ายล่วงหน้าระยะปานกลางประจำปีงบประมาณ ปี <?php echo $thyear;?></td>
</tr>
<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityData[1]['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityData[1]['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityData[1]['title'];?></td>
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
		$mainTypeResult = $this->budget_type->get($sql);
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
				$secondTypeResult = $this->budget_type->get($sql);
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


<?php
function GetSummarySubActivity($pSubActID,$pQuarter,$pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$step)
{
		$url_parameter = GetCurrentUrlGetParameter();
		$CI=& get_instance();
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
		$condition  = "";
		$condition .= $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= (!empty($pPolicyType))  ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";

			$sql = "
			SELECT ".$summary."	FROM BUDGET_TYPE_DETAIL
			LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID
			LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
			LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
			LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
			WHERE  SUBACTIVITYID =".$pSubActID."
			AND BUDGET_MASTER.STEP = ".$step." AND BUDGET_MASTER.BUDGETYEAR=".$pYear.$condition."
			";
			//$result = db_query(ConvertCommand($sql));
			//$row = db_fetch_array($result,0);
			//return $row['TOTAL'];
			$row = $CI->db->GetOne($sql);
			return $row['TOTAL'];
}
function GetBudgetSummaryNextYear($pYear,$pIndex,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pZone,$pGroup,$pProvince)
{  $CI=& get_instance();
		$condition = $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$summaryYear = "BUDGET_NY".$pIndex;
	$sql = "
	SELECT SUM(".$summaryYear.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")";
	$total="";
	$result = $CI->db->GetArray($sql);
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;
}
function GetBudgetSummaryLastYear($pYear,$pSubactivity,$pStep,$pMissionType)
{   $CI=& get_instance();
	$sql = " SELECT * FROM BUDGET_MASTER WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear;
	$result = $CI->db->GetArray($sql);
	$total="";
	foreach($result as $row)
	{
			$total += $row['LASTESTIMATEBUDGET_Y'.$pIndex];
	}
	return $total;

}
function GetBudgetSummaryCurrentYear($pYear,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pZone,$pGroup,$pProvince)
{	$CI=& get_instance();
	       $summaryMonth='';
		$condition = $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	for($i=1;$i<=12;$i++)
	{
		$summaryMonth .= $summaryMonth != '' ? " + " : "";
		$summaryMonth .=" BUDGET_M".$i;
	}
	$sql = "
	SELECT SUM(".$summaryMonth.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")";

	$result = $CI->db->GetArray($sql);
	//$CI->db->debug=true;
	$total="";
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;

}
function GetBudgetSummaryCurrentYearType($pYear,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pLV,$pTypeID,$pZone,$pGroup,$pProvince)
{

	$CI=& get_instance();
	$conditionType = "";
	$conditionType .= $pLV == '1' ? " AND BUDGETTYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '2' ? " AND EXPENSETYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '3' ? " AND ID=".$pTypeID : "";

		$condition = $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$summaryMonth="";
	for($i=1;$i<=12;$i++)
	{
		$summaryMonth .= $summaryMonth != '' ? " + " : "";
		$summaryMonth .=" BUDGET_M".$i;
	}
	$sql = "
	SELECT SUM(".$summaryMonth.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")
	AND BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE 1=1 ".$conditionType
	.")";
	$result = $CI->db->GetArray($sql);
	$total = "";
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;

}

function GetBudgetSummaryNextYearType($pYear,$pIndex,$pSubactivity,$pStep,$pMissionType,$pSection,$pWorkgroup,$pLV,$pTypeID,$pZone,$pGroup,$pProvince)
{
	$CI=& get_instance();
	$conditionType = "";
	$conditionType .= $pLV == '1' ? " AND BUDGETTYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '2' ? " AND EXPENSETYPEID=".$pTypeID : "";
	$conditionType .= $pLV == '3' ? " AND ID=".$pTypeID : "";

		$condition = $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$_GET['province']." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$summaryYear = "BUDGET_NY".$pIndex;
	$sql = "
	SELECT SUM(".$summaryYear.")TOTAL FROM BUDGET_TYPE_DETAIL
	WHERE BUDGETID IN (
	SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
	LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
	WHERE SUBACTIVITYID=".$pSubactivity." AND BUDGETYEAR=".$pYear.$condition.
	")
	AND BUDGETTYPEID IN (SELECT ID FROM CNF_BUDGET_TYPE WHERE 1=1 ".$conditionType
	.")";
	$result = $CI->db->GetArray($sql);
	$total="";
	foreach($result as $row)
	{
		$total += $row['TOTAL'];
	}
	return $total;
}
?>

<script type="text/javascript">
<?php include('js/function.js'); ?>
$(document).ready(function(){
	var pProductivity,pMainActivity;
	$('#year').change(function(){
		LoadMainActivity(<?=$year;?>,$('#year option:selected').val(),'dvMainActivity');
		LoadSubActivity(<?=$year;?>,$('#year option:selected').val(),'','dvSubActivity');
	})
	$('#productivity').live('change',function(){
		pProductivity = $('#productivity option:selected').val();
		LoadMainActivity(<?=$year;?>,pProductivity,'dvMainActivity');
		LoadSubActivity(<?=$year;?>,pProductivity,'','dvSubActivity');
	});
	$('#mainactivity').live('change',function(){
		pMainActivity = $('#mainactivity option:selected').val();
		LoadSubActivity(<?=$year;?>,pProductivity,pMainActivity,'dvSubActivity');
	});
	$('#province').live('change',function(){
		var pProvince = $('#province option:selected').val();
		if(pProvince.length>0){
			LoadSection(pProvince);
		};
	});
	$('#division').live('change',function(){
		var pSection = $('#division option:selected').val();
		if(pSection.length>0){
			LoadWorkgroup(pSection);
		};
	});
	$('#missiontype').change(function(){
		LoadSubActivity(<?=$year;?>,'','','dvSubActivity');
	});

});
</script>