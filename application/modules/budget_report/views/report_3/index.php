<h3 id="topic">รายงานแผนการใช้จ่ายงบประมาณจำแนกตามรายจ่ายประจำปีงบประมาณ <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset"  action="budget_report/index/3" method="get">
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
  <th>กิจกรรมย่อย <span class="red">(กรุณาเลือก)</span></th>
  <td>
    <div id="dvSubActivity">
        <?
		$condition = (!empty($productivity)) ? "  and productivityid =".$productivity : "";
		$condition = (!empty($mainactivity)) ? " and  mainactid =".$mainactivity : $condition;
	    echo form_dropdown('subactivity',get_option('id','title','cnf_strategy',' MAINACTID > 0 AND SYEAR='.$year.$condition),$subactivity,'id="subactivity"','เลือกกิจกรรมย่อย','0');  ?>
      </div>
     </td>
</tr>
<tr>
  <th>ภาค</th>
  <td><?php echo form_dropdown('pzone',get_option('id','title ','cnf_province_zone','zone_type_id=2','id'),$pzone,'id="pzone"','ภาคทั้งหมด') ?></td>
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
<div id="main">
<? if($subactivity!=''){

		$subactivityData  = $this->cnf_strategy->get_row($subactivity);
		$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
		$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);

	$i = 0;
	$ColID = array(-1);
	$ColTitle = array(-1);
    $ColParent = array(-1);
    $ColParent2 = array(-1);

	$productivityCondition = $productivity != '' ? " AND SUBACTIVITYID IN ( SELECT ID FROM CNF_STRATEGY WHERE MAINACTID > 0 AND PRODUCTIVITYID=".$productivity." ) " : "";
	$mainactCondition = $mainactivity != '' ? " AND SUBACTIVITYID IN ( SELECT ID FROM CNF_STRATEGY WHERE MAINACTID =".$mainactivity." ) " : "";
	$subactivityCondition = $subactivity != '' ? " AND SUBACTIVITYID = ".$subactivity : "";

	$acondition = !empty($_GET['pzone']) ? " AND CNF_PROVINCE_DETAIL_ZONE.ZONEID='".$_GET['pzone']."' " : "";
	//$acondition = $_GET['pgroup']!= '' ? " AND CNF_PROVINCE.PGROUP=".$_GET['pgroup']." " : "";
	$acondition = !empty($_GET['province']) ? " AND CNF_PROVINCE.ID=".$_GET['province']." " : "";
	$acondition = !empty($_GET['section']) ? " AND CNF_DIVISION.ID=".$_GET['section']." " : "";
	$acondition = !empty($_GET['workgroup']) ? " AND USERS.WORKGROUPID=".$_GET['workgroup']." " : "";

	$condition  = "
	SELECT CNF_BUDGET_TYPE.BUDGETTYPEID FROM
	BUDGET_MASTER LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID
	LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID
	LEFT JOIN USERS ON BUDGET_MASTER.CREATEBY = USERS.ID
	LEFT JOIN CNF_DIVISION ON USERS.DIVISIONID = CNF_DIVISION.ID
	LEFT JOIN CNF_WORKGROUP ON USERS.WORKGROUPID = CNF_WORKGROUP.ID
	LEFT JOIN CNF_PROVINCE ON CNF_WORKGROUP.WPROVINCEID = CNF_PROVINCE.ID
	LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON CNF_PROVINCE.ID = CNF_PROVINCE_DETAIL_ZONE.PROVINCEID
	WHERE BUDGET_MASTER.BUDGETYEAR=".$year.$productivityCondition.$mainactCondition.$subactivityCondition.$acondition;


	$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY TITLE ";
	$result = $this->cnf_budget_type->get($sql);
	foreach($result as $BudgetType_1)
	{
			 array_push($ColID,$BudgetType_1['id']);
			 array_push($ColTitle,$BudgetType_1['title']);
			 array_push($ColParent,0);
			 array_push($ColParent2,-1);

					$ncolumn1 = 0;
					$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." ORDER BY TITLE ";
					$sresult = $this->cnf_budget_type->get($sql);
					foreach($sresult  as $BudgetType_2)
					{
							 array_push($ColID,$BudgetType_2['id']);
							 array_push($ColTitle,$BudgetType_2['title']);
							 array_push($ColParent,$BudgetType_1['id']);
							 array_push($ColParent2,-1);

							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY TITLE ";
                            $ssresult = $this->cnf_budget_type->get($sql);
                            foreach($ssresult as $BudgetType_3)
                            {
								 array_push($ColID,$BudgetType_3['id']);
								 array_push($ColTitle,$BudgetType_3['title']);
								 array_push($ColParent,$BudgetType_1['id']);
								 array_push($ColParent2,$BudgetType_2['id']);
							 }

					}
	}
?>
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
			<a href="budget_report/index/3/export<?php echo GetCurrentUrlGetParameter(); ?>">
            <img title="Export to Excel" class="highlightit" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer"/></a></tr>
    </table>

