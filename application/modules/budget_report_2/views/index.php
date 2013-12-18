<script type="text/javascript">
	$(document).ready(function(){
		function cal_summary(){
			var summ = 0 ;
			$(".td_product_exp_1").each(function(){				
				summ += Number($(this).html().replace(/[^0-9\.]+/g,""));
			})
			$(".td_sum_product_exp_1").html(new NumberFormat(summ).toFormatted());
			
			summ = 0;
			$(".td_product_exp_2").each(function(){				
				summ += Number($(this).html().replace(/[^0-9\.]+/g,""));
			})
			$(".td_sum_product_exp_2").html(new NumberFormat(summ).toFormatted());
		}
		$("select[name=divisionid]").change(function(){
			divisionid = $(this).val();
			$.post('ajax/load_workgroup_list',{
				'divisionid':divisionid,
				'canaccessall':'<? if(login_data('budgetadmin')=='on')echo 'on';else echo login_data('budgetcanaccessall');?>',
				'controlname':'workgroupid'
			},function(data){
				$("#dv_workgroup").html(data);
			})
		})
		cal_summary();
	})
</script>
<h3>ตารางแสดงความเชื่อมโยงแผนงบประมาณประจำปี  <?=@$budgetyear;?></h3>
<form>
<fieldset>
    <legend> ค้นหา </legend>
<table class="tbadd2">
<tr>
	<td>
	ปีงบประมาณ    
    <? echo form_dropdown("budgetyear",get_option("byear","varchar(byear)","cnf_set_time","status = 1 order by byear"),@$budgetyear,'','ปีงบประมาณ');?>
	ขั้นตอน    
        <select name="step" id="step">
             <option value="1" <? if(@$step=='1')echo "selected";?>>ขั้นตอนที่ 1 : เสนอคำของงบประมาณ  </option>
             <option value="2" <? if(@$step=='2')echo "selected";?>>ขั้นตอนที่ 2 : ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ</option>
             <option value="3" <? if(@$step=='3')echo "selected";?>>ขั้นตอนที่ 3 : ปรับปรุงคำของบประมาณตามมติ ครม.</option>                          
             <option value="4" <? if(@$step=='4')echo "selected";?>>ขั้นตอนที่ 4 : ปรับปรุงคำของบประมาณตามมติ กระทรวง</option>
             <option value="5" <? if(@$step=='5')echo "selected";?>>ขั้นตอนที่ 5 : แปรญัตติเพิ่ม</option>
             <option value="6" <? if(@$step=='6')echo "selected";?>>ขั้นตอนที่ 6 : ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ</option>
             <option value="7" <? if(@$step=='7')echo "selected";?>>ขั้นตอนที่ 7 : รายละเอียดงบประมาณตาม พรบ.</option>
             <option value="8" <? if(@$step=='8')echo "selected";?>>ขั้นตอนที่ 8 : ปรับปรุงงบประมาณเพื่อการบริหาร</option>
        </select> 
           หน่วยงาน
  <div id="dv_division" style="display: inline;">
  	<? 
  		$condition = " departmentid=2 ";
  		$condition .= login_data('budgetadmin')=='on' ? " " : " and id=".login_data('divisionid');		
  		echo form_dropdown("divisionid",get_option("id","title","cnf_division",$condition),@$divisionid,"",'-- เลือกหน่วยงาน --');
  	?>    
   </div>
        กลุ่มงาน
   <div id="dv_workgroup" style="display: inline;">
    <?
    	$condition = '';
		$condition = login_data('budgetadmin')=='on' ? " divisionid in (select id from cnf_division where departmentid=2) " : " divisionid=".login_data('divisionid');
		if(login_data('budgetadmin')=='off' )$condition.= login_data('budgetcanaccessall')=='on' ? "" : " and id=".login_data('workgroupid');
		$condition = @$_GET['divisionid'] > 0 ? "  divisionid=".$_GET['divisionid'] : $condition;		
    	echo form_dropdown("workgroupid",get_option("id","title","cnf_workgroup",$condition),@$workgroupid,"","-- เลือกกลุ่มงาน --");
    ?>
  </div>
    <input type="submit" id="btnSubmit" name="btnSubmit" value="ค้นหา" class="btn_search" />
    </td>
