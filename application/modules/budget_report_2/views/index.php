<style>
	.tbReport thead th{
		text-align:center;
	}
	.tbReport th{
		font-weight:bold;
		border:solid 1px #CCC;
		padding:3px 10px;
	}
	.tbReport td{
		text-align:right;
		padding:3px 10px;
	}
</style>
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
<h3>รายงานสรุปงบประมาณรายจ่ายประจำปี จำแนกตามผลผลิตโครงการประจำปี   <?=@$budgetyear;?></h3>
<form>
<fieldset>
    <legend> ค้นหา </legend>
	<table class="tblist">
	<tr>
		<th>ปีงบประมาณ</th>
	    <td>
	    	<? echo form_dropdown("budgetyear",get_option_same("byear","cnf_set_time","1=1 and status = 1 order by byear"),@$budgetyear,'','-- เลือกปีงบประมาณ --');?>
	    </td>
	</tr>
	<tr>
	<th>ขั้นตอน</th>
	    <td>
	        <select name="step" id="step">
             <option value="1" <? if(@$_GET['step']=='1')echo "selected";?>>ขั้นตอนที่ 1 : เสนอคำของงบประมาณ  </option>
             <option value="2" <? if(@$_GET['step']=='2')echo "selected";?>>ขั้นตอนที่ 2 : ปรับปรุงคำของบประมาณตามมติ สำนักงบประมาณ</option>
             <option value="3" <? if(@$_GET['step']=='3')echo "selected";?>>ขั้นตอนที่ 3 : ปรับปรุงคำของบประมาณตามมติ ครม.</option>                          
             <option value="4" <? if(@$_GET['step']=='4')echo "selected";?>>ขั้นตอนที่ 4 : ปรับปรุงคำของบประมาณตามมติ กระทรวง</option>
             <option value="5" <? if(@$_GET['step']=='5')echo "selected";?>>ขั้นตอนที่ 5 : แปรญิตติเพิ่ม</option>
             <option value="6" <? if(@$_GET['step']=='6')echo "selected";?>>ขั้นตอนที่ 6 : ปรับปรุงคำของบประมาณจากผลการพิารณาของกรรมาธิการ</option>
             <option value="7" <? if(@$_GET['step']=='7')echo "selected";?>>ขั้นตอนที่ 7 : รายละเอียดงบประมาณตาม พรบ.</option>
             <option value="8" <? if(@$_GET['step']=='8')echo "selected";?>>ขั้นตอนที่ 8 : ปรับปรุงงบประมาณเพื่อการบริหาร</option>
             </select> 
	    </td>
	</tr>
	<tr>
		<th>ภาค</th>
	    <td>	        
	        <? echo form_dropdown("pzone",get_option("id","title","CNF_PROVINCE_ZONE","zone_type_id = 2 or zone_type_id=0 "),@$pzone,'','-- ทุกภาค --');?> 
	    </td>
	</tr>
	<tr>
		<th>กลุ่มจังหวัด</th>
	    <td>        
	    	  <? echo form_dropdown("pgroup",get_option("id","title","CNF_PROVINCE_ZONE","zone_type_id = 3 order by title "),@$pgroup,'','-- ทุกกลุ่มจังหวัด --');?> 	          
	    </td>            
	</tr>
	<tr>
		<th>จังหวัด</th>
	    <td>
	    	<div id="dvProvinceList">
	    	<? echo form_dropdown("province",get_option("id","title","CNF_PROVINCE","1=1 order by title "),@$pgroup,'','-- ทุกจังหวัด --');?> 		    	
	        </div>
	    </td>
	</tr>
	<tr>
		<th>หน่วยงาน</th>
	    <td>
	    	<div id="dvSectionList">
	    	<? 
		  		$condition = " departmentid=2 ";
		  		$condition .= login_data('budgetadmin')=='on' ? " " : " and id=".login_data('divisionid');		
		  		echo form_dropdown("divisionid",get_option("id","title","cnf_division",$condition),@$divisionid,"",'-- เลือกหน่วยงาน --');
		  	?>
	        </div>
	    </td>
	</tr>
	<tr>
		<th>กลุ่มงาน</th>
	    <td>
	    	<div id="dvWorkgroupList">
	    	<?
		    	$condition = '';
				$condition = login_data('budgetadmin')=='on' ? " divisionid in (select id from cnf_division where departmentid=2) " : " divisionid=".login_data('divisionid');
				if(login_data('budgetadmin')=='off' )$condition.= login_data('budgetcanaccessall')=='on' ? "" : " and id=".login_data('workgroupid');
				$condition = @$_GET['divisionid'] > 0 ? "  divisionid=".$_GET['divisionid'] : $condition;		
		    	echo form_dropdown("workgroupid",get_option("id","title","cnf_workgroup",$condition),@$workgroupid,"","-- เลือกกลุ่มงาน --");
		    ?>      
	        </div>
	    </td>
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
<? if($budgetyear > 0): $budgetyear= $budgetyear - 543;?>
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
<br>
<table width="95%" align="center" >
  <tr style="padding-bottom:10px;">
	<td style="padding-bottom:10px;" colspan="3" align="center">รายงานสรุปงบประมาณรายจ่ายประจำปี จำแนกตามผลผลิตโครงการประจำปี	  <?=$budgetyear+543;?></td>
