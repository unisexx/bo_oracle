<h3 id="topic">รายงานแผนการจัดสรรงบประมาณไปจังหวัดประจำปี <?php echo $thyear;?></h3>
<div id="search">
<div id="search">
<form name="frmAsset" enctype="multipart/form-data" action="budget_report_5/index" method="get">
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
  <th></th>
  <td><input type="submit" id="btnSubmit" name="btnSubmit" value="ค้นหา" class="btn_search" /></td>
</tr>
</table>
</fieldset>
</form>
</div>
<? if($subactivity!=''){ ?>
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">

      <img title="Export to Excel" class="highlightit" src="../images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" onclick="frmDelete.location='export/report_5.php?<?=$querystring;?>';" /></tr>
    </table>

</fieldset>
    <table width="95%" align="center" >
      <tr style="padding-bottom:10px;">
        <td style="padding-bottom:10px;" colspan="3" align="center"><br />
          <br />
          <h3 id="topic2">รายงานแผนการจัดสรรงบประมาณไปจังหวัดประจำปี
          <?=$thyear;?>
&nbsp;</h3></td>
      </tr>
      <tr>
        <td style="padding-bottom:10px;" align="left" width="33%">ผลผลิต :
          <?=$productivityData['TITLE'];?></td>
        <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมหลัก :
          <?=$mainactivityData['TITLE'];?></td>
        <td style="padding-bottom:10px;" align="left" width="33%">กิจกรรมย่อย :
          <?=$subactivityData['TITLE'];?></td>
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
        <td align="left">&nbsp;</td>
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

	$condition  = "SELECT CNF_BUDGET_TYPE.BUDGETTYPEID FROM BUDGET_MASTER LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID WHERE BUDGET_MASTER.BUDGETYEAR=".$year;


	$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY ORDERNO ";
	$result = db_query($sql);
	while($BudgetType_1 = db_fetch_array($result,0))
	{
			 array_push($ColID,$BudgetType_1['ID']);
			 array_push($ColTitle,$BudgetType_1['TITLE']);
			 array_push($ColParent,0);
			 array_push($ColParent2,-1);

					$ncolumn1 = 0;
					$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['ID']." ORDER BY ORDERNO ";
					$sresult = db_query($sql);
					while($BudgetType_2 = db_fetch_array($sresult,0))
					{
							 array_push($ColID,$BudgetType_2['ID']);
							 array_push($ColTitle,$BudgetType_2['TITLE']);
							 array_push($ColParent,$BudgetType_1['ID']);
							 array_push($ColParent2,-1);

							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['ID']." ORDER BY ORDERNO ";
                            $ssresult = db_query($sql);
                            while($BudgetType_3 = db_fetch_array($ssresult,0))
                            {
								 array_push($ColID,$BudgetType_3['ID']);
								 array_push($ColTitle,$BudgetType_3['TITLE']);
								 array_push($ColParent,$BudgetType_1['ID']);
								 array_push($ColParent2,$BudgetType_2['ID']);
							 }

					}
	}
?>
<table class="tbToDoList">
<tr bgcolor="#EFF7E8">
	<td rowspan="3" nowrap="nowrap">ผลผลิต/กิจกรรมหลัก/กิจกรรมย่อย</td>
    <td rowspan="3" nowrap="nowrap" align="center">งบประมาณ <br />
      ปี
<?=($thyear-1);?> <br />
ตาม พรบ.</td>
    <td rowspan="3"  nowrap="nowrap" align="center">งบประมาณ <br />
      ปี
<?=($thyear);?>  <br />
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
      <td align="center" colspan="<?=$ncolumn;?>" ><?=$bType['TITLE'];?></td>
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
	  <td colspan="<?=$ncolumn;?>" align="center"><?=$bType['TITLE']?></td>
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
	  <td align="center"><?=$bType['TITLE'];?></td>
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
				select productivityid from cnf_strategy as productivity_tbl
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year." AND SUBACTIVITYID=".$subactivity."
				GROUP BY SUBACTIVITYID
				)
				GROUP BY PRODUCTIVITYID
				)
			";
	  $presult = db_query($sql);
	  while($productivity = db_fetch_array($presult,0))
	  {
		?>
    <tr bgcolor="#00CCFF">
        <td><strong><?=$productivity['TITLE'];?></strong></td>
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
        <td align="center"><? $total = CalculateByProductivity($productivity['ID'],$ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
              <? }
              }
              ?>
  	</tr>
  	  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select mainactid from cnf_strategy as productivity_tbl
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$year."
				GROUP BY SUBACTIVITYID
				)
				AND PRODUCTIVITYID=".$productivity['ID']."
				GROUP BY mainactid
				)
			";
	  $aresult = db_query($sql);
	  while($activity = db_fetch_array($aresult,0))
	  {
	 ?>
     <tr bgcolor="#00CC99">
        <td><strong><?=$activity['TITLE'];?></strong></td>
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
        <td align="center"><? $total = CalculateByMainActivity($productivity['ID'],$activity['ID'],$ColID[$i],$year,$pzone,$pgroup,$province,$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
	  <? }
      }
      ?>
     </tr>
     	<?
			$pcondition = " WHERE 1 = 1 ";
			$pcondition .= $pzone != '' ?  " AND ZONE='".$pzone."' " : "";
			$pcondition .= $pgroup != '' ?  " AND PGROUP=".$pgroup." " : "";
			$sql = "SELECT * FROM CNF_PROVINCE_CODE ".$pcondition."  ORDER BY ZONE ";
			$saresult = db_query($sql);
			while($provinceRow = db_fetch_array($saresult,0))
			{
		?>
             <tr>
                <td> - <?=$provinceRow['TITLE'];?></td>
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
                <td align="center"><? $total = CalculateByProvince($productivity['ID'],$activity['ID'],$ColID[$i],$year,$pzone,$pgroup,$provinceRow['ID'],$userSection,$userWorkgroup); if($total > 0 ) echo number_format($total,2);?></td>
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
<?
function CalculateBySummaryProductivity($pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
//	$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
//	$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";
			$sql = "SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
				LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
				LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					 MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;
			;
			$result = db_query($sql);
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}

function CalculateByProductivity($pProductivityID, $pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
//	$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
//	$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";
			$sql = "SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
				LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
				LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					PRODUCTIVITYID =".$pProductivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;
			;
			$result = db_query($sql);
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}

function CalculateByMainActivity($pProductivityID,$pMainActivityID, $pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_SECTION_CODE.PROVINCEID=".$pProvince." " : "";
//	$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
//	$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";
			$sql = "SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
				LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
				LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					ProductivityID=".$pProductivityID." AND MainActID =".$pMainActivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;
			;
			$result = db_query($sql);
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];
}

