<table class="tbToDoList" style="width:650px">
<tr>
<td colspan="2" align="center">&nbsp;</td>
</tr>
<tr>
	<td align="center">&nbsp;</td>
    <td>ปีงบประมาณ
    <?=($bmaster['budgetyear']);?></td>
</tr>
<tr>
	<td>&nbsp;</td>
    <td>กิจกรรมย่อย  <?=$subactivitydata['title'];?></td>
</tr>
<tr>
  <td align="center">&nbsp;</td>
  <td align="center"> โครงการ /กิจกรรม
    <?=$bmaster['projecttitle'];?></td>
</tr>
<tr>
	<td align="center" valign="top">1.</td>
    <td>ความสอดคล้องกับนโยบายกระทรวง/รัฐบาล/มติ ครม.</td>    
</tr>
<tr>
	<td align="left" valign="top">&nbsp;</td>
    <td><?=$bmaster['policyaccord'];?>&nbsp;</td>
</tr>    
<tr>
	<td align="center" valign="top">2.</td>
	<td>หลักการและเหตุผล</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
    <td><?=$bmaster['principles'];?>&nbsp;</td>
</tr>
<tr>
  <td valign="top">3.</td>
  <td>วัตถุประสงค์</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td><?=$bmaster['objective'];?></td>
</tr>
<tr>
  <td valign="top">4.</td>
  <td>ขั้นตอน / วิธีการ</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td>
  		<?
		foreach($bg_process as $row)
		{
			echo $row['description']."<br/>";
		}
		?>
  </td>
</tr>
<tr>
	<td valign="top">5.</td>
    <td>กลุ่มเป้าหมาย</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
    <td><?=$bmaster['targetgroup'];?>&nbsp;</td>
</tr>   
<tr>
  <td valign="top">6.</td>
  <td>ผลที่คาดว่าจะได้รับ</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td><?=$bmaster['estimateresult'];?></td>
</tr>
<tr>
  <td valign="top">7.</td>
  <td>แผนการปฏิบัติงานและแผนการใช้จ่ายงบประมาณ</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td>
<? 
		if($bmaster['subactivityid']>0)
		{
		?>
      <table  width="650" cellpadding="15" cellspacing="0" border="1" class="standard_font">
			<tr>
			  <th width="50%">ตัวชี้วัดผลผลิต</th>
			  <th>ประเภทตัวชี้วัด</th>
			  <th>หน่วยนับ</th>
			  <th>ส่งผลต่อ<br>
		      ตัวชี้วัดผลผลิต</th>
			</tr>
         <?
		$i=0;
		$srow = $subactivitydata;
		
		 $sql = "SELECT CNF_STRATEGY_DETAIL.*,CNF_COUNT_UNIT.TITLE UNIT FROM CNF_STRATEGY_DETAIL 
		 LEFT JOIN CNF_COUNT_UNIT ON CNF_STRATEGY_DETAIL.UNITTYPEID = CNF_COUNT_UNIT.ID
		 WHERE PID=".$srow['productivityid']."  ORDER  BY KEYTYPE ";
				$sresult = $this->db->getarray($sql);
				dbConvert($sresult);
				foreach($sresult as $productivity)
				{		
				$i++;
		?>	        
		
       
            <tr>
			  <td ><?=$i;?>
			    .
              <?=$productivity['title'];?></td>
			  <td ><?=$productivity['keytype'];?>&nbsp;&nbsp;</td>
			  <td ><?=$productivity['unit'];?>&nbsp;&nbsp;</td>
			  <td >
         			 <? if($productivity['keytype']=='เชิงปริมาณ'){ ?>
                     <input name="ChkWorkPlan<?=$productivity['id'];?>" type="checkbox"  id="ChkWorkPlan<?=$productivity['id'];?>" 
                      value="<?=$productivity['unittypeid'];?>" 
                      	 <? if($productivity['id']== @$bCurrentTarget['productivityid'])echo "checked";?>                     
                      />
                 		ใช่  
                     <? } ?>                                        
			  &nbsp;</td>
            </tr>

		
     	<? } ?>
        </table>
        <? } ?>  
  
  <table  class="tblist">
  	    <tr><th colspan="2">เป้าหมายปีปัจจุบัน&nbsp;
  	      <?=number_format($bCurrentTarget['SUMMARYUNIT']);?>
  	      &nbsp;
          <?
                            $sql = "SELECT * FROM CNF_COUNT_UNIT WHERE ID=".$bCurrentTarget['UNITID'];
                            $result = @db_query($sql);
                        	$srow = @db_fetch_array($result,0);
							echo $srow['TITLE'];
						?></th>
        <tr>
			  <td colspan="2"><span class="Txt_std14_blue">แผนการปฎิบัติงาน</span>
				  <table class="type1">
					<tr>
					  <th colspan="2">ไตรมาส 1</th>
					  <th colspan="2">ไตรมาส 2</th>
					  <th colspan="2">ไตรมาส 3</th>
					  <th colspan="2">ไตรมาส 4</th>
					</tr>
					<tr>
					  <td>ต.ค. </td>
					  <td><?=number_format($bCurrentTarget['M1']);?></td>
					  <td>ม.ค.</td>
					  <td><?=number_format($bCurrentTarget['M4']);?></td>
					  <td>เม.ย. </td>
					  <td><?=number_format($bCurrentTarget['M7']);?></td>
					  <td>ก.ค. </td>
					  <td><?=number_format($bCurrentTarget['M10']);?></td>
					</tr>
					<tr>
					  <td>พ.ย. </td>
					  <td><?=number_format($bCurrentTarget['M2']);?></td>
					  <td>ก.พ. </td>
					  <td><?=number_format($bCurrentTarget['M5']);?></td>
					  <td>พ.ค. </td>
					  <td><?=number_format($bCurrentTarget['M8']);?></td>
					  <td>ส.ค. </td>
					  <td><?=number_format($bCurrentTarget['M11']);?></td>
					</tr>
					<tr>
					  <td>ธ.ค. </td>
					  <td><?=number_format($bCurrentTarget['M3']);?></td>
					  <td>มี.ค </td>
					  <td><?=number_format($bCurrentTarget['M6']);?></td>
					  <td>มิ.ย. </td>
					  <td><?=number_format($bCurrentTarget['M9']);?></td>
					  <td>ก.ย. </td>
					  <td><?=number_format($bCurrentTarget['M12']);?></td>
					</tr>
					<tr>
					  <td>รวม </td>
					  <td><?=number_format($bCurrentTarget['Q1']);?></td>
					  <td>รวม </td>
					  <td><?=number_format($bCurrentTarget['Q2']);?></td>
					  <td>รวม </td>
					  <td><?=number_format($bCurrentTarget['Q3']);?></td>
					  <td>รวม</td>
					  <td><?=number_format($bCurrentTarget['Q4']);?></td>
					</tr>
			</table>
			</td>
		</tr>
        </table>
  
  &nbsp;</td>
