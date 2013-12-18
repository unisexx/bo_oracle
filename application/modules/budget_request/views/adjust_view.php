<script type="text/javascript">
$(document).ready(function(){
	
	function calculate_request(){
	$(".tr_sum_request > td").each(function(){
		var summ = 0;		
		var td_sum_request = $(this);
		td_sum_request.html('');
		var class_title = "."+$(this).attr("class");
		$("#tbAdjustBudget").find(class_title).each(function(){
			tr_class = $(this).closest("tr").attr("class");
			//alert(tr_class);
			if(tr_class != "tr_sum_request" && tr_class != "tr_sum_adjust"){
			//$(this).attr("style","background:#CCCCCC");
			//alert($(this).find("input[type=hidden]").val());			
			summ += Number($(this).find("input[type=hidden]").val().replace(/[^0-9\.]+/g,""));
			}
		})
		if(summ > 0)td_sum_request.append(new NumberFormat(summ).toFormatted())						
	})
	$(".tr_sum_adjust > td").each(function(){
		var summ = 0;		
		var tr_sum_adjust = $(this);
		tr_sum_adjust.html('');
		var class_title = "."+$(this).attr("class");
		$("#tbAdjustBudget").find(class_title).each(function(){
			tr_class = $(this).closest("tr").attr("class");
			//alert(tr_class);
			if(tr_class != "tr_sum_request" && tr_class != "tr_sum_adjust"){
			//$(this).attr("style","background:#CCCCCC");
			//alert($(this).find("input[type=hidden]").val());			
			summ += Number($(this).find("input[type=text]").val().replace(/[^0-9\.]+/g,""));
			}
		})
		if(summ > 0)tr_sum_adjust.append(new NumberFormat(summ).toFormatted())
	})
	$("#tbAdjustBudget").find(".td_summary_row").each(function(){
			var col_row_summary = $(this);
			col_row_summary.html('');
			summ = 0;
			$(this).closest("tr").find("input[type=hidden]").each(function(){
				//$(this).closest("td").attr("style","background:#CCCCCC");
				summ += Number($(this).val().replace(/[^0-9\.]+/g,""));
			})
			col_row_summary.append(new NumberFormat(summ).toFormatted())	
			summ = 0;
			$(this).closest("tr").find("input[type=text]").each(function(){
				//$(this).closest("td").attr("style","background:#CCCCCC");
				summ += Number($(this).val().replace(/[^0-9\.]+/g,""));
			})	
			if(summ > 0)col_row_summary.append("<br>"+new NumberFormat(summ).toFormatted())				
	})
	
	}
	////
	function calculate_adjust(){	
	$(".tr_sum_adjust > td").each(function(){
		var summ = 0;		
		var tr_sum_adjust = $(this);
		tr_sum_adjust.html('');
		var class_title = "."+$(this).attr("class");
		$("#tbAdjustBudget").find(class_title).each(function(){
			tr_class = $(this).closest("tr").attr("class");
			//alert(tr_class);
			if(tr_class != "tr_sum_request" && tr_class != "tr_sum_adjust"){
			//$(this).attr("style","background:#CCCCCC");
			//alert($(this).find("input[type=hidden]").val());			
			summ += Number($(this).find("input[type=text]").val().replace(/[^0-9\.]+/g,""));
			}
		})
		if(summ > 0)tr_sum_adjust.append(new NumberFormat(summ).toFormatted())
	})
	
	}
	
	
	$("input[type=text]").setMask();
	$("#frmAdjust").submit(function(){
		if(confirm('ยืนยันการปรับปรุงงบประมาณ ?')){
			return true;
		}else{
			return false;
		}
	})
	$("input[type=text]").keyup(function(){
		var col_row_summary = $(this).closest('tr').find('.td_summary_row');
			col_row_summary.html('');
			summ = 0;
			$(this).closest("tr").find("input[type=hidden]").each(function(){
				//$(this).closest("td").attr("style","background:#CCCCCC");
				summ += Number($(this).val().replace(/[^0-9\.]+/g,""));
			})
			col_row_summary.append(new NumberFormat(summ).toFormatted())	
			summ = 0;
			$(this).closest("tr").find("input[type=text]").each(function(){
				//$(this).closest("td").attr("style","background:#CCCCCC");
				summ += Number($(this).val().replace(/[^0-9\.]+/g,""));
			})	
		col_row_summary.append("<br>"+new NumberFormat(summ).toFormatted())		
		calculate_adjust();		
	})
	calculate_request();
	$("input[type=text]").hide();
	//$("input[type=text]").attr("style","border:0;text-align:right;display:none;");
})
</script>
<style type="text/css">
h4{	
	color:#F60;
	padding-top: 15px;
	padding-bottom: 15px;
}
span{
	color:#0033CC;
}
</style>

<div id="main">	
<h4 id="topic">ปรับปรุงงบประมาณ 
	<span style="color:#333333;">(ขั้นตอนที่่ <?=$nextstep;?> : <?=$steptitle[$nextstep];?> <? echo 'หน่วยงาน <span>'.$division['title'].'</span>  ปีงบประมาณ <span>'.$budgetyear.'</span>';?> )</span> 