</tr>
</table>
</fieldset>
</form>
<? if($budgetyear > 0):?>
<div id="main">
<fieldset>
	<legend>ส่งออก</legend>
    <table >
    	<tr>
        	<td align="center" valign="middle">
            <a href="#" class="highlightit">
            <img title="Export to Excel" src="images/excel-button.jpg" alt="Export to Excel" width="80" height="44" align="absmiddle" style="cursor:pointer" onclick="budget_report_2/export<?=$url_parameter;?>" /></a></tr>
    </table>
</fieldset>
<?
	$i = 0;
	$ColID = array(-1);
	$ColTitle = array(-1);
    $ColParent = array(-1);
    $ColParent2 = array(-1);
	$wcondition = $divisionid > 0 ? " AND workgroup_id in (select id from cnf_workgroup where divisionid=".$divisionid.")" : "";
	$wcondition = $workgroupid > 0 ? " AND workgroup_id=".$workgroupid : $wcondition;	
	$condition  = "SELECT CNF_BUDGET_TYPE.BUDGETTYPEID FROM BUDGET_MASTER LEFT JOIN BUDGET_EXPENSE_TYPE ON BUDGET_MASTER.ID = BUDGET_EXPENSE_TYPE.BUDGETID LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_EXPENSE_TYPE.EXPENSETYPEID = CNF_BUDGET_TYPE.ID WHERE BUDGET_MASTER.BUDGETYEAR=".$budgetyear.$wcondition;		
	$sql = "SELECT CNF_BUDGET_TYPE.* FROM CNF_BUDGET_TYPE LEFT JOIN BUDGET_EXPENSE_TYPE ON CNF_BUDGET_TYPE.ID = BUDGET_EXPENSE_TYPE.EXPENSETYPEID WHERE CNF_BUDGET_TYPE.ID IN (".$condition.") ORDER BY TITLE ";
	$result = $this->budget_plan->get($sql,TRUE);
	foreach($result as $BudgetType_1)	
	{		
			 array_push($ColID,$BudgetType_1['id']);
			 array_push($ColTitle,$BudgetType_1['title']);
			 array_push($ColParent,0);
			 array_push($ColParent2,-1);							 

					$ncolumn1 = 0;
					$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_1['id']." ORDER BY TITLE ";
					$sresult = $this->budget_plan->get($sql,TRUE);
					foreach($sresult as $BudgetType_2)					
					{
							 array_push($ColID,$BudgetType_2['id']);
							 array_push($ColTitle,$BudgetType_2['title']);
							 array_push($ColParent,$BudgetType_1['id']);
							 array_push($ColParent2,-1);						

							$sql = "SELECT * FROM CNF_BUDGET_TYPE WHERE PID=".$BudgetType_2['id']." ORDER BY TITLE ";
                            $ssresult = $this->budget_plan->get($sql,TRUE);
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
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานสรุปงบประมาณรายจ่ายประจำปี จำแนกตามผลผลิตโครงการประจำปี	  <?=$budgetyear;?></td>
</tr>
<tr>
  <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน : 
  <?      		
		echo $division['title'];
  ?>
  </td>
  <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน : 
  <?   	
		if($workgroupid > 0 )
		{
			echo $workgroup['title'];
		}
		else
		{
			echo "ทุกกลุ่มงานในหน่วยงาน";
		}		
  ?>
  </td>
  <td width="33%" align="left">&nbsp;</td>
</tr>
</table>
<table class="tbReport" width="100%">
<tr bgcolor="#EFF7E8">
	<td rowspan="3" align="center" valign="middle">ผลผลิต / โครงการ - กิจกรรม</td>
    <td colspan="2" align="center" valign="middle">ภาคกิจพื้นฐาน</td>
    <td colspan="4" align="center" valign="middle">ภารกิจยุทธศาสตร์</td>
    <td colspan="3" align="center" valign="middle">รวมทั้งสิ้น</td>
    </tr>
<tr bgcolor="#EFF7E8">
  <td rowspan="2" align="center" valign="middle">รายจ่ายขั้นต่ำฯ<br />
    (1)</td>
  <td rowspan="2" align="center" valign="middle">รายจ่ายอื่น ๆ <br />
    (2)</td>
  <td colspan="2" align="center" valign="middle">นโยบายสำคัญของรัฐบาล</td>
  <td colspan="2" align="center" valign="middle">นโยบายอื่น</td>
  <td rowspan="2" align="center" valign="middle">รวมรายจ่ายขั้นต่ำ<br />
    (7)=(1)+(3)+(5)</td>
  <td rowspan="2" align="center" valign="middle">รวมรายจ่ายอื่น ๆ<br />
    (8)=(2)+(4)+(6)</td>
  <td rowspan="2" align="center" valign="middle">รวม<br />
    (7)+(8)</td>
</tr>
<tr bgcolor="#EFF7E8">
  <td align="center" valign="middle">รายจ่ายขั้นต่ำฯ<br />
    (3)</td>
  <td align="center" valign="middle">รายจ่ายอื่น ๆ<br />
(4)</td>
  <td align="center" valign="middle">รายจ่ายขั้นต่ำฯ<br />
(5)</td>
  <td align="center" valign="middle">รายจ่ายอื่น ๆ<br />
  (6)</td>
  </tr>
  <tr>
  	<td>รวมหน่วยงาน</td>
                <td><? //$totala = CalculateSummaryProductivityExpense($year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? #$totalb = CalculateSummaryProductivityExpense($year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? #$totalc = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? #$totald = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? #$totale = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? #$totalf = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? #$totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? #$totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? #$totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                                                
  	</tr>
  <tr>
  	<td>รวมงบประมาณผลผลิตทั้งสิ้น</td>	       
                <td class="td_sum_product_exp_1" align="right"><? #$totala = CalculateSummaryProductivityExpense($year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td class="td_sum_product_exp_1" align="right"><? #$totalb = CalculateSummaryProductivityExpense($year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? #$totalc = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? #$totald = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? #$totale = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? #$totalf = CalculateSummaryProductivityExpense( $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? #$totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? #$totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? #$totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                                                
  	</tr>
  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select productivityid from cnf_strategy as productivity_tbl 
				WHERE
				id in
				(
					SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear.$wcondition."
					GROUP BY SUBACTIVITYID
				)
				GROUP BY PRODUCTIVITYID
				)
			";
		
	  $presult = $this->budget_plan->get($sql,TRUE);
	  foreach($presult as $productivity)	  
	  {
		?>
    <tr>
        		<td  style="padding-left:5px;"><strong><?=$productivity['title'];?></strong></td>
                <td class="td_product_exp_1" align="right"><? $totala = CalculateProductivityExpense($productivity['id'], $budgetyear, '', '', '', $divisionid,$workgroupid,'ภารกิจพื้นฐาน','','',1); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td class="td_product_exp_2" align="right"><? $totala = CalculateProductivityExpense($productivity['id'], $budgetyear, '', '', '', $divisionid,$workgroupid,'ภารกิจพื้นฐาน','','',2); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? #$totalc = CalculateProductivityExpense($productivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? #$totald = CalculateProductivityExpense($productivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? #$totale = CalculateProductivityExpense($productivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? #$totalf = CalculateProductivityExpense($productivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? #$totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? #$totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? #$totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                                                
  	</tr>
  	  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select mainactid from cnf_strategy as productivity_tbl 
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear.$wcondition."
				GROUP BY SUBACTIVITYID
				)
				AND PRODUCTIVITYID=".$productivity['id']."
				GROUP BY mainactid
				)
			";			
	  $aresult = $this->budget_plan->get($sql,TRUE);
	  foreach($aresult as $activity)	  
	  {
	 ?>
     <tr>
        		<td  style="padding-left:10px;"><strong><?=$activity['title'];?></strong></td>
                <td align="right"><? $totala = CalculateMainActivityExpense($activity['id'], $budgetyear, '', '', '', $divisionid,$workgroupid,'ภารกิจพื้นฐาน','','',1); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td align="right"><? $totala = CalculateMainActivityExpense($activity['id'], $budgetyear, '', '', '', $divisionid,$workgroupid,'ภารกิจพื้นฐาน','','',2); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? #$totalc = CalculateMainActivityExpense($productivity['ID'],$activity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? #$totald = CalculateMainActivityExpense($productivity['ID'],$activity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? #$totale = CalculateMainActivityExpense($productivity['ID'],$activity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? #$totalf = CalculateMainActivityExpense($productivity['ID'],$activity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? #$totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? #$totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? #$totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                           
     </tr>         
     	<?
			//$sql = "SELECT ID, TITLE FROM CNF_STRATEGY WHERE MAINACTID=".$activity['id'];
			$sql = "SELECT ID,TITLE FROM CNF_STRATEGY 
				WHERE ID IN
					(				
						SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear.$wcondition." GROUP BY SUBACTIVITYID
					)
				AND PID=".$activity['id'];
			//echo $sql;				
			$saresult = $this->budget_plan->get($sql,TRUE);
			foreach($saresult as $subactivity)			
			{
		?>
             <tr class="tr_sub_activity"> 
                <td style="padding-left:20px;"> - <?=$subactivity['title'];?></td>
                <td align="right"><? $totala = CalculateSubActivityExpense($subactivity['id'], $budgetyear, '', '', '', $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BMINEXPENSE','',1); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td align="right"><? $totalb = CalculateSubActivityExpense($subactivity['id'], $budgetyear, '', '', '', $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BOTHEREXPENSE','',2); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? #$totalc = CalculateSubActivityExpense($subactivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? #$totald = CalculateSubActivityExpense($subactivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? #$totale = CalculateSubActivityExpense($subactivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? #$totalf = CalculateSubActivityExpense($subactivity['ID'], $year, $zone, $group, $province, $userSection,$userWorkgroup,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? #$totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? #$totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? #$totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                               
    </tr>
          <? }//ENDSubActivity ?>
     <? }//EndMainActivity ?>
  <? } ?>
  
