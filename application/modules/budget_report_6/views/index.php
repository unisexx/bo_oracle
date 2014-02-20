<h3 id="topic">รายงานตารางแสดงคำของบประมาณระดับโครงการ/งบรายจ่าย ประจำปี <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report_6/index" method="get">
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
  <th>กิจกรรมหลัก</th>
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
<?
if($subactivity != '')
{
$subactivityData  = $this->cnf_strategy->get_row($subactivity);
$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);
}
$productivityTitle = $subactivity == '' ? " ทั้งหมด  ": $productivityData['title'];
$mainactivityTitle = $subactivity == '' ? " ทั้งหมด  ": $mainactivityData['title'];
$subactivityTitle = $subactivity == '' ? " ทั้งหมด  ": $subactivityData['title'];
//$sql = " SELECT ID FROM CNF_BUDGET_TYPE WHERE PID=0 ORDER BY ORDERNO ";
//$result = db_query($sql);
//$nBudgetType = db_num_rows($result);
$nBudgetType  = $this->budget_type->get_one("count(ID) as cnt","PID",0);
$i = 0;
//$sql = " SELECT * FROM CNF_BUDGET_TYPE WHERE PID=0 ORDER BY ORDERNO ";
//$result = db_query($sql);
//while($row = db_fetch_array($result,0))
$result = $this->budget_type->select("count(*) as cnt,*")->where("PID=0")->get()->order_by('',"orderno");
foreach($result as $item)
{
	$budgetTypeID[$i] = $row['id'];
	$budgetTypeTitle[$i] = $row['title'];
	$i++;
}
$nColumn = 2 + $nBudgetType;

	$condition = $_GET['pzone']!='' ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$_GET['pzone']."' " : "";
	//$condition .= $_GET['pgroup']!= '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$_GET['pgroup']." " : "";
	$condition .= $_GET['province']!='' ? " AND CNF_PROVINCE_CODE.ID=".$_GET['province']." " : "";
	$condition .= $_GET['section']!='' ? " AND CNF_SECTION_CODE.ID=".$_GET['section']." " : "";
	$condition .= $_GET['workgroup']!='' ? " AND USER.WORKGROUPID=".$_GET['workgroup']." " : "";
	$condition .= $subactivity!='' ? " AND SUBACTIVITYID = ".$subactivity." " : "";
	$subactivityID = '';
	 $sql = "SELECT BUDGET_MASTER.* FROM BUDGET_MASTER
	LEFT JOIN USER ON BUDGET_MASTER.CREATEBY = USER.ID
	LEFT JOIN CNF_DIVISION ON USER.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_WORKGROUP ON USER.WORKGROUPID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE_DETAIL_ZONE.PROVINCEID = CNF_PROVINCE.ID
	WHERE  BUDGETYEAR=".$year." AND STEP=".$step.$condition." ORDER BY SUBACTIVITYID ";
	$result = $this->budet_master->get($sql);
	//$result = db_query($sql);
?>
<br />
&nbsp;
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานตารางแสดงคำของบประมาณระดับโครงการ/งบรายจ่าย ประจำปี	  <?php echo $thyear;?></td>
</tr>
<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityTitle;?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityTitle;?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityTitle;?></td>
</tr>
  <tr>
    <td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
    <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :<?php echo $provinceGroup ?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
  </tr>
  <tr>
	 <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน :<?php echo $division_name?></td>
	 <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน :<?php echo $workgroup_name;?></td>
	 <td align="left">จำนวนโครงการทั้งหมด : <?php echo $this->budget_type->get_one("count(*) as cnt","pid",0);?> โครงการ</td>
</tr>
<tr>
  <td colspan="3" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?></td>