function CalculateByProvince($pProductivityID,$pMainActivityID,$pBudgetTypeID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup)
{
	$condition .= $pZone != '' ? " AND CNF_PROVINCE_CODE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE_CODE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_PROVINCE_CODE.ID=".$pProvince." " : "";
	//$condition .= $pSection != '' ? " AND CNF_SECTION_CODE.ID=".$pSection." " : "";
	//$condition .= $pWorkgroup != '' ?  " AND CNF_WORK_GROUP.ID=".$pWorkgroup." " : "";
		 	$sql = "SELECT SUM(BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12) TOTAL
			FROM BUDGET_TYPE_DETAIL
			WHERE BUDGETID IN (
				SELECT BUDGET_MASTER.ID FROM BUDGET_MASTER
				LEFT JOIN CNF_WORK_GROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORK_GROUP.ID
				LEFT JOIN CNF_SECTION_CODE ON CNF_WORK_GROUP.SECTIONID = CNF_SECTION_CODE.ID
				LEFT JOIN CNF_PROVINCE_CODE ON CNF_SECTION_CODE.PROVINCEID = CNF_PROVINCE_CODE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (
					SELECT ID FROM CNF_STRATEGY WHERE
					ProductivityID=".$pProductivityID." AND MainActID =".$pMainActivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."
				)
				AND BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
			)
			AND BUDGETTYPEID=".$pBudgetTypeID;
			;
			$result = db_query($sql);
			$row = db_fetch_array($result,0);
			return $row['TOTAL'];

}
?>