</table>
</div>
<? endif;?>
<?
function CalculateProductivityExpense($productivityid, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType,$mode)
{
		$CI=& get_instance();
		//$CI->db->debug = true;
		$condition = '';
		$condition .= $pZone != '' ? " AND CNF_PROVINCEE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection > 0  ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup > 0 ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			
			 $sql = "
				SELECT SUM((
				 BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6
				 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12
				))
				FROM BUDGET_TYPE_DETAIL
				LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_TYPE_DETAIL.BUDGETTYPEID = CNF_BUDGET_TYPE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (SELECT ID FROM CNF_STRATEGY WHERE productivityid=".$productivityid." AND MAINACTID > 0 ) 			
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
				AND EXPENSETYPEMODE='".$mode."'";
			;
			$sql=iconv('utf-8','tis-620',$sql);			
			$result = $CI->db->getone($sql);			
			return $result;		
}
function CalculateMainActivityExpense($mainactid, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType,$mode)
{
		$CI=& get_instance();
		//$CI->db->debug = true;
		$condition = '';
		$condition .= $pZone != '' ? " AND CNF_PROVINCEE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection > 0  ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup > 0 ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			
			 $sql = "
				SELECT SUM((
				 BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6
				 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12
				))
				FROM BUDGET_TYPE_DETAIL
				LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_TYPE_DETAIL.BUDGETTYPEID = CNF_BUDGET_TYPE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID IN (SELECT ID FROM CNF_STRATEGY WHERE PID=".$mainactid.") 			
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
				AND EXPENSETYPEMODE='".$mode."'";
			;
			$sql=iconv('utf-8','tis-620',$sql);			
			$result = $CI->db->getone($sql);			
			return $result;		
}
function CalculateSubActivityExpense($pSubActivityID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType,$mode)
{
		$CI=& get_instance();
		//$CI->db->debug = true;
		$condition = '';
		$condition .= $pZone != '' ? " AND CNF_PROVINCEE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection > 0  ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup > 0 ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
			
			 $sql = "
				SELECT SUM((
				 BUDGET_M1 + BUDGET_M2 + BUDGET_M3 + BUDGET_M4 + BUDGET_M5 + BUDGET_M6
				 + BUDGET_M7 + BUDGET_M8 + BUDGET_M9 + BUDGET_M10 + BUDGET_M11 + BUDGET_M12
				))
				FROM BUDGET_TYPE_DETAIL
				LEFT JOIN BUDGET_MASTER ON BUDGET_TYPE_DETAIL.BUDGETID = BUDGET_MASTER.ID 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				LEFT JOIN CNF_BUDGET_TYPE ON BUDGET_TYPE_DETAIL.BUDGETTYPEID = CNF_BUDGET_TYPE.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID = ".$pSubActivityID."			
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".$pYear." AND STEP=".$_GET['step'].$condition."
				AND EXPENSETYPEMODE='".$mode."'";
			;
			$sql=iconv('utf-8','tis-620',$sql);			
			$result = $CI->db->getone($sql);			
			return $result;		
}
?>