</tr>
<tr>
  <td valign="top">8.</td>
  <td>งบประมาณทั้งโครงการ
  	&nbsp;
    <span style="color:#06F">
    <?=number_format(GetBudgetSummary('','',$_GET['id'],'','','',''),2);?>
    </span>
	บาท 
	&nbsp;รายจ่ายอื่น : <span style="color:#06F">
<?=number_format($bmaster['BOTHEREXPENSE'],2);?></span>&nbsp;บาท&nbsp;
รายจ่ายขั้นต่ำ : <span style="color:#06F"><?=number_format($bmaster['BMINEXPENSE'],2);?></span>&nbsp;บาท
</td>
</tr>
<tr>
  <td valign="top">9.</td>
  <td>ประมาณการรายจ่ายล่วงหน้าระยะปานกลาง</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td>
      <table class="type1">
      <tr>
        <th>ปีงบประมาณ</th><th>เป้าหมาย</th><th>งบประมาณ</th>
      </tr>
      <? $y=1;?>
      <tr>
        <td><?=(($bmaster['BUDGETYEAR']+$y)+543);?></td>
        <td>
		<? if($bmaster['ESTIMATEUNITTYPEID_Y'.$y]>0)
		{
			$unit = SelectData("CNF_UNIT_TYPE","WHERE ID=".$bmaster['ESTIMATEUNITTYPEID_Y'.$y]);
			echo number_format($bmaster['ESTIMATEQTY_Y'.$y],2)." ".$unit['TITLE'];
		}
		?>
        </td>
       <td>
		<? if($bmaster['ESTIMATEBUDGET_Y'.$y]>0)echo number_format($bmaster['ESTIMATEBUDGET_Y'.$y],2);?>
        </td>
      </tr>
      <? $y=2;?>
      <tr>
        <td><?=(($bmaster['BUDGETYEAR']+$y)+543);?></td>
        <td>
		<? if($bmaster['ESTIMATEUNITTYPEID_Y'.$y]>0)
		{
			$unit = SelectData("CNF_UNIT_TYPE","WHERE ID=".$bmaster['ESTIMATEUNITTYPEID_Y'.$y]);
			echo number_format($bmaster['ESTIMATEQTY_Y'.$y],2)." ".$unit['TITLE'];
		}
		?>
        </td>
       <td>
		<? if($bmaster['ESTIMATEBUDGET_Y'.$y]>0)echo number_format($bmaster['ESTIMATEBUDGET_Y'.$y],2);?>
        </td>
      </tr>    
      <? $y=3;?>
      <tr>
        <td><?=(($bmaster['BUDGETYEAR']+$y)+543);?></td>
        <td>
		<? if($bmaster['ESTIMATEUNITTYPEID_Y'.$y]>0)
		{
			$unit = SelectData("CNF_UNIT_TYPE","WHERE ID=".$bmaster['ESTIMATEUNITTYPEID_Y'.$y]);
			echo number_format($bmaster['ESTIMATEQTY_Y'.$y],2)." ".$unit['TITLE'];
		}
		?>
        </td>
       <td>
		<? if($bmaster['ESTIMATEBUDGET_Y'.$y]>0)echo number_format($bmaster['ESTIMATEBUDGET_Y'.$y],2);?>
        </td>
      </tr>                 
      </table>
  &nbsp;</td>