</tr>
  <tr>
    <td align="left" style="padding-bottom:10px;">ภาค :
      <?    
	  			if($pzone == '' ){
					echo "ทั้งหมด";
				}
				else
				{	    					
					echo $provinceZone['title'];
				}
  ?></td>
    <td align="left" style="padding-bottom:10px;">กลุ่มจังหวัด :
      <? 		
	  			if($pgroup == '' ){
					echo "ทั้งหมด";
				}
				else
				{				
					echo $provinceGroup['title'];		
				}
		  ?></td>
    <td align="left">จังหวัด : <span style="padding-bottom:10px;">
      <? 		
	  			if($provinceid == '' )
					echo "ทั้งหมด";
				else
				{	  				
					echo $province['title'];		
				}
		  ?>
    </span></td>
  </tr>
  <tr>
  <td width="33%" align="left" style="padding-bottom:10px;">หน่วยงาน : 
  <?    
  		if($divisionid == '' ){
			echo "ทั้งหมด";
		}
		else
		{  		
			echo $section['TITLE'];
		}
  ?>
  </td>
  <td width="33%" align="left" style="padding-bottom:10px;">กลุ่มงาน : 
  <? 
		if($workgroupid=='')
		{
			echo "ทุกกลุ่มงาน";
		}
		else
		{  		
			echo $workgroup['TITLE'];
		}
  ?>
  </td>
  <td width="33%" align="left">&nbsp;</td>
</tr>
  <tr>
    <td colspan="3" align="left" style="padding-bottom:10px;">
	<? $stepName = GetStepName(); echo $stepName[$_GET['step']];?>
    &nbsp;</td>
    </tr>
</table>
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
<br>
<table class="tbReport" width="100%" align="center">
<thead>
<tr bgcolor="#EFF7E8">
	<th rowspan="3" align="center" valign="middle">ผลผลิต / โครงการ - กิจกรรม</th>
    <th colspan="2" align="center" valign="middle">ภารกิจพื้นฐาน</th>
    <th colspan="4" align="center" valign="middle">ภารกิจยุทธศาสตร์</th>
    <th colspan="3" align="center" valign="middle">รวมทั้งสิ้น</th>
    </tr> 
<tr bgcolor="#EFF7E8">
  <th rowspan="2" align="center" valign="middle">รายจ่ายขั้นต่ำฯ<br />
    (1)</th>
  <th rowspan="2" align="center" valign="middle">รายจ่ายอื่น ๆ <br />
    (2)</th>
  <th colspan="2" align="center" valign="middle">นโยบายสำคัญของรัฐบาล</th>
  <th colspan="2" align="center" valign="middle">นโยบายอื่น</th>
  <th rowspan="2" align="center" valign="middle">รวมรายจ่ายขั้นต่ำ<br />
    (7)=(1)+(3)+(5)</th>
  <th rowspan="2" align="center" valign="middle">รวมรายจ่ายอื่น ๆ<br />
    (8)=(2)+(4)+(6)</th>
  <th rowspan="2" align="center" valign="middle">รวม<br />
    (7)+(8)</th>
</tr>
<tr bgcolor="#EFF7E8">
  <th align="center" valign="middle">รายจ่ายขั้นต่ำฯ<br />
    (3)</th>
  <th align="center" valign="middle">รายจ่ายอื่น ๆ<br />
(4)</th>
  <th align="center" valign="middle">รายจ่ายขั้นต่ำฯ<br />
(5)</th>
  <th align="center" valign="middle">รายจ่ายอื่น ๆ<br />
  (6)</th>
  </tr>
