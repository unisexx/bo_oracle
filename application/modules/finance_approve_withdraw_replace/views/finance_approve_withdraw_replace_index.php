<script type="text/javascript">
$(document).ready(function(){
	$('.btn_expand').click(function(){
		$(this).closest('tr').next().toggle();		  		 
			if ($(this).attr("src") == "themes/inspect/images/tree/add.jpg")
			   $(this).attr("src", "themes/inspect/images/tree/minimize.png");
			else
			   $(this).attr("src", "themes/inspect/images/tree/add.jpg");
	})	
	$('select[name=budgetyear]').live('change',function(){
		var fnyear = ($(this).val());	
		
		if(fnyear != 0){		
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgpt");
			$.post('finance_budget_related/select_fnyear_2_find_bgplantype',{
				'fnyear' : fnyear,
			},function(data){
				$("#bgpt").html(data);
			})
		}
	});	
	
	$('select[name=budgetplantype]').live('change',function(){
		var plantype = ($(this).val());	
		p_plantype=plantype;

		if(plantype != 0){			
			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#bgyt");
			$.post('finance_budget_related/select_bgplantype_find_bgyeartype',{
				'budgetplantype' : plantype,
			},function(data){
				$("#bgyt").html(data);
				$("select[name=departmentid]").removeAttr("disabled");
			})
		}
	});
	
	$('select[name=departmentid]').live('change',function(){
		var departmentid = ($(this).val());	
		
		if(departmentid != 0){		
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#div_id");
			$.post('finance_budget_related/select_department_find_division',{
				'departmentid' : departmentid,
			},function(data){
				$("#div_id").html(data);
			})
		}
		
	});
	$('select[name=divisionid]').live('change',function(){
		var divisionid = ($(this).val());	
		
		if(divisionid != 0){			
			$("<img src='images/loadingAnimation.gif' style='margin:0 0 0 5px;' />").appendTo("#workgroup_id");
			$.post('finance_budget_related/select_division_find_workgroup',{
				'divisionid' : divisionid,
			},function(data){
				$("#workgroup_id").html(data);
			})
		}
		
	});

});
</script>
<h3>อนุมัติเบิกเงินแทนกัน</h3>
<div id="search">
  <div id="searchBox">เลขที่หนังสืออนุมัติเบิกเงิน
    <input type="text" name="withdrawid" id="withdrawid" />
    ช่วงเวลา
<input name="startdate" type="text" id="startdate" size="10" class="datepicker" />
<img src="../images/calendar.png" width="16" height="16" /> ถึง
<input name="enddate" type="text" id="enddate" size="10"  class="datepicker" />
<img src="../images/calendar.png" width="16" height="16" /><br />
<br />
  <span id="dept_id"><?php echo form_dropdown('departmentid',get_option("id","title","cnf_department"),@$_GET['departmentid'],'','-- เลือกกรมที่รับผิดชอบ --')  ?></span>
  <span id="div_id"><?php echo form_dropdown('divisionid',get_option("id","title","cnf_division"),@$_GET['divisionid'],'','-- เลือกหน่วยงาน (กอง/สำนัก) --')  ?></span>
  <span id="workgroup_id"><?php echo form_dropdown('workgroupid',get_option("id","title","cnf_workgroup"),@$_GET['workgroupid'],'','-- เลือกกลุ่มงาน  --')  ?></span>
  <input type="submit" name="button9" id="button9" title="ค้นหา" value=" " class="btn_search vtip" /></div>
</div>

<div id="paging" class="frame_page">
<?=$pagination;?>  
</div>
<table class="tblist">
<tr>
  <th>&nbsp;</th>
  <th>ลำดับ</th>
  <th>รายการ</th>
  <th>เลขที่เอกสารการเบิกแทน</th>
  <th>วันที่ทำรายการ</th>
  <th>จำนวนเงิน</th>
  <th>จัดการ</th>
  </tr>
<? 
$rowclass = '';
$i=(@$_GET['page'] > 1)? (((@$_GET['page'])* 20)-20)+1:1;
foreach($dataList as $row):
$rowclass = $rowclass == '' ? 'class="odd"' : '';
$total_relate = $this->db->getone("SELECT SUM(BUDGET_COMMIT) FROM FN_WITHDRAW_REPLACE_DETAIL WHERE WITHDRAW_REPLACE_ID=".$row['id']." AND EXPENSETYPE_ID=0");
?>	  
<tr <?=$rowclass;?>>
  <td>
  	<? if(CheckExistWithdrawReplace($row['id'])>0)echo '<img src="themes/inspect/images/tree/add.jpg" width="16" height="15" class="btn_expand" />';?>  	
  </td>
  <td><?=$i;?></td>
  <td><?=$row['topic'];?></td>
  <td><?=$row['withdrawid'];?></td>
  <td><? if($row['relate_date']>0)echo stamp_to_th_fulldate($row['relate_date']);?></td>
  <td><?=number_format($total_relate,2);?></td>
  <td>
  <? if(CheckExistWithdrawReplace($row['id'])>0){
  	$summary_withdraw = $this->db->getone("SELECT SUM(withdraw) FROM FN_APPROVE_WITHDRAW_REPLACE LEFT JOIN FN_APPROVE_WITHDRAW_REPLACE_DETAIL
  	ON FN_APPROVE_WITHDRAW_REPLACE.ID = FN_APPROVE_WITHDRAW_REPLACE_DETAIL.PID 
  	WHERE REPLACEID=".$row['id']." AND EXPENSETYPE_ID=0");
	$status = $summary_withdraw == $total_relate ? "เบิกงบประมาณเรียบร้อย" : "ยังไม่เรียบร้อย";
  	echo $status;
  }else{
  ?>
  	<input type="button" name="button4" id="button4" title="อนุมัติเบิกเงิน" value=" " class="btn_approve cursor vtip" onclick="window.location='finance_approve_withdraw_replace/form/<?php echo $row['id'];?>/';" />
  <? } ?>
  </td>
</tr>
<? echo GetWithdrawReplaceList($row['id'],$i);?>
<? $i++;
	endforeach;
?>
</table>

<div id="paging" class="frame_page">
<?=$pagination;?>  
</div>