</tr>
</table>
<table class="tbToDoList">
<tr bgcolor="#EFF7E8">
    	<td>ลำดับ&nbsp;</td>
        <td>งาน/โครงการ/รายการ</td>
        <td>งบประมาณปี <?php echo $thyear-2;?></td>
        <td>งบประมาณปี <?php echo $thyear-1;?></td>
        <td colspan="<?php echo $nColumn;?>">งบประมาณปี <?php echo $thyear;?> จำแนกตามงบรายจ่าย/รายการ</td>
        <td>พื้นที่ดำเนินการ</td>
        <td>ผลลัพธ์</td>
    </tr>
	<tr bgcolor="#EFF7E8">
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>รายการ</td>
      <? for($i=0;$i<count($budgetTypeTitle);$i++){?>
	  <td><?php echo $budgetTypeTitle[$i];?>&nbsp;</td>
      <? } ?>
	  <td>รวม</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
    </tr>
    <?
	$i=0;
	$p=0;
	foreach($result as $budgetMaster)
	{
		if($subactivityID != $budgetMaster['subactivityid'])
		{
				$subactivityID = $budgetMaster['subactivityid'];
				$subactivityData = $this->cnf_strategy->get_row($subactivityID);
				$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
				$productivityData = $this->cnf_stratey->get_row($subactivityData['productivityid']);
				$productivityTitle = $subactivityID == '' ? " ทั้งหมด  ": $productivityData['title'];
				$mainactivityTitle = $subactivityID == '' ? " ทั้งหมด  ": $mainactivityData['title'];
				$subactivityTitle = $subactivityID == '' ? " ทั้งหมด  ": $subactivityData['title'];
				$p++;
				$i=0;
		?>
				 <tr style="background-color:#D7EEFF">
                  <td valign="top"><?php echo $p;?>&nbsp;</td>
                  <td valign="top">
                  กิจกรรมย่อย : <?php echo $subactivityTitle;?>&nbsp;[ <?php echo CountProject($subactivityID,$step,$year);?> โครงการ]
                  </td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;</td>
                  <?
                  $gtotal = 0;
                  for($b=0;$b<count($budgetTypeID);$b++){?>
                  <td valign="top">&nbsp;
                  </td>
                  <? } ?>
                  <td valign="top">&nbsp;</td>
                  <td valign="top">&nbsp;
                  </td>
                  <td valign="top">&nbsp;
                  </td>
                </tr>
        <?
		}

	$i++;
	?>
	<tr>
	  <td valign="top"><?php echo $p.".".$i;?>&nbsp;</td>
	  <td valign="top"><?php echo $budgetMaster['projecttitle'];?>&nbsp;</td>
	  <td valign="top"><? if($budgetMaster['lastestimatebudget_y1'] > 0 )echo number_format($budgetMaster["lastestimatebudget_y1"],2);?>&nbsp;</td>
	  <td valign="top"><? if($budgetMaster['lastestimatebudget_y2'] > 0 )echo number_format($budgetMaster["lastestimatebudget_y2"],2);?>&nbsp;</td>
	  <td valign="top">&nbsp;</td>
      <?
	  $gtotal = 0;
	  for($b=0;$b<count($budgetTypeID);$b++){?>
	  <td valign="top">
	  <?
	  $total = GetSummaryBudgetTypeExpense($budgetTypeID[$b],$budgetMaster['id'],$year,$productivity,$mainactivity,$subactivity);
	  if($total > 0 )echo number_format($total,2);
	  $gtotal += $total ;
	  ?>
      &nbsp;</td>
      <? } ?>
	  <td valign="top"><? if($gtotal > 0 ) echo number_format($gtotal,2);?>&nbsp;</td>
	  <td valign="top">
	  <?
		$operationArea = '';
		$operationArea .= $budgetMaster['chkoperationcentral']!='' ? " ส่วนกลาง " : "";

		if($budgetMaster['chkoperationregion']!='' && $operationArea!='')
			$operationArea .=" <br/>"."ส่วนภูมิภาค ";
		elseif($budgetMaster["chkoperationregion"]!='')
			$operationArea .=" <br/>"."ส่วนภูมิภาค ";

		/*$sql = "SELECT * FROM BUDGET_OPERATION_AREA
				LEFT JOIN CNF_PROVINCE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE.ID
		 		WHERE BUDGETID=".$budgetMaster['id']." ORDER BY CNF_PROVINCE.TITLE ";
		 */
		$provinceResult = $this->budget_operation_area->join("LEFT JOIN CNF_PROVINCE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE.ID")
					      ->where("BUDGETID=".$budgetMaster['id'])->order_by('',"CNF_PROVINCE.TITLE");
		foreach($provinceResult as $provinceRow)
		{
			$operationArea .="<br/>&nbsp;&nbsp;-&nbsp;".$provinceRow['title'];
		}
	  echo $operationArea;
	  ?>
      &nbsp;</td>
	  <td valign="top">
      <?
	  			$sql = " SELECT * FROM BUDGET_TYPE_DETAIL WHERE BUDGETID=".$budgetMaster['id'];
				$rresult = db_query($sql);
				while($rrow = db_fetch_array($rresult,0))
				{
						if($rrow['REMARK'] != '') echo $rrow['REMARK']."<br/>";
						if($rrow['ALLOWANCEREMARK'] != '') echo $rrow['ALLOWANCEREMARK']."<br/>";
						if($rrow['ACCOMODATIONREMARK'] != '') echo $rrow['ACCOMODATIONREMARK']."<br/>";
						if($rrow['VEHICLEREMARK'] != '') echo $rrow['VEHICLEREMARK']."<br/>";
						if($rrow['DOCUMENTREMARK'] != '') echo $rrow['DOCUMENTREMARK']."<br/>";
						if($rrow['HUMANREMARK'] != '') echo $rrow['HUMANREMARK']."<br/>";
						if($rrow['SERVICEREMARK'] != '') echo $rrow['SERVICEREMARK']."<br/>";
				}
	  ?>
      &nbsp;</td>
    </tr>
    <?
	$sql = " SELECT CNF_BUDGET_TYPE.*,(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12)AS BUDGETTOTAL
			 FROM BUDGET_TYPE_DETAIL LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_TYPE_DETAIL.BUDGETTYPEID = CNF_BUDGET_TYPE.ID
			 WHERE BUDGETID=".$budgetMaster['id'];
    $itemResult = db_query($sql);
    while($itemRow = db_fetch_array($itemResult,0))
    {
		if($itemRow['BUDGETTOTAL'] > 0 ){
	?>
    <tr>
    	<td valign="top">&nbsp;</td>
   	  <td valign="top">&nbsp;</td>
   	  <td valign="top">&nbsp;</td>
   	  <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-<?php echo $itemRow['title'];?></td>
		<?  for($b=0;$b<count($budgetTypeID);$b++){?>
          <td valign="top">
          <?
		  if($itemRow['BUDGETTYPEID']==$budgetTypeID[$b])
		  {
		    echo number_format($itemRow['BUDGETTOTAL'],2);
		  //if($total > 0 )echo number_format($total,2);
          //$gtotal += $total ;
		  }
          ?>
          &nbsp;
       </td>
      <? } ?>
    <td valign="top">&nbsp;</td>
      <td valign="top">&nbsp;</td>
        <td valign="top">&nbsp;</td>
    </tr>
    <?
		}
    }
    ?>
    <?
	} ?>
</table>
</div>
</body>
</html>
<?
function GetSummaryBudgetTypeExpense($pBudgetTypeID,$pProjectID,$pYear,$pProductivity,$pMainactivity,$pSubactivity)
{
			$sql = "
			SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID=".$pProjectID." AND BUDGETTYPEID IN (
				SELECT ID FROM CNF_BUDGET_TYPE WHERE BUDGETTYPEID=".$pBudgetTypeID." AND
				(
					EXPENSETYPEID > 0 OR ASSETTYPEID > 0
				)
			)
			";
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