</tr>
<tr>
  <td valign="top">10.</td>
  <td>งบประมาณที่ใช้ในปีที่ผ่านมา</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td><table class="type1">
    <tr>
      <th>ปีงบประมาณ</th>
      <th>งบประมาณ</th>
    </tr>
    <? $y=1;?>
    <tr>
      <td><?=(($bmaster['BUDGETYEAR']-$y)+543);?></td>
      <td><? if($bmaster['LASTESTIMATEBUDGET_Y'.$y]>0)echo number_format($bmaster['LASTESTIMATEBUDGET_Y'.$y],2);?></td>
    </tr>
    <? $y=2;?>
    <tr>
      <td><?=(($bmaster['BUDGETYEAR']-$y)+543);?></td>
      <td><? if($bmaster['LASTESTIMATEBUDGET_Y'.$y]>0)echo number_format($bmaster['LASTESTIMATEBUDGET_Y'.$y],2);?></td>
    </tr>
  </table>
  
  </td>
</tr>
<tr>
	<td valign="top">11.</td>
    <td>พื้นที่ดำเนินการ </td>
</tr> 
<tr>
	<td valign="top">&nbsp;</td>
    <td>
		<?
		$operationArea = '';
		$operationArea .= $bmaster['CHKOPERATIONCENTRAL']!='' ? " ส่วนกลาง " : "";
		
		if($bmaster['CHKOPERATIONREGION']!='' && $operationArea!='')
			$operationArea .=" <br/>"."ส่วนภูมิภาค ";
		elseif($bmaster["CHKOPERATIONREGION"]!='')
			$operationArea .=" <br/>"."ส่วนภูมิภาค ";
	  	$i = 0;
		$sql = "SELECT * FROM BUDGET_OPERATION_AREA LEFT JOIN CNF_PROVINCE_CODE ON BUDGET_OPERATION_AREA.PROVINCEID = CNF_PROVINCE_CODE.ID WHERE BUDGETID=".$bmaster['ID']." ORDER BY CNF_PROVINCE_CODE.TITLE ";
		$provinceResult = db_query($sql);
		while($provinceRow = db_fetch_array($provinceResult,0))
		{
			$i=$i+1;
			$operationArea .="<br/>&nbsp;&nbsp;".$i.".&nbsp;".$provinceRow['TITLE'];
		}				  
	  echo $operationArea;
	  ?></td>
</tr>
<tr>
	<td valign="top">12.</td>
    <td>
    งบประมาณ&nbsp;&nbsp;
    ส่วนกลาง &nbsp; 
	<span style="color:#06F">
	<? if($bmaster['SUMMARYCENTRALBUDGET']>0)echo number_format($bmaster['SUMMARYCENTRALBUDGET'],2);?>
    </span>
    &nbsp;บาท&nbsp;
    ส่วนภูมิภาค&nbsp; 
    <span style="color:#06F">
    <?
		$sql = "SELECT SUM(BUDGET)TOTAL FROM BUDGET_AREA  WHERE BUDGETID=".$bmaster['ID'];
		$result = db_query($sql);
		$row = db_fetch_array($result,0);
		echo number_format($row['TOTAL'],2);
	?>
    </span>
    &nbsp;บาท&nbsp;</td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
  <td>
  <?		
  		$i=0;
		$sql = "SELECT BUDGET_AREA.*,CNF_PROVINCE_CODE.TITLE FROM BUDGET_AREA LEFT JOIN CNF_PROVINCE_CODE ON BUDGET_AREA.PROVINCEID = CNF_PROVINCE_CODE.ID WHERE BUDGETID=".$bmaster['id']." ORDER BY TITLE ";
		$result = $this->db->getarray($sql);
		dbConvert($result);
		foreach($result as $row)
		{
			$i++;
			echo $i.". ".$row['title']." : ".number_format($row['budget'],2)." บาท <br/>";
		}
	?></td>
</tr>
<tr>
  <td valign="top">13.</td>
  <td>รายละเอียดงบประมาณ</td>
</tr>
<tr>
	<td valign="top">&nbsp;</td>
    <td>
    <?
	$i = 0;
	$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=0 ORDER BY ORDERNO ";
	$result = $this->db->getarray($sql);
	dbConvert($result);
	foreach($result as $row)
	{
		$i++;
	?>    
    <p>13.<?=$i;?> <?=$row['title'];?>&nbsp;<? $total = GetSummaryBudgetType($bmaster['id'],$row['id']); if($total > 0 ) echo number_format($total,2)." บาท<br/>";
    } ?>
    </td>
</tr>
</table>