</h4>
<br>
<form name="frmAdjust" id="frmAdjust" enctype="multipart/form-data" method="post" action="budget_request_commit/save_adjust/<?=$step;?>/<?=$divisionid;?>/<?=$budgetyear;?>">
<table id="tbAdjustBudget">
<tr>
  <th rowspan="3" style="width:500px;">กิจกรรมย่อย</th> 
  <th rowspan="3">รวม</th>
  <? 
  for($i=0;$i<count($ColID);$i++)
  {
	  if($ColParent[$i]==0)
	  {
		  $ncolumn =0;
		  //echo $ColID[$i];
		  $bType = GetBudgetType($ColID[$i]);		  			  	 
		  	for($r=0;$r<count($ColParent);$r++)
			{
					if($ColParent[$r]==$ColID[$i] && $ColParent2[$r] > -1)$ncolumn++;
			}
			$totalColumn += $ncolumn;
  ?>
	  <th colspan="<?=$ncolumn;?>" align="left"><?=$bType['title'];?></th>
  <?
	  }
  }
  ?>
  </tr>
<tr>
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
		  <th colspan="<?=$ncolumn;?>" align="center"><?=$bType['title']?></th>
	      <? }
	  }
	  ?>
  </tr>
<tr>
	  <? 
      for($i=0;$i<count($ColID);$i++)
      {
          if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
          {
              $ncolumn =0;
              $bType = GetBudgetType($ColID[$i]);		  		  

      ?>
	  <th align="center">
	  	<?=$bType['title'];?>	  	
	  </th>
      <? }
	  }
	  ?>
  </tr>
	<?
        $typeNo = 0;
		$wcondition = " AND WORKGROUP_ID IN (SELECT ID FROM CNF_WORKGROUP WHERE DIVISIONID=".$divisionid.")";
        $sql = "SELECT DISTINCT SUBACTIVITYID  FROM BUDGET_MASTER WHERE BUDGETYEAR=".$budgetyear.$wcondition." AND STEP =  ".$step;
        $result = $this->bg_master->get($sql,TRUE);
        foreach($result as $row)
        {
             $typeNo ++;
             //$budgetStrategy = GetStrategy($row['subactivityid']);
			 $budgetStrategy = $this->budget_plan->get_row($row['subactivityid']);
    ?>

<tr>
  <td style="" nowrap="nowrap"><?=$budgetStrategy['title'];?></td>
  <td class="td_summary_row" nowrap="nowrap" align="right"></td>
	  <? 
	  $ncolumn =0;
      for($i=0;$i<count($ColID);$i++)
      {
          if($ColParent[$i] > 0 && $ColParent2[$i] > 0)
          {
              $ncolumn++;
              $bType = GetBudgetType($ColID[$i]);		  		  
			  $sql = "SELECT * FROM BUDGET_ADJUST WHERE BUDGET_YEAR=".$budgetyear." AND BUDGET_TYPE_ID=".$ColID[$i]." AND ADJUST_STEP=".$step." AND SUBACTIVITY_ID=".$row['subactivityid'];
			  $srow = $this->db->getrow($sql);
			  //$srow = db_fetch_array($sresult,0);
			 if($step > 0){
		 	 $sql = "SELECT SUM(".$budgetMonth.")TOTALP FROM BUDGET_MASTER LEFT JOIN BUDGET_TYPE_DETAIL ON BUDGET_MASTER.ID = BUDGET_TYPE_DETAIL.BUDGETID
			 WHERE STEP=".$step." AND BUDGETTYPEID=".$ColID[$i]." AND BUDGET_TYPE_DETAIL.BUDGETYEAR=".$budgetyear." AND SUBACTIVITYID=".$row['subactivityid'];
			 //$presult = db_query($sql);
			 //$prow = db_fetch_array($presult,0);
			 $totalp = $this->db->getone($sql);			 
		 	 }
      ?>  
		  <td align="right" valign="bottom" class="<? if(@$totalp>0)echo 'bgFillData';?> col<?=$ncolumn;?>">
		  <?
		  $txt = '';
		  if($totalp > 0 )$txt = number_format($totalp,2);		  		 
		  if(@$srow['BUDGET_VALUE']>0)$txt.='<br>'.number_format(@$srow['BUDGET_VALUE'],2);
		  echo $txt;
		  ?>
		  <input type="hidden" name="totalp" id="totalp" class="totalp" value="<?=number_format($totalp,2);?>">	 
          <input type="text" name="<?=$budgetStrategy['id']."_".$ColID[$i];?>" id="<?=$budgetStrategy['id']."_".$ColID[$i];?>" class="txtboxAdjust Number <? if(@$totalp>0)echo 'bgFillData';?>" value="<?=number_format(@$srow['BUDGET_VALUE'],2);?>" alt="decimal"  />
          <div style="width: 150px;"></div>
          </td>
       <?
  		 }
       }
       ?>
  </tr>
 
  <tr>
  		<th></th>
		<? for($i=0;$i<=$totalColumn;$i++) { ?>
			  <td>&nbsp;</td>
  		<? } ?>
  </tr>
<? } ?>
</table>

<div style="padding-left:35%; padding-top:10px;">      	 
	<input type="button" name="button2" id="button2" value="" class="btn_back" onclick="history.back();" />
</div><!--nextstep-->
</form>
</div><!--main-->