</thead>     
  <tr style="background:#FFFDCF;">
  	<th>รวมหน่วยงาน</th>
                <td><? $totala = CalculateSummaryProductivityExpense($budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? $totalb = CalculateSummaryProductivityExpense($budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? $totalc = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? $totald = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? $totale = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? $totalf = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? $totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? $totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? $totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                                                
  	</tr>
  <tr style="background:#FFFDCF;">
  	<th>รวมงบประมาณผลผลิตทั้งสิ้น</th>	       
                <td><? $totala = CalculateSummaryProductivityExpense($budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? $totalb = CalculateSummaryProductivityExpense($budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? $totalc = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? $totald = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? $totale = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? $totalf = CalculateSummaryProductivityExpense( $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? $totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? $totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? $totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                                                
  	</tr>
  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select productivityid from cnf_strategy  productivity_tbl 
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".($budgetyear+543)."
				GROUP BY SUBACTIVITYID
				)
				GROUP BY PRODUCTIVITYID
				)
				ORDER BY ID
			";
	  $presult = $this->db->getarray($sql);
	  array_walk($presult,'dbConvert');
	  foreach($presult as $productivity )
	  {
		?>
    <tr style="background:#CFF1FF;">
        <th><?=$productivity['title'];?></th>
                <td><? $totala = CalculateProductivityExpense($productivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? $totalb = CalculateProductivityExpense($productivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? $totalc = CalculateProductivityExpense($productivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? $totald = CalculateProductivityExpense($productivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? $totale = CalculateProductivityExpense($productivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? $totalf = CalculateProductivityExpense($productivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? $totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? $totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? $totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                                                
  	</tr>
  	  <?
	  $sql = "SELECT ID,TITLE FROM CNF_STRATEGY WHERE ID IN
				(
				select mainactid from cnf_strategy  productivity_tbl 
				WHERE
				id in
				(
				SELECT SUBACTIVITYID FROM BUDGET_MASTER WHERE BUDGETYEAR=".($budgetyear+543)."
				GROUP BY SUBACTIVITYID
				)
				AND PRODUCTIVITYID=".$productivity['id']."
				GROUP BY mainactid
				)
			";
	  $aresult = $this->db->getarray($sql);
	  array_walk($aresult,'dbConvert');
	  foreach($aresult as $activity )
	  {
	 ?>
     <tr style="background:#FFE1CF;">
        <th><?=$activity['title'];?></th>
                <td><? $totala = CalculateMainActivityExpense($productivity['id'],$activity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? $totalb = CalculateMainActivityExpense($productivity['id'],$activity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? $totalc = CalculateMainActivityExpense($productivity['id'],$activity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? $totald = CalculateMainActivityExpense($productivity['id'],$activity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? $totale = CalculateMainActivityExpense($productivity['id'],$activity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? $totalf = CalculateMainActivityExpense($productivity['id'],$activity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? $totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? $totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? $totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                           
     </tr>         
     	<?
			$sql = "SELECT ID, TITLE FROM CNF_STRATEGY WHERE MAINACTID=".$activity['id'];
			$saresult = $this->db->getarray($sql);
			array_walk($saresult,'dbConvert');
	  		foreach($saresult as $subactivity )
			{
		?>
             <tr> 
                <th>&nbsp;&nbsp; - <?=$subactivity['title'];?></th>
                <td><? $totala = CalculateSubActivityExpense($subactivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BMINEXPENSE',''); if($totala > 0 ) echo number_format($totala,2);?>&nbsp;</td>
                <td><? $totalb = CalculateSubActivityExpense($subactivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจพื้นฐาน','BOTHEREXPENSE',''); if($totalb > 0 ) echo number_format($totalb,2);?>&nbsp;</td>
                <td><? $totalc = CalculateSubActivityExpense($subactivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายสำคัญของรัฐบาล'); if($totalc > 0 ) echo number_format($totalc,2);?>&nbsp;</td>
                <td><? $totald = CalculateSubActivityExpense($subactivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายสำคัญของรัฐบาล'); if($totald > 0 ) echo number_format($totald,2);?>&nbsp;</td>
                <td><? $totale = CalculateSubActivityExpense($subactivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BMINEXPENSE','นโยบายอื่น'); if($totale > 0 ) echo number_format($totale,2);?>&nbsp;</td>
                <td><? $totalf = CalculateSubActivityExpense($subactivity['id'], $budgetyear, $pzone, $pgroup, $provinceid, $divisionid,$workgroupid,'ภารกิจยุทธศาสตร์','BOTHEREXPENSE','นโยบายอื่น'); if($totalf > 0 ) echo number_format($totalf,2);?>&nbsp;</td>
                <td><? $totalg = $totala + $totalc + $totale; if($totalg > 0 ) echo number_format($totalg,2);?>&nbsp;</td>
                <td><? $totalh = $totalb + $totald + $totalf; if($totalh > 0 ) echo number_format($totalh,2);?>&nbsp;</td>
                <td><? $totali = $totalg + $totalh; if($totali > 0 ) echo number_format($totali,2);?>&nbsp;</td>                                               
</tr>
          <? }//ENDSubActivity ?>
     <? }//EndMainActivity ?>
  <? } ?>
  
</table>

</div>
<? endif;?>
<?
function CalculateSummaryProductivityExpense( $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType)
{
	$condition = '';
	$condition .= $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
	$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
	$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
	
		  $sql = "
				SELECT SUM(".$pExpenseType.")TOTAL FROM BUDGET_MASTER 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID 		
				IN (
					SELECT ID FROM CNF_STRATEGY WHERE 
					MAINACTID > 0 AND SYEAR=".$pYear."	
				)
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".($pYear+543)." AND STEP=".$_GET['step'].$condition
			;
			//echo $sql;
			$sql=iconv('utf-8','tis-620',$sql);			
			$CI=& get_instance();
			$result = $CI->db->getone($sql);			
			return $result;		
}

function CalculateProductivityExpense($pProductivityID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType)
{
	$condition = '';
	$condition .= $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
	$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
	$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
	
		  $sql = "
				SELECT SUM(".$pExpenseType.")TOTAL FROM BUDGET_MASTER 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID 		
				IN (
					SELECT ID FROM CNF_STRATEGY WHERE 
					ProductivityID=".$pProductivityID."  AND MAINACTID > 0 AND SYEAR=".$pYear."	
				)
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".($pYear+543)." AND STEP=".$_GET['step'].$condition
			;

			$sql=iconv('utf-8','tis-620',$sql);			
			$CI=& get_instance();
			$result = $CI->db->getone($sql);			
			return $result;	
}

function CalculateMainActivityExpense($pProductivityID,$pMainActivityID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType)
{
	$condition = '';
	$condition .= $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
	$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
	$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
	$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
	$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
	$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
	
		  $sql = "
				SELECT SUM(".$pExpenseType.")TOTAL FROM BUDGET_MASTER 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID 		
				IN (
					SELECT ID FROM CNF_STRATEGY WHERE 
					ProductivityID=".$pProductivityID." AND MainActID =".$pMainActivityID." AND MAINACTID > 0 AND SYEAR=".$pYear."	
				)
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".($pYear+543)." AND STEP=".$_GET['step'].$condition
			;
	
			$sql=iconv('utf-8','tis-620',$sql);			
			$CI=& get_instance();
			$result = $CI->db->getone($sql);			
			return $result;		
}

function CalculateSubActivityExpense($pSubActivityID, $pYear, $pZone, $pGroup, $pProvince, $pSection,$pWorkgroup,$pMissionType,$pExpenseType,$pPolicyType)
{
		$condition = '';
		$condition .= $pZone != '' ? " AND CNF_PROVINCE.ZONE='".$pZone."' ": "";
		$condition .= $pGroup != '' ? " AND CNF_PROVINCE.PGROUP=".$pGroup." " : "";
		$condition .= $pProvince != '' ? " AND CNF_DIVISION.PROVINCEID=".$pProvince." " : "";
		$condition .= $pSection != '' ? " AND CNF_DIVISION.ID=".$pSection." " : "";
		$condition .= $pWorkgroup != '' && $pWorkgroup != 'ALL' ?  " AND CNF_WORKGROUP.ID=".$pWorkgroup." " : "";
		$condition .= $pPolicyType != '' ? " AND CNMAIN.PolicyType='".$pPolicyType."' " : "";
		
			 $sql = "
				SELECT SUM(".$pExpenseType.")TOTAL FROM BUDGET_MASTER 
				LEFT JOIN CNF_WORKGROUP ON BUDGET_MASTER.WORKGROUP_ID = CNF_WORKGROUP.ID
				LEFT JOIN CNF_DIVISION ON CNF_WORKGROUP.DIVISIONID = CNF_DIVISION.ID
				LEFT JOIN CNF_PROVINCE ON CNF_DIVISION.PROVINCEID = CNF_PROVINCE.ID
				LEFT JOIN CNF_STRATEGY CNSUB ON BUDGET_MASTER.SUBACTIVITYID=CNSUB.ID 
				LEFT JOIN CNF_STRATEGY CNMAIN ON CNSUB.MAINACTID = CNMAIN.ID
				WHERE
				BUDGET_MASTER.SUBACTIVITYID = ".$pSubActivityID."			
				AND CNSUB.MISSIONTYPE='".$pMissionType."'
				AND BUDGET_MASTER.BUDGETYEAR = ".($pYear+543)." AND STEP=".$_GET['step'].$condition
			;
			$sql=iconv('utf-8','tis-620',$sql);
			$CI=& get_instance();			
			$result = $CI->db->getone($sql);			
			return $result;		
}
			//$sql=iconv('utf-8','tis-620',$sql);			
			//$result = $CI->db->getone($sql);			
			//return $result;		
?>