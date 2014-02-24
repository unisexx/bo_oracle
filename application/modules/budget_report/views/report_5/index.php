<h3 id="topic">รายงานแผนการจัดสรรงบประมาณไปจังหวัดประจำปี <?php echo $thyear;?></h3>
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report/index/5" method="get">
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
  <td><?php echo form_dropdown('pzone',get_option('id','title ','cnf_province_zone','zone_type_id=2','id'),$pzone,'id="pzone"','ทุกภาค') ?></td>
</tr>
<tr>
  <th>กลุ่มจังหวัด</th>
  <td>
  	<?php echo form_dropdown('pgroup',get_option('id','title','cnf_province_zone',' zone_type_id =3','title'),$pgroup,'id="pgroup"','ทุกกลุ่มจังหวัด') ?></td>
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
<?
//$this->db->debug = true;
if($subactivity!=''){
		$subactivityData  = $this->cnf_strategy->get_row($subactivity);
		$mainactivityData = $this->cnf_strategy->get_row($subactivityData['mainactid']);
		$productivityData = $this->cnf_strategy->get_row($subactivityData['productivityid']);
?>
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
			<a href="budget_report/index/5/export<?php echo GetCurrentUrlGetParameter(); ?>">
      		<img title="Export to Excel" class="highlightit" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" /></a></tr>
    </table>

</fieldset>
    <table width="95%" align="center" >
      <tr style="padding-bottom:10px;">
        <td style="padding-bottom:10px;" colspan="3" align="center">
          <h3 id="topic2">รายงานแผนการจัดสรรงบประมาณไปจังหวัดประจำปี<?php echo $thyear;?>&nbsp;</h3></td>
      </tr>
	<tr>
  <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต : <?php echo $productivityData['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก : <?php echo $mainactivityData['title'];?></td>
  <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย : <?php echo $subactivityData['title'];?></td>
	</tr>
  <tr>
    <td align="left" style="padding-bottom:10px;">ภาค :<? echo $provinceZone;?></td>
    <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :<?php echo $provinceGroup ?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;"><?php echo $provinceName; ?></span></td>
  </tr>
  <tr>
        <td colspan="2" align="left" style="padding-bottom:10px;"><? $stepName = GetStepName(); echo $stepName[$_GET['step']];?></td>
        <td align="right">หน่วย : บาท</td>
      </tr>
    </table>
<?
	$i = 0;
	$ColID = array(-1);
	$ColTitle = array(-1);
    $ColParent = array(-1);
    $ColParent2 = array(-1);

	$condition  = "SELECT CNF_BUDGET_TYPE.BUDGETTYPEID
				  FROM BUDGET_MASTER
				  LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID
				  LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID
				  WHERE BUDGET_MASTER.BUDGETYEAR=".$year;

	$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE
			LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID
			WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY ORDERNO ";
	//$result = db_query($sql);
	$result = $this->cnf_budget_type->get($sql);
	foreach($result as $BudgetType_1)
	{
			 array_push($ColID,$BudgetType_1['id']);
			 array_push($ColTitle,$BudgetType_1['title']);
			 array_push($ColParent,0);
			 array_push($ColParent2,-1);

					$ncolumn1 = 0;
					$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." ORDER BY ORDERNO ";
					$sresult = $this->cnf_budget_type->get($sql);
					foreach($sresult as $BudgetType_2)
					{
							 array_push($ColID,$BudgetType_2['id']);
							 array_push($ColTitle,$BudgetType_2['title']);
							 array_push($ColParent,$BudgetType_1['id']);
							 array_push($ColParent2,-1);

							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY ORDERNO ";
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
<table class="tbToDoList">
<tr bgcolor="#EFF7E8">
	<td rowspan="3" nowrap="nowrap">ผลผลิต/กิจกรรมหลัก/กิจกรรมย่อย</td>
    <td rowspan="3" nowrap="nowrap" align="center">งบประมาณ <br />
      ปี
<?php echo ($thyear-1);?> <br />
ตาม พรบ.</td>
    <td rowspan="3"  nowrap="nowrap" align="center">งบประมาณ <br />
      ปี
<?php echo ($thyear);?>  <br />
(เสนอตั้ง)</td>
  <?
  for($i=0;$i<count($ColID);$i++)
  {
      if($ColParent[$i]==0)
      {
          $ncolumn =0;
          $bType = GetBudgetType($ColID[$i]);
            for($r=0;$r<count($ColParent);$r++)
            {
                    if($ColParent[$r]==$ColID[$i] && $ColParent2[$r] > -1)$ncolumn++;
            }
            $totalColumn += $ncolumn;
  ?>
      <td align="center" colspan="<?=$ncolumn;?>" ><?=$bType['title'];?></td>
  <?
      }
  }
  ?>
</tr>

<tr bgcolor="#EFF7E8">
	  <?
      for($i=0;$i<count($ColID);$i++)
      {
          if($ColParent[$i] > 0 && $ColParent2[$i] == -1)
          {
              $ncolumn =0;
              $bType = GetBudgetType($ColID[$i]);
                for($r=0;$r<count($ColParent2);$r++)
                {
                        if($ColParent2[$r]==$ColID[$i])$ncolumn++;
                }
      ?>
	  <td colspan="<?=$ncolumn;?>" align="center"><?=$bType['title']?></td>
      <? }
	  }
	  ?>
  </tr>
<tr bgcolor="#EFF7E8">
	  <?
      for($i=0;$i<count($ColID);$i++)
      {
          if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
          {
              $ncolumn =0;
              $bType = GetBudgetType($ColID[$i]);

      ?>
	  <td align="center"><?=$bType['title'];?></td>
      <? }
	  }
	  ?>
  </tr>
  <tr>
  	<td>รวมงบประมาณทั้งสิ้น</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
          <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center">
        <? $total = CalculateBySummaryProductivity($ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?>
        </td>
        <? } ?>
        <? } ?>
  </tr>
  <tr>
  	<td>รวมงบประมาณผลผลิตทั้งสิ้น</td>
	<td>&nbsp;</td>
    <td>&nbsp;</td>
          <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center">
        <? $total = CalculateBySummaryProductivity($ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?>
        </td>
        <? } ?>
        <? } ?>
  </tr>
  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select productivityid from cnf_strategy
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subactivity."
				GROUP BY SUBACTIVITYID
				)
				GROUP BY PRODUCTIVITYID
				)
			";
	  $presult = $this->cnf_strategy->get($sql);
	  foreach($presult as $productivity)
	  {
		?>
    <tr bgcolor="#00CCFF">
        <td><strong><?=$productivity['title'];?></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
          <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center"><? $total = CalculateByProductivity($productivity['id'],$ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
              <? }
              }
              ?>
  	</tr>
  	  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select mainactid from cnf_strategy
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year."
				GROUP BY SUBACTIVITYID
				)
				AND PRODUCTIVITYID=".$productivity['id']."
				GROUP BY mainactid
				)
			";
	  $aresult = $this->cnf_strategy->get($sql);
	  foreach($aresult as $activity)
	  {
	 ?>
     <tr bgcolor="#00CC99">
        <td><strong><?=$activity['title'];?></strong></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <?
          for($i=0;$i<count($ColID);$i++)
          {
              if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
              {
                  $ncolumn =0;
                  $bType = GetBudgetType($ColID[$i]);

          ?>
        <td align="center"><? $total = CalculateByMainActivity($productivity['id'],$activity['id'],$ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
	  <? }
      }
      ?>
     </tr>
     	<?
			$pcondition = " WHERE 1 = 1 ";
			$pcondition .= $pzone != '' ?  " AND ZONEID='".$pzone."' " : "";
			//$pcondition .= $pgroup != '' ?  " AND PGROUP=".$pgroup." " : "";
			$sql = "SELECT * FROM CNF_PROVINCE
			LEFT JOIN CNF_PROVINCE_DETAIL_ZONE ON PROVINCEID = CNF_PROVINCE.ID ".$pcondition."  ORDER BY ZONEID ";
			$saresult = $this->province->get($sql);
			foreach($saresult as$provinceRow)
			{
		?>
             <tr>
                <td> - <?=$provinceRow['title'];?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <?
                  for($i=0;$i<count($ColID);$i++)
                  {
                      if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
                      {
                          $ncolumn =0;
                          $bType = GetBudgetType($ColID[$i]);

                  ?>
                <td align="center"><? $total = CalculateByProvince($productivity['id'],$activity['id'],$ColID[$i],$year,$pzone,$pgroup,$provinceRow['id'],$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
                  <? }
                  }
                  ?>
                 </tr>
          <? }//ENDSubActivity ?>
     <? }//EndMainActivity ?>
  <? } ?>

</table>
<? } ?>
</div>
</body>
</html>
<script type="text/javascript">
<?php include('js/function.js'); ?>
$(document).ready(function(){
	var pgroup,yy;
	yy = $('#year option:selected').val();
	$('#year').change(function(){
		yy = $('#year option:selected').val();

		LoadSubActivity(yy,'','','dvSubActivity');
	})
	$('#pgroup').change(function(){
		pgroup = $('#pgroup option:selected').val();
		//alert(pgroup);
		if(pgroup.length>0){
			LoadProvinceGroup(pGroup);
		}
	})
});
</script>