</fieldset>
<table width="95%" align="center" >
      <tr style="padding-bottom:10px;">
        <td style="padding-bottom:10px;" colspan="3" align="center">แผนการใช้จ่ายงบประมาณจำแนกตามรายข่ายประจำปีงบประมาณ <?=$thyear;?></td>
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
<table width="100%">
	<tr>
    	<td align="right">หน่วย : บาท</td>
    </tr>
</table>
<table class="tbToDoList">
<tr bgcolor="#EFF7E8">
	<td rowspan="2">ผลผลิต/กิจกรรมหลัก/กิจกรรมย่อย/งบรายจ่าย</td>
  	<td rowspan="2">งบประมาณที่ได้รับ</td>
   	<td colspan="12">แผนการเบิกจ่าย</td>
</tr>
<tr bgcolor="#EFF7E8">
    <? for($i=0;$i<12;$i++)
	{
		$flag = $i<=2 ? 1 : 0;
	?>
   	<td align="center" ><?=GetMonthName('',$i);?><?=substr(($thyear-$flag),2,2);?></td>
    <? }  ?>
</tr>
<?
$productivityCondition = $productivity != '' ? " AND ID=".$productivity : "";
$mainactivityCondition = $mainactivity != '' ? " AND ID IN (SELECT PRODUCTIVITYID FROM CNF_STRATEGY WHERE ID=".$mainactivity." ) " : "";
$subactivityCondition = $subactivity != '' ? " AND ID IN (SELECT PRODUCTIVITYID FROM CNF_STRATEGY WHERE ID=".$subactivity." ) " : "";
$sql = "SELECT * FROM  CNF_STRATEGY WHERE PRODUCTIVITYID=0 AND SECTIONSTRATEGYID > 0 AND SYEAR=".$year.$productivityCondition.$mainactivityCondition.$subactivityCondition;
$productivityResult = $this->cnf_strategy->get($sql);
foreach($productivityResult as $productivityRow)
{
?>
<tr>
	<td>
	<?=$productivityRow['title'];?>
    <?
			$zone = $pzone;
			$group = $pgroup;
			//$province = $_GET['province'];
	$gtotal = 0;
	for($i=1;$i<=4;$i++)
	{
		$total[$i] = GetSummaryProductivity2($productivityRow['id'],$i,$year, $userSection,$userWorkgroup,$step,$productivity,$mainactivity,$subactivity,$zone,$group,$province);
		$gtotal += $total[$i];
	}
	?>
    &nbsp;</td>
  	<td align="right"><? if($gtotal > 0 )echo number_format($gtotal,2);?>&nbsp;</td>
   	<td colspan="3" align="center" bgcolor="#FF9999" ><? if($total[1] > 0 )echo number_format($total[1],2);?>&nbsp;</td>
  	<td colspan="3" align="center" bgcolor="#FFFF99" ><? if($total[2] > 0 )echo number_format($total[2],2);?>&nbsp;</td>
  	<td colspan="3" align="center" bgcolor="#00FF66" ><? if($total[3] > 0 )echo number_format($total[3],2);?>&nbsp;</td>
  	<td colspan="3" align="center" bgcolor="#FFCCFF" ><? if($total[4] > 0 )echo number_format($total[4],2);?>&nbsp;</td>
</tr>
		<?
			$mainactCondition = $mainactivity != '' ? " AND ID=".$mainactivity : "";
			$subactivityCondition = $subactivity != '' ? " AND ID IN (SELECT MAINACTID FROM CNF_STRATEGY WHERE ID=".$subactivity." ) " : "";
			$sql = "SELECT * FROM CNF_STRATEGY WHERE PRODUCTIVITYID=".$productivityRow['id']." AND BUDGETPOLICYID > 0 AND MAINACTID = 0 AND SYEAR=".$year.$mainactCondition.$subactivityCondition;
			$mainActivityResult = $this->cnf_strategy->get($sql);
			foreach($mainActivityResult as $mainActivityRow)
			{
		?>
            <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?=$mainActivityRow['title'];?>
                <?
				$gtotal = 0;
				for($i=0;$i<12;$i++)
				{
					$total[$i] =GetSummaryMainActivity2($mainActivityRow['id'],'',($i+1),$year,$userSection,$userWorkgroup,$step,$productivity,$mainactivity,$subactivity,$zone,$group,$province);
					$gtotal += $total[$i];
				}
				?>
                &nbsp;</td>
                <td align="right"><? if($gtotal > 0 )echo number_format($gtotal,2);?></td>
                <? for($i=0;$i<12;$i++)
                {
                ?>
                <td align="right" ><? if($total[$i]>0)echo number_format($total[$i],2);?>&nbsp;</td>
                <? }  ?>
            </tr>
					<?
						$subactivityCondition = $subactivity != '' ? " AND ID=".$subactivity : "" ;
                        $sql = "SELECT * FROM CNF_STRATEGY WHERE  MAINACTID = ".$mainActivityRow['id']." AND SYEAR=".$year.$subactivityCondition;
                        $subActivityResult = $this->cnf_strategy->get($sql);
						foreach($subActivityResult as $subActivityRow)
                        {
                    ?>
                        <tr>
                            <td>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<?=$subActivityRow['title'];?>&nbsp;
                            <?
							$gtotal = 0;
							for($i=0;$i<12;$i++)
                            {
                            $total[$i] = GetSummarySubActivity2($subActivityRow['id'],'', ($i+1),$year, $userSection,$userWorkgroup,$step,$productivity,$mainactivity,$subactivity,$zone,$group,$province);
							$gtotal += $total[$i];
							}
                            ?>
                            </td>
                            <td align="right"><? if($gtotal > 0 )echo number_format($gtotal,2);?>&nbsp;</td>
                            <? for($i=0;$i<12;$i++)
                            {
                            ?>
                            <td align="right" ><? if($total[$i] > 0)echo number_format($total[$i],2);?>&nbsp;</td>
                            <? }  ?>
                        </tr>
                    	<? } ?>
        <? } ?>
<? } ?>
  <?
  $no = 0;
  for($i=0;$i<count($ColID);$i++)
  {
      if($ColParent[$i]==0)
      {
          $bType = GetBudgetType($ColID[$i]);
		  $no++;
  ?>
  <tr bgcolor="#00CC66">
      <td align="left"  >
	  <?=$no.". ".$bType['title'];?>
		<?
		$gtotal = 0;
		for($m=0;$m<12;$m++)
        {
		 $total[$m] = GetSummaryMainBudgetTypeByMonth($ColID[$i],($m+1),'',$year,$userSection,$userWorkgroup,$step,$productivity,$mainactivity, $subactivity,$zone,$group,$province);
		 $gtotal += $total[$m];
        }
        ?>
      </td>
      <td align="right"><? if($gtotal > 0 )echo number_format($gtotal,2);?>&nbsp;</td>
		<? for($m=0;$m<12;$m++)
        {
        ?>
		<td align="right" ><? if($total[$m] > 0 ) echo number_format($total[$m],2);?>&nbsp;</td>
       <? }  ?>
  </tr>

  	  <?
      for($second=0;$second<count($ColID);$second++)
      {
          if($ColParent[$second]==$ColID[$i] && $ColParent2[$second] <0)
          {
              $secondType = GetBudgetType($ColID[$second]);
      ?>
	  		  <tr bgcolor="#00CCFF">
                <td align="left"  >
				<?=$secondType['title'];?>
                <?
				$gtotal = 0;
				for($m=0;$m<12;$m++)
                {
					$total[$m] = GetSummaryExpenseTypeByMonth($secondType['id'],($m+1),'',$year,$userSection,$userWorkgroup,$step,$productivity,$mainactivity, $subactivity,$zone,$group,$province);
					$gtotal += $total[$m];
                }
				 ?>
                &nbsp;
                </td>
                <td align="right"><? if($gtotal > 0 )echo number_format($gtotal,2);?>&nbsp;</td>
                    <? for($m=0;$m<12;$m++)
                    {
                    ?>
					<td align="right" ><? if($total[$m] > 0 ) echo number_format($total[$m],2);?>&nbsp;</td>
                    <? }  ?>
   			 </tr>


               	  <?
				  for($third=0;$third<count($ColID);$third++)
				  {
					  if($ColParent[$third]==$ColID[$i] && $ColParent2[$third] == $ColID[$second])
					  {
						  $thirdType = GetBudgetType($ColID[$third]);
				  ?>
						  <tr>
							<td align="left"  >
                            - <?=$thirdType['title'];?>
                            <?
								$gtotal = 0;
								for($m=0;$m<12;$m++)
								{
									$total[$m] = GetSummaryBudgetTypeByMonth($thirdType['id'],($m+1),'',$year,$userSection,$userWorkgroup,$step,$productivity,$mainactivity, $subactivity,$zone,$group,$province);
									$gtotal += $total[$m];
								}  ?>
                            &nbsp;</td>
							  <td align="right"><? if($gtotal > 0)echo number_format($gtotal,2);?>&nbsp;</td>
								<? for($m=0;$m<12;$m++)
								{
								?>
								<td align="right" ><?  if($total[$m] > 0 ) echo number_format($total[$m],2);?>&nbsp;</td>
								<? }  ?>
						 </tr>
				  <? }
				  }
				  ?>

      <? }
	  }
	  ?>


  <?
      }
  }
  ?>
</table>
<? } ?>
</div>
</body>
</html>

<script type="text/javascript">
<?php include('js/function.js'); ?>
$(document).ready(function(){
	var pProductivity,pMainActivity,pProvince,pZone,pSection;
	yy = $('#year option:selected').val();
	$('#year').change(function(){
		yy = $('#year option:selected').val();
		LoadProductivity(yy,'dvProductivity');
		LoadMainActivity(yy,'','dvMainActivity');
		LoadSubActivity(yy,'','','dvSubActivity');
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
		pSection = $('#division option:selected').val();
		//LoadWorkgroup(pSection);
		LoadWorkgroup(pSection,pZone,pProvince);
	});

});
</script>